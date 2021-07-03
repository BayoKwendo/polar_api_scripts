<?php require_once('functions.php'); ?>
<?php
    $page=(object)array(
            'title'=>'Users',
            'caption'=>'User Dashboard',
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
        <li class="breadcrumb-item active">Users</li>
      </ol>
      <?php echo view_message(); ?>  
      <div class="row">      
          <div class="col-12">          
              <div class="card card-outline-primary">
                  <div class="card-header">
                      <h5>
                          <i class="fa fa-list-alt"></i> User List
                          <span class="pull-right">
                              <button class="btn btn-sm btn-primary" data-id="-1" data-toggle="modal" data-target="#userModal" ><i class="fa fa-user"> New User</i></button>
                              &nbsp;|&nbsp;
                              <a class="btn btn-sm btn-success" href="<?php echo $page->uri;?>" >View All</a>
                          </span>
                      </h5>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                          <?php $headings = '<tr><th>#</th><th>Full Names</th><th>Username</th><th>Email</th><th>Last Vist</th><th></th></tr>'; ?>
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead><?php echo $headings; ?></thead>
                              <tfoot><?php echo $headings; ?></tfoot>
                              <tbody>
                                  <?php
                                      if($users = db_get_all("SELECT * FROM users ORDER BY full_names ASC ")){
                                      //var_dump($users);
                                          $count = 0;
                                          foreach($users AS $row){
                                              $data = array();
                                              foreach($row AS $key => $value){
                                                  $data[] = "data-$key='$value' ";
                                              }
                                              $msg = "Records for $row->id [$row->full_names]";
                                              $pass_msg = "Change Password for $row->full_names";
                                              $del = ' data-id="'.$row->id.'" data-tbl="users" data-msg="'.$msg.'" ' ;
                                              $pass = ' data-id="'.$row->id.'" data-tbl="users" data-msg="'.$pass_msg.'" ' ;
                                                                                            
                                              $btn_edit = '<button class="btn btn-sm btn-warning" data-id="'.$row->id.'"  data-full_names="'.$row->full_names.'" data-toggle="modal" data-target="#userModal" ><i class="fa fa-pencil"></i></button>';
                                              $del_msg = "Records for User: $row->full_names ";
                                              $btn_del = '<button class="btn btn-sm btn-danger" data-id="'.$row->id.'"  data-tbl="users" data-msg="'.$del_msg.'"  data-toggle="modal" data-target="#deleteModal" ><i class="fa fa-trash"></i></button>';
                                              $btn_pass = '<a '.$pass.' class="btn btn-sm btn-warning" data-toggle="modal" data-target="#password1Modal" ><i class="fa fa-key" > </i></a>';
  
                                              $btns = "$btn_edit | $btn_pass | $btn_del";                                                           
                                              echo '<tr>';
                                              echo '<td>'.++$count.'</td>';
                                              echo '<td>'.$row->full_names.'</td>';
                                              echo '<td>'.$row->username.'</td>';
                                              echo '<td>'.$row->email.'</td>';
                                              echo '<td>'.$row->last_visit.'</td>';
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
  <div data-backdrop="true" class="modal fade " id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="userModalLabel">New User Details</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div id="user-form" class="content">
          <!-- user form here !-->
          </div>
      </div>
    </div>
  </div>
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
  
      $('#userModal').on('show.bs.modal', function (event) {
         // alert("OK");
          var button = $(event.relatedTarget);
          var id = button.data('id');  
          var full_names = button.data('full_names');
  
          var modal = $(this);
         modal.find('.modal-body input#id').val(id);
          $.post("formSubmit.php", {'ajax-user-form': id}, function (data) {
              modal.find('div#user-form').html(data).show();
          });
        
          if (id > 0) {
              modal.find('.modal-title').text('Edit User Details: ' + full_names);
              modal.find('.modal-body input#full_names').val(full_names);
  
          } else {
              modal.find('.modal-title').text('New User Details');
  
          }
          
      });
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