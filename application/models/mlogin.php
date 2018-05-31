<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model{
	function CekLogin($table,$where){
		return $this->db->get_where($table,$where);
	}

	function Simpan($table,$data){
		$this->db->replace($table, $data);
	}

	function SimpanId($u,$fields,$table){
		$this->db->where('user',$u)->update($table,$fields);
  }

	function DeleteAll($table){
    $this->db->empty_table($table);
  }
}
