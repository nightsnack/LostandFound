<?php

class Find extends CI_Controller
{

    private $per_page = 10;

    function __construct()
    {
        parent::__construct();
        $this->load->model("Found");
        $this->load->library('pagination');
//         $_SESSION['open_id'] = 1101;
//         $_SESSION['student_id']='B14020229';
//         $_SESSION['name'] = '蔡宇轩';
//         echo $_SESSION['open_id'];
        
    }

    /**
     * 查询用户学号和名字
     * 
     * @return array 表内全部内容
     */
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

    /**
     * 展示当前类型的全部内容，分页
     * 
     * @param
     *            number item_type 类型数字
     * @param
     *            number current_page 页码
     */
    public function showItems($item_type=1,$current_page=1)
    {        

        $config = array();
        $config['per_page']=$this->per_page;

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
        $head['title'] = "失物招领";
        $this->load->view('templates/header',$head);
        $this->load->view('FindList',$pass);
        $this->load->view('templates/footer');
    }

    /**
     * 显示当前物品详情，判断用户是否是发布用户
     * 
     * @param
     *            number itemid 物品id
     */
    public function showDetail($item_id)
    {

        $item_info = $this->Found->query_one($item_id);
        if (empty($item_info)){
            show_404();
        }
        $front = $item_info['0'];
        if ($front['uploadphotos']) {
            $front['uploadphotos'] = 'http://image.aifuwu.org/' . $front['uploadphotos'].'@400w';
        } else
            $front['uploadphotos'] = 'http://image.aifuwu.org/lostfound/default.jpg@400w';

        $head['title'] = '【捡到一件物品】'.$front['item_name'];
        $this->load->view('templates/header',$head);
        $this->load->view('FindDetails',$front);
        $this->load->view('templates/footer');
    }

    /**
     * 更改我发布的物品信息
     * 
     * @param unknown $itemid
     *            物品id
     */
    public function showUpdateFind($item_id)
    {
        $this->getname();
        $item_info = $this->Found->update_query_one($item_id);
        $front = $item_info['0'];
        if ($front['student_id'] !== $_SESSION['student_id'])
            show_404();
            else {
        if ($front['uploadphotos']) {
            $front['uploadphotos_img'] = 'http://image.aifuwu.org/' . $front['uploadphotos'].'@400w';
        } else
            $front['uploadphotos_img'] = 'http://image.aifuwu.org/lostfound/default.jpg@400w';
            }
            $this->load->view('templates/header');
            $this->load->view('UpdateFind',$front);
            $this->load->view('templates/footer');
    }

    /**
     * 用来接收新增数据页面的post
     * 成功后返回0，失败返回错误代码。
     */
    function insertItem()
    {   
        $this->getname();
        $post_data = $this->input->post(); 
        if ($post_data['item_name'] && $post_data['tel'] && $post_data['type_id']) {
            (isset($post_data['tel'])) && ($post_data['tel'] = trim($post_data['tel']));
            (isset($post_data['item_name'])) && ($post_data['item_name'] = trim($post_data['item_name']));
            (isset($post_data['position'])) && ($post_data['position'] = trim($post_data['position']));
            (isset($post_data['time'])) && ($post_data['time'] = trim($post_data['time']));
            (isset($post_data['detail'])) && ($post_data['detail'] = trim($post_data['detail']));
            $post_data['student_id'] = $_SESSION['student_id'];
            $post_data['release_name'] = $_SESSION['name'];
            $post_data['create_time'] = date('Y-m-d H:i:s');
            $post_data['inform_id'] = 0;
            $post_data['inform_change_time'] = date('Y-m-d H:i:s');
            $post_data['inform_change_person'] = $_SESSION['name'];
            $post_data['receive_id'] = 0;
            $post_data['receive_change_time'] = date('Y-m-d H:i:s');
            $post_data['receive_change_person'] = $_SESSION['name'];
            $insert_return = $this->Found->insert_one($post_data);
            if ($insert_return['status']) {
                $data = array(
                    'errno' => 0,
                    'item_id'=>$insert_return['id']
                );
            } else {
                $data = array(
                    'errno' => 102,
                    'error' => '新增失败，请再次尝试！'
                );
            }
        } else {
            $data = array(
                'errno' => 103,
                'error' => '请将信息填写完整！'
            );
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }

    /**
     * 用来接更新物品详情的post
     * 也接改变物品通知领取状态的post
     * 前端需要校验的参数 item_name、tel（数据库里设置这个不为0）
     * 可接受任何参数的更改，但不允许更改
     */
    function updateItem()
    {
        $this->getname();
        $post_data = $this->input->post();
        if (isset($post_data['item_id'])) {
            (isset($post_data['tel'])) && ($post_data['tel'] = trim($post_data['tel']));
            (isset($post_data['item_name'])) && ($post_data['item_name'] = trim($post_data['item_name']));
            (isset($post_data['position'])) && ($post_data['position'] = trim($post_data['position']));
            (isset($post_data['time'])) && ($post_data['time'] = trim($post_data['time']));
            (isset($post_data['detail'])) && ($post_data['detail'] = trim($post_data['detail']));
            $res = $this->Found->query_one($post_data['item_id']);
            if ($res[0]['student_id'] !== $_SESSION['student_id'])
                            show_404();
            if (isset($post_data['inform_id'])&&$post_data['inform_id'] != $res[0]['inform_id']) {
                $post_data['inform_change_time'] = date('Y-m-d H:i:s');
                $post_data['inform_change_person'] = $_SESSION['name'];
            }
            if (isset($post_data['receive_id'])&&$post_data['receive_id'] != $res[0]['receive_id']) {
                $post_data['receive_change_time'] = date('Y-m-d H:i:s');
                $post_data['receive_change_person'] = $_SESSION['name'];
            }
            
            if ($this->Found->update_one($post_data)) {
                $data = array(
                    'errno' => 0
                );
            } else {
                $data = array(
                    'errno' => 102,
                    'error' => '更新失败，请更新数据。'
                );
            }
        } else {
            $data = array(
                'errno' => 103,
                'error' => '请将信息填写完整！'
            );
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
}

?>