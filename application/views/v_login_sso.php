<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo !empty($app_name)? $app_name: 'Mawas SSO';?></title>
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
    if(!empty($alert)){  
      echo "<div class='alert alert-danger font-weight-bold text-center'>$alert</div>";
    } 
    ?>

    <?php
      if(!empty($client_id)){
    ?>
      <div class="login-box-body">

        <img src="<?php echo base_url('gambar/logo.png') ?>" class="img-responsive">

        <div style="position: relative; top: -50px;">
          <div class="col-12 text-center">
            <h3><?php echo $app_name ?></h3>
          </div>

          <div class="col-12 text-center">
            <h4><?php echo $app_desc ?></h4>
          </div>

          <form action="<?php echo base_url().'sso/login' ?>" method="post">
            <input type="hidden" name="client_id" value="<?php echo $client_id ?>">
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
    <?php
      }
    ?>
  </div>

  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

</body>
</html>
