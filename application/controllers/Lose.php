<?php

class Lose extends CI_Controller
{

    private $per_page = 10;



    function __construct()
    {
        parent::__construct();
        $this->load->model("Lost");
        $this->load->library('pagination');
//         $_SESSION['open_id'] = 1101;
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
            show_404();
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
        $item_info = $this->Lost->query_list($item_type,$offset,$config['per_page']);
        $config['base_url'] = site_url("Lose/showItems/$item_type");
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
        $this->load->view('Loselist',$pass);
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
        $this->getname();
        $this->load->model('Info');
        $judge = $this->Info->queryVal($_SESSION['open_id']);

        $item_info = $this->Lost->query_one($item_id);
        if (empty($item_info)){
            show_404();
        }
        $front = $item_info['0'];
        if ($front['uploadphotos']) {
            $front['uploadphotos'] = 'http://image.aifuwu.org/' . $front['uploadphotos'].'@400w';
        } else
            $front['uploadphotos'] = 'http://image.aifuwu.org/lostfound/default.jpg@400w';
        if (isset($judge['student_id'])&&$judge['student_id'] == $item_info['0']['student_id']) {
            $front['is_mine'] = 1;
        }else $front['is_mine'] = 0;
        $this->load->view('templates/header');
        $this->load->view('LoseDetails',$front);
        $this->load->view('templates/footer');
    }

    /**
     * 更改我发布的物品信息
     * 
     * @param unknown $itemid
     *            物品id
     */
    public function showUpdateLose($item_id)
    {
        $this->getname();
        $item_info = $this->Lost->update_query_one($item_id);
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
            $this->load->view('UpdateLose',$front);
            $this->load->view('templates/footer');
    }

    /**
     * 用来接收新增数据页面的post
     * 成功后返回0，失败返回错误代码。
     */
    function insertItem()
    {
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
            $post_data['retrieve_id'] = 0;
            $post_data['retrieve_change_time'] = date('Y-m-d H:i:s');
            $post_data['retrieve_change_person'] = $_SESSION['name'];
            $insert_return = $this->Lost->insert_one($post_data);
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
     * 可接受任何参数的更改，但不允许更改student_id release_name type_id
     */
    function updateItem()
    {
        $this->getname();
        $post_data = $this->input->post();
        
        if(isset($post_data['student_id'])||isset($post_data['release_name'])||isset($post_data['type_id']))
        {
            show_404();
        }
        if (isset($post_data['item_id'])) {
            (isset($post_data['tel'])) && ($post_data['tel'] = trim($post_data['tel']));
            (isset($post_data['item_name'])) && ($post_data['item_name'] = trim($post_data['item_name']));
            (isset($post_data['position'])) && ($post_data['position'] = trim($post_data['position']));
            (isset($post_data['time'])) && ($post_data['time'] = trim($post_data['time']));
            (isset($post_data['detail'])) && ($post_data['detail'] = trim($post_data['detail']));
            $res = $this->Lost->query_one($post_data['item_id']);
            if ($res[0]['student_id'] !== $_SESSION['student_id'])
                show_404();
            if (isset($post_data['retrieve_id'])&&$post_data['retrieve_id'] != $res[0]['retrieve_id']) {
                $post_data['retrieve_change_time'] = date('Y-m-d H:i:s');
                $post_data['retrieve_change_person'] = $_SESSION['name'];
            }
            
            if ($this->Lost->update_one($post_data)) {
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