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





$heading_title = 'Currently Available Jobs';
$heading = $thisjob==FALSE? $heading_title. ' '.$ctry_title:$thisjob;
$heading = $thisapply==FALSE? $heading:$thisapply;
  //var_dump($result,$remote_url);
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

 <!-- Additional CSS Files -->
 <link rel="stylesheet" href="assets/css/fontawesome.css">
 <link rel="stylesheet" href="assets/css/style.css">
 <link rel="stylesheet" href="assets/css/owl.css">
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
 


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
            <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>

            <li class="nav-item"><a class="nav-link" href="services.php">Our Services</a></li>

            <li class="nav-item active"><a class="nav-link" href="jobs.php">Jobs</a></li>

            <li class="nav-item"><a class="nav-link" href="https://finance.polarmanpower.com/">Staff Login</a></li>

            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Page Content -->
  <div class="page-heading about-heading header-text"  style="background-image: url(assets/images/IMG_8809.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Currently Available</h4>
            <h2>Jobs</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
   <br/>
   <div class="section-heading" style="padding-right: 60px; padding-left: 60px;">
    <h2>Job Categories</h2>
  </div>


  <div class="col-md-12">
    <br/>
  </div>
  <div class="col-md-4 row col-md-offset-4 pull-right">
    <form class="form-inline" method="GET" action="jobs.php">
      <div class="input-group col-md-12">
        <input type="text" class="form-control" placeholder="Search here..." name="filter_value"  value="<?php echo isset($_GET['filter_value']) ? $_GET['filter_value'] : '' ?>"/>
        <span class="input-group-btn">
          <button class="btn btn-primary" name="search"><span class="fa fa-search"></span></button>
        </span>
        &nbsp; &nbsp;
        <span class="input-group-btn">
          <a href="jobs.php?">
            <span  class="btn btn-danger fa fa-remove"></span>
          </a>
        </span>
      </div>

    </form>

  </div>

  <div class="row col-md-12"> 

    <div class="col-md-3"> 
      <br />
      <div class="row col-md-12">

        <div class="col-md-12">
          <div class="about-left1">
            <?php //echo $data->content; ?>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center active">
                <b>JOBS BY COUNTRY</b>
              </li>
              <?php
              if(isset($result->location_of_work)){
                foreach($result->location_of_work AS $c) {
                  echo '<li class="list-group-item d-flex justify-content-between align-items-center"><a href="?filter_value='.str_replace(' ','*',$c->location_of_work).'" >'.$c->location_of_work.'</a><span class="badge badge-primary badge-pill">'.$c->count.'</span></li>';
                }
              }
              ?>
            </ul>
          </div>
          <br/>
          <div class="about-left1">
            <?php //echo $data->content; ?>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center active">
                <b>JOBS BY COMPANY</b>
              </li>
              <?php
              if(isset($result->company_name)){
                foreach($result->company_name AS $c) {
                  echo '<li class="list-group-item d-flex justify-content-between align-items-center"><a href="?filter_value='.str_replace(' ','*',$c->company_name).'" >'.$c->company_name.'</a><span class="badge badge-primary badge-pill">'.$c->count.'</span></li>';
                }
              }
              ?>
            </ul>
          </div>
          <br/>
          <div class="about-left1">
            <?php //echo $data->content; ?>
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center active">
                <b>SALARY OFFERED</b>
              </li>
              <?php
              if(isset($result->salary_offered)){
                foreach($result->salary_offered AS $c) {
                  echo '<li class="list-group-item d-flex justify-content-between align-items-center"><a href="?filter_value='.str_replace(' ','*',$c->salary_offered).'" >'.$c->salary_offered.'</a><span class="badge badge-primary badge-pill">'.$c->count.'</span></li>';
                }
              }
              ?>
            </ul>
          </div>
        </div>
     <!--  <div class="col-md-6">
        
      </div>
    -->
  </div>
</div>
<!-- wrapper right-->




<div class="col-md-9">
      
  <br />
  <?php
  if(isset($result->status)) {
    if($result->status == 0){
      echo '<div class="alert alert-warning text-center">'.$result->msg.'</div>';
    } elseif($result->status == 1) {
          if(isset($_GET['msg'])){ //var_dump($_GET);
            $msg = base64_decode($_GET['msg']);
            $alert = substr($msg,0,5)=='Error'? 'danger':'success';
            echo '<div class="alert alert-'.$alert.' alert-dismissible" role="alert">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">×</button>
            '.$msg.'
            </div>';
          }
      if(count($result->data) > 0) {
                  //$jobs = $result->jobs;
        echo '
        <div class="row">';
        foreach($result->data AS $row) {
          if($result->data)
          echo '<div class="col-md-3">
          <div class="product-item">
          <div class="down-content">
          <h4><a href="?job='.$row->id.'&title='.$row->position.' at '.$row->company_name.'" >'.$row->position.' - '.$row->company_name.'</a></h4>
          <h6><b>Duty Station: </b>'.$row->location_of_work.' <br/>
          <b>Posted on: </b>'.date_format(date_create($row->created_on),"Y/m/d H:i:s").' <br/> 
          <b>Salary Offered: </b> <i  style="color:green;">'.$row->salary_offered.' </i><br/>
          <b>Status: </b> <i  style="color:green;">'.$row->status.' </i></h6>
          </small>
          <br />
          <div class="pull-right">
          <a href="?id='.$row->id.'" >Read more to Apply<i class="fa fa-angle-right"></i></a>
          </div>
          </div>
          </div>
          </div>
          ';
        }                 
        echo ' 
        </div>
        </div>
        </div>
        </div>
        ';

      }
      else{

         echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">×</button>
            No result!';

      }
    }
    elseif($result->status == 3) {
      if(isset($result->data)) {
        $job = $result->data;
        $job_required = $result->required_documents;
        $job_docs = '<ol ><li>'.implode('</li><li>', ).'</li></ol>';
        $gender = (object)['M'=>'Male','F'=>'Female','M/F'=>'Male / Female','none'=>'None'];
                  //var_dump($job->sex,$gender);
        $index = $job->sex==''? 'none':$job->sex;
        $gender = $gender->{$index};
                  //var_dump($job, $docs);
        echo '<a href="jobs.php" class="btn btn-default " >Go Back</a>';
        echo '<hr style="margin:5px 0 0 0" />';
        echo    '<table class="table table-responsive table-condensed">
        <tr><td colspan="2"><b>Job Title: </b>'.$job->position.' ['.$job->quantity.']</td></tr>
        <tr><td ><b>Job Reference #: </b>'.$job->job_ref.'</td><td><b>Duty Station: </b>'.$job->location_of_work.'</tr>
        <tr><td ><b>Gender: </b>'.$gender.'</td><td><b>Age Limit (years): </b>'.$job->age_limit.'</td></tr>
        <tr><td ><b>Date Posted: </b>'.$job->created_on.'</td><td><b>Status: </b>'.$job->status.'</td></tr>
        <tr><td colspan="2"><b>Job Summary : </b><br />'.$job->remarks.'</td></tr>
        <tr><td colspan="2"><b>Application Requirements: </b><br />'.$job_required->ColumnName.'</td></tr>
        </table>';
        echo '<a href="?filter_value=apply&apply='.$job->id.'&title='.$job->position.' at '.$job->company_name.'" class="btn btn-default pull-right" >
        <span  class="btn btn-success">Apply</span></a>';
        echo '<hr >';
      }
    } 
    elseif($result->status == 4) {
      ?>
      <br/>
      <h4><?php echo '<h5> Applying for Job Position: <b>'.$_GET['title'].'</b> </h4>';?></h4>
        <br />
        <br />
        <form class="form-vertical" method="POST" action="forms.php" >
          <input type="hidden" name="id" value="-1" />
          <div class="col-md-8 col-md-offset-2">
            <div class="col-md-4">
              <div class="form-group">
                <label class="col-form-label">Applicant Name</label>
                <input class="form-control" name="applicant_name" type="text" value="" placeholder="Applicant Name" required >
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="personal_contact">Applicant Contact/ Phone Number</label>
                <input  id="personal_contact" type="text" name="personal_contact" value="+254" class="form-control" placeholder="Phone Number" required>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="email_address">Email Address <small style="color:red;font-weight:bold;"><sup>Enter a valid email addres</sup></small></label>
                <input id="email_address" type="text" name="email_address" value="" class="form-control" placeholder="example@gmail.com" required>
              </div>
            </div>

            <button class="btn btn-primary pull-right" type="submit" name="submit">Submit</button>
          </div>

        </form>
        <?php
        // echo '<hr >';
      }
    }
    ?>

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

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Additional Scripts -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/owl.js"></script>

</body>

</html>
