<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mproduct extends CI_Model {
	function getWhere($tabel, $where){
		return $this->db->get_where($tabel, $where);
	}

	function selectAll($tabel){
		return $this->db->get($tabel);
	}

	function insertBarang($tabel, $data){
		return $this->db->insert($tabel, $data);
	}

	function selectMaxId($tabel, $data){
		$this->db->select_max($data);
		return $this->db->get($tabel);
	}

	function updateData($tabel, $data, $where){
		return $this->db->update($tabel, $data, $where);
	}
}
