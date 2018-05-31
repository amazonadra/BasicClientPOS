<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$API = '';
class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('mlogin');
		// $this->API='192.168.43.52/pos';
		$this->API='localhost/basicserverpos';
	}

	public function index(){
		$this->db->trans_begin();
    	$h = $this->db->get('apilogin')->result_array();
    	// $userid = '';
    	$id[] = array('id'=>'0');
			if($h != NULL){
				$user = $h[0]['user'];
      	$pass = $h[0]['pass'];
      	$keys = $h[0]['apikeys'];
      	$config = array (
        	'auth'          => TRUE,
        	'auth_type'     => 'basic',
        	'auth_username' => $user,
        	'auth_password' => $pass);
      	$this->restclient->initialize($config);
      	$id = $this->restclient->get($this->API.'/api/cabangid/user/'.$user.'/ritelpos/'.$keys);
				if(!array_key_exists('error', $id)){
        	$cabangid = $id[0]['id_cabang'];
        	$alamat = $id[0]['alamat'];
        	$telp = $id[0]['telepon'];
        	$email = $id[0]['email'];
        	$nama = $id[0]['nama_cabang'];
					$tanggal = $id[0]['dibuat'];
					$petugas = $this->restclient->get($this->API.'/api/petugas/id/'.$cabangid.'/ritelpos/'.$keys);
        	foreach ($petugas as $p) {
						$inputpetugas = array(
            	'id_staf' => $p['id_petugas'],
            	'username' => $p['user'],
							'nama' => $p['nama_petugas'],
							'email' => $p['email'],
							'kunci' => $p['pass_petugas'],
							'level' => $p['level_petugas']
          	);
						$this->mlogin->Simpan('staf',$inputpetugas);
					}
					$input = array(
          	'id_cabang' => $cabangid,
          	'nama' => $nama,
          	'email' => $email,
          	'telfon' => $telp,
          	'alamat' => $alamat,
						'tanggal' => $tanggal
        	);
        	$this->mlogin->SimpanId($user,$input,'apilogin');
      	}
      	else{
        	if($id['error'] == 'IP unauthorized'){
          	$id[] = array('id'=>'ip');
        	}elseif ($id['error'] == 'Unauthorized' || $id['error'] == 'Invalid credentials'){
          	$id[] = array('id'=>'invalid');
        	}elseif ($id['error'] == 'Invalid API key ') {
          	$id[] = array('id'=>'api');
        	}
      	}
    	}
    	if ($this->db->trans_status() === FALSE){
      	$this->db->trans_rollback();
    	}
    	else{
      	$this->db->trans_commit();
    	}

			$data = array(
				'judul' => 'TokoPOS | Login',
				'login' => $id[0]['id_cabang']
	 		);
			$this->load->view('viewlogin', $data);
	}

	function Cekapi(){
    $cek = $this->db->get('apilogin')->num_rows();
    echo $cek;
  }

	function Initapi()
	{
		$user = $this->input->post('user',true);
		$pass = $this->input->post('pass',true);
    $key = $this->input->post('api',true);
		$input = array(
			'user' => $user,
			'pass' => $pass,
      'apikeys' => $key
		);

		$this->mlogin->Simpan('apilogin',$input);
		echo json_encode(array("status" => TRUE));
	}

  function Reset(){
    $this->mlogin->DeleteAll('apilogin');
    $this->mlogin->DeleteAll('staf');
    echo 'Sukses';
  }

	function AksiLogin(){
		$user = $this->input->post('username',true);
		$kunci = $this->input->post('kunci',true);
		$where = array(
			'username' => $user,
			'kunci' => $kunci
		);
		$cek = $this->mlogin->CekLogin('staf',$where)->num_rows();
		$data = $this->mlogin->CekLogin('staf',$where)->result_array();
		if($cek > 0){
			$data_session = array(
				'username' => $user,
				'nama' => $data[0]['nama'],
				'id_staf' => $data[0]['id_staf'],
				'level' => $data[0]['level'],
				'status' => "login",
				'id' => $data[0]['id']
				);
			$this->session->set_userdata($data_session);
			redirect(site_url('home'));
		}else{
			$data['login'] = '0';
			$data['logins'] = 'gagal';
			$this->load->view('viewlogin',$data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(site_url('login'));
	}
}
