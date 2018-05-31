<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('mproduct');
		if($this->session->userdata('status') != "login"){
			redirect(site_url("login"));
		}
	}

	function index(){
		$id = $this->uri->segment(3);
		$tunai = $this->uri->segment(4);
		$content = array(
			'transaksi' => $this->mproduct->getWhere('barangkeluar',array('id_transaksi' => $id))->result(),
			'barang' => $this->mproduct->getWhere('barangkeluar_detail',array('id_transaksi' => $id))->result(),
			'cabang' => $this->mproduct->selectAll('apilogin')->result(),
			'tunai' => $tunai
		);
    $this->load->view('viewinvoice',$content);
	}
}
