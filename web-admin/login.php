<?php //header("Location:pages.php");?>
<?php require_once('functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>POLAR</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Staff Login</div>
      <div class="card-body">
        <form method="post" action="formSubmit.php" >
        <?php echo view_message(); ?>  
          <div class="form-group">
            <label for="login_name">Username or Email address</label>
            <input class="form-control" id="login_name" name="login_name" type="text" aria-describedby="login_name" placeholder="Enter username or email" required>
          </div>
          <div class="form-group">
            <label for="login_password">Password</label>
            <input class="form-control" id="login_password" name="login_password" type="password" placeholder="Login Password" required>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="staff-login" >Login</button> 
        </form>
        <hr />
        <a href="../index.php">Back to POLAR Website</a>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
