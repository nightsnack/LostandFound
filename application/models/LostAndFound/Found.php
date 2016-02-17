<?php

class Found extends CI_Model
{
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
        $this->db->db_select('lost_found');
        $this->db->db_set_charset('utf8');
        
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
        $this->db->select('a.*,b.name as type,c.name as inform,d.name as receive');//'a.item_name,a.student_id,a.release_name,a.tel,a.position,a.time,a.detail,b.name as type,c.name as inform,
            //a.inform_change_person,a.inform_change_time,d.name as receive,a.receive_change_person,a.receive_change_time'
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
     * @param array $data
     *            包含插入的字段和数据
     * @return int 返回插入成功的个数
     */
    public function insert_one($data)
    {
        $this->db->insert($this->table, $data);
        return array(
            'id'=>$this->db->insert_id(),
            'status'=>$this->db->affected_rows()
        );

       
    }
    
    
    /**
     * 
     * @param unknown $table_name  表名
     * @return unknown  全部数据
     */
    public function query_name_all($table_name)
    {
        $query = $this->db->get($table_name)->result_array();
        return $query;
    }
    
    
    /**
     * 
     * @param unknown $table_name 表名
     * @param unknown $select    要查询的字段
     * @param unknown $key       已知的字段名
     * @param unknown $value     已知的字段的值
     * @return string            查询得到的值             
     */
    public function query_name_one($table_name,$select,$key,$value)
    {
        $this->db->select($select);
        $this->db->from($table_name);
        $this->db->where($key,$value);
        $query = $this->db->get()->result_array();
        return $query['0'][$select];
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
     * @param array 包含更新的字段和数据
     *            
     * @return int 返回更新成功的个数
     */
    public function update_one($data)
    {
        $this->db->update($this->table, $data, array(
            $this->primary_key => $data[$this->primary_key]
        ));
        return $this->db->affected_rows();
    }
    
    /**
     *
     * @param int $student_id
     *            学号
     * @param int $offset
     *            开始位置
     * @param int $num
     *            查找数量
     * @return array:total 当前项总数量
     *         res 详情结果（数组）
     */
    public function query_mine($student_id, $offset, $num)
    {
        $this->db->select('a.item_id,a.item_name,a.detail,b.name as receive');
        $this->db->from("$this->table as a");
        $this->db->join('receive_status as b', "a.receive_id = b.receive_id", 'inner');
        $this->db->order_by($this->primary_key, 'DESC');
        $this->db->where("a.student_id", $student_id);
        $this->db->limit($num, $offset);
        $query = $this->db->get()->result_array();
    
        $this->db->where("student_id", $student_id);
        $this->db->from($this->table);
        $res = $this->db->count_all_results();
    
        return array(
            'total' => $res,
            'res' => $query
        );
    }
    
}
    
    

?>