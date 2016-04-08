<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        // 初始化
        parent::__construct(); // 必须进行父类的初始化
        
    }

    function index()
    {
        $this->load->view('templates/login/header');
        $this->load->view('user/login/login');
        $this->load->view('templates/login/footer');
    }

}