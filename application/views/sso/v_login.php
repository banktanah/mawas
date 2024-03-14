<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo 'SSO BBT'.(!empty($app_name)? ' | '.$app_name: '');?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?=base_url()?>/gambar/favicon.png" type="image/gif">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <script src="https://www.google.com/recaptcha/api.js"></script>
  <?php include('_style.php') ?>
</head>
<!-- <body class="hold-transition login-page bg-gradient" style="overflow-y: hidden;"> -->
<body class="hold-transition login-page with-bg-img" style="overflow-y: hidden;">
  <div class="login-box center-ele">
      <div class="login-box-body" style="border-radius: 15px;">
        <img src="<?php echo base_url('gambar/logo.png') ?>" class="img-responsive">

        <div style="position: relative; top: -50px;">
          <div class="col-12 text-center">
            <h3><?php echo !empty($app_name)? $app_name: '' ?></h3>
          </div>

          <div class="col-12 text-center">
            <h4><?php echo !empty($app_desc)? $app_desc: '' ?></h4>
          </div>

          <?php 
            if($this->session->flashdata('alert')) { 
          ?>
              <div class="alert alert-warning font-weight-bold text-center" role="alert">
                <?=$this->session->flashdata('alert')?>
              </div>
          <?php 
            } 
          ?>

          <?php 
            if($this->session->flashdata('error')) { 
          ?>
              <div class="alert alert-danger font-weight-bold text-center" role="alert">
                <?=$this->session->flashdata('error')?>
              </div>
          <?php 
            } 
          ?>

          <?php
            if(!empty($client_id)){
              $username_cache = !empty($this->session->flashdata('username_cache'))? $this->session->flashdata('username_cache'): '';
          ?>
              <form id="login-form" action="<?php echo base_url().'sso/login' ?>" method="post">
                <input type="hidden" name="client_id" value="<?php echo $client_id ?>">
                <input type="hidden" name="challenge" value="<?php echo $challenge ?>">
                <input type="hidden" name="challenge_method" value="<?php echo $challenge_method ?>">
                <input type="hidden" name="redirect" value="<?php echo $redirect ?>">

                <div class="form-group has-feedback">
                  <input type="text" id="text_username" class="form-control" placeholder="NIP/Email" name="username" value="<?=$username_cache?>">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                  <input type="password" class="form-control" placeholder="Password" name="password">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                  <input type="checkbox" id="remember_me" name="remember_me">
                  <label for="remember_me"> Remember Me</label><br>
                </div>
                
                <div class="row">
                  <div class="col-xs-12">
                    <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button> -->
                    <button 
                      class="btn btn-primary btn-block btn-flat g-recaptcha" 
                      data-sitekey="<?=$recaptcha_site_key?>" 
                      data-callback="onSubmit" 
                      data-action="submit"
                    >
                      LOGIN
                    </button>
                  </div>
                </div>

                <div class="row text-center" style="margin-top: 10px;">
                  <span>Lupa Password?</span>
                  <a class="cssbuttongo" href='<?= (base_url()."sso/forgot_password?client_id=$client_id") ?>'>
                      <span>Click Here</span>
                  </a>
                </div>
              </form>
              <script>
                let savedUsername = localStorage.getItem("text_username");
                if(savedUsername){
                  document.getElementById('text_username').value = savedUsername;
                }
              </script>
          <?php
            }
          ?>
          
          <div class="row text-center" style="margin-top: 10px;">
            &copy; 2024 IT Badan Bank Tanah
          </div>

        </div>
      </div>
  </div>

  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

  <script>
    function onSubmit(token) {
      let username = document.getElementById('text_username').value;
      if(username){
        localStorage.setItem("text_username", username);
      }
      document.getElementById("login-form").submit();
    }

    <?php
      /**
       * We login via javascript because we need the new session id generated -
       * by the login-page's response header. We should use new session id every -
       * login to avoid session fixation attack
       */
      if(!empty($remember_user_id)){
    ?>
        // let form = document.createElement("form");
        // form.method = "POST";
        // form.action = "<?=base_url('/sso/login_via_remember')?>";
  
        // let input_user_id = document.createElement("input");
        // input_user_id.name = "user_id";
        // input_user_id.value = "<?=$remember_user_id?>";
        // form.appendChild(input_user_id);

        // let url = new URL(window.location.href);
  
        // let input_client_id = document.createElement("input");
        // input_client_id.name = "client_id";
        // input_client_id.value = url.searchParams.get("client_id");
        // form.appendChild(input_client_id);
  
        // let input_challenge = document.createElement("input");
        // input_challenge.name = "challenge";
        // input_challenge.value = url.searchParams.get("challenge");
        // form.appendChild(input_challenge);
  
        // let input_challenge_method = document.createElement("input");
        // input_challenge_method.name = "challenge_method";
        // input_challenge_method.value = url.searchParams.get("challenge_method");
        // form.appendChild(input_challenge_method);
  
        // document.body.appendChild(form);
        // form.submit();
    <?php
      }
    ?>
  </script>

</body>
</html>
