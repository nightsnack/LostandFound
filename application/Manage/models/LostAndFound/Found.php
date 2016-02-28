<?php

class Found extends CI_Model
{
    /* 主键名 */
    private $primary_key = "item_id";

    /* 表名 */
    private $table = "Found";
    
    private $_db;

    /**
     * 构造函数，初始化database，加载aes，设置aes密钥
     */
    function __construct()
    {
        parent::__construct();
        $this->_db = $this->load->database('lostfound',true);
        
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
        $this->_db->select('a.item_name,a.detail,d.name as receive,a.item_id');
        $this->_db->from("$this->table as a");
        $this->_db->join('receive_status as d', "a.receive_id = d.receive_id",'inner');
        $this->_db->order_by($this->primary_key, 'DESC');
        $this->_db->where("a.type_id", $type);
        $this->_db->limit($num,$offset);
        $query = $this->_db->get()->result_array();
        
        $this->_db->where("type_id", $type);
        $this->_db->from($this->table);
        $res = $this->_db->count_all_results();
//         if (sizeof($query) == 0)
//             return '';

        return  array(
            'total' => $res,
            'res' => $query
            );
    }

    /**
     * 后台管理
     * @param int $offset 开始位置
     * @param int $num 数目
     * @return multitype:array 总数和详情
     */
    
    public function query_all($offset,$num)
    {
        $this->_db->select('a.item_id as 物品编号,a.item_name as 物品名称 ,b.name as 物品类型,a.student_id as 发布人帐号 ,a.release_name as 发布人姓名,a.tel as 发布人电话,a.position as 捡到地点,a.time as 捡到时间 ,c.name as 通知状态,d.name as 领取状态');
        $this->_db->from("$this->table as a");
        $this->_db->join('item_type as b', "a.type_id = b.type_id",'inner');
        $this->_db->join('inform_status as c', "a.inform_id = c.inform_id",'inner');
        $this->_db->join('receive_status as d', "a.receive_id = d.receive_id",'inner');
        $this->_db->order_by($this->primary_key, 'DESC');
        $this->_db->limit($num,$offset);
        $query = $this->_db->get()->result_array();
        
        $this->_db->from($this->table);
        $res = $this->_db->count_all_results();
        //         if (sizeof($query) == 0)
            //             return '';        
        return  array(
            'total' => $res,
            'res' => $query
        );
    }

    
    function batch_del_items($id)
    {
        if(is_array($id)) $this->_db->where_in($this->primary_key, $id);
        else  $this->_db->where($this->primary_key, $id);
        return $this->_db->delete($this->table);
    }
    
    
    public function query_one($id)
    {
        $this->_db->select('a.item_id,a.student_id,a.release_name, b.name as item_type,a.tel,a.item_name, a.tel,a.position,a.time,a.detail,a.inform_id,a.receive_id');
//a.item_id as 物品编号,a.student_id as 发布人帐号,a.release_name as 发布人姓名, b.name as 物品类型,a.tel as 发布人电话,a.item_name as 物品名称, a.tel as 发布人电话,a.position as 捡到地点,a.time as 捡到时间,a.detail as 物品详情,c.name as 通知状态,d.name as 领取状态'
        $this->_db->from("$this->table as a");
        $this->_db->join('item_type as b', "a.type_id = b.type_id",'inner');
//         $this->_db->join('inform_status as c', "a.inform_id = c.inform_id",'inner');
//         $this->_db->join('receive_status as d', "a.receive_id = d.receive_id",'inner');
        $this->_db->where("a.item_id", $id);
        $query = $this->_db->get()->result_array();
        
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
        $this->_db->insert($this->table, $data);
        return array(
            'id'=>$this->_db->insert_id(),
            'status'=>$this->_db->affected_rows()
        );

       
    }
    
    
    /**
     * 
     * @param unknown $table_name  表名
     * @return unknown  全部数据
     */
    public function query_name_all($table_name)
    {
        $query = $this->_db->get($table_name)->result_array();
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
        $this->_db->select($select);
        $this->_db->from($table_name);
        $this->_db->where($key,$value);
        $query = $this->_db->get()->result_array();
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
        $this->_db->delete($this->table, array(
            $this->primary_key => $notice_id
        ));
        
        return $this->_db->affected_rows();
    }

    /**
     *管理端
     * @param array 包含更新的字段和数据
     *            
     * @return int 返回更新成功的个数
     */
    public function update_one($data)
    {
        $this->_db->update($this->table, $data, array(
            $this->primary_key => $data[$this->primary_key]
        ));
        return $this->_db->affected_rows();
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
        $this->_db->select('a.item_id,a.item_name,a.detail,b.name as receive');
        $this->_db->from("$this->table as a");
        $this->_db->join('receive_status as b', "a.receive_id = b.receive_id", 'inner');
        $this->_db->order_by($this->primary_key, 'DESC');
        $this->_db->where("a.student_id", $student_id);
        $this->_db->limit($num, $offset);
        $query = $this->_db->get()->result_array();
    
        $this->_db->where("student_id", $student_id);
        $this->_db->from($this->table);
        $res = $this->_db->count_all_results();
    
        return array(
            'total' => $res,
            'res' => $query
        );
    }

    
}
    
    

?>