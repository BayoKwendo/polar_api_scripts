<?php include ('web-admin/functions.php');?>
<?php
	$data = FALSE;
	if($data=db_get_row("SELECT * FROM web_pages WHERE name='service'")) ;
	else $data = $data=db_get_row("SELECT * FROM web_pages WHERE name='404'");
?>
<?php include ('header.php'); ?>
<!--about-->
	<div id="about">

		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 ">
					<div class="about-heading1">
						<h2>Our Serivces<hr style="margin:0;"></h2>
					</div>
				</div>
			</div>
		</div>

		<!-- wrapper left-->
		<div class="container">

		<div class="row">
			<div class="col-12 hidden-sm col-md-3">
				<div class="about-left1">
					<ul class="list-group">
						<li class="list-group-item active"><h4><?php echo strtoupper($data->name);?> Menu</h4></li>
						<?php 
						//var_dump($data->name);
							if($menu = db_get_all("SELECT id, name, title FROM web_pages WHERE parent_page='$data->name' AND published='1' ")){
								foreach($menu AS $m){
									echo '<li class="list-group-item" ><a onclick="submenu(\''.$m->id.'\',\''.$data->name.'\')" style="cursor:pointer" >'.$m->title.'</a></li>';
								}
							} else {
								echo '<li class="list-group-item">No submenus</li>';
							}
						?>						
					</ul>
				</div>
			</div>

			<!-- wrapper right-->
			<div class="col-12 col-md-9" >
				<div id="view_<?php echo $data->name;?>" >
					<?php echo $data->published==1? $data->content:$data->offline_text;; ?>
				</div>
			</div>
		</div>

		</div>
	</div>

<?php include ('footer.php'); ?>