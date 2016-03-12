<?php

class Person extends CI_Controller
{
    private $open_id = 1101;
    private $per_page=5;

    
    function __construct()
    {
        parent::__construct();
        $_SESSION['open_id'] = 1101;
        
        $this->getname();
    }
    
    
    /**
     * 查询用户学号和名字
     * 
     * @return NULL 
     */
    private function getname()
    {
        $this->load->model('Info');
        $rs = $this->Info->queryVal($this->open_id);
        if (empty($rs['name']) || $rs['name'] == 'nothing') {
            $data = array(
                'errno' => '100',
                'error' => '请绑定'
            );
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
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