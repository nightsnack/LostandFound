<?php

/**
 * Author: Maximus
 * Date: 2015/11/16
 * Time: 22:58
 */
class Info extends CI_Model
{
	/* 所有字段名称 */
	private $key = array("open_id", "student_id", "name", "idcard_num", "educard_id", "school", "major", "class", "entrance_time");
	/* 主键名 */
	private $primary_key = "open_id";
	/* 表名 */
	private $table = "student_basic_information";
	/* 置空值 */
	private $empty = "nothing";
	
	/**
	 * 构造函数，初始化database，加载aes，设置aes密钥
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->database('default');
		$this->db->db_select('afwdb');
		$this->db->db_set_charset('latin1');
		$this->load->library('aes');  // $this->aes
		$this->aes->setKey('yiW7BPNI8ax0O39opkKCCFQS');
	}

	/**
	 * @param $open_id String 微信号
	 * @return int 返回删除成功的个数
	 */
	public function deleteVal($open_id)
	{
		$this->db->delete($this->table, array($this->primary_key => $open_id));

		return $this->db->affected_rows();
	}

	/**
	 * @param $array array 包含更新的字段和数据
	 * @return int 返回更新成功的个数
	 */
	public function updateVal($array)
	{
		foreach ($array as &$v) {
			$this->padding($v);     // 对空值进行nothing填补
		}
		foreach (array_keys($array) as $k) {
			if (strcmp($k, $this->primary_key)) {   // if $k != 主键名, 因为主键名不加密，否则加密后无法识别
				$this->todoEncode($array[$k]);
			}
		}
		$this->db->update($this->table, $array, array($this->primary_key => $array[$this->primary_key]));

		return $this->db->affected_rows();
	}

	/**
	 * @param $array array 包含插入的字段和数据
	 * @return int 返回插入成功的个数
	 */
	public function insertVal($array)
	{
		$this->addKeys($array);     // 补全字段
		foreach ($array as &$v) {
			$this->padding($v);     // 对空值进行nothing填补
		}
		foreach (array_keys($array) as $k) {
			if (strcmp($k, $this->primary_key)) {   // if $k != 主键名, 因为主键名不加密，否则加密后无法识别
				$this->todoEncode($array[$k]);
			}
		}
		$this->db->insert($this->table, $array);

		return $this->db->affected_rows();
	}

	/**
	 * @param $open_id String 微信号
	 * @return Object 封装所有数据的一个对象
	 */
	public function queryVal($open_id)
	{
		$arr = $this->db->get_where($this->table, array($this->primary_key => $open_id))->result_array();
		if (sizeof($arr) == 0) {
			return null;
		} else {
			$obj = $arr[0];
		}
		foreach ($this->key as $k) {
			if (strcmp($k, $this->primary_key)) {   // if $k != 主键名, 因为主键名不加密，所以无需解密
				$this->todoDecode($obj[$k]);
			}
		}

		return $obj;
	}

	/**
	 * @param $array array 对不存在的字段进行自动补充，并设置为nothing，引用传递
	 */
	private function addKeys(&$array)
	{
		foreach ($this->key as $k) {
			if (!array_key_exists($k, $array)) {    // 如果相应字段不存在，则添加为nothing
				$array += array($k => $this->empty);
			}
		}
	}

	/**
	 * @param $data String 判断数据是否为空，空则设置为nothing，引用传递
	 */
	private function padding(&$data)
	{
		if (!strcmp($data, "")) {   // if $data == "", todo set->nothing
			$data = $this->empty;
		}
	}

	/**
	 * @param $data String 要加密的数据，引用传递
	 */
	private function todoEncode(&$data)
	{
		if (strcmp($data, $this->empty))   // if $data != nothing, todo encode
			$data = $this->aes->encode($data);
	}

	/**
	 * @param $data String 要解密的数据，引用传递
	 */
	private function todoDecode(&$data)
	{
		if (strcmp($data, $this->empty))   // if $data != nothing, todo decode
			$data = $this->aes->decode($data);
	}

}