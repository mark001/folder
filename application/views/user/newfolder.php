<!--start content-->
<div class="container">
  <div class="content_container">
    <h1>New folder</h1>
      <form class="form-horizontal" role="form">
        <fieldset>
           <div class="form-group">
              <label for="folder_name" class="col-lg-2 control-label">Name</label>
              <div class="col-lg-10">
                <input class="form-control" id="folder_name" placeholder="folderName" type="text" name="txtFolderName" required>
              </div>
            </div>  
          <div class="form-group">
            <label class="col-lg-2 control-label">Access Level</label>
            <div class="col-lg-10">
              <div class="checkbox">
                <label>
                  <input id="public_radio" value="Public"  type="checkbox" name="chkAccess"> Private folder
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label">Type</label>
            <div class="col-lg-10">
              <?php $types = array ('Java', 'C#', 'HTML', 'PHP', 'JAVASCRIPT'); ?>
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
<!--end content-->