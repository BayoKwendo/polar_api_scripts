<!DOCTYPE html>
<html lang="en">

<head>

 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="">
 <meta name="author" content="">
 <link rel="icon" href="assets/images/favicon.png">
 <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

 <title>Polar</title>

 <!-- Bootstrap core CSS -->
 <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

 <!-- Additional CSS Files -->
 <link rel="stylesheet" href="assets/css/fontawesome.css">
 <link rel="stylesheet" href="assets/css/style.css">
 <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>  
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.php"><h2>Polar <em>Agencies</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li> 
            <li class="nav-item"><a class="nav-link" href="aboutus.php">AboutUs</a></li>




            <li class="nav-item"><a class="nav-link" href="services.php">Our Services</a></li>

            <li class="nav-item"><a class="nav-link" href="jobs.php">Jobs</a></li>

            <li class="nav-item"><a class="nav-link" href="https://finance.polarmanpower.com/">Staff Login</a></li>

            <li class="nav-item active"><a class="nav-link" href="contact.php">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Page Content -->
  <div class="page-heading contact-heading header-text" style="background-image: url(assets/images/IMG_8950.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>GET IN TOUCH</h4>
            <h2>Contact Us</h2>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="find-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Our Location on Maps</h2>
          </div>
        </div>
        <div class="col-md-8">
<!-- How to change your own map point
	1. Go to Google Maps
	2. Click on your location point
	3. Click "Share" and choose "Embed map" tab
	4. Copy only URL and paste it within the src="" field below
-->
<div id="map">

  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8201435996207!2d36.82000416197175!3d-1.281663004362784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10d3b7816bab%3A0x478d83f048088e5c!2sPolar%20Agencies%20%7BK%7D%20Ltd!5e0!3m2!1sen!2ske!4v1628625362855!5m2!1sen!2ske" width="100%" height="330px" frameborder="0" allowfullscreen="" loading="lazy"></iframe>

</div>
</div>
<div class="col-md-4">
  <div class="left-content">
    <h4>About our office</h4>
    <p><b>Valji Building, No. 301 Moktar Daddah St, Nairobi</b><br>
      Nairobi-Kenya<br>
      <b>Tel:</b> _+254111024500 │ +254723277996<br>
      <b>Email: </b> polaragencies@gmail.com</p>
      <ul class="social-icons">
        <li><a href="https://www.facebook.com/PolarManagement/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="https://twitter.com/polarglobal?lang=en"><i class="fa fa-twitter"></i></a></li>
        <li><a href="https://ca.linkedin.com/company/aboutpolar"><i class="fa fa-linkedin"></i></a></li>
        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
      </ul>
    </div>
  </div>
</div>
</div>
</div>


<div class="send-message">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Send us a Message</h2>
        </div>
      </div>
      <div >
        <?php
          if(isset($_GET['msg'])){ //var_dump($_GET);
            $msg = base64_decode($_GET['msg']);
            $alert = substr($msg,0,5)=='Error'? 'danger':'success';
            echo '<div class="alert alert-'.$alert.' alert-dismissible" role="alert">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">×</button>
            '.$msg.'
            </div>';
          }
          ?>
        </div>
        <div id="errormessage"></div>
        <div class="col-md-8">
          <div class="contact-form">
            <form id="contact" action="feedback.php" method="post">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <fieldset>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required="">
                  </fieldset>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <fieldset>
                    <input name="email" type="text" class="form-control" id="email" placeholder="E-Mail Address" required="">
                  </fieldset>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <fieldset>
                    <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" required="">
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                  </fieldset>
                </div>
                <div class="col-lg-12">
                  <fieldset>
                    <button type="submit" id="form-submit" class="filled-button">Send Message</button>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-4">
          <img src="assets/images/IMG_8.jpg" class="img-fluid" alt="">

<!--         <h5 class="text-center" style="margin-top: 15px;">John Doe</h5>
-->      </div>
</div>
</div>
</div>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="inner-content">
          <ul class="social-icons">
            <li><a href="https://www.facebook.com/PolarManagement/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="https://twitter.com/polarglobal?lang=en"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://ca.linkedin.com/company/aboutpolar"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
          </ul>
          <br />
          <p>Copyright © 2021 POLAR AGENCIES Ltd. All rights reserved<</p>

        </div>
      </div>
    </div>
  </div>
</footer>



<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Additional Scripts -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/owl.js"></script>
</body>

</html>
