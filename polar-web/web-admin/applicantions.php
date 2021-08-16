<?php require_once('functions.php'); ?>
<?php
    $page=(object)array(
            'title'=>'Applicantion',
            'caption'=>'Applicantion Dashboard',
            'uri'=>basename($_SERVER['PHP_SELF'])
        );
        //var_dump(get_active_user());
?>
<?php include ('header.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Applicantions</li>
      </ol>
      <?php echo view_message(); ?>  
      <div class="row">      
          <div class="col-12">          
              <div class="card card-outline-primary">
                  <div class="card-header">
                      <h5>
                          <i class="fa fa-list-alt"></i> Applicantion List
                          <!--span class="pull-right">
                              <button class="btn btn-sm btn-primary" data-id="-1" data-toggle="modal" data-target="#applicantModal" ><i class="fa fa-user"> New Applicant</i></button>
                              &nbsp;|&nbsp;
                              <a class="btn btn-sm btn-success" href="<?php echo $page->uri;?>" >View All</a>
                          </span!-->
                      </h5>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <?php $headings = '<tr><th>#</th><th>Applican Name</th><th>Position Application</th><th>Agent</th><th>Status</th><th></th></tr>'; ?>
                          <table class="table table-sm table-condensed table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead><?php echo $headings; ?></thead>
                              <tfoot><?php echo $headings; ?></tfoot>
                              <tbody>
                                  <?php
                                      if($applications = db_get_all("SELECT * FROM job_application WHERE apply>'0' ORDER BY first_name ASC ")){
                                      //var_dump($users);
                                          $count = 0;
                                          foreach($applications AS $row){
                                              $data = array();
                                              $status = 'UNKOWN';
                                              foreach($row AS $key => $value){
                                                  $data[] = "data-$key='$value' ";
                                              }
                                              $msg = "Records for  $row->first_name $row->last_name";
                                              $pass_msg = "Change Password for $msg";
                                              $del = ' data-id="'.$row->id.'" data-tbl="applicant_info" data-msg="'.$msg.'" ' ;
                                              $pass = ' data-id="'.$row->id.'" data-tbl="applicant_info" data-msg="'.$pass_msg.'" ' ;
                                            if($row->apply==0) {
                                                $status = '@ATS';
                                            } elseif($row->apply==1){
                                                $status = '@ATS - Waiting processing';
                                            } elseif($row->apply==2){
                                                $status = '@ATS - Recieved for Processing';
                                            }
                                              $btn_edit = '<button class="btn btn-sm btn-warning" data-id="'.$row->id.'"  data-first_name="'.$row->first_name.'" data-last_name="'.$row->last_name.'" data-toggle="modal" data-target="#applicantModal" ><i class="fa fa-pencil"></i></button>';
                                              $del_msg = "Records for $row->first_name $row->last_name ";
                                              $btn_del = '<button class="btn btn-sm btn-danger" data-id="'.$row->id.'"  data-tbl="users" data-msg="'.$del_msg.'"  data-toggle="modal" data-target="#deleteModal" ><i class="fa fa-trash"></i></button>';
                                              $btn_pass = '<a '.$pass.' class="btn btn-sm btn-warning" data-msg="'.$pass_msg.'" data-toggle="modal" data-target="#password1Modal" ><i class="fa fa-key" > </i></a>';
                                              $class = $row->apply==1? ' class="table-warning text-success" ':'';
                                              $btns = '';//"$btn_pass | $btn_del";                                                           
                                              echo '<tr '.$class.' >';
                                              echo '<td>'.++$count.'</td>';
                                              echo '<td>'.$row->first_name . ' ' . $row->last_name.'</td>';
                                              echo '<td>'.$row->position_applied.'</td>';
                                              echo '<td>'.$row->agent.'</td>';
                                              echo '<td>'.$status.'</td>';
                                              echo '<td nowrap >'.$btns.'</td>';
                                              echo '</tr>';
                                          }
                                      }
                                  ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <?php include ('footer.php'); ?>
  
  <!-- User Modal -->
  <!-- Password Modal -->
  <div data-backdrop="true" class="modal fade" id="password1Modal" tabindex="-1" role="dialog" aria-labelledby="password1ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title text-danger" id="dmsg">Change Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <form method="post" action="formSubmit.php" >
          <div class="modal-body">        
              <div class="content">
                  <input id="id" name="id" value="" type="hidden" />
                  <input id="tbl" name="tbl" value="" type="hidden" />
                  <input id="msg" name="msg" value="" type="hidden" />
                  <div class="row">
            <div class="col-sm-12">
                          <input id="msg" name="msg" value="" type="hidden" />
                          <div class="form-group">
                              <label for="password">New Password </label>
                              <input id="password" name="password" type="text" class="form-control border-input" placeholder="Password" value="" required />
                          </div>					    
            </div>
          </div>
                  
                  <div class="clearfix"></div>
              </div>
          </div>
          <div class="modal-footer">
             <div class="left-side">
                  <input type="submit" class="btn btn-info btn-sm btn-danger btn-wd" value="password" name="password-btn" />
                  <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
              </div> 
          </div>
      </form>
      </div>
    </div>
  </div>
  
  <!--    end modal -->
  
  <script>
  
      // PASSWORD ACTION
      $('#password1Modal').on('show.bs.modal', function (event) {
          //alert('password');
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
              modal.find('#dmsg').html(msg);
              //modal.find('.content input#msg').val(msg);
          } else {
              alert('Your action cannot be completed due to Invalid Record');
              return false;
          }
      });
      //)};
  </script>