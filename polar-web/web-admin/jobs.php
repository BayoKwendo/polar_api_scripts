<?php require_once('functions.php'); ?>
<?php confirm_logged_in(); ?>
<?php
    $page=(object)array(
            'title'=>'Jobs',
            'caption'=>'Jobs Dashboard',
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
        <li class="breadcrumb-item active">Jobs</li>
      </ol>
      <?php echo view_message(); ?>
      <div class="card mb-3">
        <div class="card-header">
          <h5>
            <i class="fa fa-list-alt"></i> <?php echo $page->caption;?>
            <span class="pull-right">
              <a class="btn btn-sm btn-primary" data-id="-1" data-toggle="modal1" data-target="#jobsModal1" href="jobs.php?pg=-1" ><i class="fa fa-page">  Post New Job</i></a>
              &nbsp;|&nbsp;
              <a class="btn btn-sm btn-success" href="jobs.php" >View All</a>
            </span>
          </h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
              if(isset($_REQUEST['pg'])){
                $id = intval($_REQUEST['pg']);
                $pg = $id>0? db_get_row("SELECT * FROM jobs WHERE id='$id' "):FALSE;
                //var_dump($pg);
                ?>
                <form method="post" action="formSubmit.php" >
                  
                    <div class="modal-body">                        
                        <input type="hidden" id="id" name="id" value="<?php echo isset($pg->id)? $pg->id:-1;?>" />
                        <input type="hidden" id="date_posted" name="date_posted" value="<?php echo isset($pg->date_posted)? $pg->date_posted:$now;?>" />
                            <div class="row">
                            <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="job_ref" >Job Refrence</label>
                                        <input id="job_ref" name="job_ref" value="<?php echo isset($pg->job_ref)? $pg->job_ref:'';?>" type="text" class="form-control border-input" placeholder="Job REF" required />
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="job_title" >Job Title</label>
                                        <input id="job_title" name="job_title" value="<?php echo isset($pg->job_title)? $pg->job_title:'';?>" type="text" class="form-control border-input" placeholder="Job Title" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organisation" >Organisation</label>
                                        <input id="organisation" name="organisation" value="<?php echo isset($pg->organisation)? $pg->organisation:'';?>" type="text" class="form-control border-input" placeholder="Organisation" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reports_to" >Reports To</label>
                                        <input id="reports_to" name="reports_to" value="<?php echo isset($pg->reports_to)? $pg->reports_to:'';?>" type="text" class="form-control border-input" placeholder="Reports To" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duty_station" >Duty Station</label>
                                        <input id="duty_station" name="duty_station" value="<?php echo isset($pg->duty_station)? $pg->duty_station:'';?>" type="text" class="form-control border-input" placeholder="Duty Station" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select id="country" name="country" class="form-control border-input" placeholder="country" required >
                                            <?php
                                                if($ctry = db_get_all("SELECT * FROM countries ORDER BY nationality ASC ")){                                                   
                                                    echo '<option value="" > ----- Select Country ------- </option>';
                                                    foreach($ctry AS $opt){
                                                        echo '<option value="'.$opt->country_name.'"  '.((isset($pg->country)&&$pg->country==$opt->country_name)? "selected":"").'  >'.$opt->country_name.'</option>';
                                                    }
                                                } else {
                                                    echo '<option value="" > No Country info </option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about_us" >About Us</label>
                                        <textarea id="about_us" rows="5" name="about_us" class="form-control border-input" placeholder="About Us" required /><?php echo isset($pg->about_us)? $pg->about_us:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="job_summary" >Job Summary</label>
                                        <textarea id="job_summary" rows="5" name="job_summary" class="form-control border-input" placeholder="Job Summary" required /><?php echo isset($pg->job_summary)? $pg->job_summary:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="kdr" >Key Duties and Responsibilities</label>
                                        <textarea id="kdr" rows="5" name="kdr" class="form-control border-input" placeholder="Key Duties and Responsibilities" required /><?php echo isset($pg->kdr)? $pg->kdr:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="qse" >Qualifications, Skills and Experience</label>
                                        <textarea id="qse" rows="5" name="qse" class="form-control border-input" placeholder="Qualifications, Skills and Experience" required /><?php echo isset($pg->kdr)? $pg->kdr:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="compensations" >Compensations</label>
                                        <textarea id="compensations" rows="5" name="compensations" class="form-control border-input" placeholder="Compensations" required /><?php echo isset($pg->compensations)? $pg->compensations:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="howto_apply" >How to Apply</label>
                                        <textarea id="howto_apply" rows="5" name="howto_apply" class="form-control border-input" placeholder="How to Apply" required /><?php echo isset($pg->howto_apply)? $pg->howto_apply:'';?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="deadline" >Deadline</label>
                                        <input id="deadline" name="deadline" value="<?php echo isset($pg->deadline)? $pg->deadline:'';?>" type="datetime-local" class="form-control border-input" placeholder="Deadline" required />
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
                            <input type="submit" class="btn btn-info btn-sm " value="Save" name="jobs_entry" />
                        </div>
                    </div>
                </form>
                <?php
              } else {
                $headings = '<tr><th>#</th><th>Title</th><th>Job Ref</th><th>Organisation</th><th>Duty Station</th><th>Published</th><th>Deadline</th><th></th></tr>';
                echo '<table class="table1 table-bordered" id="dataTable" width="100%" cellspacing="0">';
                echo '<thead>'.$headings.'</thead>';
                echo '<tfoot>'.$headings.'</tfoot>';
                echo '<tbody>';
                if($pages = db_get_all("SELECT * FROM jobs ORDER BY date_posted DESC ")){
                  //var_dump($pages);
                  $count = 0;
                  foreach($pages AS $row){
                    $link_view = '<a href="#" data-id="'.$row->id.'"  data-job_title="'.$row->job_title.'" data-toggle="modal" data-target="#jobsViewModal" >'.$row->job_title.'</a>';
                    $btn_edit = '<a href="jobs.php?pg='.$row->id.'"  class="btn btn-sm btn-warning" data-id="'.$row->id.'"  data-job_title="'.$row->job_title.'" data-toggle="modal1" data-target="#jobsModal1" ><i class="fa fa-pencil"></i></a>';
                    $del_msg = "Records for Job Title article: $row->job_title ";
                    $btn_del = '<button class="btn btn-sm btn-danger" data-id="'.$row->id.'"  data-tbl="jobs" data-msg="'.$del_msg.'"  data-toggle="modal" data-target="#deleteModal" ><i class="fa fa-trash"></i></button>';
                    $btns = "$btn_edit | $btn_del";
                    echo '<tr>';
                    echo '<td>'.++$count.'</td>';
                    echo '<td>'.$link_view.'</td>';
                    echo '<td>'.$row->job_ref.'</td>';
                     echo '<td>'.$row->organisation.'</td>';
                     echo '<td>'.$row->duty_station.', '.$row->country.'</td>';
                     echo '<td>'.($row->published? "YES":"NO").'</td>';
                     echo '<td>'.$row->deadline.'</td>';
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
        CKEDITOR.replace('about_us',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'});
        CKEDITOR.replace('job_summary',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'});
        CKEDITOR.replace('kdr',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'});
        CKEDITOR.replace('qse',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'});

        CKEDITOR.replace('compensations',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'});
        CKEDITOR.replace('howto_apply',{filebrowserBrowseUrl:roxyFileman,
                                    filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                    removeDialogTabs: 'link:upload;image:upload'});
        
    });
</script>
<?php } ?>
  <!-- News View Modal -->
  <div data-backdrop="true" class="modal fade " id="jobsViewModal" tabindex="-1" role="dialog" aria-labelledby="jobsViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="jobsModalLabel"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div id="job-view" class="content">
          <!-- page form here !-->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--    end modal -->
  
  <script>

      $('#jobsViewModal').on('show.bs.modal', function (event) {
         //alert("OK");
          var button = $(event.relatedTarget);
          var id = button.data('id');  
         var job_title = button.data('job_title');
        //alert(job_title);
          var modal = $(this);
          $.post("formSubmit.php", {'ajax-job-view': id}, function (data) {
              modal.find('div#job-view').html(data).show();
          });        
          if (id > 0) {
              modal.find('.modal-title').text(job_title);
          }      
      });
      //)};
  </script>