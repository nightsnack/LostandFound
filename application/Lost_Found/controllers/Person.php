<?php

header("Content-type: text/html;charset=utf-8");
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
class Person extends CI_Controller
{
    private $per_page=5;

    
    function __construct()
    {
        parent::__construct();
        $_SESSION['open_id'] = 1201;
        
        $this->getname();
    }
    
    
    /**
     * 查询用户学号和名字
     * 
     * @return NULL 
     */
     function getname()
    {
        if(!$_SESSION['open_id'])
        {
            die('{"errno":101,"error":"非法进入！"}');
        }
        
        $this->load->model('Info');
        $rs = $this->Info->queryVal($_SESSION['open_id']);
//         var_dump($rs);
        if ($rs==NULL)
        {
            $data = array(
                'errno' => '1000',
                'error' => '请传入open_id和student_id和zhxy_psw绑定'
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
        if (empty($rs['name']) || $rs['name'] == 'nothing') {
            $data = array(
                'errno' => '1001',
                'error' => '请传入open_id和zhxy_psw绑定'
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
            
        }
        $_SESSION['student_id'] = $rs['student_id'];
        $_SESSION['name'] = $rs['name'];
    }
    
    public function myLose()
    {
        $this->load->model('Lost'); 
//         $current_page = $this->input->get_post("current_page");
//         if (! $current_page)
//             $current_page = 1;
//         $offset = ($current_page - 1) * $this->per_page;
        $item_info = $this->Lost->query_mine($_SESSION['student_id']);//, $offset, $this->per_page
//         $num_pages = (int) ceil($item_info['total'] / $this->per_page);
        
        $pass['res'] = $item_info['res'];
//         $pass['pages'] = $num_pages;
        echo json_encode($pass, JSON_UNESCAPED_UNICODE);
    }
    
    public function myFind()
    {
        $this->load->model('Found'); 
//         $current_page = $this->input->get_post("current_page");
//         if (! $current_page)
//             $current_page = 1;
//         $offset = ($current_page - 1) * $this->per_page;
        $item_info = $this->Found->query_mine($_SESSION['student_id']);//, $offset, $this->per_page
//         $num_pages = (int) ceil($item_info['total'] / $this->per_page);
        
        $pass['res'] = $item_info['res'];
//         $pass['pages'] = $num_pages;
        echo json_encode($pass, JSON_UNESCAPED_UNICODE);
    }
    
}

?>