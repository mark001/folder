<!-- start of content -->
<div id="main" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Manage Folders</h1>
  <?php if (empty($folders)) { ?>
	  <div class="alert alert-info">
	    <h4>There are no folder data in the database! <a id="link" href="" style="color:black">(<i class="fa fa-refresh"></i> refresh)</a></h4>
	  </div>
  <?php } else { ?>
      <table class="table table-striped table-hover ">
        <thead>
          <tr>
            <th>Folder Name</th>
            <th>Folder Author</th>
            <th>Access Level</th>
            <th>Project Type</th>
            <th>Last Update</th>
            <th></th>
           
          </tr>
        </thead>

        <tbody>
          <?php foreach($folders as $folder){ ?>
            <tr class="clickable-row" data-href="">
              <td><?php echo $folder['folder_name'] ?></td>
              <td><?php echo $this->user_model->getUserByUserID($folder['user_id'])['username'] ?></td>
              <td><?php if ($folder['folder_access']=='1'){ echo "Private"; } else if ($folder['folder_access']=='2'){ echo "Public";} else { echo "error"; }  ?></td>
              <td><?php echo $folder['folder_type'] ?></td>
              <td>
                <?php
                  echo date_format(date_create($folder['folder_update']), 'm/d/Y g:ia');
                ?>
              </td>
              <td>
                <!--<a href="#" style="text-decoration:none;" title="Upload folder"><i class="fa fa-upload"></i> Push</a>&nbsp;&nbsp;
                <a href="#" style="text-decoration:none;" title="Dowload folder"><i class="fa fa-download"></i> Pull</a>-->
              </td>
            </tr>
          <?php } ?>
        </tbody>
     </table>
    <?php } ?>
</div>
<!-- end of content -->