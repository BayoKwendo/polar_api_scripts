
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © POLAR MANAGEMENT Ltd <?php echo date('Y'); ?></small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Password Change Modal -->
    <div data-backdrop="true" class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger" id="dmsg">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <form method="post" action="formSubmit.php">
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
                                        <input type="submit" class="btn btn-info btn-sm btn-danger " value="Change Password" name="password-change" />
                                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            <!-- Delete Modal -->
            <div data-backdrop="true" class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="deleteModalLabel">Delete Confirmation</h5>
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
                                        <h6 >Are you sure? <hr style="margin:5px 0px;" /></h6>
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
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
                $(document).ready(function(){
                    $('a.verify').on('click', function(event){
                        confirm('ARE YOU SURE?\nIf all the documents are autenticated, this requirement will be cleared and set completed else it will be set as incomplete [Clicking it again reverts the action]');
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
                    // DELETE ACTION
                    $('#deleteModal').on('show.bs.modal', function (event) {
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
                        } else {
                            alert('Your action cannot be completed due to Invalid Record');
                            return false;
                        }
                    });
                    
                });
            </script>
  </div>
</body>

</html>
