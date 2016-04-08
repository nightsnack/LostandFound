<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    private function check_is_login()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    
            $this->user = array(
                'username' => $_SESSION['username'],
                'logged_in' => $_SESSION['logged_in'],
                'name' => $_SESSION['name'],
                'is_admin' => $_SESSION['is_admin']
            );
        }
        else {
            $pass=array();
            $pass['errno']=100;
            $pass['error']='未登录';
            echo json_encode($pass,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    private function check_is_admin()
    {
        if (!$_SESSION['is_admin']) {
            $pass=array();
            $pass['errno']=101;
            $pass['error']='你没有权限';
            echo json_encode($pass,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    

    public function index()
    {
        $this->check_is_login();
        $pass=$this->user;
        echo json_encode($pass);
    }

    public function secondary_user()
    {
        $this->check_is_login();
         $this->check_is_admin();
        $pass['user'] = $this->user;
        $pass['userlist'] = $this->user_model->get_all();
        echo json_encode($pass,JSON_UNESCAPED_UNICODE);
    }
    
    public function revert_user()
    {
        $username = trim($this->input->post('username'));
        $this->check_is_login();
        $this->check_is_admin();
        $data['username'] = $username;
        $data['password'] = $username;
        $status = $this->user_model->update_user($data);
        
        if ($status==1){
            $pass = array(
                'errno'=>0,
                'error'=>"重置密码成功"
            );
            echo json_encode($pass,JSON_UNESCAPED_UNICODE);
            die();
        }else {
            $pass = array(
                'errno'=>200,
                'error'=>'重置密码失败'
            );
            echo json_encode($pass,JSON_UNESCAPED_UNICODE);
            die();
        }
        
    }
    
    public function delete_user()
    {
        $username = trim($this->input->post('username'));
        $this->check_is_login();
        $this->check_is_admin();
        $status = $this->user_model->delete_user($username);
        
        if ($status==1){
            $pass = array(
                'errno'=>0,
                'error'=>"删除用户成功"
            );
            echo json_encode($pass,JSON_UNESCAPED_UNICODE);
            die();
        }
        else {
            $pass = array(
                'errno'=>200,
                'error'=>'删除用户失败'
            );
            echo json_encode($pass,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    public function register()
    {
        $username = $this->input->post('username');
        $name = $this->input->post('name');
        $password = $username;
        
        if ($this->user_model->create_user($name, $username, $password)) {
            $data = array(
                'errno' => 0
            );
            echo json_encode($data);
            die();
        } else {
            $data = array(
                'errno' => 200,
                'error' => '创建用户失败'
            );
            echo json_encode($data);
            die();
        }
    }
    
    public function change_psw()
    {
        $updatedata['username'] = $this->input->post('username');
        $updatedata['oldpassword'] = $this->input->post('oldpassword');
        $updatedata['password'] = $this->input->post('password');
    
        if (!$this->user_model->resolve_user_login($updatedata['username'], $updatedata['oldpassword'])) {
            $data = array(
                'errno' => 200,
                'error' => '原密码输入错误'
            );
            echo json_encode($data);
            die();
        }
        unset($updatedata['oldpassword']);
        if ($this->user_model->update_user($updatedata)) {
            $data = array(
                'errno' => 0
            );
            echo json_encode($data);
            die();
        } else {
            $data = array(
                'errno' => 200,
                'error' => '修改密码失败'
            );
            echo json_encode($data);
            die();
        }
    }

    public function login()
    {
        
        // create the data object
        $data = new stdClass();
        
        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        // set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == false) {
            
            // validation not ok, send validation errors to the view
            $this->load->view('templates/login/header');
            $this->load->view('user/login/login');
            $this->load->view('templates/login/footer');
        } else {
            
            // set variables from the form
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            if ($this->user_model->resolve_user_login($username, $password)) {
                
                $user = $this->user_model->get_user($username);
                // set session user datas
                echo $_SESSION['username'] = (string) $user[0]['username'];
                echo $_SESSION['name'] = (string) $user[0]['name'];
                $_SESSION['logged_in'] = (bool) true;
                $_SESSION['is_admin'] = (bool) $user[0]['is_admin'];

                // user login ok
                redirect(base_url('page/index.html'));
            } else {
                
                // login failed
                $data->error = '用户名/密码错误';
                
                // send error to the view
                $this->load->view('templates/login/header');
                $this->load->view('user/login/login', $data);
                $this->load->view('templates/login/footer');
            }
        }
    }

    public function logout()
    {
        
        // create the data object
        $data = new stdClass();
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            
            // remove session datas
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            
            // user logout ok
            $this->load->view('templates/login/header');
            $this->load->view('user/logout/logout_success', $data);
            $this->load->view('templates/login/footer');
        } else {
            
            // there user was not logged in, we cannot logged him out,
            // // redirect him to site root
            redirect('/');
        }
    }
}
