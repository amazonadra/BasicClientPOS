<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TokoPOS | Print Invoice</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url()."assets/"; ?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url()."assets/"; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url()."assets/"; ?>css/animate.min.css" rel="stylesheet">

    <link href="<?php echo base_url()."assets/"; ?>css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md" onload="window.print()">
    <div class="container body">
      <div class="main_container">
        <div class="row">
          <div class="col-md-6">
            <div class="x_panel">
              <div class="x_title">
                <div class="row">
                  <div class="col-xs-12 invoice-header">
                    <h4 style="text-align:center">
                      <i class="fa fa-home"></i> Toko<b>POS</b>
                    </h4>

                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <section class="content invoice">
                  <!-- title row -->
                  <?php
                  $satu = substr($cabang[0]->telfon,0,4);
                  $dua = substr($cabang[0]->telfon,4,3);
                  $tiga = substr($cabang[0]->telfon,7);
                  $telp = $satu.'-'.$dua.'-'.$tiga;
                   ?>

                  <section>
                   <div style="text-align:center">
                     <address>
                       <strong><?php echo $cabang[0]->nama ?></strong>
                       <br> <?php echo $cabang[0]->alamat ?>
                     </address>
                   <div>
                  </section>

                  <table style="width:100%">
                    <tr>
                      <td style="text-align:left"><?php echo $transaksi[0]->nama ?></td>
                      <td style="text-align:right"><?php echo date('d-m-Y H:i:s'); ?></td>
                      <td style="text-align:right"><b>Id #<?php echo $transaksi[0]->id_transaksi ?></b></td>
                  </table>

                  <!-- Table row -->
                  <div class="row">
                    <div class="col-xs-12 table">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>No. </th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          foreach ($barang as $b) {
                            $jumlah = $b->jumlah;
                            $harga = $b->harga_satuan;
                            $subtotal = $harga * $jumlah;?>
                            <tr>
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $b->nama; ?></td>
                              <td><?php echo $jumlah; ?></td>
                              <td>Rp. <?php echo number_format($harga,2,",","."); ?></td>
                              <td>Rp. <?php echo number_format($subtotal,2,",","."); ?></td>
                            </tr>
                          <?php  } ?>
                          <tr>
                            <td colspan="2"><b>Total Belanja</b></td>
                            <td colspan="2"><b><?php echo $transaksi[0]->total_item ?></b> Item(s)</td>
                            <td><b>Rp. <?php echo number_format($transaksi[0]->total_harga,2,",","."); ?></b></td>
                          </tr>
                          <tr>
                            <td colspan="4"><b>Tunai</b></td>
                            <td><b>Rp. <?php echo number_format($tunai,2,",","."); ?></b></td>
                          </tr>
                          <tr>
                            <td colspan="4"><b>Kembali</b></td>
                            <td><b>Rp. <?php echo number_format(($tunai - $transaksi[0]->total_harga),2,",","."); ?></b></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </section>
                <section>
                  <div style="text-align:center">
                    <br>Terima Kasih, Selamat Belanja Kembali
                    <br>============ Layanan Konsumen ============
                    <br>SMS & Call : <?php echo $telp ?>
                    <br>Email : <?php echo $cabang[0]->email ?>
                  <div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url()."assets/"; ?>js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url()."assets/"; ?>js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url()."assets/"; ?>js/custom.js"></script>
  </body>
</html>
