<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        // 初始化
        parent::__construct(); // 必须进行父类的初始化
        
        $this->load->library('form_validation');
    }

    function index()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            
            $user = array(
                'user_id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'logged_in' => $_SESSION['logged_in'],
                'is_admin' => $_SESSION['is_admin']
            );
            
            $this->load->view('templates/manageheader');
            $this->load->view('home',$user);
            $this->load->view('templates/managefooter');
        }
        else {
            $data = new stdClass();
            $data->error = '登录超时，请重新登录';
            
            // send error to the view
            $this->load->view('templates/login/header');
            $this->load->view('user/login/login', $data);
            $this->load->view('templates/login/footer');
        }
    }

}