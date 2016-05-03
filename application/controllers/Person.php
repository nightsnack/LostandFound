<?php

class Person extends CI_Controller
{
    private $per_page=15;

    
    function __construct()
    {
        parent::__construct();
//         $_SESSION['open_id'] = "1101";
        $this->load->library('pagination');
        
        $this->getname();
    }
    
    
    /**
     * 查询用户学号和名字
     * 
     * @return NULL 
     */
    private function getname()
    {
        if(!isset($_SESSION['open_id']))
        {
            show_error('请从微信菜单进入', 403, $heading = '请从微信菜单进入');
        }
        if (empty($_SESSION['name']) || $_SESSION['name'] == 'nothing'||empty($_SESSION['student_id']) || $_SESSION['student_id'] == 'nothing') {
            header('http://wechat.aifuwu.org/oauth/Binding');
        }
   }
    
    public function myLose($current_page = 1)
    {
        $config['per_page']=$this->per_page;
        $offset   = ($current_page - 1 ) * $config['per_page'];
        $this->load->model('Lost');
        $item_info = $this->Lost->query_mine($_SESSION['student_id'],$offset,$config['per_page']);
        $config['base_url'] = site_url("Person/myLose");
        $config['total_rows'] = $item_info['total'];
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        
        $config['full_tag_open'] = '<center><ul class="pagination">';
        $config['full_tag_close'] = '</ul></center>';
        
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        
        $config['next_link'] = '下页';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '上页';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $pass['page']= $this->pagination->create_links();
        $pass['res'] = $item_info['res'];
        $this->load->view('templates/header');
        $this->load->view('Mylose',$pass);
        $this->load->view('templates/footer');
    }
    
    public function myFind($current_page = 1 )
    {
        $config['per_page']=$this->per_page;
        $offset   = ($current_page - 1 ) * $config['per_page'];
        $this->load->model('Found');
        $item_info = $this->Found->query_mine($_SESSION['student_id'],$offset,$config['per_page']);
        $config['base_url'] = site_url("Person/myFind/");
        $config['total_rows'] = $item_info['total'];
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
    
        $config['full_tag_open'] = '<center><ul class="pagination">';
        $config['full_tag_close'] = '</ul></center>';
    
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
    
        $config['next_link'] = '下页';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
    
        $config['prev_link'] = '上页';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
    
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
    
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
    
        $this->pagination->initialize($config);
        $pass['page']= $this->pagination->create_links();
        $pass['res'] = $item_info['res'];
        $pass['url']="Find/showDetail/";
        $this->load->view('templates/header');
        $this->load->view('Myfind',$pass);
        $this->load->view('templates/footer');
    }
    
}

?>