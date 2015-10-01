<!--start content-->
<div class="container">
  <?php if($this->session->flashdata('message') != ''){ ?>
    <div id="alert" class="alert alert-success fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <h4><?php echo $this->session->flashdata('message'); ?></h4>
    </div>
  <?php } ?>
  <div class="content_container">
      <div class="jumbotron">
          <p class="lead"> <img style="max-width:150px; margin-top: -45px;" src="<?php echo base_url(); ?>assets/img/banner2.png">. Organize your codes. Share your programming knowledge.</p>
      </div>

      <p class="lead">Do your folder thing, <i>now</i>.</p>

      <div class="container text-center">
        <a class="manage" href="/folder/folder/<?php echo $this->session->userdata('username');  ?>" title="Manage folders" alt="Manage folder"></a>
        <a class="add" href="/folder/folder/new" title="Create new folder" alt="New folder"></a>
        <a class="share" href="share_folders.php" title="Share folder" alt="Share folder"></a>   
      </div>  
  </div>
</div>
<script type="text/javascript">
    setTimeout(function(){
      $('#alert').fadeOut();
    }, 2000);
</script>
<!--end content-->