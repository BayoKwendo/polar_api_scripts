	<!--footer-->
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="footer-heading">
						<h3><span>about</span> us</h3>						
						<?php
							if($footnote = db_get_row("SELECT * FROM web_pages WHERE name='footnote' ")){
								if($footnote->published==1) echo $footnote->content;
								else echo $footnote->offline_text;
							} else {
								echo "404 Content Not Found";
							}
						?>						
					</div>
				</div>

				<div class="col-md-4">
					<div class="footer-heading">
						<h3><span>latest</span> <a href="news.php">news</a></h3>
						<?php
							if($latestnews = db_get_all("SELECT * FROM news_feed WHERE published='1' ORDER BY news_date DESC LIMIT 4 ")){
								$cnt = 1;
								echo '<ul>';
								foreach($latestnews AS $news){
									echo '<li><a href="news.php?news='.$news->id.'">'.$news->topic.'</a></li>';
									$cnt+=1;
								}
								if($cnt>4) echo '<li><a href="news.php">View All News</a></li>';
								echo '<ul>';
							} else {
								echo "No current news available";
							}
						?>
					</div>
				</div>

				<div class="col-md-4">
					<div class="footer-heading">
						<h3><span>Our </span><a href="gallery.php">Gallery</a></h3>
						<div class="insta">
						<?php
							if($photos = db_get_all("SELECT * FROM photos WHERE published='1' ORDER BY date_created DESC LIMIT 6 ")){
								$cnt = 1;
								echo '<ul>';
								foreach($photos AS $pix){
									echo '<img src="web-admin/media/photos/'.$pix->file.'" alt="'.$pix->caption.'" />';
									$cnt+=1;
								}
								echo '<ul>';
							} else {
								echo "No photos currently availale in gallery";
							}
						?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!--bottom footer-->
	<div id="bottom-footer" class="hidden-xs">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="footer-left">
						&copy; POLAR MANAGEMENT Ltd. All rights reserved
						<div class="credits">
							Designed by <a target="_blank" href="https://www.afomeng.com">AFOM</a>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="footer-right">
						<ul class="list-unstyled list-inline pull-right">
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About</a></li>
							<li><a href="service.php">Services</a></li>
							<li><a href="jobs.php">Jobs</a></li>
							<li><a href="contact.php">Contact</a></li>
							<li><a href="web-admin/login.php" target="_blank" >Staff Login</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- Page level plugin JavaScript-->
    <script src="web-admin/vendor/datatables/jquery.dataTables.js"></script>
    <script src="web-admin/vendor/datatables/dataTables.bootstrap4.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.flexslider.js"></script>
	<script src="js/jquery.inview.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
	<script src="js/script.js"></script>
	<!--script src="contactform/contactform.js"></script!-->
	<!-- Custom scripts for this page-->
    <script src="web-admin/js/sb-admin-datatables.min.js"></script>
</body>

</html>
