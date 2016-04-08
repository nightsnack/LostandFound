<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
 
    private $table = 'users';
    
    private $primary_key = 'username';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database('default');
        $this->db->db_select('user');
        $this->db->db_set_charset('utf8');
    }

    /**
     * 
     * @param unknown $name  名字（展示出来）
     * @param unknown $username  登录名
     * @param unknown $password  登录密码
      */
    public function create_user($name, $username, $password)
    {
        $data = array(
            'name' => $name,
            'username' => $username,
            'password' => $this->hash_password($password),
            'created_at' => date('Y-m-j H:i:s'),
            'is_admin' => 0
        );
        
        return $this->db->insert($this->table, $data);
    }

    /**
     * 登录的密码验证
     *
     * @access public
     * @param mixed $username            
     * @param mixed $password            
     * @return bool true on success, false on failure
     */
    public function resolve_user_login($username, $password)
    {   
        $this->db->select('password');
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $hash = $this->db->get()->row('password');
        
        return $this->verify_password_hash($password, $hash);
    }

    /**
     * 查单个用户详情
     *
     * @access public
     * @param mixed $username            
     * @return array user
     */
    public function get_user($username)
    {
        $this->db->from($this->table);
        $this->db->where($this->primary_key, $username);
        
        return $this->db->get()->result_array();
    }

    
    public function get_all()
    {
        $this->db->select('username,name,is_admin');
        $this->db->from($this->table);
        $this->db->order_by('created_at');
        
        return $this->db->get()->result_array();
    }


    public function update_user($data)
    {
        $data['password'] = $this->hash_password($data['password']);
        $this->db->update($this->table, $data, array(
            $this->primary_key => $data[$this->primary_key]
        ));
        return $this->db->affected_rows();
    }
    
    public function insert_user($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }
    
    public function delete_user($username)
    {
        $this->db->delete($this->table, array(
            $this->primary_key => $username
        ));
        
        return $this->db->affected_rows();
    }
    
    
    /**
     * hash_password function.
     *
     * @access private
     * @param mixed $password            
     * @return string|bool could be a string on success, or bool false on failure
     */
    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * verify_password_hash function.
     *
     * @access private
     * @param mixed $password            
     * @param mixed $hash            
     * @return bool
     */
    private function verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
