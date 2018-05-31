<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>TokoPOS | Login</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url()."assets/"; ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url()."assets/"; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url()."assets/"; ?>css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="<?php echo base_url()."assets/"; ?>css/custom.css" rel="stylesheet">
  <link href="<?php echo base_url()."assets/"; ?>css/icheck/flat/green.css" rel="stylesheet">

  <script src="<?php echo base_url()."assets/"; ?>js/jquery.min.js"></script>

  <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
  <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body onload="cek()" style="background:#F7F7F7;">
  <div class="">
    <?php
  		if((isset($logins))=='gagal'){
  			$hidden = '';
  		}
  		else{$hidden='hidden';}
  	?>
    <div id="wrapper">
        <section class="animate form login_content" id="page1">
          <form action="<?php echo site_url('login/AksiLogin'); ?>" method="post">
            <h1>Masuk ke Sistem</h1>
            <div>
              <p class="<?php echo $hidden; ?> btn-danger">Username atau Password anda salah</p>
            </div>
            <div>
              <input autofocus type="text" class="form-control" id="username" placeholder="Username" name="username" required="requred" autocomplete="off" />
            </div>
            <div>
              <input type="password" class="form-control" id="kunci" placeholder="Password" name="kunci" required="required" autocomplete="off" />
            </div>
            <div>
              <input type="hidden" id="kode" class="form-control" value="<?php echo $login ?>" />
              <button type='submit' id="masuk" class="btn btn-default submit">Masuk</button>
            </div>
            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">Lupa kata sandi?
                <a href='#' id="toregister"> Reset kata sandi</a></br>
              </p>
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-home" style="font-size: 26px;"></i> Toko<b>POS</b></h1>
                <p>©2017 All Rights Reserved. <b>TokoPOS</b></p>
              </div>
            </div>
          </form>
          <!-- form -->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="#" id="hal1" class="btn btn-default btn-sm hidden"> Halaman 1</a>
          </div>
        </section>
        <!-- content -->

        <section class="hidden animate form login_content" id="page2">
          <form>
            <h1>Reset Kata Sandi</h1>
            <div>
              <input type="email" class="form-control" placeholder="Email" required="" />
            </div>
            <div>
              <a class="btn btn-default submit" href="<?php echo site_url('login');?>">Reset</a>
              <a class="btn btn-default submit" href="#" id='tologin'>Batal</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-home" style="font-size: 26px;"></i> Toko<b>POS</b></h1>

                <p>©2017 All Rights Reserved. <b>TokoPOS</b></p>
              </div>
            </div>
          </form>
          <!-- form -->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="#" id="hal2" class="btn btn-default btn-sm hidden"> Halaman 2</a>
          </div>
        </section>
        <!-- content -->
      </div>
  </div>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="keluar()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Install Client</h3>
        </div>
        <div class="modal-body form">
          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="cabang"/>
            <div class="form-body">
              <div class="form-group">
                <label class="control-label col-md-3">Username</label>
                <div class="col-md-9">
                  <input name="user" id="users" title="Anda harus teliti dalam memasukkan username" placeholder="Masukkan username install client" class="form-control" type="text" autofocus/>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Password</label>
                <div class="col-md-9">
                  <input name="pass" id="passw" placeholder="Masukkan password install client" class="form-control" type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">API Key</label>
                <div class="col-md-9">
                  <input name="api" id="api" placeholder="Masukkan 16 digit API Key" class="form-control" type="text">
                </div>
              </div>
            </div>
          </form>
            </div>
            <div class="modal-footer">
              <a type="button" id="btnSave" onclick="simpan()" class="btn btn-default">Install Client</a>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    <!-- End Bootstrap modal -->
    <!-- jQuery -->
    <script src="<?php echo base_url()."assets/";?>js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url()."assets/";?>js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(function(){
      $('#hal1').click(function(){
        $('#page2').hide();
        $('#page1').fadeIn();
      });
      $('#hal2').click(function(){
        $('#page1').hide();
        $('#page2').fadeIn();
        $('#page2').attr('class','animate form login_content');
      });
      $('#toregister').click(function(){
        $('#page1').hide();
        $('#page2').fadeIn();
        $('#page2').attr('class','animate form login_content');
      });
      $('#tologin').click(function(){
        $('#page2').hide();
        $('#page1').fadeIn();
      });

      $(document).on('keyup', function(e){
        e.preventDefault();
        if(!$("input").is(":focus")){
          if($('#page1').is(':visible')){
            if(e.keyCode == 39){
              console.log(e.keyCode);
              $('#hal2').click();
            }else if(e.keyCode == 37){
              $('#hal2').click();
            }else if(e.keyCode == 85){
              $('#username').focus();
            }else if(e.keyCode == 80){
              $('#kunci').focus();
            }else if(e.keyCode == 73){
              $('#masuk').focus();
            }
          }else if($('#page2').is(':visible')){
            if(e.keyCode == 39){
              $('#hal1').click();
            }else if(e.keyCode == 37){
              $('#hal1').click();
            }
          }
        }else if(e.keyCode == 27){
          $('input').blur();
        }
      })
    });

    function cek()
    {
      $.ajax({
        url:'<?php echo site_url('login/cekapi');  ?>',
        type:'get',
        success : function(data){
          if(data > 0) {
            var value = document.getElementById("kode").value;
            if(value == 'invalid'){
              hapus();
              alert('Username tidak terdaftar diserver, silahkan cek kembali');
              location.reload();
            }else if (value == 'ip') {
              hapus();
              alert('Ip tidak terdaftar diserver, lakukan setting IP terlebih dahulu');
              location.reload();
            }else if (value == 'api') {
              hapus();
              alert('API key tidak benar, mohon dicek kembali');
              location.reload();
            }
          }else {
            $('#form')[0].reset();
            $('#modal_form').modal({backdrop: 'static', keyboard: false});
            $('#modal_form').modal('show');
            $('#modal_form').on('shown.bs.modal', function () {
                $('#users').focus();
            });
            $("#api").on('keypress', function(event){
              if(event.keyCode == 13){
                event.preventDefault();
                $("#btnSave").click();
              }
            });
          }
        }
      });
     }

    function keluar() {
      window.location.reload();
    }

    function simpan() {
      $.ajax({
        url :'<?php echo site_url('login/initapi')?>',
        type : 'post',
        data : $('#form').serialize(),
    		dataType: "JSON",
    		success: function(response){
         alert('Data sedang dicek di server');
   		   location.reload();
       },
       error: function (jqXHR, textStatus, errorThrown)
   		{
        alert('Gagal melakukan pengecekan data \n'+ errorThrown);
   		}
      });
    }

    function hapus() {
      $.ajax({
        url : '<?php echo site_url('login/reset') ?>',
        success:function(response){
        }
      });
    }
    </script>

</body>
</html>
