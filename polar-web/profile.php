<?php include ('web-admin/functions.php');?>
<?php
  confirm_logged_in_A();
  $active_user = get_active_user_A();
 // var_dump($active_user, $_SESSION['polar_db_A']->id);
	$data = (object)array('name'=>"profile",'title'=>"My Account: Profile Information")
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
                <?php
                    if($profile = db_get_row("SELECT * FROM applicant_info WHERE id='$active_user->id' ")){
                        $modal_data = ' data-id="'.$profile->id.'" data-oldpass="'.$profile->password.'" data-old_pix="'.$profile->photo.'" ';
                        //var_dump($profile);
                ?>
                    <div class="col-12 col-md-8">
                        <div class="card card-outline-primary">
                            <div class="header">
                                <h4 class="title">Edit Profile
                                    <hr style="padding:0;margin:0;" />
                                </h4>
                                <?php echo view_message_A(); ?>
                            </div>
                            <div class="card-body">
                                <form method="post" action="forms.php">
                                    <input type="hidden" id="id" name="id" value="<?php echo $profile->id;?>" />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input id="first_name" name="first_name" value="<?php echo $profile->first_name;?>" type="text" class="form-control border-input"
                                                    placeholder="First Name" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input id="last_name" name="last_name" value="<?php echo $profile->last_name;?>" type="text" class="form-control border-input"
                                                    placeholder="Last Name" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contact">Contact</label>
                                                <input id="contact" name="contact" value="<?php echo $profile->contact;?>"  type="text" class="form-control border-input"
                                                    placeholder="Contact" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email_address">Email</label>
                                                <input id="email_address" name="email_address" type="email" value="<?php echo $profile->email_address;?>" class="form-control border-input" placeholder="Email Address"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="about_me">About Me</label>
                                                <textarea id="about_me" name="about_me" rows="5" class="form-control" placeholder="Here can be your description" required><?php echo $profile->about_me;?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right" name="profile_entry">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="text-center" >
                                <button <?php echo $modal_data;?> href="#" class="btn-sm btn-success" data-toggle="modal" data-target="#photoModal"><i class="pe-7s-photo"> Photo</i></button>
                                <button <?php echo $modal_data;?> href="#" class=" btn-sm btn-warning" data-toggle="modal" data-target="#passwordModal"><i class="pe-7s-key"> Password</i></button>
                                <hr   />
                            <?php
                                if(isset($profile->photo)&&$profile->photo!=''){
                                    echo '<img class="img-center img-thumbnail img-circle" src="images/applicants/'.$profile->photo.'" alt="..." />';
                                } else {
                                    echo '<img width="100" class="img-center img-thumbnail img-circle" src="images/default-avatar.png" alt="..." />';
                                }
                            ?>
                            <h4 class="title">
                                <?php echo $profile->first_name.' '.$profile->last_name;?><hr style="margin:0;" >
                                <small><?php echo substr($profile->about_me,0,200);?></small>
                            </h4>
                            
                        </div>
                    </div>
                    <?php 
                    } else {
                        echo '<div class="col-md-12 alert alert-info">Error Loading your profile details, check if you are on the right page</div>';
                    }
                ?>
            </div>
				</div>
			</div>			
		</div>
	</div>
    
<?php include ('footer.php'); ?>
    <!-- Photo Change Modal -->
    <div data-backdrop="true" class="modal fade " id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="photoModalLabel">Change Your Photo </h4>
                </div>
                <form method="post" action="forms.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="content">
                            <input type="hidden" id="id" name="id" value="-1" />
                            <input type="hidden" id="old_pix" name="old_pix" value="" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="photo">Profile Photo <small style="color:red;" > Photo Size: 200x200px</small></label>
                                        <input id="photo" name="photo" value="" type="file" class="form-control border-input" placeholder="Photo" required />
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="left-side">
                            <input type="submit" class="btn btn-info btn-fill btn-wd" value="Upload" name="photo_entry" />
                            <button type="button" class="btn btn-danger btn-fill" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Password Change Modal -->
<div data-backdrop="true" class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-danger" id="dmsg">Change Password</h4>
                </div>
                <form method="post" action="forms.php">
                    <div class="modal-body">
                        <div class="content">
                            <input id="id" name="id" value="0" type="hidden" />
                            <input id="oldpass" name="oldpass" value="" type="hidden" />
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <label for="current_password">Current Password </label>
                                        <input id="password-0" name="current_password" type="text" class="form-control border-input" placeholder="Old Password" value="" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input id="msg" name="msg" value="" type="hidden" />
                                    <div class="form-group">
                                        <label for="password-2">New Password </label>
                                        <input id="password-2" name="password2" type="text" class="form-control border-input" placeholder="New passwprdPassword" value="" required />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input id="msg" name="msg" value="" type="hidden" />
                                    <div class="form-group">
                                        <label for="password2">Reppeat Password </label>
                                        <input id="password2" name="password" type="text" class="form-control border-input" placeholder="Repeat Password" value="" required />
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="left-side">
                            <input type="submit" class="btn btn-info btn-fill btn-danger btn-wd" value="password" name="password-change" />
                            <button type="button" class="btn btn-success btn-fill" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
    <!--    end modal -->

    <script>
        $('#photoModal').on('show.bs.modal', function (event) {
            // alert("OK");

            var button = $(event.relatedTarget);
            var id = button.data('id');
            var old_pix = button.data('old_pix');
            var modal = $(this);
            modal.find('.modal-body input#id').val(id);
            modal.find('.modal-body input#old_pix').val(old_pix);

        });
        // CHANGE PASSWORD ACTION
        $('#passwordModal').on('show.bs.modal', function(event) {
                    //alert('password');
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    var oldpass = button.data('oldpass');
                    //alert(id);
                    var modal = $(this);
                    if (id > 0) {
                        modal.find('.content input#id').val(id);
                        modal.find('.content input#oldpass').val(oldpass);
                        //modal.find('.content input#msg').val(msg);
                    } else {
                        alert('Your action cannot be completed due to Invalid Record');
                        return false;
                    }
        });

        //)};
    </script>