<!--start content-->
<div class="container">
  <div class="content_container">
      <h1><?php echo $folder['folder_name'] ?> &middot; Push</h1>
      <form  action="<?php echo base_url('folder_user/upload/'.$folder['folder_name']) ?>" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
        <fieldset>
          <div class="form-group">
            <label for="branch" class="col-lg-2 control-label">Branches</label>
              <div class="col-lg-10">
                <select name="optBranch" id="branch" class="form-control">
                  <?php foreach($branches as $branch) { ?>
                    <option value="<?php echo $branch['branch_name'] ?>"><?php echo $branch['branch_name'] ?></option>
                  <?php } ?>
                </select>
              </div>
          </div>
          <div class="form-group">
            <label for="files" class="col-lg-2 control-label">Locate folder</label>
            <div class="col-lg-10">
              <input type="file" class="form-control" id="files" name="files[]" multiple="" webkitdirectory="">
              <div style="display:none" id="filelist"></div>
            </div>
          </div>
          <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Commit Message</label>
           <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="textArea" name="txtCommitMessage" placeholder="Provide pushed file update message."></textarea>
            </div>
          </div>
          <div class="form-group" >
            <div class="col-lg-10 col-lg-offset-2">
              <button id="submit" type="button" class="btn btn-primary" id="update_edit">Push</button>
              <a  href="/folder/folder/<?php echo $this->session->userdata['username'] ?>" class="btn btn-default" id="cancel_edit">Cancel</a>
            </div>
          </div>
        </fieldset>
      </form>
  </div>
</div>
<script type="text/javascript">
var output = document.getElementById('filelist');
  var filelist;

$(document).ready(function(){
  $('#files').change(function(e){
    $('#filelist').text("");
    filelist = e.target.files;

    if (filelist[0] != null){
      $('#filelist').show();
      for (var i in e.target.files)
        if (filelist[i].webkitRelativePath != null)
          output.innerText  = output.innerText + filelist[i].webkitRelativePath + "\n";
    } else {
      $('#filelist').hide();
    }
  });
  $('#submit').click(function(){
    uploadFiles(filelist);
    $
  });
});

function uploadFiles(files){

  // Create a new HTTP requests, Form data item (data we will send to the server) and an empty string for the file paths.
  xhr = new XMLHttpRequest();
  data = new FormData();
  paths = "";
  
  // Set how to handle the response text from the server
  xhr.onreadystatechange = function(ev){
    console.debug(xhr.responseText);
  };
  
  // Loop through the file list
  for (var i in files){
    // Append the current file path to the paths variable (delimited by tripple hash signs - ###)
    paths += files[i].webkitRelativePath+"###";
    // Append current file to our FormData with the index of i
    data.append(i, files[i]);
  };
  // Append the paths variable to our FormData to be sent to the server
  // Currently, As far as I know, HTTP requests do not natively carry the path data
  // So we must add it to the request manually.
  data.append('paths', paths);
  data.append('branch', document.getElementById('branch').value);
  data.append('commit_message', document.getElementById('textArea').value);

  xhr.open('POST', "/folder/push/<?php echo $folder['folder_name'] ?>", true);
  xhr.send(this.data);
}
</script>
<!--end content>