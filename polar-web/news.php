<?php include ('web-admin/functions.php');?>
<?php
	$data = FALSE;
	if($data=db_get_row("SELECT * FROM web_pages WHERE name='news'")) ;
	else $data = $data=db_get_row("SELECT * FROM web_pages WHERE name='404'");
?>
<?php include ('header.php'); ?>
<!--about-->
	<div id="about">

		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 ">
					<div class="about-heading1">
						<h2>Available Jobs<hr style="margin:0;"></h2>						
					</div>
				</div>
			</div>
		</div>

		<!-- wrapper left-->
		<div class="container">
			<div class="row">
				<div class="col-12 hidden-sm col-md-4">
					<div class="about-left1">
						<?php echo $data->content; ?>
					</div>
				</div>
				<!-- wrapper right-->
				<div class="col-12 col-md-8">				
					<?php
						if(isset($_GET['news'])){
							$id = intval($_GET['news']);
							if($page = db_get_row("SELECT * FROM news_feed WHERE id='$id' ")){
								?>
								<script>
									document.write('<a href="' + document.referrer + '" class="btn btn-default">Go Back</a>');
								</script>
								<?php
                                echo '<h3>Topic: '.$page->topic.'<hr></h3>';
                                echo ''.$page->article;
                                echo '<hr >Created By: '.$page->author.' Create Date: '.$page->news_date;
                                
							}
						} else {
							$headings = '<tr><th></th><th></th><th></th></tr>';
							echo '<table class="table1 table-responsive" id="dataTable" width="100%" cellspacing="0">';
							echo '<thead>'.$headings.'</thead>';
							//echo '<tfoot>'.$headings.'</tfoot>';
							echo '<tbody>';
							if($pages = db_get_all("SELECT * FROM news_feed ORDER BY news_date DESC ")){
							//var_dump($pages);
							$count = 0;
							foreach($pages AS $row){
								echo '<tr>';
								echo '<td>	</td>';
								echo '<td>';
								echo '<h4><a href="?news='.$row->id.'" >'.$row->topic.'</a></h4>';
								echo '<small class="text-success"><b>Author: </b>'.$row->author.' <b>Posted on: </b>'.$row->news_date.' </small>';
								echo substr($row->article,0,195);
								echo '&nbsp;<small class="pull-left1" ><a  href="?news='.$row->id.'" class="btn1 btn-info btn-xs"><b class="text-warning1" >Read</b></a></small>' ;
								echo '</td>';
								echo '<td></td>';
								echo '</tr>';
							}
							}
							echo '</tbody>';
							echo '</table>';


						}
					?>
				</div>
			</div>
		</div>
	</div>

<?php include ('footer.php'); ?>
<script>
$(document).ready(function(){$("#dataTable1").DataTable()});
</script>