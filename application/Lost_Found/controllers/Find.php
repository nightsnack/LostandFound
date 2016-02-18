<?php

class Find extends CI_Controller
{
    private $per_page = 5;
    private $open_id = 1101;
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('Find');
        $this->load->view('templates/footer');
    }
    
    /**
     *         查询用户学号和名字
     * @return array 表内全部内容
     */
    function getname()
    {
        $this->load->model('Info');
        $rs = $this->Info->queryVal($this->open_id);
        if (empty($rs['name'])||$rs['name']=='nothing')
        {
            $rs['student_id']='';
        }
        $this->db->close();
       return $rs;
    }
    
    /**
     * 展示当前类型的全部内容，分页
     * @param number $item_type 类型数字
     * @param number $current_page 页码
     */
    public function showItems($item_type,$current_page = 1)
    {
        $this->load->model("Found");
        $config = array();
        $config['per_page']=$this->per_page;
//         $post_data = $this->input->get(NULL, TRUE);
//         $item_type = $post_data["type"];
//         $current_page = $post_data["pagenum"];
        $offset   = ($current_page - 1 ) * $config['per_page'];
        $item_info = $this->Found->query_list($item_type,$offset,$config['per_page']);
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
    
    /**
     * 显示当前物品详情，判断用户是否是发布用户
     * @param number $item_id 物品id
     */
    public function showDetail($item_id)
    {
        $personal_data = $this->getname();
        $this->load->model("Found");
        $item_info = $this->Found->query_one($item_id);
        $front=$item_info['0'];
        if ($personal_data['student_id']==$item_info['0']['student_id'])
        {
            $front['display'] = 'block';
            $front['action'] = site_url('Find/updateFind');
            $inform_detail = $this->Found->query_name_all('inform_status');
            $front['inform_select'] = $inform_detail;
            $receive_detail = $this->Found->query_name_all('receive_status');
            $front['receive_select'] = $receive_detail;
        }
        else {
            $front['display'] = 'none';
            $front['action'] = '#';
            $inform_detail = $this->Found->query_name_all('inform_status');
            $front['inform_select'] = $inform_detail;
            $receive_detail = $this->Found->query_name_all('receive_status');
            $front['receive_select'] = $receive_detail;
        }
        $this->load->view('templates/header');
        $this->load->view('FindDetails',$front);
        $this->load->view('templates/footer');
    }
    
    /**
     * 新增一个发布
     */
    public function newFind()
    {
        
        $personal_data = $this->getname();

        if ($personal_data['student_id']=='')
        {
            echo "请先绑定";
            die();
        }
        $this->load->model("Found");
        $res['view'] = $this->Found->query_name_all('item_type');
        $res['student_id'] = $personal_data['student_id'];
        $res['name'] = $personal_data['name'];
        $this->load->view('templates/header');
        $this->load->view('NewFind',$res);
        $this->load->view('templates/footer');
    }
    
    /**
     * 更改我发布的物品信息（！！注意，这个方法没有id校验，但入口只存在于 我发布的物品的详情页 ）
     * @param unknown $item_id 物品id
     */
    public function showUpdateFind($item_id)
    {
        $this->load->model("Found");
        $item_info = $this->Found->query_one($item_id);
        $front=$item_info['0'];
        $this->load->view('templates/header');
        $this->load->view('UpdateFind',$front);
        $this->load->view('templates/footer');
    }
    
    /**
     * 用来接收新增数据页面的post
     * 成功后跳转该物品详情页，失败返回新增。
     */
    public function insertNewFind()
    {
        $this->load->model("Found");
        $post_data = $this->input->post();
        $post_data['release_name']=trim($post_data['release_name']);
        $post_data['student_id'] = trim($post_data['student_id']);
        $post_data['tel']=trim($post_data['tel']);
        $post_data['item_name']=trim($post_data['item_name']);
        $post_data['position']=trim($post_data['position']);
        $post_data['time']=trim($post_data['time']);
        $post_data['detail']=trim($post_data['detail']);
        $post_data['type_id']= $this->Found->query_name_one('item_type','type_id','category',$post_data['category']);
        unset($post_data['category']);
        $post_data['inform_id'] = 0;
        $post_data['inform_change_person'] = 'System';
        $post_data['inform_change_time']=date('Y-m-d H:i:s');
        $post_data['receive_id'] = 0;
        $post_data['receive_change_person'] = 'System';
        $post_data['receive_change_time']=date('Y-m-d H:i:s');
        $res = $this->Found->insert_one($post_data);
        if  ($res['status'] === 1)
        {
            redirect("Find/showDetail/{$res['id']}");
        }
        else {
            redirect("Find/newFind");
        }
    }
    /**
     * 用来接更新物品详情的post
     * 也接改变物品通知领取状态的post
     */
    public function updateFind()
    {
        $this->load->model("Found");
        $post_data = $this->input->post();
         (isset($post_data['tel']))&&($post_data['tel']=trim($post_data['tel']));
        (isset($post_data['item_name']))&&($post_data['item_name']=trim($post_data['item_name']));
        (isset($post_data['position']))&&($post_data['position']=trim($post_data['position']));
        (isset($post_data['time']))&&($post_data['time']=trim($post_data['time']));
        (isset($post_data['detail']))&&($post_data['detail']=trim($post_data['detail']));
        $res = $this->Found->update_one($post_data);
        if ($res==1)
        {
            $url = site_url("Find/showDetail/{$post_data['item_id']}");
            echo "<script> alert('更新成功'); </script>";
            echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
        }
        else {
            $url = site_url("Find/showDetail/{$post_data['item_id']}");
            echo "<script> alert('更新失败'); </script>";
            echo "<meta http-equiv='Refresh' content='0;URL=$url'>";
        }
    }
    
    
    
}

?>