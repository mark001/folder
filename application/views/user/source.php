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

  pre {
    display: inline-block;
    white-space: pre-wrap;       /* css-3 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;    
  }
</style>

<?php
  $id = @$_GET['id'];
  $type = '';

  if (!empty($id)){
    $myfile = $this->file_model->getFileByFileID($id);
    $mimetype = get_mime_by_extension($myfile['file_path']);
    $myFiletype = new SplFileInfo($myfile['file_path']);
    $myFiletype =  $myFiletype->getExtension();
    switch ($myFiletype) {
      case 'java': $type = 'shBrushJava'; break;
      case 'js': $type = 'shBrushJScript'; break;
      case 'php': $type = 'shBrushPhp'; break;
      case 'css': $type = 'shBrushCss'; break;
      case 'html': $type = 'shBrushXml'; break;
      default:break;
    }
  }
?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/shCore.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/<?php echo $type ?>.js"></script>
<script type="text/javascript">
  SyntaxHighlighter.config.stripBrs = true;
  SyntaxHighlighter.config.tagName = "textarea";
  SyntaxHighlighter.all();
</script>
<div class="container-fluid">
<div class="col-xs-3 col-sm-3 col-md-2" id="left-pane">
  <h4><a href="/folder/folder/<?php echo $user['username'] ?>/<?php echo $folder['folder_name'] ?>"> <?php echo $folder['folder_name'] ?></a></h4>
  <div class="form-group">
    <label for="select" class=" control-label">Branch</label>
      <div>
        <select class="form-control" id="branch" name="cboBranch" >
          <?php foreach($branches as $branch) { ?>
            <option <?php echo $branch['branch_name']==$branch_selected?'selected':null; ?> value="<?php echo $branch['branch_name']; ?>"><?php echo $branch['branch_name']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  <ul class="nav nav-custom nav-sidebar">
    <?php 
      foreach($files as $file) { 
        if ((strpos(get_mime_by_extension($file['file_path']), 'text') !== FALSE) || (strpos(get_mime_by_extension($file['file_path']), 'image') !== FALSE)){
    ?>
        <li <?php if ($id==$file['file_id']){ ?>  class="active" <?php } ?>><a href="?id=<?php echo $file['file_id'] ?>"><?php echo $file['file_name'] ?></a></li>
    <?php 
        }
      }
    ?>
 </ul>
</div>

<!--main content-->
<div id="main" class="col-xs-7 col-xs-offset-3 col-sm-7 col-sm-offset-3 col-md-8 col-md-offset-2">
  <div class="content_container">
    <h1 class="page-header"><?php echo $folder['folder_name'] ?> &middot; <?php echo $branch_selected?></h1>
    <?php if (empty($id)) { ?>
      <h3>There is no selected file to be open</h3>
    <?php } else { ?>
      <h3 class="sub-heading"><?php echo $myfile['file_name'] ?></h3>
      <div class="form-group">
      <?php if (strpos(get_mime_by_extension($myfile['file_path']), 'text') !== FALSE){ ?>
        <code>
          <textarea class="form-control brush: <?php echo $myFiletype; ?>;  tab-size: 4;" >
              <?php echo read_file($myfile['file_path']); ?>
          </textarea>
        </code>
      <?php
        } else{
           $src= str_replace('C:\\xampp\\htdocs\\folder\\', base_url() , $myfile['file_path']);
      ?>
      <pre>
        <img src="<?php echo $src ?>">
      </pre>
      <?php } ?>
    </div>
    <?php } ?>
  </div>
</div>
<!---end main content-->

<!--right sidebar-->
<div class="col-xs-2 col-xs-offset-10 col-sm-2 col-sm-offset-10 col-md-2 col-md-offset-10" id="right-pane">
    <h4> Controls</h4>
    <ul class="nav nav-sidebar">
      <?php if($user['username']==$this->session->userdata('username')) { ?>
        <li><a href="#" data-toggle="modal" data-target=".createBranch"><span class="fa fa-sitemap"></span> Create Branch</a></li>
        <li><a href="/folder/folder/<?php echo $folder['folder_name'] ?>/push"><span class="glyphicon glyphicon-arrow-up"></span> Push</a></li>
      <?php } ?>
      <li><a href="#"><span class="glyphicon glyphicon-arrow-down"></span> Pull</a></li>
      <li><a href="/folder/folder/download/zip/<?php echo $this->user_model->getUserByUserID($folder['user_id'])['username'] ?>/<?php echo $folder['folder_name'] ?>/<?php echo $branch_selected ?>"><span class="fa fa-file-archive-o" /></span> Download as ZIP</a></li>
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
                    <input type="text" class="form-control" id="branchName" name="txtBranchName" placeholder="Branch name">
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

    $('#branch').change(function(){
      location.href = "/folder/folder/<?php echo $user['username'] ?>/<?php echo $folder['folder_name']?>/" + $('#branch').val();
    });

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
