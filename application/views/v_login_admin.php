<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?=base_url()?>/gambar/favicon.png" type="image/gif">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page bg-blue">
  <div class="login-box" style="margin-top: 4%;">
    <div class="login-logo">
      <!-- <h3>APLIKASI MONITORING KEUANGAN</h3>      -->
    </div>

    <?php 
    if(isset($_GET['alert'])){
      if($_GET['alert']=="gagal"){
        echo "<div class='alert alert-danger font-weight-bold text-center'>Maaf! Email & Password Salah.</div>";
      }else if($_GET['alert']=="belum_login"){
        echo "<div class='alert alert-danger font-weight-bold text-center'>Anda Harus Login Terlebih Dulu!</div>";
      }else if($_GET['alert']=="logout"){
        echo "<div class='alert alert-success font-weight-bold text-center'>Anda Telah Logout!</div>";
      }
    } 
    ?>

    <div class="login-box-body">

      <img src="<?php echo base_url('gambar/logo.png') ?>" class="img-responsive">

      <form action="<?php echo base_url().'admin/aksi' ?>" method="post">

        <div class="form-group has-feedback">          
          <input type="text" class="form-control" placeholder="Username" name="username">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <?php echo form_error('username'); ?>

        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <?php echo form_error('password'); ?>
        

        <div class="row">

          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
          </div>
        </div>

      </form>

    </div>
  </div>

  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

</body>
</html>
