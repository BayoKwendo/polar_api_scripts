<?php include ('web-admin/functions.php');?>
<?php
	$data = FALSE;
	if($data=db_get_row("SELECT * FROM web_pages WHERE name='home'")) ;
	else $data = $data=db_get_row("SELECT * FROM web_pages WHERE name='404'");
?>
<?php include ('header.php'); ?>
	<!--slider-->
	<div id="slider" class="flexslider">
		<?php if($slides = db_get_all("SELECT * FROM slideshow WHERE published='1' ")){ ?>
			<ul class="slides">
				<?php
					shuffle($slides);
					foreach($slides AS $slider){
						echo '<li>';
						echo '<img src="web-admin/media/slideshow/'.$slider->file.'" >';
						echo '<div class="caption" >';
						echo '<h2><span>'.$slider->caption.'</span></h2>';
						echo '<p>'.$slider->description.'</p>';
						echo '</div>';
						echo '</li>';
					}
				?>
			</ul>
		<?php } ?>
	</div>
	<?php 
		if($data->name=='404'){
			echo '<div id="portfolio">
					<div class="container">
						<div class="row">

							<div class="col-md-12">
								<div class="portfolio-heading">
									<h2>'.$data->title.'</h2>
									<p>'.$data->content.'</p>
								</div>
							</div>

						</div>
					</div>';
		} else {
			echo '<div id="about">
					<div class="container">
						<div class="row">

							<div class="col-md-12">
								<div class="about-heading1"><h2>'.$data->title.'</h2></div>
								<p>'.$data->content.'</p>
								
							</div>

						</div>
					</div>';
		}
	?>
<?php include ('footer.php'); ?>