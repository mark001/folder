<!-- start  of content --> 
<div id="main" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> 
  <h1 class="page-header">Manage Users</h1>
    <?php if($this->session->flashdata('message') != ''){ ?>
      <div id="alert" class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <h4><?php echo $this->session->flashdata('message'); ?></h4>
      </div>
    <?php } ?>
    <?php if (!empty($users)) { ?> 
      <table class="table table-stripped table-hover">
        <thead>
          <tr>
            <th>Username</th>
            <th>E-mail</th>
            <th>User Type</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user) { 
            if ($user['username'] != $this->session->userdata('username')) { ?>
              <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['user_type']=='1'?'administrator':'client' ?></td>
                <td><a href="/folder/administrator/accounts/edit/<?php echo $user['username']; ?>" style="text-decoration:none;"><i class="fa fa-pencil-square-o"></i> Edit</a> 
                  <!-- start of delete -->
                    &nbsp;&nbsp;
                    <a href="#" data-toggle="modal" data-target=".<?php echo str_replace(' ', '', $user['username']); ?>delete" style="text-decoration:none;"><i class="fa fa-trash"></i> Delete</a>
                    <!-- Modal Warning <DELETE> -->
                    <div class="<?php echo str_replace(' ', '', $user['username']) ?>delete modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Folder - Administrator</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong><?php echo $user['username']; ?></strong>?</p>
                                <h6 class="help-block alert alert-danger">Deleting the user will result to removing all of his credentials and repositories.</h6>
                            </div>
                            <div class="modal-footer">
                              <a href="/folder/administrator/accounts/delete/<?php echo $user['username']; ?>" class="btn btn-danger" role="button">Delete</a>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- Modal Warning <DELETE> -->
                  <!-- end of delete -->
                  <!-- start of reset password -->
                    &nbsp;&nbsp;
                    <a href="#" data-toggle="modal" data-target=".<?php echo str_replace(' ', '', $user['username']); ?>reset" style="text-decoration:none;"><i class="fa fa-repeat"></i> Reset Password</a>
                    <!-- Modal Warning <Reset Password> -->
                      <div class="<?php echo str_replace(' ', '', $user['username']); ?>reset modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Folder - Administrator</h4>
                              </div>
                              <div class="modal-body">
                                  <p>Are you sure you want to reset password of <strong><?php echo $user['username']; ?></strong>?</p>
                                  <h6 class="help-block alert alert-info">An email will be sent to the user to inform them about their password.</h6>
                              </div>
                              <div class="modal-footer">
                                <a href="/folder/administrator/accounts/reset/password/<?php echo $user['username']; ?>" class="btn btn-primary" role="button">Reset Password</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                      </div>
                      <!-- Modal Warning <Reset Password> -->
                    <!-- start of reset password -->
                    <!-- start of ban -->
                      &nbsp;&nbsp;
                      <a href="#" data-toggle="modal" data-target=".<?php echo str_replace(' ', '', $user['username']); ?>ban" style="text-decoration:none;">
                        <?php if ($user['user_status'] == '1') { ?>
                          <i class="fa fa-ban"></i> Ban User
                        <?php } else { ?>
                          <i class="fa fa-circle-o"></i> Unban User
                        <?php } ?>
                      </a>
                      <!-- Modal Warning <ban/unban> -->
                        <div class="<?php echo str_replace(' ', '', $user['username']); ?>ban modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-sm">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Folder - Administrator</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to <?php echo $user['user_status']=='1'?'ban':'unban' ?> <strong><?php echo $user['username']; ?></strong>?</p>
                                    <h6 class="help-block alert alert-warning">Banning users will prevent them from logging in.</h6>
                                </div>
                                <div class="modal-footer">
                                  <a href="/folder/administrator/accounts/ban/<?php echo $user['username']; ?>" class="btn btn-warning" role="button"><?php echo $user['user_status']=='1'?'Ban User':'Unban User' ?> </a>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                        </div>
                        <!-- Modal Warning <ban/unban> -->
                    <!-- start of reset password -->
                    </td>
              </tr>
          <?php 
              }
            } 
          ?>
        </tbody>
      </table>
    <?php } else { ?>
      <div class="alert alert-info">
        <h4>There are no user data in the database! <a id="link" href="" style="color:black">(<i class="fa fa-refresh"></i> refresh)</a></h4>
      </div>
    <?php } ?>
</div>
<!-- end of content --> 