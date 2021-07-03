<?php require_once('functions.php'); ?>
<?php include ('header.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Web Media</li>
      </ol>
      <?php echo view_message(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <h5>
            <i class="fa fa-list-alt"></i> Web Media
            <span class="pull-right">
              <a class="btn btn-sm btn-primary" data-id="-1" data-toggle="modal1" data-target="#pageModal1" href="media.php?pg=-1" ><i class="fa fa-page"> New Page</i></a>
              &nbsp;|&nbsp;
              <a class="btn btn-sm btn-success" href="media.php" >View All</a>
            </span>
          </h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
              if(isset($_REQUEST['pg'])){
                $id = intval($_REQUEST['pg']);
                $pg = $id>0? db_get_row("SELECT * FROM web_pages WHERE id='$id' "):FALSE;
                //var_dump($pg);
                ?>
                <form method="post" action="formSubmit.php" >
                  
                    <div class="modal-body">        
                          <legend>Upload Media Here</legend>
                            <input type="hidden" id="id" name="id" value="<?php echo isset($pg->id)? $pg->id:-1;?>" />
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="media_type">Media Type</label>
                                        <select id="media_type" name="media_type" class="form-control border-input" placeholder="Media Type" required >
                                            <option> Select Media Type Mode</option>
                                            <option value="Photo" <?php echo isset($pg->media_type)&&$pg->media_type=='Photo'? 'selected':''; ?> > Photo</option>
                                            <option value="Video" <?php echo isset($pg->media_type)&&$pg->media_type=='Video'? 'selected':''; ?> > Video</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label for="caption" >Media Caption</label>
                                        <input id="caption" name="caption" value="<?php echo isset($pg->caption)? $pg->caption:'';?>" type="text" class="form-control border-input" placeholder="Media Caption" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" >Media Description</label>
                                        <textarea id="description" rows="5" name="description" class="form-control border-input" placeholder="Media Description" required /><?php echo isset($pg->description)? $pg->description:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                       
                            <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="file" >Browse Media File</label>
                                        <input id="file" name="file" value="<?php echo isset($pg->file)? $pg->file:'';?>" type="file" class="form-control border-input" placeholder="Media File" required />
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
                            <input type="submit" class="btn btn-info btn-sm " value="Save" name="media_entry" />
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
                <?php
              } else {
                $headings = '<tr><th>#</th><th>Caption</th><th>Type</th><th>Published</th><th>Created By</th><th!-->Updated By</th><th>Updated On</th!--><th></th></tr>';
                echo '<table class="table1 table-bordered" id="dataTable" width="100%" cellspacing="0">';
                echo '<thead>'.$headings.'</thead>';
                echo '<tfoot>'.$headings.'</tfoot>';
                echo '<tbody>';
                if($pages = db_get_all("SELECT * FROM web_media ORDER BY caption ASC ")){
                  //var_dump($pages);
                  $count = 0;
                  foreach($pages AS $row){
                    $link_view = '<a href="#" data-id="'.$row->id.'"  data-caption="'.$row->caption.'" data-toggle="modal" data-target="#mediaViewModal" >'.$row->caption.'</a>';
                    $btn_edit = '<a href="media.php?pg='.$row->id.'"  class="btn btn-sm btn-warning" data-id="'.$row->id.'"  data-caption="'.$row->caption.'" data-toggle="modal1" data-target="#pageModal1" ><i class="fa fa-upload"></i></a>';
                    $del_msg = "Records for Page: $row->title ";
                    $btn_del = '<button class="btn btn-sm btn-danger" data-id="'.$row->id.'"  data-tbl="agents" data-msg="'.$del_msg.'"  data-toggle="modal" data-target="#deleteModal" ><i class="fa fa-trash"></i></button>';
                    $btns = "$btn_edit | $btn_del";
                    echo '<tr>';
                    echo '<td>'.++$count.'</td>';
                     echo '<td>'.$link_view.'</td>';
                     echo '<td>'.$row->media_type.'</td>';
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