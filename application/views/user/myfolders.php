<!--start content-->
<div class="container">
  <?php if($this->session->flashdata('message') != ''){ ?>
    <div id="alert" class="alert alert-success fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <h4><?php echo $this->session->flashdata('message'); ?></h4>
    </div>
  <?php } ?>
  <div class="content_container">
    <h1>My folders</h1>
    <?php if (empty($folders)) { ?>
      <div class="alert alert-info">
        <h4>You have not yet created a folder! <a id="link" href="" style="color:black">(<i class="fa fa-refresh"></i> refresh)</a></h4>
      </div>
    <?php } else { ?>
      <table class="table table-striped table-hover ">
        <thead>
          <tr>
            <th>#</th>
            <th>Folder Name</th>
            <th>Project Type</th>
            <th>Last Update</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <?php 
            $count = 1;
            foreach($folders as $folder){
          ?>
            <tr>
              <td class="clickable-row" data-href="/folder/folder/<?php echo $this->session->userdata['username'] ?>/<?php echo $folder['folder_name'] ?>"><?php echo $count; ?></td>
              <td class="clickable-row" data-href="/folder/folder/<?php echo $this->session->userdata['username'] ?>/<?php echo $folder['folder_name'] ?>"><?php echo $folder['folder_name'] ?></td>
              <td class="clickable-row" data-href="/folder/folder/<?php echo $this->session->userdata['username'] ?>/<?php echo $folder['folder_name'] ?>"><?php echo $folder['folder_type'] ?></td>
              <td class="clickable-row" data-href="/folder/folder/<?php echo $this->session->userdata['username'] ?>/<?php echo $folder['folder_name'] ?>">
                <?php
                  echo date_format(date_create($folder['folder_update']), 'm/d/Y g:ia');
                ?>
              </td>
              <td>
                <a href="/folder/folder/<?php echo $folder['folder_name'] ?>/push" style="text-decoration:none;" title="Upload folder"><i class="fa fa-upload"></i> Push</a>&nbsp;&nbsp;
                <a href="#" style="text-decoration:none;" title="Dowload folder"><i class="fa fa-download"></i> Pull</a> &nbsp;&nbsp;
                <a href="/folder/folder/access/change/<?php echo $folder['folder_name'] ?>" style="text-decoration:none;" title=""><?php if ($folder['folder_access']=="1") { ?><i class="fa fa-lock"></i> Private<?php } else { ?><i class="fa fa-unlock"></i> Public<?php } ?> &nbsp;&nbsp;
                <a href="#" data-toggle="modal" data-target=".<?php echo str_replace(' ', '', $folder['folder_name']); ?>delete" style="text-decoration:none;" title="Delete folder"><i class="fa fa-trash"></i> Delete folder</a> &nbsp;&nbsp;
                <!-- Modal Warning <DELETE> -->
                    <div class="<?php echo str_replace(' ', '', $folder['folder_name']); ?>delete modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Folder</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong><?php echo $folder['folder_name']; ?></strong>?</p>
                                <h6 class="help-block alert alert-danger">Deleting the folder will result to removing all of the folder's branches and files.</h6>
                            </div>
                            <div class="modal-footer">
                              <a href="/folder/folder/delete/<?php echo $folder['folder_name']; ?>" class="btn btn-danger" role="button">Delete</a>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- Modal Warning <DELETE> -->
                  <!-- end of delete -->
              </td>
            </tr>
          <?php 
            $count++;
          } 
          ?>
        </tbody>
     </table>
    <?php } ?>
  </div>
</div>
<!--end content>