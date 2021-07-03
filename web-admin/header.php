<?php
  $active_user = get_active_user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
	<link rel="icon" type="image/png" href="http://polar-management.com/images/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>POLAR</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">POLAR</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pages">
          <a class="nav-link" href="pages.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Pages</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="News Feed">
          <a class="nav-link" href="news.php">
            <i class="fa fa-fw fa-newspaper-o"></i>
            <span class="nav-link-text">News Feed</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Jobs">
          <a class="nav-link" href="jobs.php">
            <i class="fa fa-fw fa-briefcase"></i>
            <span class="nav-link-text">Jobs</span>
          </a>
        </li>
        <!--li class="nav-item" data-toggle="tooltip" data-placement="right" title="Job Applicantions">
          <a class="nav-link" href="applicantions.php">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Applicantions <i class="badge badge-light"><?php echo db_get_field_val("SELECT COUNT(*) AS num FROM job_application WHERE apply='1'","num");?></i></span>
          </a>
        </li!-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Web Media">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#media" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Web Media</span>
          </a>
            <ul class="sidenav-second-level collapse" id="media">            
              <li>
                <a href="slideshow.php">Slidshow</a>
              </li>
              <li>
                <a href="photos.php">Photos</a>
              </li>
              <li>
                <a href="videos.php">Videos</a>
              </li>
              
            </ul>
        </li>
          
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Applicants">
          <a class="nav-link" href="applicants.php">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Applicants</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
          <a class="nav-link" href="users.php">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Users</span>
          </a>
        </li>
        
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="alertsDropdown" href="#" data-toggle="dropdown" >
            <b class=""><?php echo $active_user->full_names; ?></b>              
          </a>
          <!--div class="dropdown-menu" aria-labelledby="alertsDropdown">
            
            <a class="dropdown-item small1" href="./user.php"> About Me</a>
            <div class="dropdown-divider" ></div>
            <a class="dropdown-item small1" <?php echo "data-id='$active_user->id' data-oldpass='$active_user->password' ";?> href="#" class="" data-toggle="modal" data-target="#passwordModal"> Change Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small1" href="#">More</a>
          </div!-->
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul!-->
    </div>
  </nav>
  