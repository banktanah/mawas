<?php
  /**
   * We need this page for the app to successfully saved 
   * the new session_id and remember_token into cookies
   */
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
  <form id="loginform" action="<?php echo base_url().'sso/automatic_login' ?>" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
    <input type="hidden" name="client_id" value="<?php echo $client_id ?>">
    <input type="hidden" name="challenge" value="<?php echo $challenge ?>">
    <input type="hidden" name="challenge_method" value="<?php echo $challenge_method ?>">
    <input type="hidden" name="remember_me" value="<?php echo $remember_me ?>">
    <input type="hidden" name="redirect" value="<?php echo $redirect ?>">
  </form>
  <script>
    document.getElementById("loginform").submit();
  </script>
</body>
</html>
