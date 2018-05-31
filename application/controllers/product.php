<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('mproduct');
		if($this->session->userdata('status') != "login"){
			redirect(site_url("login"));
		}
	}

	function index(){
		$data = array('barang' => $this->mproduct->selectAll('barang')->result());
		$datacabang = $this->mproduct->selectAll('toko')->result_array();
		$content = array(
			'judul' => 'TokoPOS | Product',
			'content1' => $this->load->view('viewproduct', $data, true),
			'nama' => $this->session->userdata('nama'),
			//'pendapatan' => $this->pendapatanhari(),
			'cabang' => $datacabang[0]['namacabang']
		);
		$isi = $this->cart->destroy();
		$this->load->view('index',$content);
	}
}
