<?php include ('web-admin/functions.php');?>
<?php
	$data = FALSE;
	if($data=db_get_row("SELECT * FROM web_pages WHERE name='jobs'")) ;
	else $data = $data=db_get_row("SELECT * FROM web_pages WHERE name='404'");
	$remote_url = "https://ats.polar-management.com/Documentation/Apis/";
	//$remote_url = "https://testibg-lp-027:443/Documentation/Apis/";
	$postData = array();
	$postData['userName'] = 'WEBCLIENT';
	$postData['userKey'] = 'VUU5TVFWSkFNakF4T1E9PQ==';
	$ctry_title = '';
	$thisjob = FALSE;
	$thisapply = FALSE;
	if(isset($_GET['job'])) {
		$job_ref = strval($_GET['job']);
		$thisjob = 'Job details for '. strval($_GET['title']);
		$remote_url .= 'getJoblisting/Job/'.$job_ref.'/';
		$postData['job_ref'] = $job_ref;
	} elseif(isset($_GET['apply'])) {
		$job_id = strval($_GET['apply']);
		$thisapply = 'Job Application form for '. strval($_GET['title']);
		$remote_url .= 'getJoblisting/Apply/'.$job_id.'/';
		$postData['job_id'] = $job_id;
	} elseif(isset($_GET['country'])) {
		$location_of_work = strval($_GET['country']);
		$ctry_title = 'in '		.str_replace('*',' ', $location_of_work);
		$remote_url .= 'getJoblisting/Country/'.$location_of_work.'/';
		$postData['location_of_work'] = $location_of_work;
	} else {		
		$remote_url .= 'getJoblisting/List/';
		//$postData['akk'] = 'ALL Jobs';
	}
	$payload = json_encode($postData);
	
	$ch = curl_init();
	curl_setopt_array(
		$ch, array(
			CURLOPT_URL => $remote_url,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLINFO_HEADER_OUT => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $payload,
			CURLOPT_HTTPHEADER => array(
				'Accept: application/json',
				'Content-Type: application/json',
				'Content-Length: ' . strlen($payload)
			)
		)
	); 
	$return = curl_exec($ch);
	curl_close($ch);
	$result = json_decode(($return));
	$heading_title = 'Currently Available Jobs';
	$heading = $thisjob==FALSE? $heading_title. ' '.$ctry_title:$thisjob;
	$heading = $thisapply==FALSE? $heading:$thisapply;
	//var_dump($result,$remote_url);
?>
<?php include ('header.php'); ?>
<!--about-->
	<div id="about">

		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 ">
					<div class="text-center about-heading1">
						<h4><?php echo $heading ?><hr style="margin:10px;"></h4>	
						<?php echo view_message_A();?>					
					</div>
				</div>
			</div>
		</div>

		<!-- wrapper left-->
		<div class="container">
			<div class="row">
				<div class="col-12 hidden-sm col-md-3">
					<div class="about-left1">
						<?php //echo $data->content; ?>
						<ul class="list-group">
							<li class="list-group-item d-flex justify-content-between align-items-center active">
								<b>JOBS BY COUNTRY</b>
							</li>
							<?php
								if(isset($result->ctry)){
									foreach($result->ctry AS $c) {
										echo '<li class="list-group-item d-flex justify-content-between align-items-center"><a href="?country='.str_replace(' ','*',$c->location_of_work).'" >'.$c->location_of_work.'</a><span class="badge badge-primary badge-pill">'.$c->jobs.'</span></li>';
									}
								}
							?>
							</ul>
					</div>
				</div>
				<!-- wrapper right-->
				<div class="col-12 col-md-9">				
					<?php
						if(isset($result->request)) {
							if($result->request == 'Failed'){
								echo '<div class="alert alert-warning text-center">'.$result->msg.'</div>';
							} elseif($result->request == 'Successful') {
								if(isset($result->jobs)) {
									//$jobs = $result->jobs;
									$headings = '<tr><th></th></tr>';
									echo '<table class="table1 table-responsive" id="dataTable" width="100%" cellspacing="0">';
									echo '<thead>'.$headings.'</thead>';
									//echo '<tfoot>'.$headings.'</tfoot>';
									echo '<tbody>';
									foreach($result->jobs AS $row) {
										echo '<tr>';
										//echo '<td>	</td>';
										echo '<td>';
										echo '<hr style="margin: 10px 1px 10px 1px;" />';
										echo '<h5 style="margin:0;"><a href="?job='.$row->id.'&title='.$row->position.' at '.$row->company_name.'" >'.$row->position.' - '.$row->company_name.'</a></h5>';
										echo '<small class="text-success"><b>Duty Station: </b>'.$row->location_of_work.' <b>Posted on: </b>'.$row->created_on.' <b>Status: </b>'.$row->status.'</small>';
										echo '<br style="margin:0" />';
										echo substr($row->remarks,0,195);
										echo '&nbsp;<small class="pull-left1" ><a  href="?job='.$row->id.'&title='.$row->position.' at '.$row->company_name.'" class="btn1 btn-info btn-xs"><b class="text-warning1" >Read More to Apply</b></a></small>' ;
										
										echo '</td>';
										//echo '<td></td>';
										echo '</tr>';
									}									
									echo '</tbody>';
									echo '</table>';

								} elseif(isset($result->job)) {
									$job = $result->job;
									$docs= $result->docs;
									$job_docs = [];//'';
									$rdocs = explode(',', $job->required_documents);
									foreach($rdocs AS $k=>$v){
										if(array_key_exists($v, $docs)){
											$job_docs[] = $docs->{$v};
										}
									}
									$job_docs = '<ol ><li>'.implode('</li><li>', $job_docs).'</li></ol>';
									$gender = (object)['M'=>'Male','F'=>'Female','M/F'=>'Male / Female','none'=>'None'];
									//var_dump($job->sex,$gender);
									$index = $job->sex==''? 'none':$job->sex;
									$gender = $gender->{$index};
									//var_dump($job, $docs);
									echo '<a href="jobs.php" class="btn btn-default " >Go Back</a>';
									echo '<a href="?apply='.$job->id.'&title='.$job->position.' at '.$job->company_name.'" class="btn btn-default pull-right" >Apply</a>';
									echo '<hr style="margin:5px 0 0 0" />';
									echo    '<table class="table table-responsive table-condensed">
											<tr><td colspan="2"><b>Job Title: </b>'.$job->position.' ['.$job->quantity.']</td></tr>
											<tr><td ><b>Job Reference #: </b>'.$job->job_ref.'</td><td><b>Duty Station: </b>'.$job->location_of_work.'</tr>
											<tr><td ><b>Gender: </b>'.$gender.'</td><td><b>Age Limit (years): </b>'.$job->age_limit.'</td></tr>
											<tr><td ><b>Date Posted: </b>'.$job->created_on.'</td><td><b>Status: </b>'.$job->status.'</td></tr>
											<tr><td colspan="2"><b>Job Summary : </b><br />'.$job->remarks.'</td></tr>
											<tr><td colspan="2"><b>Application Requirements: </b><br />'.$job_docs.'</td></tr>
											</table>';
									echo '<hr >';

								} elseif(isset($result->apply)) {
									$apply = $result->apply;
									//var_dump($result);
									?>
										<form class="form-vertical" method="post" action="forms.php" >
											<input type="hidden" name="id" value="-1" />
											<div class="row">
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
														<label for="applied_job">Job Applied For</label>
														<!--input id="applied_job" type="text" name="applicantapplied_job_contact" value="" class="form-control" placeholder="Job Applied For" required!-->
														<select style="width:100%" class="form-control" name="applied_job" placeholder="Job Applied for" required >
																	<option value="" selected disabled > --------------------------- </option>
																	<?php if(isset($result->thisjob)){
																		foreach($result->thisjob AS $option) {
																			$selected = (isset($form_data->applied_job)&&$form_data->applied_job=="$option->position -> $option->job_ref")? 'selected':'';
																			echo '<option value="'."$option->position -> $option->job_ref".'" '.$selected.' >'."$option->position -> $option->job_ref".'</option>';
																		}
																	} ?>
																</select>	
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
													<label for="agent">Agent</label>
													<select style="width:100%" class="form-control" name="agent_no" placeholder="Agent" required >
																	<option value="" selected disabled > --------------------------- </option>
																	<?php if(isset($result->agents)){
																		foreach($result->agents AS $option) {
																			$selected = (isset($form_data->agent_no)&&$form_data->agent_no==$option->agent_number)? 'selected':'';
																			echo '<option value="'.$option->agent_number.'" '.$selected.' >'."$option->agent_number - $option->agent_names".'</option>';
																		}
																	} ?>
																</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="application_date">Date of Application <small style="color:red;font-weight:bold;"><sup>Choose from Calendar</sup></small></label>
														<input  id="application_date" type="date" name="application_date" value="" class="form-control" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="application_time">Time of Application <small style="color:red;font-weight:bold;"><sup>Select the time</sup></small></label>
														<input id="application_time" type="time" name="application_time" value="" class="form-control" required>
															
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="col-form-label">Applicant ID/ Passport Number <small style="color:red;font-weight:bold;"><sup>Enter a valid ID number</sup></small></label>
														<input class="form-control" name="id_no" type="text" value="" placeholder="ID Number" required >
													</div>
												</div>        
												<div class="col-md-6">
													<div class="form-group">
														<label for="dob">Date of Birth <small style="color:red;font-weight:bold;"><sup>Choose from Calendar</sup></small></label>
														<input id="dob" type="date" name="dob" value="" class="form-control" placeholder="DOB" required>
															
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
												<div class="form-group">
													<label for="gender">Gender</label>
														<select id="gender" type="text" name="gender" placeholder="gender" class="form-control" required >
															<option value="" disabled>----------</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
															<option value="Others">Others</option>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
													<label for="marital_status">Marital Status</label>
														<select id="marital_status" type="marital_status" name="marital_status" placeholder="Marital Status" class="form-control" required >
															<option value="" disabled>------------</option>
															<option value="Single">Single</option>
															<option value="Married">Married</option>
															<option value="Divorced">Divorced</option>
															<option value="Widowed">Widowed</option>
															<option value="Others">Others</option>

														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="email_address">Email Address <small style="color:red;font-weight:bold;"><sup>Enter a valid email addres</sup></small></label>
														<input id="email_address" type="text" name="email_address" value="" class="form-control" placeholder="example@gmail.com" required>
															
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="col-form-label">Physical Address</label>
														<input class="form-control" name="physical_address" type="text" value="" placeholder="Physical Address" required >
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="skin_color">Skin Colour</label>
														<input  id="skin_color" type="text" name="skin_color" value="" class="form-control" placeholder="Skin Color" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="height">Height</label>
														<input id="height" type="text" name="height" value="" class="form-control" placeholder="height" required>
															
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
												<div class="form-group">
														<label for="weight">Weight</label>
														<input id="weight" type="text" name="weight" value="" class="form-control" placeholder="Weight" required>
															
													</div>
												</div>
												<div class="col-md-6">
												<div class="form-group">
														<label for="eye_color">Eye Color</label>
														<input id="eye_color" type="text" name="eye_color" value="" class="form-control" placeholder="eye_color" required>
															
													</div>
												</div>        
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="medical_status">Medical / Physical Status (State affiliation allergy or disability affecting you, if any</label>
														<input id="medical_status" type="text" name="medical_status" value="" class="form-control" placeholder="Medical Status" required>
															
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
													<label for="fathers_name">Father's Name</label>
														<input id="fathers_name" type="text" name="fathers_name" value="" class="form-control" placeholder="Father's Name" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="fathers_contact">Father's Contact</label>
														<input  id="fathers_contact" type="text" name="fathers_contact" value="" class="form-control" placeholder="Father's Contact" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="fathers_address">Father's Address</label>
														<input id="fathers_address" type="text" name="fathers_address" value="" class="form-control" placeholder="Father's Address" required>
															
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
													<label for="mothers_name">Mother's Name</label>
														<input id="mothers_name" type="text" name="mothers_name" value="" class="form-control" placeholder="Mother's Name" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="mothers_contact">Mother's Contact</label>
														<input  id="mothers_contact" type="text" name="mothers_contact" value="" class="form-control" placeholder="Mother's Contact" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="mothers_address">Mother's Address</label>
														<input id="mothers_address" type="text" name="mothers_address" value="" class="form-control" placeholder="Mother's Address" required>
															
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
													<label for="next_of_kin">Next Of Kin's Name</label>
														<input id="next_of_kin" type="text" name="next_of_kin" value="" class="form-control" placeholder="Next of kin's Name" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="kin_contact">Next Of Kin's Contact</label>
														<input  id="kin_contact" type="text" name="kin_contact" value="" class="form-control" placeholder="Next of kin's Contact" required>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="kin_address">Next Of Kin's Address</label>
														<input id="kin_address" type="text" name="kin_address" value="" class="form-control" placeholder="Next of kin's Address" required>
															
													</div>
												</div>
											</div>    
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="kin_relationship">Next Of Kin's Relationship</label>
														<input id="kin_relationship" type="text" name="kin_relationship" value="" class="form-control" placeholder="Relationship With Next of Kin" required>
															
													</div>
												</div>
												<div class="col-md-6" >
													<div class="form-group">
														<br />
														<input type='submit' name="apply_entry_web" value="Submit Application" class="btn btn-block btn-info" />
													</div>
												</div>
											</div>        
										</div>
										</form>
									<?php
									echo '<hr >';
								}
							}
						}
						/*
						if(isset($_GET['job'])){
							$id = intval($_GET['job']);
							if($page = db_get_row("SELECT * FROM jobs WHERE id='$id' ")){ 
							    $apply = -1;//isset($user->id)? $user->id:-1;
								?>
								
								<a href="jobs.php" class="btn btn-default " >Go Back</a>
								<a href="job_applications.php?apply=<?php echo $apply;?>&job=<?php echo $page->id;?>" class="btn btn-default pull-right" >Apply</a>
								<hr style="margin:5px 0 0 0" />
								<?php
								echo    '<table class="table table-responsive table-condensed">
											<tr><td colspan="2"><b>Job Title: </b>'.$page->job_title.'</td></tr>
											<tr><td colspan="2"><b>Reports to: </b>'.$page->reports_to.'</td></tr>
											<tr><td ><b>Organisation: </b>'.$page->organisation.'</td><td><b>Duty Station: </b>'.$page->duty_station.', '.$page->country.'</td></tr>
											<tr><td ><b>Date Posted: </b>'.$page->date_posted.'</td><td><b>Deadline: </b>'.$page->deadline.'</td></tr>
											<tr><td colspan="2"><b>About Us: </b><br />'.$page->about_us.'</td></tr>
											<tr><td colspan="2"><b>Job Summary: </b><br />'.$page->job_summary.'</td></tr>
											<tr><td colspan="2"><b>Key Duties and Responsibilities: </b><br />'.$page->kdr.'</td></tr>
											<tr><td colspan="2"><b>Qualifications, Skills and Experience: </b><br />'.$page->qse.'</td></tr>
											<tr><td colspan="2"><b>Compensations: </b><br />'.$page->compensations.'</td></tr>
											<tr><td colspan="2"><b>How to Apply: </b><br />'.$page->howto_apply.'</td></tr>
											</table>';
								echo '<hr >Created By: '.$page->created_by;
							}
						} else {
							$headings = '<tr><th></th><th></th><th></th></tr>';
							echo '<table class="table1 table-responsive" id="dataTable" width="100%" cellspacing="0">';
							echo '<thead>'.$headings.'</thead>';
							//echo '<tfoot>'.$headings.'</tfoot>';
							echo '<tbody>';
							if($pages = db_get_all("SELECT * FROM jobs ORDER BY date_posted DESC ")){
							//var_dump($pages);
							$count = 0;
							foreach($pages AS $row){
								echo '<tr>';
								echo '<td>	</td>';
								echo '<td>';
								echo '<h4><a href="?job='.$row->id.'" >'.$row->job_title.' - '.$row->organisation.'</a></h4>';
								echo '<small class="text-success"><b>Duty Station: </b>'.$row->duty_station.', '.$row->country.' <b>Posted on: </b>'.$row->date_posted.' <b>Deadline: </b>'.$row->deadline.'</small>';
								echo substr($row->about_us,0,195);
								echo '&nbsp;<small class="pull-left1" ><a  href="?job='.$row->id.'" class="btn1 btn-info btn-xs"><b class="text-warning1" >Read More to Apply</b></a></small>' ;
								echo '</td>';
								echo '<td></td>';
								echo '</tr>';
							}
							}
							echo '</tbody>';
							echo '</table>';


						}
						*/
					?>
				</div>
			</div>
		</div>
	</div>

<?php include ('footer.php'); ?>
<script>
$(document).ready(function(){$("#dataTable1").DataTable()});
</script>