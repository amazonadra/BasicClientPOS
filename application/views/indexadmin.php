<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $judul; ?></title>

  <!-- Bootstrap core CSS -->

  <link href="<?php echo base_url()."assets/"; ?>css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo base_url()."assets/"; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url()."assets/"; ?>css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url()."assets/"; ?>css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url()."assets/"; ?>css/icheck/flat/green.css" rel="stylesheet">

  <link href="<?php echo base_url()."assets/"; ?>js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url()."assets/"; ?>js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url()."assets/"; ?>js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <script src="<?php echo base_url()."assets/"; ?>js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
  <style>
    .dataTables_filter{
      width: 100%;
    }
    .right_col, .top_nav, footer{
      margin-left: 0 !important;
    }

    a.site_title{
      color: #2a3f54 !important;
      padding-left:18px;
    }

    a.site_title:hover{
      color: #45688a !important;
      padding-left:18px;
    }

    .top_nav .navbar-right{
      float: none !important;
      width: 100% !important;
    }

    tr.pos td.kiri {
      vertical-align: middle;
      text-align: left;
    }

    tr.pos td.kanan {
      vertical-align: middle;
      text-align: right;
    }

    .kotak{
      top:12px;
    }

    .tengah{
      top:7px;
    }
  </style>
</head>
<body class="nav-md">
  <div class="container body" style="background:#F7F7F7">
    <div class="main_container">

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav class="" role="navigation">
            <ul class="nav navbar-nav navbar-right">
              <div class="col-md-2">
                <a class="site_title" href="<?php echo site_url('home')?>"><i class="fa fa-home"></i>Toko<b>POS</b></a>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-2 kotak">
                <div class="input-group">
                  <input class="form-control" value="<?php echo $cabang;?>" disabled>
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-tent"></i>
                  </span>
                </div>
              </div>
              <div class="col-md-2 kotak">
                <div class="input-group">
                  <?php $localIP = getHostByName(getHostName()); ?>
                  <input class="form-control" value="<?php echo $localIP ?>" disabled>
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-exclamation-sign"></i>
                  </span>
                </div>
              </div>
              <div class="col-md-2 kotak">
                <div class="input-group">
                  <input class="form-control" id="pendapatan" value="Rp. <?php echo number_format($pendapatan,2,",","."); ?>" disabled>
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-piggy-bank"></i>
                    </span>
                  </div>
              </div>
              <li class="">
                <a id="menu" href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo base_url()."assets/"?>images/user.png" alt="<?php echo base_url()."assets/"?>images/user.png"><?php echo $nama;?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a id="logout" href='<?php echo site_url('login/logout')?>'><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>
              <li role="presentation">
                <a href="javascript:;" id="singkron" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-refresh"></i>
                  <!-- <span class="badge bg-green">1</span> -->
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="clearfix"></div>

        <div class="row">
          <section id="page1" class="animate">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel kotak">
                <div class="x_content tengah">
                  <form>
                    <div class="col-md-11 col-sm-11 col-xs-12 form-group">
                      <input autofocus type="text" id="barcode" class="form-control" placeholder="Masukkan id produk" autocomplete="off" required="required">
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-12 form-group">
                      <button id="tuku" type="button" class="btn btn-default btn-success submit tambah"><i class="glyphicon glyphicon-shopping-cart"></i></a>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="glyphicon glyphicon-shopping-cart"></i>  Cart</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <form id="beli">
                    <table id='carttable' class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Produk</th>
                          <th>Jumlah</th>
                          <th width="20%">Harga</th>
                          <th width="20%">Sub-Total</th>
                          <th width="5%"></th>
                        </tr>
                      </thead>
                      <tbody class='hasil'>
                        <tr>
                          <td colspan="2"><strong>Total Belanja</strong></td>
                          <td colspan="2"><b class="total"><?php echo $this->cart->total_items(); ?></b> Item(s)</td>
                          <td><b>Rp. <?php echo number_format($this->cart->total(),2,",","."); ?></b></td>
                          <td></td>
                        </tr>
                        <tr class="pos">
                          <td colspan="3"></td>
                          <td class="kiri"><strong>Jumlah Bayar</strong></td>
                          <td><b><input type="number" class="form-control col-md-3" required size="6" id="inputbayar" value="0" min="0"></b></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                    <a class="btn btn-default submit btn-sm resetitem"><i class="fa fa-trash-o"></i> Clear</a>
<!-- test -->
                    <!-- <button id='tumbas' type="submit" class="btn btn-default submit btn-sm btn-primary"><i class="fa fa-check" required></i> Check Out</button> -->
                    <button id='checkout' type="button" class="btn btn-default submit btn-sm btn-primary"><i class="fa fa-check"></i> Check Out</button>
                    <!-- <b id="alert-cart" class="hidden animate" style="color:#d32a2a"> </b> -->
<!-- end test -->

                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <a href="#" id="hal2" class="btn btn-default btn-sm hidden"> Halaman 2</a>
              <a href="#" id="hal3" class="btn btn-default btn-sm hidden"> Halaman 3</a>
            </div>
          </section>

          <section id="page2" class="hidden animate">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel kotak">
                <div class="x_title">
                  <h2><i class="glyphicon glyphicon-gift"></i>  Products</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="produk1" class="table table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th>No. </th>
                        <th>Id</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Harga</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                        foreach ($barang as $b) {?>
                        <tr class="pos">
                          <td class="kiri"><?php echo $no++ ?></td>
                          <td class="kiri"><?php echo $b->id_barang; ?></td>
                          <td class="kiri"><?php echo $b->nama; ?></td>
                          <td class="kiri"><?php echo $b->stock; ?></td>
                          <td class="kanan">Rp. <?php echo number_format($b->harga,2,",","."); ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <a href="#" id="hal1" class="btn btn-default btn-sm hidden"> Halaman 1</a>
              <a href="#" id="hal3" class="btn btn-default btn-sm hidden"> Halaman 3</a>
            </div>
          </section>

          <section id="page3" class="hidden animate">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="glyphicon glyphicon-send"></i>  Tabel Transaksi</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Transaksi Keluar</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Transaksi Masuk</a>
                      </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                        <div class="x_title">
                          <h2>Data Transaksi Keluar</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <table id="keluar" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>No. </th>
                                <th>ID Transaksi</th>
                                <th>Nama Staf</th>
                                <th>Tanggal</th>
                                <th>Jumlah Item</th>
                                <th>Total Harga</th>
                                <th>Info Detail</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                						    $no = 1;
                						    foreach($keluar as $k){?>
                              <tr class="pos" id="<?php echo $k->id_transaksi?>">
                                <td class="kiri"><?php echo $no++?></td>
                                <td class="kiri"><?php echo $k->id_transaksi ?></td>
                                <td class="kiri"><?php echo $k->nama ?></td>
                                <td class="kiri"><?php echo $k->tanggal ?></td>
                                <td class="kiri"><?php echo $k->total_item ?></td>
                                <td class="kanan">Rp. <?php echo number_format($k->total_harga,2,",",".") ?></td>
                                <td><button class="btn btn-default btn-sm details" id="<?php echo $k->id_transaksi?>">
                                <i class="fa fa-info-circle"></i>  &nbsp;details</button></td>
                              </tr>
                					    <?php }?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <div class="x_title">
                          <h2>Data Transaksi Masuk</h2>
  					              <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <table id="masuk" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>No. </th>
                                <th>ID Transaksi</th>
                                <th>Nama Staf</th>
                                <th>Tanggal</th>
                                <th>Jumlah Item</th>
                                <th>Total Harga</th>
                                <th>Info Detail</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                						    $no = 1;
                						    foreach($masuk as $m){?>
                              <tr class="pos" id="<?php echo $m->id_transaksi; ?>">
                                <td class="kiri"><?php echo $no++ ?></td>
                                <td class="kiri"><?php echo $m->id_transaksi ?></td>
                                <td class="kiri"><?php echo $m->nama ?></td>
                                <td class="kiri"><?php echo $m->tanggal ?></td>
                                <td class="kiri"><?php echo $m->total_item ?></td>
                                <td class="kanan">Rp. <?php echo number_format($m->total_harga,2,",",".") ?></td>
                                <td><button class="btn btn-default btn-sm details" id=""><i class="fa fa-info-circle"></i>  &nbsp;details</button></td>
                              </tr>
                					    <?php }?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <a href="#" id="hal1" class="btn btn-default btn-sm hidden"> Halaman 1</a>
              <a href="#" id="hal2" class="btn btn-default btn-sm hidden"> Halaman 2</a>
            </div>
          </section>

        </div>
      </div>
      <!-- /page content -->

      <!-- Bootstrap modal -->
      <div class="modal fade" id="singkronisasi" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Sinkronisasi</h3>
            </div>
            <div class="modal-body form">
              <form action="#" id="form" class="form-horizontal">
                <!-- <input type="hidden" value="" name="cabang"/> -->
                <div class="form-body">
                  <div class="form-group">
                    <label class="control-label col-md-2">ID Manifest</label>
                    <div class="col-md-9">
                      <input id="id_manifest" placeholder="Masukkan id manifest terbaru" class="form-control" type="text" autofocus/>
                    </div>
                    <label class="control-label col-md-1" id="ikon"></label>
                  </div>
                  <div class="modal-header">
                    <h4 class="" align="center">Daftar Barang</h4>
                  </div>
                  <div class="modal-body form" id="daftarbarang">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <span style="float:left;margin-top: 9px;"><b id="alert-cart" class="hidden animate" style="text-align: left;color:#d32a2a;">Id manifest kosong!</b></span>
              <a id="konfirm" class="btn btn-default" style="margin-bottom:0px;">Singkronkan</a>
              <a id="batal" onclick="keluar()" class="btn btn-default">Batal</a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- End Bootstrap modal -->

      <!-- Bootstrap modal -->
      <div class="modal fade" id="kembalian" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Uang Kembali</h3>
            </div>
            <div class="modal-body form">
              <form action="#" id="form" class="form-horizontal">
                <input type="hidden" value="" name="cabang"/>
                <div class="form-body">
                  <h1 id="uangkembali"></h1>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <a type="button" id="tumbas" class="btn btn-default">Print</a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- End Bootstrap modal -->

    </div>
  </div>
  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="<?php echo base_url()."assets/"; ?>js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="<?php echo base_url()."assets/"; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="<?php echo base_url()."assets/"; ?>js/nicescroll/jquery.nicescroll.min.js"></script>

  <!-- icheck -->
  <script src="<?php echo base_url()."assets/"; ?>js/icheck/icheck.min.js"></script>

  <script src="<?php echo base_url()."assets/"; ?>js/custom.js"></script>

  <!-- pace -->
  <script src="<?php echo base_url()."assets/"; ?>js/pace/pace.min.js"></script>

  <!-- Datatables-->
  <script src="<?php echo base_url()."assets/"; ?>js/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url()."assets/"; ?>js/datatables/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url()."assets/"; ?>js/datatables/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url()."assets/"; ?>js/datatables/buttons.bootstrap.min.js"></script>
  <script src="<?php echo base_url()."assets/"; ?>js/datatables/jszip.min.js"></script>
  <script src="<?php echo base_url()."assets/"; ?>js/datatables/vfs_fonts.js"></script>
  <script src="<?php echo base_url()."assets/"; ?>js/datatables/dataTables.scroller.min.js"></script>
  <script src="<?php echo base_url()."assets/"; ?>js/datatables/buttons.print.min.js"></script>

  <script>
    function kembali() {
      $('#kembalian').modal('show');
    }

    function keluar() {
      $('#kembalian').modal('hide');
      $('#singkronisasi').modal('hide');
    }

    $(document).ready(function() {
      $('#produk1').dataTable({});
    });

    // function fok(){
    //   $(document).on('focus','#inputbayar', function(){
    //     if($('#inputbayar').val() == 0){
    //       $('#inputbayar').val('');
    //     }
    //   });
    //   $('#inputbayar').focus();
    // }

    $(function(){

      $('#hal1').click(function(){
        $('#page2').hide();
        $('#page3').hide();
        $('#page1').fadeIn();
      });

      $('#hal2').click(function(){
        $('#page1').hide();
        $('#page3').hide();
        $('#page2').fadeIn();
        $('#page2').attr('class','animate');
      });

      $('#hal3').click(function(){
        $('#page1').hide();
        $('#page2').hide();
        $('#page3').fadeIn();
        $('#page3').attr('class','animate');
      });

      $(document).on('blur','#inputbayar', function(){
        if($('#inputbayar').val() == ''){
          $('#inputbayar').val('0');
        }
      }).on('keyup', function(e){
        e.preventDefault();
        if(!$("input").is(":focus")){
          console.log(e.keyCode);
          if (e.keyCode == 66) {
            // fok();
            $('#inputbayar').focus();
          }else if (e.keyCode == 88) {
            $('tbody.hasil tr').first().find('td a.hapusitem').click();
          }else if (e.altKey && (e.keyCode >= 48 && e.keyCode <= 57)) {
            var c = 10;
            for (var i = 48; i <= 57; i++) {
              if(e.altKey && e.keyCode == i){
                var teks = $("td.nomor:textEquals('"+c+"')").closest('tr').find('td.kompo').attr('title');
                alert(teks);
              }
              c++;
              c = c%10;
            }
          }else if (e.keyCode >= 48 && e.keyCode <= 57) {
            var c = 10;
            for (var i = 48; i <= 57; i++) {
              if(e.keyCode == i){
                $("td.nomor:textEquals('"+c+"')").closest('tr').find('td a').click();
              }
              c++;
              c = c%10;
            }
          }

          if (e.keyCode == 79){
            $('#menu').click();
            $('#logout').focus();
          }
          if($('#page1').is(":visible")){
            if (e.keyCode == 39) {
              $('#hal2').click();
            }else if (e.keyCode == 37) {
              $('#hal3').click();
            }else if (e.keyCode == 83){
              $('#barcode').focus();
            }else if (e.keyCode == 67){
              $('.resetitem').click();
            }else if (e.keyCode == 75){
              $('#checkout').click();
            }
          }else if ($('#page2').is(":visible")) {
            if (e.keyCode == 39) {
              $('#hal3').click();
            }else if (e.keyCode == 37) {
              $('#hal1').click();
            }else if (e.keyCode == 83){
              $('div#produk1_filter input.input-sm').focus();
            }
          }else if ($('#page3').is(":visible")) {
            if (e.keyCode == 39) {
              $('#hal1').click();
            }else if (e.keyCode == 37) {
              $('#hal2').click();
            }else if (e.keyCode == 83){
              $('div#keluar_filter input.input-sm').focus();
              $('div#masuk_filter input.input-sm').focus();
            }else if (e.keyCode == 75) {
              $('#home-tab').click();
            }else if (e.keyCode == 77) {
              $('#profile-tab').click();
            }
          }
        }else if (e.keyCode == 27) {
          $("input").blur();
        }
      });

      $(document).on('click','#singkron',function(e){
        e.preventDefault();
        $('#singkronisasi').modal('show');
        $.ajax({
          url: '<?php echo site_url('home/singkron')?>',
          type: 'get',
          dataType: 'json',
          success: function(data){
            console.log(data.id);
          }
        });
      }).on('input','#id_manifest',function(){
        var id = $(this).val();
        $.ajax({
           url: '<?php echo site_url('home/cekid')?>',
           data: {'id':id},
           type:'get',
           dataType: 'json',
           success:function(data){
             if(data.isi == 0){
               $('#ikon').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>');
             }else{
               $('#ikon').html('<span class="glyphicon glyphicon-ok" style="color:green"></span>');
               $('#daftarbarang').html(data.barang);
             }
           }
         })
      }).on('click','#konfirm',function(){
        var value = $("#id_manifest").val();
        $.ajax({
          url: '<?php echo site_url('home/updatebarang')?>',
          type: 'get',
          data: {'id':value},
          success:function(data){
            console.log(data);
            if(data.isi == 0){
              $('#alert-cart').show();
              $('#alert-cart').attr('class','animate');
            }else{
              keluar();
            }
          }
        })
      });

      $(document).on('click', '#checkout', function(e){
        e.preventDefault();
        var value = $('#inputbayar').val()
        $.ajax({
          url: '<?php echo site_url('home/cek')?>',
          type: 'get',
          data: {'bayar':value},
          dataType: 'json',
          success: function(data){
            console.log(data.isi);
            console.log(value);
            if (data.isi == 1) {
              // alert(data.pendapatan);
              $('#uangkembali').html(data.uangkembali);
              $('#kembalian').modal();
              $('#pendapatan').val(data.pendapatan);
            }else {
              alert(data.alert);
              // $('#alert-cart').html(data.alert);
              // $('#alert-cart').show();
              // $('#alert-cart').attr('class','animate');
            }
          }
        });
      });

      $(document).on('click', '#tumbas', function(e){
        var value = $('#inputbayar').val()
        e.preventDefault();
        $.ajax({
          url: '<?php echo site_url('home/beli')?>',
          type: 'post',
          dataType: 'json',
          success: function(data){
            $('<iframe>').attr('src','<?php echo site_url('invoice/index')?>'+'/'+data.id+'/'+value).appendTo('body');
            $(".resetitem").click();
            $('#kembalian').modal('hide');
          }
        });
      });

      $(document).on('click', '#tuku', function(){
          var value = $('#barcode').val();
          //alert(value);
          $.ajax({
            url:'<?php echo site_url('home/tambahitem') ?>',
            type: 'get',
            data:{
             'id_barang':value
            },
            dataType:'json',
            success: function(data) {
              $('tbody.hasil').html(data.isi);
              console.log(value);
              $('input#update'+value).focus();
            }
          });
      }).on('keypress', '#barcode', function(e){
        if (e.keyCode == 13) {
          $('#tuku').click();
          e.preventDefault();
        }
      })

      $(document).on('keypress','.updateitem', function(e){
        if(e.keyCode == 13){
           e.preventDefault();
           var id = $(this).closest('tr').prop('id');
           var value = $(this).val();
           $.ajax({
             url:'<?php echo site_url('home/updateitem') ?>',
             type:'get',
             data:{'id' : id, 'value': value},
             dataType:'json',
             success:function(data){
               $('tbody.hasil').html(data.isi);
             }
           });
           $("input").blur();
        }
      });

      $(document).on('click','.hapusitem',function(){
        var id = $(this).prop('id');
        $.ajax({
          url:'<?php echo site_url('home/hapusitem') ?>',
          type:'get',
          data:{'id':id},
          dataType:'json',
          success:function(data){
            $('tbody.hasil').html(data.isi);
          }
        });
      });

      $(document).on('click','.resetitem', function(){
        $.ajax({
          url: '<?php echo site_url('home/resetitem') ?>',
          dataType:'json',
          success:function(data){
            $('tbody.hasil').html(data.isi);
            // $('#alert-cart').hide();
          }
        });
      });

      //Detail barang keluar
      function format (id) {
        return '<table id="detkeluar" class="table dt-responsive table-bordered nowrap tabel" width="100%">'
        +'<thead><tr>'
          +'<th colspan="6" style="text-align:center;background:#ededed">Detail Transaksi '+id+'</th>'
        +'</tr>'
        +'<tr>'
          +'<th>No.</th>'
          +'<th>Id</th>'
          +'<th>Nama Produk</th>'
          +'<th>Jumlah Item</th>'
          +'<th>Harga</th>'
        +'</tr></thead>'
        +'<tbody class="det '+id+'"></tbody></table>';
      }

      $(document).ready(function(){
        var table = $('#keluar').DataTable({
          responsive:false
        });
        $('#keluar tbody').on('click', 'td button.details', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);
          var id = $(this).closest('tr').prop('id');
          //console.log(id);
          $.ajax({
            url:'<?php echo site_url('home/detailkeluar') ?>',
            type:'get',
            data:{'id':id},
            dataType:'json',
            success: function(data){
              console.log(id);
              $('tbody.'+id).html(data.isi);
            }
          });

          if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
          }
          else {
            // Open this row
            row.child( format(id) ).show();
            tr.addClass('shown');
          }
        });
      });

    //Detail barang masuk
    function format2 (id) {
      return '<table id="detmasuk" class="table dt-responsive table-bordered nowrap tabel" width="100%">'
      +'<thead><tr>'
        +'<th colspan="6" style="text-align:center;background:#ededed">Detail Transaksi '+id+'</th>'
      +'</tr>'
      +'<tr>'
        +'<th>No.</th>'
        +'<th>Id</th>'
        +'<th>Nama Produk</th>'
        +'<th>Jumlah Item</th>'
        +'<th>Harga</th>'
      +'</tr></thead>'
      +'<tbody class="det '+id+'"></tbody></table>';
    }

    $(document).ready(function(){
      var table = $('#masuk').DataTable({
        responsive:false
      });
      $('#masuk tbody').on('click', 'td button.details', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var id = $(this).closest('tr').prop('id');
        $.ajax({
          url:'<?php echo site_url('home/detailmasuk') ?>',
          type:'get',
          data:{'id':id},
          dataType:'json',
          success: function(data){
            $('tbody.'+id).html(data.isi);
          }
        });

        if ( row.child.isShown() ) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
       }
        else {
          // Open this row
          row.child( format2(id) ).show();
          tr.addClass('shown');
       }
      });
    });
  });
  </script>

</body>
<?php
  include 'footer.html';
?>
</html>
