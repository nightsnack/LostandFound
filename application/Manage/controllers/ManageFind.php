<?php
class ManageFind extends CI_Controller
{
    private $per_page = 15;
    private $open_id = 1101;

    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    
    public function index($current_page = 1)
    {
        $this->load->model("LostAndFound/Found");
        $config = array();
        $config['per_page']=$this->per_page;
        $offset   = ($current_page - 1 ) * $config['per_page'];
        $item_info = $this->Found->query_all($offset,$config['per_page']);
        $config['base_url'] = site_url("ManageFind/index");
        $config['total_rows'] = $item_info['total'];
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        
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

        $this->load->view('MyFind',$pass);
        
    }
    
}