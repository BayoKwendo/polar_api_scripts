<?php require_once('functions.php'); ?>
<?php confirm_logged_in(); ?>
<?php
    $page=(object)array(
            'title'=>'News',
            'caption'=>'News Dashboard',
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
        <li class="breadcrumb-item active">News</li>
      </ol>
      <?php echo view_message(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <h5>
            <i class="fa fa-list-alt"></i> <?php echo $page->caption;?>
            <span class="pull-right">
              <a class="btn btn-sm btn-primary" data-id="-1" data-toggle="modal1" data-target="#newsModal1" href="news.php?pg=-1" ><i class="fa fa-page">  Write News Article</i></a>
              &nbsp;|&nbsp;
              <a class="btn btn-sm btn-success" href="news.php" >View All</a>
            </span>
          </h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
              if(isset($_REQUEST['pg'])){
                $id = intval($_REQUEST['pg']);
                $pg = $id>0? db_get_row("SELECT * FROM news_feed WHERE id='$id' "):FALSE;
                //var_dump($pg);
                ?>
                <form method="post" action="formSubmit.php" >
                  
                    <div class="modal-body">        
                        
                            <input type="hidden" id="id" name="id" value="<?php echo isset($pg->id)? $pg->id:-1;?>" />
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="topic" >Topic</label>
                                        <input id="topic" name="topic" value="<?php echo isset($pg->topic)? $pg->topic:'';?>" type="text" class="form-control border-input" placeholder="Topic" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="article" >New Article</label>
                                        <textarea id="article" rows="20" name="article" class="form-control border-input" placeholder="Page Content" required /><?php echo isset($pg->article)? $pg->article:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                    
                    </div>    
                    <div class="modal-footer">
                        <div class="left-side">
                            <input type="submit" class="btn btn-info btn-sm " value="Save" name="news_entry" />
                        </div>
                    </div>
                </form>
                <?php
              } else {
                $headings = '<tr><th>#</th><th>Topic</th><th>Author</th><th>Published</th><th>Created On</th><th></th></tr>';
                echo '<table class="table1 table-bordered" id="dataTable" width="100%" cellspacing="0">';
                echo '<thead>'.$headings.'</thead>';
                echo '<tfoot>'.$headings.'</tfoot>';
                echo '<tbody>';
                if($pages = db_get_all("SELECT * FROM news_feed ORDER BY news_date DESC ")){
                  //var_dump($pages);
                  $count = 0;
                  foreach($pages AS $row){
                    $link_view = '<a href="#" data-id="'.$row->id.'"  data-topic="'.$row->topic.'" data-toggle="modal" data-target="#newsViewModal" >'.$row->topic.'</a>';
                    $btn_edit = '<a href="news.php?pg='.$row->id.'"  class="btn btn-sm btn-warning" data-id="'.$row->id.'"  data-topic="'.$row->topic.'" data-toggle="modal1" data-target="#newsModal1" ><i class="fa fa-pencil"></i></a>';
                    $del_msg = "Records for News article: $row->topic ";
                    $btn_del = '<button class="btn btn-sm btn-danger" data-id="'.$row->id.'"  data-tbl="news_feed" data-msg="'.$del_msg.'"  data-toggle="modal" data-target="#deleteModal" ><i class="fa fa-trash"></i></button>';
                    $btns = "$btn_edit | $btn_del";
                    echo '<tr>';
                    echo '<td>'.++$count.'</td>';
                    echo '<td>'.$link_view.'</td>';
                     echo '<td>'.$row->author.'</td>';
                     echo '<td>'.($row->published? "YES":"NO").'</td>';
                     echo '<td>'.$row->news_date.'</td>';
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
    var roxyFileman = 'fileman/index.html'; 
    $(function(){
        CKEDITOR.replace( 'article',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'}); 
    });
</script>
<?php } ?>
  <!-- News View Modal -->
  <div data-backdrop="true" class="modal fade " id="newsViewModal" tabindex="-1" role="dialog" aria-labelledby="newsViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="newsModalLabel"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div id="news-view" class="content">
          <!-- page form here !-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--    end modal -->
  
  <script>

      $('#newsViewModal').on('show.bs.modal', function (event) {
         //alert("OK");
          var button = $(event.relatedTarget);
          var id = button.data('id');  
         var topic = button.data('topic');
  
          var modal = $(this);
          $.post("formSubmit.php", {'ajax-news-view': id}, function (data) {
              modal.find('div#news-view').html(data).show();
          });        
          if (id > 0) {
              modal.find('.modal-title').text(topic);
          }      
      });
      //)};
  </script>