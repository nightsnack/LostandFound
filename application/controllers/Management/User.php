<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct() {
		
		parent::__construct();
		$this->load->model('Management/user_model','user_model');
		
	}
	
	
	public function index() {
		
	}

	public function register() {
		
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('templates/login/header');
			$this->load->view('Management/user/register/register', $data);
			$this->load->view('templates/login/footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->user_model->create_user($username, $email, $password)) {
				
				//hash the username to generate the email confirm link
				$data_username_hash['username_hash'] = md5($username);
				
				//send confirm email
				$this->load->library('email');
				$this->email->from('iservice@njupt.edu.cn', '爱服务');
				$this->email->to($email);
				$this->email->subject('学生事务中心-注册邮箱确认');
				$this->email->message($this->load->view('Management/user/confirm_email', $data_username_hash, TRUE));
				$this->email->send();

				// user creation ok
				$this->load->view('templates/login/header');
				$this->load->view('Management/user/register/register_success', $data);
				$this->load->view('templates/login/footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('templates/login/header');
				$this->load->view('Management/user/register/register', $data);
				$this->load->view('templates/login/footer');
			}	
		}
	}

	public function confirm_email(){

		$username_hash = $this->uri->segment(3);
		$this->user_model->confirm_user_email($username_hash);
		redirect('Management/user/login');
	}

		
	public function login() {
		
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
			$this->load->view('Management/user/login/login');
			$this->load->view('templates/login/footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($username, $password)) {
				
				$user_id = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($user_id);
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['username']     = (string)$user->username;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_admin']     = (bool)$user->is_admin;
				
				// user login ok
				redirect('Management/Main');
			} else {
				
				// login failed
				$data->error = '用户名/密码错误或邮箱未验证';
				
				// send error to the view
				$this->load->view('templates/login/header');
				$this->load->view('Management/user/login/login', $data);
				$this->load->view('templates/login/footer');
				
			}
			
		}
		
	}
	
	public function logout() {
		
		// create the data object
		$data = new stdClass();
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$this->load->view('templates/login/header');
			$this->load->view('Management/user/logout/logout_success', $data);
			$this->load->view('templates/login/footer');
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
// 			// redirect him to site root
			redirect('/');
			
		}
		
	}

	public function redirect_to_login(){
		$this->load->view('redirect_to_login');
	}

	public function redirect_to_logout(){
		$this->load->view('redirect_to_logout');
	}

	public function debug(){
		$this->load->view('debug');
	}
	
}
