<?php

class Person extends CI_Controller
{
    private $open_id = 1101;
    private $per_page=5;
    private $student_id;
    private $name;
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }
    
    
    public function index()
    {
        $this->load->view("templates/header");
        $this->load->view("LostAndFound/Admin");
        $this->load->view("templates/footer");
    }
    
    private function getID()
    {
        $this->load->model('Info');
        $rs = $this->Info->queryVal($this->open_id);
        if (empty($rs['name'])||$rs['name']=='nothing')
        {
            $this->load->view("Bind");
            die();
        }
        $this->student_id=$rs['student_id'];
        $this->name=$rs['name'];
    }

    public function myLose($current_page = 1)
    {
        $this->getID();
        $config['per_page']=$this->per_page;
        $offset   = ($current_page - 1 ) * $config['per_page'];
        $this->load->model('LostAndFound/Lost');
        $item_info = $this->Lost->query_mine($this->student_id,$offset,$config['per_page']);
        $config['base_url'] = site_url("LostAndFound/Person/myLose/");
        $config['total_rows'] = $item_info['total'];
        $config['uri_segment'] = 4;
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
        $this->load->view('LostAndFound/Mylost',$pass);
        $this->load->view('templates/footer');
    }
    
    public function myFind($current_page = 1)
    {
        $this->getID();
        $config['per_page']=$this->per_page;
        $offset   = ($current_page - 1 ) * $config['per_page'];
        $this->load->model('LostAndFound/Found');
        $item_info = $this->Found->query_mine($this->student_id,$offset,$config['per_page']);
        $config['base_url'] = site_url("LostAndFound/Person/myFind/");
        $config['total_rows'] = $item_info['total'];
        $config['uri_segment'] = 4;
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
        $this->load->view('LostAndFound/Myfound',$pass);
        $this->load->view('templates/footer');
    }
    
}

?>