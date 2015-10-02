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
            <tr class="clickable-row" data-href="<?php echo base_url("home"); ?>">
              <td><?php echo $count; ?></td>
              <td><?php echo $folder['folder_name'] ?></td>
              <td><?php echo $folder['folder_type'] ?></td>
              <td>
                <?php
                  echo date_format(date_create($folder['folder_update']), 'm/d/Y g:ia');
                ?>
              </td>
              <td>
                <a href="#" style="text-decoration:none;" title="Upload folder"><i class="fa fa-upload"></i> Push</a>&nbsp;&nbsp;
                <a href="#" style="text-decoration:none;" title="Dowload folder"><i class="fa fa-download"></i> Pull</a>
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