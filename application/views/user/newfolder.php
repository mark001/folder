<!--start content-->
<div class="container">
  <div class="content_container">
    <h1>New folder</h1>
      <form id="form" action="/folder/folder/create" method="POST" class="form-horizontal" role="form">
        <fieldset>
           <div class="form-group">
              <label for="folder_name" class="col-lg-2 control-label">Author</label>
              <div class="col-lg-10">
                <input class="form-control" id="folder_name" type="text" name="txtFolderAuthor" value="<?php echo $this->session->userdata('username');  ?>" readonly>
              </div>
            </div>
           <div id="foldername_group" class="form-group">
              <label for="folder_name" class="col-lg-2 control-label">Name</label>
              <div class="col-lg-10">
                <input class="form-control" id="folderName" placeholder="folderName" type="text" name="txtFolderName" required>
                <i id="check-folder" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
                <p id="help-warning-folder" class="help-block" style="display:none">Branch already exists.</p>
              </div>
            </div>  
          <div class="form-group">
            <label class="col-lg-2 control-label">Access Level</label>
            <div class="col-lg-10">
              <div class="checkbox">
                <label>
                  <input id="accessLevel" name="accessLevel" type="hidden" value="1">
                  <span id="access"><i id="accessIcon" class="fa fa-lock"></i> <span id="accessLabel">Private</span></span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Type</label>
            <div class="col-lg-10">
              <?php $types = array ('Java', 'HTML', 'PHP', 'JAVASCRIPT'); ?>
              <?php foreach($types as $value) { ?>
                <div class="radio">
                  <label>
                    <input name="optType" id="js_radio" value="<?php echo $value; ?>" type="radio">
                    <?php echo $value; ?>
                  </label>
                </div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group" >
            <label for="textArea" class="col-lg-2 control-label">Description</label>
            <div class="col-lg-10">
              <textarea class="form-control" rows="3" id="textArea" name="txtDescription"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Create new folder</button>
              <button type="reset" class="btn btn-default">Cancel</button>
            </div>
          </div>
        </fieldset>
      </form> 
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){

    $('#access').click(function(){
      if ($('#accessLevel').val() == "1"){
        $('#accessLabel').text("Public");
        $('#accessLevel').val("0");
        $('#accessIcon').removeClass('fa-lock');
        $('#accessIcon').addClass('fa-unlock');
      } else {
        $('#accessLevel').val("1");
        $('#accessLabel').text("Private");
        $('#accessIcon').removeClass('fa-unlock');
        $('#accessIcon').addClass('fa-lock');
      }
    });
    var fldr = false;

    $('#folderName').change(function(){
      var foldername = $('#folderName').val();
      if (foldername == ""){
        $('#foldername_group').removeClass('has-error');
        $('#foldername_group').removeClass('has-success');
        $('#check-folder').hide();
        $('#help-warning-folder').hide();
        fldr = false;
      } else {
        $.ajax({
          type: 'POST',
          url: '/folder/folder/check',
          data: {'txtFolderName':foldername},
          success: function (result){
            console.log(result);
            if (result == "1"){
              $('#foldername_group').addClass('has-error');
              $('#foldername_group').removeClass('has-success');
              $('#check-folder').hide();
              $('#help-warning-folder').show();
              fldr = false;
            } else {
              $('#foldername_group').removeClass('has-error');
              $('#foldername_group').addClass('has-success');
              $('#check-folder').show();
              $('#help-warning-folder').hide();
              fldr = true;
            }
          }
        })
      }
    });

    $('#form').submit(function(e){
      if(!(fldr)){
        $('#folderName').focus();
        $('#foldername_group').addClass('has-error');
        $('#foldername_group').removeClass('has-success');
        e.preventDefault();
      } else{
        $('#foldername_group').removeClass('has-error');
      }
    });

  });
</script>
<!--end content-->