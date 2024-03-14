<!DOCTYPE html>
<html>
<head></head>
<body>
  <form id="loginform" action="<?php echo base_url().'sso/login_via_remember' ?>" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
    <input type="hidden" name="client_id" value="<?php echo $client_id ?>">
    <input type="hidden" name="challenge" value="<?php echo $challenge ?>">
    <input type="hidden" name="challenge_method" value="<?php echo $challenge_method ?>">
    <input type="hidden" name="redirect" value="<?php echo $redirect ?>">
  </form>
  <script>
    document.getElementById("loginform").submit();
  </script>
</body>
</html>
