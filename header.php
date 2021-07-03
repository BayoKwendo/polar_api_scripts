<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>POLAR MANAGEMENT LTD.<?php echo $data->title;?></title>
	<meta name="description" content="POLAR Management">
	<meta name="keywords" content="POLAR">

	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Open+Sans|Raleway" rel="stylesheet">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<!-- Page level plugin CSS-->
	<link href="web-admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>

<body id="top" data-spy="scroll">
	<!--top header-->

	<header id="home">

		<section class="top-nav hidden-xs">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="top-left">
							<ul>
								<li><a href="https://www.facebook.com/PolarManagement/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3">
						<div class="top-left">
							<ul>
								<?php
									if($user = get_active_user_A()){
										echo '<li><a href="profile.php"><i class="fa fa-user" aria-hidden="true"></i>Hello! '.strtoupper($user->username).'</a></li>';
										echo '<li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>';
									} else {
										echo '<li><a href="#login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>My Account</a></li>';
									}
								?>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="top-right">
							<p>Location:<span>COMET HSE, MONROVIA STREET SUITE 19</span></p>
						</div>
					</div>

				</div>
			</div>
		</section>

		<!--main-nav-->

		<div id="main-nav">

			<nav class="navbar">
				<div class="container">

					<div class="navbar-header">
						<!--a href="" class="navbar-brand">POLAR</a!-->
						<img class="navbar" height="90" src="images/logo.jpeg" />
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ftheme">
							<span class="sr-only">Toggle</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<div class="navbar-collapse collapse" id="ftheme">

						<ul class="nav navbar-nav navbar-right">
							<li <?php echo $data->name=='home'? ' class="active" ':'';?> ><a href="index.php">home</a></li>
							<li <?php echo $data->name=='about'? ' class="active" ':'';?> ><a href="about.php">about</a></li>
							<li <?php echo $data->name=='service'? ' class="active" ':'';?> ><a href="service.php">services</a></li>
							<li <?php echo $data->name=='jobs'? ' class="active" ':'';?> ><a href="jobs.php">Jobs</a></li>
							<li <?php echo $data->name=='contact'? ' class="active" ':'';?> ><a href="contact.php">contact</a></li>
							<li class="hidden-sm hidden-xs">
								<a href="#" id="ss"><i class="fa fa-search" aria-hidden="true"></i></a>
							</li>
						</ul>

					</div>

					<div class="search-form">
						<form>
							<input type="text" id="s" size="40" placeholder="Search..." />
						</form>
					</div>

				</div>
			</nav>
		</div>
		<hr style="margin:0;" />
	</header>

