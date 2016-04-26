<?php

class Person extends CI_Controller
{
    private $per_page=15;

    
    function __construct()
    {
        parent::__construct();
        $_SESSION['open_id'] = "1101";
        $this->load->library('pagination');
        
        $this->getname();
    }
    
    
    /**
     * 查询用户学号和名字
     * 
     * @return NULL 
     */
     function getname()
    {
        if(!isset($_SESSION['open_id']))
        {
            die('{"errno":101,"error":"非法进入！"}');
        }
        
        $this->load->model('Info');
        $rs = $this->Info->queryVal($_SESSION['open_id']);
        if ($rs==NULL)
        {
            $data = array(
                'errno' => '1000',
                'error' => '请传入open_id和student_id和zhxy_psw绑定',
                'open_id' => $_SESSION['open_id']
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
        if (empty($rs['name']) || $rs['name'] == 'nothing') {
            $data = array(
                'errno' => '1001',
                'error' => '请传入open_id和zhxy_psw绑定',
                'open_id' => $_SESSION['open_id']
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
            
        }
        $_SESSION['student_id'] = $rs['student_id'];
        $_SESSION['name'] = $rs['name'];
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