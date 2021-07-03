<?php require_once('functions.php'); ?>
<?php confirm_logged_in(); ?>
<?php
    $page=(object)array(
            'title'=>'Web Pages',
            'caption'=>'Web Pages Dashboard',
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
        <li class="breadcrumb-item active">Web Pages</li>
      </ol>
      <?php echo view_message(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <h5>
            <i class="fa fa-list-alt"></i> <?php echo $page->caption;?>
            <span class="pull-right">
              <a class="btn btn-sm btn-primary" data-id="-1" data-toggle="modal1" data-target="#pageModal1" href="pages.php?pg=-1" ><i class="fa fa-page"> New Page</i></a>
              &nbsp;|&nbsp;
              <a class="btn btn-sm btn-success" href="pages.php" >View All</a>
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
                        
                            <input type="hidden" id="id" name="id" value="<?php echo isset($pg->id)? $pg->id:-1;?>" />
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" >Page Name</label>
                                        <input id="name" name="name" value="<?php echo isset($pg->name)? $pg->name:'';?>" type="text" class="form-control border-input" placeholder="Page Name" required />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title" >Title</label>
                                        <input id="title" name="title" value="<?php echo isset($pg->title)? $pg->title:'';?>" type="text" class="form-control border-input" placeholder="Page Title" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content" >Content</label>
                                        <textarea id="content" rows="20" name="content" class="form-control border-input" placeholder="Page Content" required /><?php echo isset($pg->content)? $pg->content:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="offline_text" >Offline Text</label>
                                        <textarea id="offline_text" rows="5" name="offline_text" class="form-control border-input" placeholder="Offline Text" required /><?php echo isset($pg->offline_text)? $pg->offline_text:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                       
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="parent_page">Parent Page</label>
                                        <select id="parent_page" name="parent_page" class="form-control border-input" placeholder="Parent Page" required >
                                            <option value="" > Select Parent Page </option>
                                            <option value="None" <?php echo isset($pg->parent_page)&&$pg->parent_page=='None'? 'selected':''; ?> > Has No Parent Page</option>
                                            <?php
                                                if($parents = db_get_all("SELECT name, title FROM web_pages WHERE parent_page='None' ")){
                                                    foreach($parents AS $row){
                                                        $selected = (isset($pg->parent_page)&&$pg->parent_page==$row->name)? 'selected':'';
                                                        echo '<option value="'.$row->name.'" '.$selected.' >'.$row->title.'</option>';
                                                    }
                                                } else {

                                                }
                                            ?>
                                       </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                            <input type="submit" class="btn btn-info btn-sm " value="Save" name="page_entry" />
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
                <?php
              } else {
                $headings = '<tr><th>#</th><th>Page Title</th><th>Page Name</th><th>Parent Page</th><th>Published</th><th>Created By</th><!--th>Created On</th!--><th>Updated By</th><!--th>Updated On</th!--><th nowrap ></th></tr>';
                echo '<table class="table1 table-bordered" id="dataTable" width="100%" cellspacing="0">';
                echo '<thead>'.$headings.'</thead>';
                echo '<tfoot>'.$headings.'</tfoot>';
                echo '<tbody>';
                if($pages = db_get_all("SELECT * FROM web_pages ORDER BY title ASC ")){
                  //var_dump($pages);
                  $count = 0;
                  foreach($pages AS $row){
                    $link_view = '<a href="#" data-id="'.$row->id.'"  data-title="'.$row->title.'" data-toggle="modal" data-target="#pageViewModal" >'.$row->title.'</a>';
                    $btn_edit = '<a href="pages.php?pg='.$row->id.'"  class="btn btn-sm btn-warning" data-id="'.$row->id.'"  data-title="'.$row->title.'" data-toggle="modal1" data-target="#pageModal1" ><i class="fa fa-pencil"></i></a>';
                    $del_msg = "Records for Page: $row->title ";
                    $btn_del = '<button class="btn btn-sm btn-danger" data-id="'.$row->id.'"  data-tbl="web_pages" data-msg="'.$del_msg.'"  data-toggle="modal" data-target="#deleteModal" ><i class="fa fa-trash"></i></button>';
                    $btns = "$btn_edit | $btn_del";
                    echo '<tr>';
                    echo '<td>'.++$count.'</td>';
                     echo '<td>'.$link_view.'</td>';
                     echo '<td>'.$row->name.'</td>';
                     echo '<td>'.$row->parent_page.'</td>';
                     echo '<td>'.($row->published? "YES":"NO").'</td>';
                     echo '<td>'.$row->created_by.' ('.$row->created_on.')</td>';
                     //echo '<td>'.$row->created_on.'</td>';
                     echo '<td>'.$row->last_updated_by.' ('.$row->last_updated_on.')</td>';
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
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php include ('footer.php'); ?>
<?php if(isset($_REQUEST['pg'])){ ?>
<script> 
   // CKEDITOR.replace( 'content'); 
    //CKEDITOR.replace( 'offline_text'); 
    var roxyFileman = 'fileman/index.html'; 
    $(function(){
        CKEDITOR.replace( 'content',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'}); 
        CKEDITOR.replace( 'offline_text',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'}); 
    });
</script>
<?php } ?>
  <!-- Page Modal -->
  <div data-backdrop="true" class="modal fade " id="pageModal" tabindex="-1" role="dialog" aria-labelledby="pageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="pageModalLabel">New page Details</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
          <div id="page-form" class="row">
          <!-- page form here !-->
          </div>
      </div>
    </div>
  </div>
  <!-- Page View Modal -->
  <div data-backdrop="true" class="modal fade " id="pageViewModal" tabindex="-1" role="dialog" aria-labelledby="pageViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="pageModalLabel"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div id="page-view" class="content">
          <!-- page form here !-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--    end modal -->
  
  <script>
  
      $('#pageModal').on('show.bs.modal', function (event) {
         //alert("OK");
          var button = $(event.relatedTarget);
          var id = button.data('id');  
         // var title = button.data('title');
  
          var modal = $(this);
          //modal.find('.modal-body input#id').val(id);
          $.post("formSubmit.php", {'ajax-page-form': id}, function (data) {
              modal.find('div#page-form').html(data).show();
          });        
          if (id > 0) {
              modal.find('.modal-title').text('Edit Page Details: ' + full_names);
              //modal.find('.modal-body input#title').val(title);  
          } else {
              modal.find('.modal-title').text('New Page Details');  
          }         
      });

      $('#pageViewModal').on('show.bs.modal', function (event) {
         //alert("OK");
          var button = $(event.relatedTarget);
          var id = button.data('id');  
         var title = button.data('title');
  
          var modal = $(this);
          $.post("formSubmit.php", {'ajax-page-view': id}, function (data) {
              modal.find('div#page-view').html(data).show();
          });        
          if (id > 0) {
              modal.find('.modal-title').text(title);
          }      
      });
      //)};
  </script>