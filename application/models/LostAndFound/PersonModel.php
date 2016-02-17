<?php

class PersonModel extends CI_Model
{
    /* 主键名 */
    private $primary_key = "open_id";
    
    /* 表名 */
    private $table = "student_basic_information";
    
    /**
     * 构造函数，初始化database
     */
    function __construct()
    {
        parent::__construct();
        $this->load->database('laf');
    }
    
    /**
     *
     * @param unknown $table_name  表名
     * @return unknown  全部数据
     */
    public function query_all()
    {
        $query = $this->db->get($this->table)->result_array();
        return $query;
    }
}

?>