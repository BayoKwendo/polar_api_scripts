<?php include ('functions.php');?>
<?php
$data = FALSE;

$remote_url;

if(isset($_GET['filter_value'])) {

  $filter_value = str_replace(' ','*',$_GET['filter_value']);
  $remote_url = "https://api.polarmanpower.com/jobs_public?filter_value=$filter_value";
}elseif(isset($_GET['id'])) {

  $id = str_replace(' ','*',$_GET['id']);
  $remote_url = "https://api.polarmanpower.com/jobs_public?id=$id";
}
else{
  $remote_url = "https://api.polarmanpower.com/jobs_public";
}


  //$remote_url = "https://testibg-lp-027:443/Documentation/Apis/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $remote_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$headers = array(
  'Accept: application/json',
  'Content-Type: application/json'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$return = curl_exec($ch);
if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
}
$result = json_decode($return);




// $heading_title = 'Currently Available Jobs';
// $heading = $thisjob==FALSE? $heading_title. ' '.$ctry_title:$thisjob;
// $heading = $thisapply==FALSE? $heading:$thisapply;
//   //var_dump($result,$remote_url)

$heading; 

?>


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
</head>
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
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li> 
            



            <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>

            <li class="nav-item"><a class="nav-link" href="services.php">Our Services</a></li>

            <li class="nav-item"><a class="nav-link" href="jobs.php">Jobs</a></li>

            <li class="nav-item"><a class="nav-link" href="https://finance.polarmanpower.com/">Staff Login</a></li>

            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="banner header-text">
    <div class="owl-banner owl-carousel">
      <div class="banner-item-01">
        <div class="text-content">
          <h2>GREAT WORK</h2>
          <h4>Your first stop to your next career move in any field.</h4>
        </div>
      </div>
      <div class="banner-item-02">
        <div class="text-content">
          <h2>GREAT TEAM MEMBERS</h2>
          <h4>Build and maintain long term relationships with our clients and our candidates.</h4>
        </div>
      </div>
      <div class="banner-item-03">
        <div class="text-content">
          <h2>COLABORATION TEAM GROUP</h2>
          <h4>We are always on the lookout for determined, enthusiastic people who are passionate about a career.</h4>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Ends Here -->

  <div class="best-features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">


          <div class="section-heading">
            <h2>About Us</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="left-content">




            <p>Polar Agencies is an employment company registered under Kenyan Law and deals with foreign placement solutions/services located in Nairobi &ndash; Kenya.</p>
            <p> Polar Agencies brings a fresh and innovative approach to consulting services, acting as liaison between the job seekers and&nbsp; &nbsp;the foreign employers and also provides and harnesses employment&nbsp; &nbsp;migration and development to both the home and destination countries.&nbsp; &nbsp;We aim to build and maintain long term relationships. The company has reported substantial organic growth over the past ten years undoubtedly as a result of this philosophy</p>
            <ul class="featured-list">
              <li><a href="#">Time management</a></li>
              <li><a href="#">Interpersonal skills</a></li>
              <li><a href="#"> Leadership qualities.</a></li>
            </ul>
            <br/>
            <div class="fb-page" 
            data-tabs="events"
            data-href="https://web.facebook.com/PolarManagement/?_rdc=1&_rdr"
            data-width="380">

          </div>
          <script>
            window.fbAsyncInit = function() {
              FB.init({
                appId            : '?_rdc=1&_rdr',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v11.0'
              });
            };
          </script>
          <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
          <ul class="social-icons">
            <br/>
            <li><a href="https://www.facebook.com/PolarManagement/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="https://twitter.com/polarglobal?lang=en"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://ca.linkedin.com/company/aboutpolar"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>

          </ul>
          <br />
          
          <a class="twitter-timeline"
          href="https://twitter.com/polaragencies?lang=en"
          data-width="300"
          data-height="300">
          Tweets by @PolarAgencies
        </a>

      </div>
    </div>
    <div class="col-md-6">
      <div class="right-image">
        <img src="assets/images/IMG_8939.jpg" alt="">
      </div>
    </div>
    <div class="offset-3 col-md-6 text-center">
      <br/>
      <a href="aboutus.php" class="filled-button">Read More</a>
    </div>
  </div>


</div>
</div>

<div class="services" style="background-image: url(assets/images/IMG_884.jpg);" >
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Currently Available Jobs</h2>

<!--           <a href="blog.html">read more <i class="fa fa-angle-right"></i></a>
-->        </div>
</div>

<?php

if(isset($result->data)) {
  $number_output = 0;                //$jobs = $result->jobs;
  foreach($result->data AS $row) {

    $number_output++;
    if($number_output > 3)break;


    echo '
    <div class="col-lg-4 col-md-6">
    <div class="service-item">
    <a href="#" class="services-item-image"><img src="assets/images/IMG_8928.jpg" class="img-fluid" alt=""></a>

    <div class="down-content">
    <h4><a href="?job='.$row->id.'&title='.$row->position.' at '.$row->company_name.'" >'.$row->position.' - '.$row->company_name.'</a></h4>
    <h6><b>Duty Station: </b>'.$row->location_of_work.' <br/>
    <b>Posted on: </b>'.$row->created_on.' <br/> <b>Status: </b> <i  style="color:green;">'.$row->status.' </i></h6>
    <br />

    <div class="pull-right">
    <a href="jobs.php?id='.$row->id.'" >Read more to Apply<i class="fa fa-angle-right"></i></a>
    </div>
    </div>
    </div>
    </div>';




  }                 
} 
?>


<div class="offset-3 col-md-6 text-center">
  <a href="jobs.php" class="filled-button">Find More Jobs</a>
</div>
</div>
</div>
</div>
</div>

<div class="happy-clients">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>Our Clients</h2>

<!--           <a href="testimonials.html">read more <i class="fa fa-angle-right"></i></a>
-->        </div>
</div>
<div class="col-md-12">
  <div class="owl-clients owl-carousel text-center">
    <div class="service-item">
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
      <div class="down-content">
        <h4>ABDAL RECRUITMENT CO </h4>
<!--                   <p class="n-m"><em>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</em></p>
-->                </div>
</div>

<div class="service-item">
  <div class="icon">
    <i class="fa fa-user"></i>
  </div>
  <div class="down-content">
    <h4>MOHAMMED AL-HAIDER</h4>
<!--                   <p class="n-m"><em>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</em></p>
-->                </div>
</div>

<div class="service-item">
  <div class="icon">
    <i class="fa fa-user"></i>
  </div>
  <div class="down-content">
    <h4>CAN RECRUITMENT OFFICE</h4>
    <!--  <p class="n-m"><em>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</em></p> -->
  </div>
</div>

<div class="service-item">
  <div class="icon">
    <i class="fa fa-user"></i>
  </div>
  <div class="down-content">
    <h4>BRIGHT INTERNATIONAL</h4>
    <!-- <p class="n-m"><em>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</em></p> -->
  </div>
</div>

<div class="service-item">
  <div class="icon">
    <i class="fa fa-user"></i>
  </div>
  <div class="down-content">
    <h4>SAUDI COMPANY</h4>
    <!-- <p class="n-m"><em>"Lorem ipsum dolor sit amet, consectetur an adipisicing elit. Itaque, corporis nulla at quia quaerat."</em></p> -->
  </div>
</div>

<div class="service-item">
  <div class="icon">
    <i class="fa fa-user"></i>
  </div>
  <div class="down-content">
    <h4>FUEL PUMP ATTENDANTS</h4>
    <!-- s -->
  </div>
</div>
</div>
</div>
</div>
</div>
</div>



<div class="call-to-action">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="inner-content">
          <div class="row">
            <div class="col-md-8">
              <h4>Polar Agencies</h4>
              <p>We aim to build and maintain long term relationships with both our clients and our candidates</p>
            </div>
            <div class="col-lg-4 col-md-6 text-right">
              <a href="contact.php" class="filled-button">Contact Us</a>
            </div>
          </div>
        </div>
      </div>
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
