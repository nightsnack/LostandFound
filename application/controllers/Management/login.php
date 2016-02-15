<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
    public function __construct()
    {
        //初始化
        parent::__construct();        //必须进行父类的初始化

		$this->load->database();
		$this->load->library('form_validation');
// 		$this->load->model("Login_model");
	}
	
	function index()
	{
		$this->load->view("Back/login");
	}
	
	function logout()
	{
		$session_data=array(
			'wechat_user_id'=>'',
			'wechat_user_name'=>'',
			'wechat_md5_encode_str'=>'',
			'wechat_last_login_time'=>'',
			'wechat_last_login_ip'=>'',
			'wechat_user_role'=>'',
			'wechat_hits'=>''
		);
		$this->session->unset_userdata($session_data);

		redirect('login');
	}

	function check_login()
	{
		session_start();

		if($this->Login_model->check_user($this->input->post("user_name"),md5($this->input->post("password"))))
		{
            $output = array(
                'url_route' => site_url('main'),
                'result_code' => 0,
                'msg' => '登录成功！'
            );
		}
		else
		{
			$tx_msg="登录失败，请重试";
            $output = array(
                'result_code' => 1,
                'msg' => $tx_msg
            );
		}

        echo json_encode($output);
	}
}