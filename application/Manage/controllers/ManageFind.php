<?php
header("Content-type: text/html;charset=utf-8");

class ManageFind extends CI_Controller
{
    private $per_page = 15;
    private $open_id = 1101;

    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model("LostAndFound/Found");
    }

    
    public function index($current_page = 1)
    {
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
    
    public function query_page()
    {
        $current_page = 1;
        $current_page = $this->input->get_post("pagenum");
        $offset   = ($current_page - 1 ) * $this->per_page;
        $item_info = $this->Found->query_all($offset,$this->per_page);
        $num_pages = (int) ceil($item_info['total'] / $this->per_page);
        $pass['page']= $num_pages;
        $pass['res'] = $item_info['res'];
    
        echo json_encode($pass);
    
    }
    
    function del_item()
    {
        $item_id = $this->input->get_post("item_id");
    
            if($this->Found->batch_del_items($item_id))
            {
                $data = array(
                    'errno' => 0
                );
            }
            else
            {
                $data = array(
                    'errno' => 102,
                    'error' => '删除失败'
                );
            }
        echo json_encode($data);
    }
    
    function batch_del_wechat_user()
    {
        $mp_account_id = $this->input->get_post("mp_account_id");
        $keyword_id = $this->input->get_post("tid");
    
        //        $data = array(
        //            'errno' => 10,
        //            'error' => json_encode($keyword_id)
        //        );
        //        die(json_encode($data));
    
        if(!$keyword_id)
        {
            $data = array(
                'errno' => 10,
                'error' => '参数有误'
            );
            die(json_encode($data));
        }
    
        {
            $mp_id = null;
            if($this->wechat_user->batch_del_wechat_user($keyword_id, $mp_id))
            {
                $data = array(
                    'errno' => 0
                );
            }
            else
            {
                $data = array(
                    'errno' => 102,
                    'error' => '删除失败'
                );
            }
        }
    
        echo json_encode($data);
    }
    
    
    function query_item()
    {
        $item_id = $this->input->get_post("item_id");
        $res = $this->Found->query_one($item_id);
        if($res)
        {
            $data = array(
                'errno' => 0,
                'detail'=>$res[0]
            );
        }
        else
        {
            $data = array(
                'errno' => 102,
                'error' => '查找失败'
            );
        }
        echo json_encode($data);
    }
    
    
    
    
}