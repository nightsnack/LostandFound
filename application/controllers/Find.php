<?php

class Find extends CI_Controller
{
    private $per_page = 5;
    
    function __construct()
    {
        parent::__construct();
        $this->load->model("Items");
        $this->load->library('pagination');
    }
    
    public function showItems($item_type,$current_page = 1)
    {
        $config = array();
        $config['per_page']=$this->per_page;
//         $post_data = $this->input->get(NULL, TRUE);
//         $item_type = $post_data["type"];
//         $current_page = $post_data["pagenum"];
        $offset   = ($current_page - 1 ) * $config['per_page'];
        $item_info = $this->Items->query_list($item_type,$offset,$config['per_page']);
        $config['base_url'] = site_url("Find/showItems/$item_type");
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
//        var_dump($item_info['res']);
        $this->load->view('templates/header');
		$this->load->view('FindFeedback',$pass);
		$this->load->view('templates/footer');
    }
    
    public function showDetail($item_id)
    {
        $item_info = $this->Items->query_one($item_id);
        $this->load->view('templates/header');
        $this->load->view('FindDetails',$item_info['0']);
        $this->load->view('templates/footer');
    }
    
    public function newFind()
    {
        $res['view'] = $this->Items->queryNameAll('item_type');

        $this->load->view('templates/header');
        $this->load->view('NewFind',$res);
        $this->load->view('templates/footer');
    }
    
    public function InsertnewFind()
    {
        $post_data = $this->input->post_get(NULL,TRUE);
//         ($post_data['name']!=='')&&($name = $post_data['name']);
//         ($post_data['studentID']!=='')&&($studentID = $post_data['studentID']);
//         ($post_data['cellphone']!=='')&&($cellphone = $post_data['name']);
//         ($post_data['name']!=='')&&($name = $post_data['name']);
//         ($post_data['name']!=='')&&($name = $post_data['name']);
//         ($post_data['name']!=='')&&($name = $post_data['name']);
//        $post_data['type'];
        $post_data[] = $this->Items->queryName('item_type','type_id',$post_data['type']);
    }
    
}

?>