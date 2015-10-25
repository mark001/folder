<style>
  #right-pane{
      float:right;
      position: absolute;
      display:  block;
  }

  #left-pane{
    float:left;
    position: absolute;
    display: block;
  }

  .nav-custom{
    padding-left: 20px;
  }

</style>
<div class="container-fluid">
<!--main content-->
<div class="col-xs-10">
  <div class="content_container container-fluid">
    <h1 class="page-header"><?php echo $folder['folder_name'] ?> &middot; Dashboard</h1>
    
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-files-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $file_count; ?></div>
                        <div>Total Files</div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-cloud-upload fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $push_count ?></div>
                        <div>Total Push</div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-sitemap fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $branch_count ?></div>
                        <div>Total Branches</div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <a href="/folder/folder/<?php echo $user['username'] ?>/<?php echo $folder['folder_name']?>/master" style="float:right"><h4><i class="fa fa-hand-o-right"></i> Go to master branch of <?php echo $folder['folder_name'] ?></h4></a>
  </div>
</div>
  <!---end main content-->

<!--right sidebar-->
<div class="col-xs-2 col-xs-offset-10 col-sm-2 col-sm-offset-10 col-md-2 col-md-offset-10 " id="right-pane">
    <h4> Controls</h4>
    <ul class="nav nav-sidebar">
      <?php if($user['username']==$this->session->userdata('username')) { ?>
        <li><a href="#" data-toggle="modal" data-target=".createBranch"><span class="fa fa-sitemap"></span> Create Branch</a></li>      
        <li><a href="/folder/folder/<?php echo $folder['folder_name'] ?>/push"><span class="fa fa-arrow-up"></span> Push</a></li>
      <?php } ?>
      <li><a href="#"><span class="fa fa-arrow-down"></span> Pull</a></li>
      <li><a href="/folder/folder/download/zip/<?php echo $this->user_model->getUserByUserID($folder['user_id'])['username'] ?>/<?php echo $folder['folder_name'] ?>/master"><span class="fa fa-file-archive-o"></span> Download as ZIP</a></li>
  </div>
</div>
<!-- Modal Warning <create branch> -->
<div class="createBranch modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Branch</h4>
        </div>
        <form  id="form" action="/folder/folder/branch/create" method="POST" class="form-horizontal" role="form">
          <div class="modal-body">
            <input type="hidden" name="folderAuthor" value="<?php echo $user['username'] ?>">
            <fieldset>
              <div class="form-group">
                <label for="createFrom" class="col-lg-3 control-label">Create Branch from</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" id="createFrom" name="txtFolderName" placeholder="Folder name" value="<?php echo $folder['folder_name'] ?>" readonly>
                </div>
              </div>
              <div id="branchname_group" class="form-group">
                <label for="branchName" class="col-lg-3 control-label">Branch Name</label>
                <div class="col-lg-9">
                  <input type="text" class="form-control" id="branchName" name="txtBranchName" placeholder="Branch name" >
                  <i id="check-branch" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
                  <p id="help-warning-branch" class="help-block" style="display:none">Branch already exists.</p>
               </div>
              </div>
            </fieldset>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" role="button">Create</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
</div>
  <!-- Modal Warning <create branch> -->
<!--end right sidebar-->
<script type="text/javascript">
  $(document).ready(function(){
    var bran = false;

    $('#branchName').change(function(){
      var branchname = $('#branchName').val();
      if (branchname == ""){
        $('#branchname_group').removeClass('has-error');
        $('#branchname_group').removeClass('has-success');
        $('#check-branch').hide();
        $('#help-warning-branch').hide();
        bran = false;
      } else {
        $.ajax({
          type: "POST",
          url: "/folder/folder/branch/check",
          data: {'username':"<?php echo $user['username'] ?>", 'folderName':"<?php echo $folder['folder_name'] ?>", 'branchName':branchname},
          success: function (result){
            if (result == "1"){
              $('#branchname_group').addClass('has-error');
              $('#branchname_group').removeClass('has-success');
              $('#check-branch').hide();
              $('#help-warning-branch').show();
              bran = false;
            } else {
              $('#branchname_group').removeClass('has-error');
              $('#branchname_group').addClass('has-success');
              $('#check-branch').show();
              $('#help-warning-branch').hide();
              bran = true;
            }
          }
        });
      }
    });

    $('#form').submit(function(e){
      if (!(bran)){
        $('#branchName').focus();
        $('#branchname_group').addClass('has-error');
        $('#branchname_group').removeClass('has-success');
        e.preventDefault();
      } else {
        $('#branchname_group').removeClass('has-error');
      }
    });
  });
</script>