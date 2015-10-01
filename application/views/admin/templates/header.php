<?php 
    header('Cache-Control: no-store, no-cache, must-revalidate'); 
    header('Cache-Control: post-check=0, pre-check=0', FALSE); 
    header('Pragma: no-cache'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/logo.png">

    <title>Folder &middot; <?php echo $title; ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/folder_custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom_animation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/dashboard.css" rel="stylesheet">
    
    <script src="<?php echo base_url(); ?>assets/js/ie-emulation-modes-warning.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
  
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/folder/administrator"><img src="<?php echo base_url(); ?>/assets/img/logo.png" width="25" height="25" align="left">&nbsp;&nbsp;&nbsp;&nbsp; Folder Admin</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username');  ?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/folder/administrator/accounts/edit/<?php echo $this->session->userdata('user_id'); ?>"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="/folder/logout"><i class="fa fa-sign-out"></i> Sign Out</a></li>                
              </ul>
            </li>
          </ul>
        </div>
    </nav>
    <div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li class="<?php echo @$header; ?>"><a href="/folder/administrator"><i class="fa fa-area-chart"></i> Overview</a></li>
        <li class="<?php echo @$report; ?>"><a href="/folder/administrator/reports"><i class="fa fa-bug"></i> Reports <span class="badge"><?php ?></span></a></li>  
      </ul>

      <h4>Accounts</h4>
      <ul class="nav nav-sidebar">
        <li class="<?php echo @$form; ?>"><a href="/folder/administrator/accounts/add"><i class="<?php echo @$icon==null?'fa fa-user-plus':$icon ?>"></i> <?php echo @$label==null?'Add User':$label ?></a></li>
        <li class="<?php echo @$manage_users; ?>"><a href="/folder/administrator/accounts/manage"><i class="fa fa-users"></i> Manage Users</a></li>
      </ul>

      <h4>Folders</h4>
      <ul class="nav nav-sidebar">
        <li class="<?php echo @$manage_folders; ?>"><a href="/folder/administrator/folders/manage"><i class="fa fa-folder"></i> Manage Folders</a></li>
      </ul>
    </div>
    <script type="text/javascript">
        /*window.setInterval(function(){
          $.get("<?php echo base_url(); ?>folder_admin/checkIfLogin", function(data){
          if (data != "true"){
              window.location.assign("<?php echo base_url(); ?>");
            }
          });
        }, 0);*/
    </script>