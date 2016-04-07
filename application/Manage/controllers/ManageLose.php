<?php

class ManageLose extends CI_Controller
{

    private $per_page = 15;


    private $user;

    function __construct()
    {
        parent::__construct();
        $this->load->model("LostAndFound/Lost");
        $this->check_is_login();
    }

    public function query_page()
    {
        $pass['user'] = $this->user;
        
        $current_page = $this->input->get_post("pagenum");
        if (! $current_page)
            $current_page = 1;
        $offset = ($current_page - 1) * $this->per_page;
        if ($_SESSION['is_admin'] == 1) {
            $item_info = $this->Lost->query_all($offset, $this->per_page);
        } else {
            $item_info = $this->Lost->query_all_user($offset, $this->per_page, $_SESSION['name']);
        }
        $num_pages = (int) ceil($item_info['total'] / $this->per_page);
        $pass['page'] = $num_pages;
        $pass['res'] = $item_info['res'];
        
        echo json_encode($pass);
    }

    function del_item()
    {
        $item_id = $this->input->get_post("item_id");
        
        $res = $this->Found->query_one($item_id);
        if ($_SESSION['is_admin']==0) {
            if ($res[0]['student_id'] !== $_SESSION['name'])
                die('{"errno":101,"error":"非法进入！"}');
        }
        if ($this->Lost->batch_del_items($item_id)) {
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

    function upd_item()
    {
        $post_data = $this->input->post();
        $post_data['item_name'] = $this->input->post('item_name');
        $post_data['tel'] = $this->input->post('tel');
        if ($post_data['item_name'] && $post_data['tel']) {
            unset($post_data['item_type']);
            unset($post_data['uploadphotos']);
            (isset($post_data['student_id'])) && ($post_data['student_id'] = trim($post_data['student_id']));
            (isset($post_data['release_name'])) && ($post_data['release_name'] = trim($post_data['release_name']));
            (isset($post_data['tel'])) && ($post_data['tel'] = trim($post_data['tel']));
            (isset($post_data['item_name'])) && ($post_data['item_name'] = trim($post_data['item_name']));
            (isset($post_data['position'])) && ($post_data['position'] = trim($post_data['position']));
            (isset($post_data['time'])) && ($post_data['time'] = trim($post_data['time']));
            (isset($post_data['detail'])) && ($post_data['detail'] = trim($post_data['detail']));
            $res = $this->Lost->query_one($post_data['item_id']);
            if ($_SESSION['is_admin'] == 0) {
                if ($res[0]['student_id'] !== $_SESSION['name'])
                    die('{"errno":101,"error":"非法进入！"}');
            }
            unset($post_data['is_admin']);
            if ($post_data['retrieve_id'] != $res[0]['retrieve_id']) {
                $post_data['retrieve_change_time'] = date('Y-m-d H:i:s');
                $post_data['retrieve_change_person'] = $_SESSION['username'];
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
                'errno' => 102,
                'error' => '请将信息填写完整！'
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
        
        $batch = $this->Lost->query_batch($item_id);         //身份校验
        foreach ($batch as $item)
        {
            if($item["student_id"] !==$_SESSION['name'] ){
                die('{"errno":101,"error":"非法进入！"}');
            }
        }
        
        if ($this->Lost->batch_del_items($item_id)) {
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
        $res = $this->Lost->query_one($item_id);
        $res[0]['is_admin'] = $this->user['is_admin'];
        if ($res[0]['uploadphotos']) {
            $res[0]['uploadphotos'] = 'http://oss.aifuwu.org/' . $res[0]['uploadphotos'];
        } else
            $res[0]['uploadphotos'] = 'http://oss.aifuwu.org/lostfound/default.jpg';
        echo json_encode($res[0]);
    }

    function add_item()
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
            $post_data['student_id'] = $_SESSION['name'];
            $post_data['release_name'] = $_SESSION['name'];
            $post_data['retrieve_id'] = 0;
            $post_data['retrieve_change_time'] = date('Y-m-d H:i:s');
            $post_data['retrieve_change_person'] = $_SESSION['username'];
            if ($this->Lost->insert_one($post_data)) {
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
                'errno' => 102,
                'error' => '请将信息填写完整！'
            );
        }
        echo json_encode($data);
    }

    function check_is_login()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            
            $this->user = array(
                'username' => $_SESSION['username'],
                'logged_in' => $_SESSION['logged_in'],
                'name' => $_SESSION['name'],
                'is_admin' => $_SESSION['is_admin']
            );
        } else {
            $pass = array();
            $pass['error'] = 1;
            echo json_encode($pass);
            die();
        }
    }
}

?>