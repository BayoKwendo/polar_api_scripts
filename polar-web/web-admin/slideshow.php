<?php require_once('functions.php'); ?>
<?php confirm_logged_in(); ?>
<?php
    $page=(object)array(
            'title'=>'Slideshow Pictures',
            'caption'=>'Slideshow Dashboard',
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
        <li class="breadcrumb-item active">Slideshow Pictures</li>
      </ol>
      <?php echo view_message(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <h5>
            <i class="fa fa-list-alt"></i> <?php echo $page->caption;?>
            <span class="pull-right">
              <a class="btn btn-sm btn-primary" data-id="-1" data-toggle="modal1" data-target="#photoModal1" href="slideshow.php?pg=-1" ><i class="fa fa-page"> Upload Photo</i></a>
              &nbsp;|&nbsp;
              <a class="btn btn-sm btn-success" href="slideshow.php" >View All</a>
            </span>
          </h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
              if(isset($_REQUEST['pg'])){
                $id = intval($_REQUEST['pg']);
                $pg = $id>0? db_get_row("SELECT * FROM slideshow WHERE id='$id' "):FALSE;
                //var_dump($pg);
                ?>
                <form method="post" action="formSubmit.php" enctype="multipart/form-data" >
                  
                    <div class="modal-body">        
                          <legend>Upload Slideshow Picture Here</legend>
                            <input type="hidden" id="id" name="id" value="<?php echo isset($pg->id)? $pg->id:-1;?>" />
                            <input type="hidden" id="old_pix" name="old_pix" value="<?php echo isset($pg->id)? $pg->file:'';?>" />
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="caption" >Picture Caption</label>
                                        <input id="caption" name="caption" value="<?php echo isset($pg->caption)? $pg->caption:'';?>" type="text" class="form-control border-input" placeholder="Photo Caption" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" >Picture Description</label>
                                        <textarea id="description" rows="5" name="description" class="form-control border-input" placeholder="Media Description" required /><?php echo isset($pg->description)? $pg->description:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <?php if(isset($pg->id)&&$pg->id>0) { ?>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="change_pix" >Change Photo</label>
                                        <select id="change_pix" name="change_pix" class="form-control border-input" placeholder="" required >
                                            <option value="" > ------------- </option>
                                            <option value="0" >NO</option>
                                            <option value="1" >YES</option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="file" >Browse Picture File <b><sup class="text-danger"> **Picture size: 800 x 300px**</sup></b></label>
                                        <input id="file" name="file" value="" type="file" class="form-control border-input" placeholder="Media File" <?php echo isset($pg->id)&&$pg->id>0? '':'required'; ?> />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
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
                            <input type="submit" class="btn btn-info btn-sm " value="Save" name="slideshow_entry" />
                        </div>
                    </div>
                </form>
                <?php
              } else {
                $headings = '<tr><th>#</th><th>Caption</th><th>Published</th><th>Created By</th><th></th></tr>';
                echo '<table class="table1 table-bordered" id="dataTable" width="100%" cellspacing="0">';
                echo '<thead>'.$headings.'</thead>';
                echo '<tfoot>'.$headings.'</tfoot>';
                echo '<tbody>';
                if($pages = db_get_all("SELECT * FROM slideshow ORDER BY caption ASC ")){
                  //var_dump($pages);
                  $count = 0;
                  foreach($pages AS $row){
                    $link_view = '<a href="#" data-id="'.$row->id.'"  data-caption="'.$row->caption.'" data-toggle="modal" data-target="#pictureViewModal" >'.$row->caption.'</a>';
                    $btn_edit = '<a href="slideshow.php?pg='.$row->id.'"  class="btn btn-sm btn-warning" data-id="'.$row->id.'"  data-caption="'.$row->caption.'" data-toggle="modal1" data-target="#photoModal1" ><i class="fa fa-upload"></i></a>';
                    $del_msg = "Records for Slide Shop Picture: $row->caption ";
                    $btn_del = '<button class="btn btn-sm btn-danger" data-id="'.$row->id.'"  data-tbl="slideshow" data-msg="'.$del_msg.'"  data-toggle="modal" data-target="#deleteModal" ><i class="fa fa-trash"></i></button>';
                    $btns = "$btn_edit | $btn_del";
                    echo '<tr>';
                    echo '<td>'.++$count.'</td>';
                     echo '<td>'.$link_view.'</td>';
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
  <div data-backdrop="true" class="modal fade " id="pictureViewModal" tabindex="-1" role="dialog" aria-labelledby="pictureViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="pictureViewModalLabel"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div id="pix" class="content">
          <!-- photo form here !-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--    end modal -->
  
  <script>
    $('#pictureViewModal').on('show.bs.modal', function (event) {
        //alert("OK");
        var button = $(event.relatedTarget);
        var id = button.data('id');  
        var caption = button.data('caption');        
        var modal = $(this);
        $.post("formSubmit.php", {'ajax-picture-view': id}, function (data) {
            //alert(data);
            modal.find('div#pix').html(data).show();
        });        
        if (id > 0) {
            modal.find('.modal-title').text(caption);
        }      
    });
  //)};
  </script>