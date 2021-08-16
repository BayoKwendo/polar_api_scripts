<?php include ('web-admin/functions.php');?>
<?php
  confirm_logged_in_A();
  $active_user = get_active_user_A();
 // var_dump($active_user, $_SESSION['polar_db_A']->id);
	$data = (object)array('name'=>"apply",'title'=>"My Account: Job Application")
?>
<?php include ('header.php'); ?>
<div id="get-touch">
	<div class="container">
		<div class="row">
            <div class="col-12 col-sm-12 col-md-12 ">
                <div class="get-touch-heading1">
                    <?php echo '<h4>'.$data->title.'<hr style="margin:5px 0;" /></h4>'; ?>
                    <?php echo view_message_A();?>
                </div>
            </div>
			<div class="col-xs-12 col-md-3">
                <div class="about-left1">
					<ul class="list-group">
						<li class="list-group-item active">My Menu</h4></li>
						<li class="list-group-item" ><a href="profile.php" >My Profile</a></li>
						<li class="list-group-item" ><a href="job_applications.php" >Job Applications</a></li>					
					</ul>
				</div>
            </div>            
            <div class="col-xs-12 col-md-9">
                <h5>
                    <strong><i class="fa fa-list-alt"></i> My Jobs </strong>
                    <span class="pull-right">
                    <a class="btn1 btn-sm btn-primary" data-id="-1" data-toggle="modal1" data-target="#jobsModal1" href="job_applications.php?apply=-1" ><i class="fa fa-page">  New Job Application</i></a>
                    &nbsp;|&nbsp;
                    <a class="btn1 btn-sm btn-success" href="job_applications.php" >View All</a>
                    </span>
                    <hr style="margin:10px 0;" />
                </h5>
                <div class="table-responsive1">
                    <?php
                        if(isset($_GET['apply'])){  //var_dump($_GET);//
                            $id = intval($_GET['apply']);
                            $job = isset($_GET['job'])? strval($_GET['job']):FALSE;
                            //$job = $job==FALSE? FALSE: db_get_row("SELECT id, jor_ref, job_title * FROM jobs WHERE id='$job' ");
                            //var_dump($id, $job);
                            $application_details = $id>0? db_get_row("SELECT * FROM job_application WHERE id='$id' "):FALSE;
                            require('application_form.php');
                        } else {
                            $headings = '<tr><th>#</th><th>Position</th><th>Job Ref</th><th>Agent</th><th>Application Date</th><th>Status</th><th></th></tr>';
                            echo '<table class="table table-bordered" id="dataTable" w1idth="100%" cellspacing="0">';
                            echo '<thead>'.$headings.'</thead>';
                            echo '<tfoot>'.$headings.'</tfoot>';
                            echo '<tbody>';
                            if($applications = db_get_all("SELECT * FROM job_application WHERE applicant_info_id='$active_user->id' ")){ 
                                //var_dump($applications);
                                $count = 0;
                                foreach($applications AS $row){ //var_dump($row);
                                    $status = array('Saved','Submited');
                                    $link_view = '<a href="#" data-id="'.$row->id.'"  data-job_title="'.$row->position_applied.'" data-toggle="modal" data-target="#jobsViewModal" >'.$row->position_applied.'</a>';
                                    $btn_edit = '<a href="job_applications.php?apply='.$row->id.'"  class="btn1 btn-sm btn-warning" data-id="'.$row->id.'"  data-job_title="'.$row->position_applied.'" data-toggle="modal1" data-target="#jobsModal1" ><i class="fa fa-pencil"></i></a>';
                                    $del_msg = "Records for Job application for Position: $row->position_applied ";
                                    $submit_msg = "Submit Job application for Position: $row->position_applied for Job Placement at POLAR Management Limited";
                                    $btn_del = '<button class="btn1 btn-sm btn-danger" data-id="'.$row->id.'"  data-tbl="job_application" data-msg="'.$del_msg.'"  data-toggle="modal" data-target="#deleteModal" ><i class="fa fa-trash"></i></button>';
                                    $btn_sbt = '<button class="btn1 btn-sm btn-default" data-id="'.$row->id.'"  data-tbl="job_application" data-msg="'.$submit_msg.'"  data-toggle="modal" data-target="#submitModal" >Submit</button>';
                                    $btns = $row->apply==0? "$btn_edit | $btn_del | $btn_sbt":'DONE';
                                    echo '<tr>';
                                    echo '<td>'.++$count.'</td>';
                                    echo '<td>'.$link_view.'</td>';
                                    echo '<td>'.$row->job_ref.'</td>';
                                    echo '<td>'.$row->agent.'</td>';
                                    echo '<td>'.$row->date_of_application.'</td>';
                                    echo '<td>'.$status[$row->apply].'</td>';
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
		</div>
	</div>			
</div>
    
<?php include ('footer.php'); ?>
<!-- Delete Modal -->
<div data-backdrop="true" class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="deleteModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="post" action="forms.php" >
            <div class="modal-body">        
                <div class="content">
                    <input id="id" name="id" value="" type="hidden" />
                    <input id="tbl" name="tbl" value="" type="hidden" />
                    <input id="msg" name="msg" value="" type="hidden" />
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 >Are you sure? <hr style="margin:5px 0px;" /></h4>
                            <p class="text-danger">You are about to delete <span id="dmsg" ></span></p>						    
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="modal-footer">
            <div class="left-side">
                    <input type="submit" class="btn btn-info btn-sm btn-danger " value="Delete" name="delete-btn" />
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
                </div> 
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Submit Modal -->
<div data-backdrop="true" class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="submitModalLabel">Submit Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="post" action="forms.php" >
            <div class="modal-body">        
                <div class="content">
                    <input id="id" name="id" value="" type="hidden" />
                    <input id="tbl" name="tbl" value="" type="hidden" />
                    <input id="msg" name="msg" value="" type="hidden" />
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 >Are you sure? <hr style="margin:2px 0px;" /></h4>
                            <b class="text-success">You are about to  <span id="smsg" ></span></b>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="modal-footer">
            <div class="left-side">
                    <input type="submit" class="btn btn-info btn-sm btn-danger " value="YES, Submit" name="apply-submit-btn" />
                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
                </div> 
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div data-backdrop="true" class="modal fade" id="jobsViewModal" tabindex="-1" role="dialog" aria-labelledby="jobsViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-danger" id="jobsViewModalLabel">Delete Confirmation</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">        
                <div class="content" id="jobView" >
                   
                </div>
            </div>
            <div class="modal-footer">
            <div class="left-side">
                    <button type="button" class="btn1 btn-success btn-sm" data-dismiss="modal">OK, Close</button>
                </div> 
            </div>
        </form>
        </div>
    </div>
</div>
<!--    end modal -->

    <script>
        // DELETE ACTION
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var tbl = button.data('tbl');
            var msg = button.data('msg');
            var modal = $(this);
            if (id > 0) {
                modal.find('.content input#id').val(id);
                modal.find('.content input#tbl').val(tbl);
                modal.find('.content input#msg').val(msg);
                modal.find('#smsg').html(msg);
            } else {
                alert('Your action cannot be completed due to Invalid Record');
                return false;
            }
            
        });
        // SUBMIT ACTION
        $('#submitModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var tbl = button.data('tbl');
            var msg = button.data('msg');
            //alert(id);
            var modal = $(this);
            if (id > 0) {
                modal.find('.content input#id').val(id);
                modal.find('.content input#tbl').val(tbl);
                modal.find('.content input#msg').val(msg);
                modal.find('#smsg').html(msg);
            } else {
                alert('Your action cannot be completed due to Invalid Record');
                return false;
            }
        });
        // SUBMIT ACTION
        $('#jobsViewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var title = button.data('job_title');
            //alert(id);
            var modal = $(this);
            if (id > 0) {
                modal.find('.modal-title').text('Applicant Details for Job: '+title);
                $.post("application_info.php", {'ajax-jobview': id}, function (data) {
                    modal.find('div#jobView').html(data).show();
                });
            } else {
                alert('Your action cannot be completed due to Invalid Record');
                return false;
            }
        });
        //)};
    </script>