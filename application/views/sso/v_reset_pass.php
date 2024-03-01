<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mawas SSO - Reset Pass</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?=base_url()?>/gambar/favicon.png" type="image/gif">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .bg-gradient {
      background: linear-gradient(140deg, #1a540d 0%, #40b825 70%, #5ef73b 100%);
    }
  </style>
</head>
<body class="hold-transition login-page bg-gradient">
  <div class="login-box" style="margin-top: 10%;">
    <div class="login-logo">
      <!-- <h3>APLIKASI MONITORING KEUANGAN</h3>      -->
    </div>

    <?php
    if(!empty($alert)){  
      echo "<div class='alert alert-danger font-weight-bold text-center'>$alert</div>";
    } 
    ?>

    <div class="login-box-body" style="border-radius: 15px;">
      <img src="<?php echo base_url('gambar/logo.png') ?>" class="img-responsive">
      <div style="position: relative; top: -50px;">
        <div class="col-12 text-center">
          <h3>Reset SSO password</h3>
        </div>

        <div class="col-12 text-center">
          <?php 
              if($this->session->flashdata('error')) { 
          ?>
                <div class="alert alert-danger" role="alert">
                    <?=$this->session->flashdata('error')?>
                </div>
          <?php 
              } 
          ?>
          <?php 
              if($this->session->flashdata('alert')) { 
          ?>
                <div class="alert alert-success" role="alert">
                    <?=$this->session->flashdata('alert')?>
                </div>
          <?php 
              } 
          ?>
        </div>

        <?php
          $pass_cache = !empty($this->session->flashdata('pass_cache'))? $this->session->flashdata('pass_cache'): '';
          $cpass_cache = !empty($this->session->flashdata('cpass_cache'))? $this->session->flashdata('cpass_cache'): '';
        ?>

        <form action="<?php echo base_url().'sso/do_reset_password' ?>" method="post">
          <input type="hidden" name="reset_code" value="<?=$_GET['reset_code']?>">
          <input type="hidden" name="client_id" value="<?=$_GET['client_id']?>">

          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="New Password" name="password" value="<?=$pass_cache?>">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Confirm New Password" name="confirm_password" value="<?=$cpass_cache?>">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">RESET</button>
            </div>
          </div>

          <div class="row text-center" style="margin-top: 10px;">
            <span>Back to&nbsp;</span>
            <a class="cssbuttongo" href="<?=$this->session->flashdata('client_home')?>">
                <span>Login</span>
            </a>
          </div>

        </form>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

</body>
</html>
