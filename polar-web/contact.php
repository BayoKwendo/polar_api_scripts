<?php include ('web-admin/functions.php');?>
<?php
	$data = FALSE;
	if($data=db_get_row("SELECT * FROM web_pages WHERE name='contact'")) ;
	else $data = $data=db_get_row("SELECT * FROM web_pages WHERE name='404'");
?>
<?php include ('header.php'); ?>
<!--contact form-->
	<div id="get-touch">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-6">
					<div class="get-touch-heading">
						<h2>get in touch</h2>
						<?php echo $data->published==1? $data->content:$data->offline_text;?>
					</div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-6">
					<div class="get-touch-heading">
						<h2>contact</h2>
						<p>COMET HSE, MONROVIA STREET SUITE 19<br>
							P.o Box # Nairobi-Kenya<br>
							Tel: +254 732-629872 │ +254 202-629872<br>
							Email: info@polar-management.com</p>
					</div>
				</div>
			</div>

			<div class="content">
				<div class="row">
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

					<form action="feedback.php" method="post" role="form" class="form contactForm">
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required />
								<div class="validation"></div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" required />
								<div class="validation"></div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" required />
								<div class="validation"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message" required ></textarea>
								<div class="validation"></div>
							</div>
						</div>
						<div class="submit">
							<button name="submit" class="btn btn-default" type="submit">Send Now</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php include ('footer.php'); ?>