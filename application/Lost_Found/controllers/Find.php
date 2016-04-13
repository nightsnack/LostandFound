<?php

class Find extends CI_Controller
{

    private $per_page = 10;



    function __construct()
    {
        parent::__construct();
        $this->load->model("Found");
//         echo $_SESSION['open_id'] = 1101;
//         echo $_SESSION['open_id'];
        $this->getname();
    }

    /**
     * 查询用户学号和名字
     * 
     * @return array 表内全部内容
     */
    private function getname()
    {
        if(!$_SESSION['open_id'])
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

    /**
     * 展示当前类型的全部内容，分页
     * 
     * @param
     *            number item_type 类型数字
     * @param
     *            number current_page 页码
     */
    public function showItems()
    {
        $item_type = $this->input->post("item_type");
//         $current_page = $this->input->get_post("current_page");
//         if (! $current_page)
//             $current_page = 1;
//         $offset = ($current_page - 1) * $this->per_page;
        $item_info = $this->Found->query_list($item_type);//, $offset, $this->per_page
//         $num_pages = (int) ceil($item_info['total'] / $this->per_page);
        
        $pass['res'] = $item_info['res'];
//         $pass['pages'] = $num_pages;
        echo json_encode($pass, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 显示当前物品详情，判断用户是否是发布用户
     * 
     * @param
     *            number itemid 物品id
     */
    public function showDetail()
    {
        $item_id = $this->input->post("item_id");
        $item_info = $this->Found->query_one($item_id);
        $front = $item_info['0'];
        if ($front['uploadphotos']) {
            $front['uploadphotos'] = 'http://image.aifuwu.org/' . $front['uploadphotos'].'@720w';
        } else
            $front['uploadphotos'] = 'http://image.aifuwu.org/lostfound/default.jpg@720w';
        if ($_SESSION['student_id'] == $item_info['0']['student_id']) {
            $front['is_mine'] = 1;
            $front['inform_select'] = $this->Found->query_name_all('inform_status');
            $front['receive_select'] = $this->Found->query_name_all('receive_status');
        }else $front['is_mine'] = 0;
        echo json_encode($front, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 更改我发布的物品信息
     * 
     * @param unknown $itemid
     *            物品id
     */
    public function showUpdateFind()
    {
        $item_id = $this->input->get_post("item_id");
        $item_info = $this->Found->update_query_one($item_id);
        $front = $item_info['0'];
        if ($front['student_id'] !== $_SESSION['student_id'])
            $front = array(
                'errno' => '101',
                'error' => '错误入口!'
            );
            else {
        if ($front['uploadphotos']) {
            $front['uploadphotos'] = 'http://oss.aifuwu.org/' . $front['uploadphotos'];
        } else
            $front['uploadphotos'] = 'http://oss.aifuwu.org/lostfound/126.jpg';
            }
        echo json_encode($front, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 用来接收新增数据页面的post
     * 成功后返回0，失败返回错误代码。
     */
    function insertItem()
    {
        $post_data = $this->input->post();
        $post_data['item_name'] = $this->input->post('item_name');
        $post_data['tel'] = $this->input->post('tel');
        $post_data['type_id'] = $this->input->post('type_id');
        if ($post_data['item_name'] && $post_data['tel'] && $post_data['type_id']) {
            (isset($post_data['tel'])) && ($post_data['tel'] = trim($post_data['tel']));
            (isset($post_data['item_name'])) && ($post_data['item_name'] = trim($post_data['item_name']));
            (isset($post_data['position'])) && ($post_data['position'] = trim($post_data['position']));
            (isset($post_data['time'])) && ($post_data['time'] = trim($post_data['time']));
            (isset($post_data['detail'])) && ($post_data['detail'] = trim($post_data['detail']));
            $post_data['student_id'] = $_SESSION['student_id'];
            $post_data['release_name'] = $_SESSION['name'];
            $post_data['inform_id'] = 0;
            $post_data['inform_change_time'] = date('Y-m-d H:i:s');
            $post_data['inform_change_person'] = $_SESSION['name'];
            $post_data['receive_id'] = 0;
            $post_data['receive_change_time'] = date('Y-m-d H:i:s');
            $post_data['receive_change_person'] = $_SESSION['name'];
            if ($this->Found->insert_one($post_data)) {
                $data = array(
                    'errno' => 0
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
        $post_data = $this->input->post();
        $post_data['item_id'] = $this->input->post('item_id');
        if(isset($post_data['student_id'])||isset($post_data['release_name'])||isset($post_data['type_id']))
        {
            echo "你更改了不该更改的内容";
            die();
        }
        if ($post_data['item_id']) {
            // unset($post_data['item_type']);
            // unset($post_data['uploadphotos']);
            // (isset($post_data['student_id'])) && ($post_data['student_id'] = trim($post_data['student_id']));
            // (isset($post_data['release_name'])) && ($post_data['release_name'] = trim($post_data['release_name']));
            (isset($post_data['tel'])) && ($post_data['tel'] = trim($post_data['tel']));
            (isset($post_data['item_name'])) && ($post_data['item_name'] = trim($post_data['item_name']));
            (isset($post_data['position'])) && ($post_data['position'] = trim($post_data['position']));
            (isset($post_data['time'])) && ($post_data['time'] = trim($post_data['time']));
            (isset($post_data['detail'])) && ($post_data['detail'] = trim($post_data['detail']));
            $res = $this->Found->query_one($post_data['item_id']);
            if ($res[0]['student_id'] !== $_SESSION['student_id'])
                die('{"errno":101,"error":"非法进入！"}');
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
        echo json_encode($data);
    }
}

?>