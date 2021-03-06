<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    private function getname()
    {
        if(!isset($_SESSION['open_id']))
        {
            show_error('请关注“南京邮电大学学生事务中心”微信，从微信“i服务”菜单进入“失物招领”。', 403, $heading = '未从微信进入');
        }
        if (empty($_SESSION['name']) || $_SESSION['name'] == 'nothing'||empty($_SESSION['student_id']) || $_SESSION['student_id'] == 'nothing') {
            header('http://wechat.aifuwu.org/oauth/Binding');
        }
    }
    
	public function index()
	{
	    $head['title'] = "失物招领";
		$this->load->view('templates/header',$head);
		$this->load->view('Home');
		$this->load->view('templates/footer');
	}
	
	public function FindSquare()
	{	    
	    $head['title'] = "失物招领";
	    $this->load->view('templates/header',$head);
	    $this->load->view('FindSquare');
	    $this->load->view('templates/footer');
	}
	
	public function InsertFind()
	{
	    $this->getname();
	    $this->load->view('templates/header');
	    $this->load->view('NewFind');
	    $this->load->view('templates/footer');
	}
	
	public function LoseSquare()
	{
	    $head['title'] = "失物招领";
	    $this->load->view('templates/header',$head);
	    $this->load->view('LoseSquare');
	    $this->load->view('templates/footer');
	}
	
	public function InsertLose()
	{
	    $this->getname();
	    $this->load->view('templates/header');
	    $this->load->view('NewLose');
	    $this->load->view('templates/footer');
	}
}
