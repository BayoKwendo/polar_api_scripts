<?php include ('web-admin/functions.php');?>
<?php
	$data = FALSE;
	if($data=db_get_row("SELECT * FROM web_pages WHERE name='gallery'")) ;
    else $data = $data=db_get_row("SELECT * FROM web_pages WHERE name='404'");
    $xload = isset($_GET['videos'])? 'videos':'photos';
?>
<?php include ('header.php'); ?>
    <!--about-->
	<div id="about">

		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 ">
					<div class="text-center">
						<h2>Our Media Gallery: <span class="btn btn-danger"><?php echo isset($_GET['videos'])? 'VIDEOS':'PHOTOS';?></span><hr style="margin:5px 0;"></h2>						
					</div>
				</div>
			</div>
		</div>

		<!-- wrapper left-->
		<div class="container gallery-container">
            <div class="row">
				<div class="col-12 hidden-sm col-md-2">
					<div class="about-left1">
						<ul class="list-group">
							<li class="list-group-item active"><h4>MEDIA Menu</h4></li>
                            <li class="list-group-item" ><a href="?photos" >Photos</a></li>
                            <li class="list-group-item" ><a href="?videos" >Videos</a></li>
												
						</ul>
					</div>
				</div>
                
                <div class="col-12 col-md-10">
                <?php //if(isset($_GET['videos'])){ ?>

                    <div class="justify-content-center">
                        <link rel="stylesheet" href="css/ekk-lightbox.css">
                        
                            <div class="row" data-code="" id="xload" >
                            <?php
                                $tbl = isset($_GET['videos'])? 'videos':'photos';
                                $sql = "SELECT * FROM $tbl WHERE published='1' ORDER BY date_created DESC LIMIT 0, 12 ";
                                if($media = db_get_all($sql)){
                                    foreach($media AS $row){ //var_dump($vidz);
                                        $thumbnail = $tbl=='videos'? explode('=',$row->youtube_link)[1]:null;
                                        $href = $tbl=='videos'? $row->youtube_link:'web-admin/media/photos/'.$row->file;
                                        $src = $tbl=='videos'? 'https://img.youtube.com/vi/'.$thumbnail.'/mqdefault.jpg':$href;
                                        $gallery = $tbl=='videos'? 'youtubevideos':'example-gallery';
                                        echo '<a href="'.$href.'" data-toggle="lightbox" data-gallery="'.$gallery.'" class="col-sm-4" data-title="'.$row->caption.'" data-footer="'.$row->description.'">
                                                    <img src="'.$src.'" align="left" class="img-fluid img-responsive img-thumbnail">
                                                    <br>&nbsp;'.$row->caption.'&nbsp;</a>';
                                    }
                                } else {
                                    echo '<div class="alert alert-info">No Videos available</div>';
                                }
                            ?> 
                    </div>
                <?php // } else { ?>


                    <!-- div class="gallery-container">
                        <link rel="stylesheet" href="css/baguetteBox.min.css">
                        <link rel="stylesheet" href="css/thumbnail-gallery.css">
                        <div class="tz-gallery">
                            <div class="row" id="xload">
                            <?php
                                if($photos = db_get_all("SELECT * FROM photos WHERE published='1' ORDER BY date_created DESC LIMIT 0, 12 ")){
                                    foreach($photos AS $pix){
                                        echo '<div class="col-xs-12 col-md-6" style="height:300px;overflow:hidden;" >
                                                <div class="thumbnail">
                                                    <a class="lightbox" href="web-admin/media/photos/'.$pix->file.'">
                                                        <img style="height:200px;" class="img-responsive img-fluid img-thumbnail" src="web-admin/media/photos/'.$pix->file.'" alt="'.$pix->caption.'">
                                                    </a>
                                                    <div class="caption">
                                                        <h3>'.substr($pix->caption,0,20).'</h3>
                                                        <p>'.substr($pix->description,0,20).'</p>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-info">No Phots available</div>';
                                }
                            ?>                    
                            </div>
                            <script src="js/baguetteBox.min.js"></script>
                        <script>
                            baguetteBox.run('.tz-gallery');
                        </script>
                        </div>
                        
                    </div!-->
                            <?php //} ?>
                </div>
            </div>
	    </div>
    </div>
<?php //var_dump($xload); ?>
<?php include ('footer.php'); ?>
<script src="js/ekko-lightbox.js"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
<script>
$(document).ready(function() {
    var win = $(window);
    var page = 1;
    <?php echo "var xload = '$xload'";?>;
    //alert(xload);
	// Each time the user scrolls
	win.scroll(function() { 
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
            page = page + 1;
            
            $.post("web-admin/formSubmit.php", { 'ajax-xload': xload,'page':page }, function(data) {
                $('#xload').append(data);
            });
            /*
            $.ajax({
				url: 'get-post.php',
				dataType: 'html',
				success: function(html) {
					$('#posts').append(html);
					$('#loading').hide();
				}
            });
            */
		}
	});
});
</script>
