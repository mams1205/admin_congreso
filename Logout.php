<?php

  $PageSecurity =1;
  $AllowAnyone=True; /* Allow all users to log off - needed for autoamted runs */

  include('includes/librerias.php');
  include('includes/session.inc');

?>
<html>
<head>
	<title><?php echo $_SESSION['CompanyRecord']['coyname'];?> - <?php echo 'Log Off'; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/<?php echo $theme;?>/login.css" type="text/css" />
</head>

<body class="bg-white">
  <div class="login-box">
    <div class="login-logo ml-auto">
      <img src="Images/Logo_Slic.jpg" class="rounded" alt="Logo Slic Soluciones" width="250" height="90">
      <h6> Gracias por usar SlicWEB </h6>
    </div>

    <div class="card">
      <div class="card-body login-card-body">
      	<form action="<?php echo $rootpath; ?>/indexppal.php" name="loginform" method="post">
          <input type="hidden" name="FormID" value="<?php echo $_SESSION['FormID']; ?>" />

          <div class="row">
            <button type="submit" class="btn btn-primary btn-block btn-rounded" name="SubmitUser">Regresar a Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>



<?php
  session_unset();
  session_destroy();

?>
