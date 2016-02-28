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
        $_SESSION['user_id']='Admin';
        $_SESSION['username']='管理员';
        $_SESSION['is_admin']=1;
    }

    
    public function index($current_page = 1)
    {
        $this->load->view('MyFind');
        
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
    
    function upd_item()
    {
        $post_data = $this->input->post();
        unset($post_data['item_type']);
        (isset($post_data['student_id']))&&($post_data['student_id']=trim($post_data['student_id']));
        (isset($post_data['release_name']))&&($post_data['release_name']=trim($post_data['release_name']));
        (isset($post_data['tel']))&&($post_data['tel']=trim($post_data['tel']));
        (isset($post_data['item_name']))&&($post_data['item_name']=trim($post_data['item_name']));
        (isset($post_data['position']))&&($post_data['position']=trim($post_data['position']));
        (isset($post_data['time']))&&($post_data['time']=trim($post_data['time']));
        (isset($post_data['detail']))&&($post_data['detail']=trim($post_data['detail']));
        $res = $this->Found->query_one($post_data['item_id']);
        if ($post_data['inform_id']!=$res[0]['inform_id']){
        $post_data['inform_change_time']=date('Y-m-d H:i:s');
        $post_data['inform_change_person']=$_SESSION['username'];
        }
        if ($post_data['receive_id']!=$res[0]['receive_id']){
        $post_data['receive_change_time']=date('Y-m-d H:i:s');
        $post_data['receive_change_person']=$_SESSION['username'];
        }

        if($this->Found->update_one($post_data))
        {
            $data = array(
                'errno' => 0
            );
        }
        else
        {
            $data = array(
                'errno' => 102,
                'error' => '更新失败，请更新数据。'
            );
        }
        echo json_encode($data);
    }

    function batchdel_item()
    {
        $item_id = $this->input->get_post("item_id");
        
        if (! $item_id) {
            $data = array(
                'errno' => 10,
                'error' => '参数有误'
            );
            die(json_encode($data));
        }
        if ($this->Found->batch_del_items($item_id)) {
            $data = array(
                'errno' => 0
            );
        } else {
            $data = array(
                'errno' => 102,
                'error' => '删除失败'
            );
        }
        echo json_encode($data);
    }
    
    
    function query_item()
    {
        $item_id = $this->input->get_post("item_id");
        $res = $this->Found->query_one($item_id);
        echo json_encode($res[0]);
    }
    
    function add_item()
    {
        $post_data = $this->input->post();
        (isset($post_data['tel']))&&($post_data['tel']=trim($post_data['tel']));
        (isset($post_data['item_name']))&&($post_data['item_name']=trim($post_data['item_name']));
        (isset($post_data['position']))&&($post_data['position']=trim($post_data['position']));
        (isset($post_data['time']))&&($post_data['time']=trim($post_data['time']));
        (isset($post_data['detail']))&&($post_data['detail']=trim($post_data['detail']));
        $post_data['student_id']=$_SESSION['user_id'];
        $post_data['release_name']=$_SESSION['username'];
        $post_data['inform_id']=0;
        $post_data['inform_change_time']=date('Y-m-d H:i:s');
        $post_data['inform_change_person']=$_SESSION['username'];
        $post_data['receive_id']=0;
        $post_data['receive_change_time']=date('Y-m-d H:i:s');
        $post_data['receive_change_person']=$_SESSION['username'];
        if($this->Found->insert_one($post_data))
        {
            $data = array(
                'errno' => 0
            );
        }
        else
        {
            $data = array(
                'errno' => 102,
                'error' => '新增失败，请再次尝试！'
            );
        }
        echo json_encode($data);
    }
    
    
}