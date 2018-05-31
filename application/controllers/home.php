<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->API='192.168.43.52/pos';
		$this->load->model('mproduct');
		if($this->session->userdata('status') != "login"){
			redirect(site_url('login'));
		}
	}

	function index(){
		$datacabang = $this->mproduct->selectAll('apilogin')->result_array();
		$where = array('flag' => '1');
		// $where2 = 'stock >', '0';
		$content = array(
			'judul' => 'TokoPOS | Beranda',
			'barang' => $this->db->where('stock >', '0')->get('barang')->result(),
			'keluar' => $this->mproduct->selectAll('barangkeluar')->result(),
			'keluardetail' => $this->mproduct->selectAll('barangkeluar_detail')->result(),
			'masuk' => $this->mproduct->getWhere('barangmasuk', $where)->result(),
			'masukdetail' => $this->mproduct->getWhere('barangmasuk_detail', $where)->result(),
			'nama' => $this->session->userdata('nama'),
			'pendapatan' => $this->pendapatanhari(),
			'cabang' => $datacabang[0]['nama']
		);
		$level = $this->session->userdata('level');
		$isi = $this->cart->destroy();
		if($level == 1){
			$this->load->view('indexadmin',$content);
		}else{
			$this->load->view('index',$content);
		}
	}

	function TambahItem(){
		$id = $this->input->get('id_barang',true);
		$where = array('id_barang' => $id );
		$item = $this->mproduct->getWhere('barang',$where)->result_array();
		$data = array(
    	'id' => $item[0]['id_barang'],
			'name' => $item[0]['nama'],
      'qty' => 1,
      'price' => $item[0]['harga'],
		);
		$this->cart->insert($data);
		$isi = $this->cart->contents();
		$this->TampilItem($isi, array());
	}

	function HapusItem(){
		$id = $this->input->get('id',true);
		$this->cart->remove($id);
		$isi = $this->cart->contents();
		$this->TampilItem($isi, array());
	}

	function ResetItem(){
		$this->cart->destroy();
		$isi = $this->cart->contents();
		$this->TampilItem($isi, array());
	}

	function UpdateItem(){
    $id = $this->input->get('id',true);
    $val = $this->input->get('value',true);
    $data = array('rowid' => $id, 'qty' => $val);
    $this->cart->update($data);
  	$isi = $this->cart->contents();
    $this->TampilItem($isi, array());
  }

	function pendapatanhari(){
		$d = (int)date('d');
		$m = (int)date('m');
		$y = (int)date('Y');
		$where = array(
			'DAY(tanggal)' => $d,
			'MONTH(tanggal)' => $m,
			'YEAR(tanggal)' => $y
		);
		$pendapatan = $this->mproduct->getWhere('barangkeluar', $where)->result_array();
		$total = 0;
		foreach ($pendapatan as $p) {
			$total = $total + $p['total_harga'];
		}
		return $total;
	}

	function Cek(){
		$bayar = $this->input->get('bayar',true);
		$harga = $this->cart->total();
		$total = $this->cart->total_items();
		$kembali = $bayar - $harga;
		$uangkembali = 'Rp. '.number_format($kembali,2,",",".");
		$alert = ' ';
		$status = 0;

		if($total == 0){
			$alert = 'Keranjang Belanja Masih Kosong!';
		}else if($bayar == 0){
			$alert = 'Jumlah Pembayaran Kosong!';
		}else if($kembali < 0){
			$alert = 'Jumlah Pembayaran Salah!';
		}else{
			$status = '1';
		}

		echo json_encode(array("isi" => $status, "alert" => $alert, "uangkembali" => $uangkembali));
	}

	function Beli(){
		if($this->cart->total_items() > 0){
			$this->db->trans_begin();
			$idstaf = $this->session->userdata('id_staf');
			$date = date('Ymd');
	    $idkeluar = $this->mproduct->selectMaxId('barangkeluar','id');
	    if($idkeluar->num_rows()>0){
	      $idkeluar = $idkeluar->result();
	      $id = $idkeluar[0]->id+1;
	      if(strlen((string)$id) == 1){
	        $id = '000'.$id;
	      }elseif (strlen((string)$id) == 2) {
	        $id = '00'.$id;
	      }elseif (strlen((string)$id) == 3) {
	        $id ='0'.$id;
	      }else{
	        $id = $id;
	      }
	    }else{
	      $id = '0001';
	    }
	    $idtrans = 'O'.$date.$id;

			$datakeluar = array(
				'id_transaksi' => $idtrans,
				'id_staf' => $idstaf,
				'nama' => $this->session->userdata('nama'),
			 	'tanggal' => date('Y-m-d H:i:s'),
			 	'total_item' => $this->cart->total_items(),
			 	'total_harga' => $this->cart->total()
			);
			$this->mproduct->insertBarang('barangkeluar',$datakeluar);

			foreach ($this->cart->contents() as $c) {
				$datakeluard = array(
					'id_transaksi' => $idtrans,
					'id_barang' => $c['id'],
					'nama' => $c['name'],
					'jumlah' => $c['qty'],
					'harga_satuan' => $c['price'],
				);
				$this->mproduct->insertBarang('barangkeluar_detail',$datakeluard);
			}
			$this->Restock();

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
			}else {
				$this->db->trans_commit();
			}
		}else {
			$idtans = FALSE;
		}

		$isi = $this->cart->contents();
		$this->cart->destroy();
		$this->TampilItem($isi, $idtrans);
	}

	function TampilItem($isi, $id){
		$output1 = '';
		$isi = array_reverse($isi);
    $total = $this->cart->total_items();
    if ($total == 0){
      $total = '';
    }else{
      $total = $this->cart->total_items();
    }
    foreach ($isi as $i){
      $hasil = $this->mproduct->getWhere('barang',array('id_barang' => $i['id']))->result_array();
      $output1 .= '<tr class="pos" id="'.$i['rowid'].'">
                  	<td class="kiri">'.$i['id'].'</td>
                    <td class="kiri">'.$i['name'].'</td>
                    <td class="kiri">
                    	<input name="jumlah[]" type="number" class="col-md-3 form-control updateitem" id="update'.$i['id'].'" style="width:65px;" value="'.$i['qty'].'" min="1" max="'.$hasil[0]['stock'].'" required>
                    </td>
                    <td class="kiri">Rp. '.number_format($i['price'],2,",",".").'</td>
                    <td class="kiri">Rp. '.number_format($i['subtotal'],2,",",".").'</td>
                    <td class="kiri">
                      <a type="kiri" class="btn btn-default submit btn-sm btn-danger hapusitem" id="'.$i['rowid'].'"><i class="fa fa-times"></i></a>
                    </td>
                  </tr>';
    }
    $output1 .= '<tr>
                	<td colspan="2"><strong>Total Belanja</strong></td>
									<td><b class="total">'. $this->cart->total_items() .'</b> Item(s)</td>
									<td></td>
                  <td><b>Rp. '.number_format($this->cart->total(),2,",",".").'</td>
                  <td></td>
                </tr>
								<tr class="pos">
									<td colspan="3"></td>
									<td><strong>Jumlah Bayar</strong></td>
									<td><b><input type="number" class="form-control col-md-3" size="6" id="inputbayar" required value="0" min="0"></b></td>
									<td></td>
								</tr>';

  	$pendapatan = 'Rp.'.number_format($this->pendapatanhari(),2,",",".");
		echo json_encode(array('isi' => $output1, 'id' => $id, 'pendapatan' => $pendapatan));
	}

	function Restock(){
		foreach ($this->cart->contents() as $c) {
			$id = $c['id'];
			$where = array('id_barang' => $id);
			$stock = $this->mproduct->getWhere('barang', $where)->result_array();

			$stockbaru = $stock[0]['stock'] - $c['qty'];
			$this->mproduct->updateData('barang', array('stock' => $stockbaru), $where);
		}
	}

	function DetailKeluar(){
		$id = $this->input->get('id',true);
		$where = array('id_transaksi' => $id);
		$hasil = $this->mproduct->getWhere('barangkeluar_detail' ,$where)->result_array();
		$output ='';
		$no = 1;
		foreach ($hasil as $h) {
			$output .= '<tr class="pos" id="'.$h['id_barang'].'">
										<td>'.$no++.'</td>
										<td>'.$h['id_barang'].'</td>
										<td>'.$h['nama'].'</td>
										<td>'.$h['jumlah'].'</td>
										<td class="kanan">Rp. '.number_format($h['harga_satuan'],2,",",".").'</td>
									</tr>';
		}

		echo json_encode(array('isi' => $output));
	}

	function DetailMasuk(){
		$id = $this->input->get('id',true);
		$where = array('id_transaksi' => $id);
		$hasil = $this->mproduct->getWhere('barangmasuk_detail' ,$where)->result_array();
		$output ='';
		$no = 1;
		foreach ($hasil as $h) {
			$output .= '<tr class="pos" id="'.$h['id_barang'].'">
										<td>'.$no++.'</td>
										<td>'.$h['id_barang'].'</td>
										<td>'.$h['nama'].'</td>
										<td>'.$h['jumlah'].'</td>
										<td class="kanan">Rp. '.number_format($h['harga_satuan'],2,",",".").'</td>
									</tr>';
		}

		echo json_encode(array('isi' => $output));
	}

	function Singkron(){
		$api = $this->mproduct->selectAll('apilogin')->result_array();
		$cabangid = $api[0]['id_cabang'];
		$keys = $api[0]['apikeys'];
		$user = $api[0]['user'];
		$pass = $api[0]['pass'];
		$config = array (
			'auth'          => TRUE,
			'auth_type'     => 'basic',
			'auth_username' => $user,
			'auth_password' => $pass);
		$this->restclient->initialize($config);
		$manifest = $this->restclient->get($this->API.'/api/barangmasuk/id/'.$cabangid.'/ritelpos/'.$keys);

		if(!array_key_exists('error', $manifest)){
			$where = array('id_transaksi' => $manifest[0]['id_transaksi']);
			$ada = $this->mproduct->getWhere('barangmasuk', $where)->num_rows();
			if ($ada == 0) {
				foreach ($manifest as $m) {
					$inputmanifest = array(
						'id_transaksi' => $m['id_transaksi'],
						'id_staf' => $this->session->userdata('id_staf'),
						'nama' => $this->session->userdata('nama'),
						'tanggal' => date('Y-m-d H:i:s'),
						'flag' => '0'
					);
					$this->mlogin->Simpan('barangmasuk',$inputmanifest);
				}

				$mdetail = $this->restclient->get($this->API.'/api/bmdetails/id/'.$inputmanifest['id_transaksi'].'/ritelpos/'.$keys);
				foreach ($mdetail as $md) {
					$inputmdetail = array(
						'id_transaksi' => $md['id_transaksi'],
						'id_barang' => $md['id_barang'],
						'nama' => $md['nama_barang'],
						'jumlah' => $md['jumlah'],
						'harga_satuan' => $md['harga_barang'],
						'flag' => '0'
					);
					$this->mlogin->Simpan('barangmasuk_detail',$inputmdetail);
				}
			}
		}
		// $idmanifest = 'bisa';
		// echo json_encode(array('id' => $idmanifest));
	}

	function CekId(){
		$id = $this->input->get('id',true);
		$where = array('id_transaksi' => $id, 'flag' => '0');
		$isi = $this->mproduct->getWhere('barangmasuk', $where)->num_rows();

		$isibarang = $this->mproduct->getWhere('barangmasuk_detail', $where)->result_array();
		$formbarang = '<table class="table table-striped">
		<thead>
			<th>Id Barang</th>
			<th>Nama Barang</th>
			<th>Jumlah</th>
		</thead>';

		foreach ($isibarang as $b) {
			$formbarang .= '<tr>
				<td>'.$b['id_barang'].'</td>
				<td>'.$b['nama'].'</td>
				<td>'.$b['jumlah'].'</td>
			</tr>';
		}

		$formbarang .= '</table>';

		echo json_encode(array('isi' => $isi, 'barang' => $formbarang));
	}

	function UpdateBarang(){
		$id = $this->input->get('id',true);
		$where = array('id_transaksi' => $id, 'flag' => '0');
		$a = $this->mproduct->getWhere('barangmasuk', $where)->num_rows();
		if ($a > 0){
			$tjumlah = '0';
			$tharga = '0';
			$barang = $this->mproduct->getWhere('barangmasuk_detail', $where)->result_array();
			foreach ($barang as $b) {
				$jumlah = $this->mproduct->getWhere('barang', array('id_barang' => $b['id_barang']))->result_array();
				if ($jumlah == false){
					$stock = $b['jumlah'];
				}else{
					$stock = $b['jumlah'] + $jumlah[0]['stock'];
				}
				$inputbarang = array(
					'id_barang' => $b['id_barang'],
					'nama' => $b['nama'],
					'stock' => $stock,
					'harga' => $b['harga_satuan'],
				);
				$tjumlah = $tjumlah + $b['jumlah'];
				$thargasatu = $b['jumlah'] * $b['harga_satuan'];
				$tharga = $tharga + $thargasatu;
				$this->mlogin->Simpan('barang', $inputbarang);
			}
			$data2 = array('flag' => '1');
			$data = array('flag' => '1', 'total_item' => $tjumlah, 'total_harga' => $tharga);
			$this->mproduct->updateData('barangmasuk', $data, $where);
			$this->mproduct->updateData('barangmasuk_detail', $data2, $where);


			$api = $this->mproduct->selectAll('apilogin')->result_array();
			$cabangid = $api[0]['id_cabang'];
			$keys = $api[0]['apikeys'];
			$user = $api[0]['user'];
			$pass = $api[0]['pass'];
			$config = array (
				'auth'          => TRUE,
				'auth_type'     => 'basic',
				'auth_username' => $user,
				'auth_password' => $pass);
			$this->restclient->initialize($config);
			$this->restclient->post(($this->API.'/api/barangmasuk/ritelpos/'.$keys), ['id' => $cabangid]);
		}

		echo $a;
	}
}
