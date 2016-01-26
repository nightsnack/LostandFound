<?php

class Items extends CI_Model
{

    /* 所有字段名称 */
    private $key = array(
        "student_id",
        "release_name",
        "tel",
        "item_name",
        "type_id",
        "position",
        "time",
        "detail",
        "notice_id",
        "notice_change_person",
        "notice_change_time",
        "receive_id",
        "receive_change_person",
        "receive_change_time"
    );

    /* 主键名 */
    private $primary_key = "item_id";

    /* 表名 */
    private $table = "Found";

    /**
     * 构造函数，初始化database，加载aes，设置aes密钥
     */
    function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }

/**
 * 
 * @param int $type    查找类型
 * @param int $offset  开始位置
 * @param int $num     查找数量
 * @return array:total 当前项总数量
 *               res   详情结果（数组）
 */
    public function query_list($type,$offset,$num)
    {
        $this->db->select('a.item_name,a.detail,d.name as receive,a.item_id');
        $this->db->from("$this->table as a");
//        $this->db->join('item_type as b', "a.type_id = b.type_id",'inner');
//        $this->db->join('inform_status as c', "a.inform_id = c.inform_id",'inner');
        $this->db->join('receive_status as d', "a.receive_id = d.receive_id",'inner');
        $this->db->order_by($this->primary_key, 'DESC');
        $this->db->where("a.type_id", $type);
        $this->db->limit($num,$offset);
        $query = $this->db->get()->result_array();
        
        $this->db->where("type_id", $type);
        $this->db->from($this->table);
        $res = $this->db->count_all_results();
//         if (sizeof($query) == 0)
//             return '';

        return  array(
            'total' => $res,
            'res' => $query
            );
    }


    
    public function query_one($id)
    {
        $this->db->select('a.item_name,a.student_id,a.release_name,a.tel,a.position,a.time,a.detail,b.name as type,c.name as inform,
            a.inform_change_person,a.inform_change_time,d.name as receive,a.receive_change_person,a.receive_change_time');
        $this->db->from("$this->table as a");
        $this->db->join('item_type as b', "a.type_id = b.type_id",'inner');
        $this->db->join('inform_status as c', "a.inform_id = c.inform_id",'inner');
        $this->db->join('receive_status as d', "a.receive_id = d.receive_id",'inner');
        $this->db->where("a.item_id", $id);
        $query = $this->db->get()->result_array();
        
//         if (sizeof($query) == 0)
//             return '';

        return  $query;
    }

    /**
     *
     * @param $array array
     *            包含插入的字段和数据
     * @return int 返回插入成功的个数
     */
    public function insertNotice($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }
    /**
     * 
     * @param unknown $table_name  表名
     * @return unknown  全部数据
     */

    public function queryNameAll($table_name)
    {
        $query = $this->db->get($table_name)->result_array();
        return $query;
    }
    
    
    
    public function queryNameOne($table_name,$id_type,$id)
    {
        $this->db->select('name');
        $this->db->from($table_name);
        $this->db->where($id_type,$id);
        $query = $this->db->get()->result_array();
        return $query;
    }
    
    /**
     *
     * @param $open_id String
     *            微信号
     * @return int 返回删除成功的个数
     */
    public function deleteNotice($notice_id)
    {
        $this->db->delete($this->table, array(
            $this->primary_key => $notice_id
        ));
        
        return $this->db->affected_rows();
    }

    /**
     *
     * @param $array array
     *            包含更新的字段和数据
     * @return int 返回更新成功的个数
     */
    public function updateNotice($array)
    {
        $this->db->update($this->table, $array, array(
            $this->primary_key => $array[$this->primary_key]
        ));
        return $this->db->affected_rows();
    }
}
    
    

?>