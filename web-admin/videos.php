<?php require_once('functions.php'); ?>
<?php confirm_logged_in(); ?>
<?php
    $page=(object)array(
            'title'=>'Videos',
            'caption'=>'Video Dashboard',
            'uri'=>basename($_SERVER['PHP_SELF'])
        );
        //var_dump(get_active_page());
?>
<?php include ('header.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Videos</li>
      </ol>
      <?php echo view_message(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <h5>
            <i class="fa fa-list-alt"></i> <?php echo $page->caption;?>
            <span class="pull-right">
              <a class="btn btn-sm btn-primary" data-id="-1" data-toggle="modal1" data-target="#photoModal1" href="videos.php?pg=-1" ><i class="fa fa-youtube"> Link Video</i></a>
              &nbsp;|&nbsp;
              <a class="btn btn-sm btn-success" href="videos.php" >View All</a>
            </span>
          </h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
              if(isset($_REQUEST['pg'])){
                $id = intval($_REQUEST['pg']);
                $pg = $id>0? db_get_row("SELECT * FROM videos WHERE id='$id' "):FALSE;
                //var_dump($pg);
                ?>
                <form method="post" action="formSubmit.php" enctype="multipart/form-data" >
                  
                    <div class="modal-body">        
                          <legend>Link Youtube Video Here</legend>
                            <input type="hidden" id="id" name="id" value="<?php echo isset($pg->id)? $pg->id:-1;?>" />
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="caption" >Video Caption</label>
                                        <input id="caption" name="caption" value="<?php echo isset($pg->caption)? $pg->caption:'';?>" type="text" class="form-control border-input" placeholder="Video Caption" required />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" >Video Description</label>
                                        <textarea id="description" rows="5" name="description" class="form-control border-input" placeholder="Media Description" required /><?php echo isset($pg->description)? $pg->description:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                            
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label for="youtube_link" >Youtube Video Link</label>
                                        <input id="youtube_link" name="youtube_link" value="<?php echo isset($pg->youtube_link)? $pg->youtube_link:'';?>" type="url" class="form-control border-input" placeholder="Youtube Video Link" required />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="published">Published</label>
                                        <select id="published" name="published" class="form-control border-input" placeholder="published" required >
                                            <option> Select Publish Mode</option>
                                            <option value="1" <?php echo isset($pg->published)&&$pg->published==1? 'selected':''; ?> > YES</option>
                                            <option value="0" <?php echo isset($pg->published)&&$pg->published==0? 'selected':''; ?> > NO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                    
                    </div>    
                    <div class="modal-footer">
                        <div class="left-side">
                            <input type="submit" class="btn btn-info btn-sm " value="Save" name="video_entry" />
                        </div>
                    </div>
                </form>
                <?php
              } else {
                $headings = '<tr><th>#</th><th>Video Caption</th><th>Youtube Link</th><th>Published</th><th>Created By</th><th></th></tr>';
                echo '<table class="table1 table-bordered" id="dataTable" width="100%" cellspacing="0">';
                echo '<thead>'.$headings.'</thead>';
                echo '<tfoot>'.$headings.'</tfoot>';
                echo '<tbody>';
                if($pages = db_get_all("SELECT * FROM videos ORDER BY caption ASC ")){
                  //var_dump($page1s);
                  $count = 0;
                  foreach($pages AS $row){
                    $link_view = '<a href="#" data-id="'.$row->id.'"  data-caption="'.$row->caption.'" data-toggle="modal" data-target="#videoViewModal" >'.$row->caption.'</a>';
                    $btn_edit = '<a href="videos.php?pg='.$row->id.'"  class="btn btn-sm btn-warning" data-id="'.$row->id.'"  data-caption="'.$row->caption.'" data-toggle="modal1" data-target="#photoModal1" ><i class="fa fa-link"></i></a>';
                    $tube_link = '<a href="'.$row->youtube_link.'" target="_blank" ><i class="fa fa-youtube" > Play</i></a> ';
                    $del_msg = "Records for Video: $row->caption ";
                    $btn_del = '<button class="btn btn-sm btn-danger" data-id="'.$row->id.'"  data-tbl="videos" data-msg="'.$del_msg.'"  data-toggle="modal" data-target="#deleteModal" ><i class="fa fa-trash"></i></button>';
                    $btns = "$btn_edit | $btn_del";
                    echo '<tr>';
                    echo '<td>'.++$count.'</td>';
                    echo '<td>'.$link_view.'</td>';
                    echo '<td>'.$tube_link.'</td>';
                    echo '<td>'.($row->published? "YES":"NO").'</td>';
                    echo '<td>'.$row->created_by.' ('.$row->date_created.')</td>';
                     //echo '<td>'.$row->created_on.'</td>';
                     //echo '<td>'.$row->last_updated_by.' ('.$row->last_updated_on.')</td>';
                     //echo '<td>'.$row->last_updated_on.'</td>';
                    echo '<td nowrap >'.$btns.'</td>';
                    echo '</tr>';
                  }
                }
                echo '</tbody>';
                echo '</table>';
              }
            ?>
          </div>
        </div>
        <!-- div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div !-->
      </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php include ('footer.php'); ?>

  <!-- Page View Modal -->
  <div data-backdrop="true" class="modal fade " id="videoViewModal" tabindex="-1" role="dialog" aria-labelledby="videoViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="videoViewModalLabel"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div id="video-view" class="content">
          <!-- photo form here !-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--    end modal -->
  
  <script>
    $('#videoViewModal').on('show.bs.modal', function (event) {
        //alert("OK");
        var button = $(event.relatedTarget);
        var id = button.data('id');  
        var caption = button.data('caption');
        //alert(id);   
        var modal = $(this);
        $.post("formSubmit.php", {'ajax-video-view': id}, function (data) {
            
            modal.find('div#video-view').html(data).show();
        });        
        if (id > 0) {
            modal.find('.modal-title').text(caption);
        }      
    });
    $('#videoViewModal').on('hide.bs.modal', function(e) { 
      var $if = $(e.delegateTarget).find('iframe'); 
      var src = $if.attr("src"); 
      $if.attr("src", '/empty.html'); 
      $if.attr("src", src);
    });
    /*
    jQuery(".modal-backdrop, #myModal .close, #myModal .btn").live("click", function() {
        jQuery("#myModal iframe").attr("src", jQuery("#myModal iframe").attr("src"));
    });
    */
  //)};
  </script>