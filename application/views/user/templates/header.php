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
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/folder_custom.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/logo.png">
    <link href="<?php echo base_url(); ?>assets/css/dashboard.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/shCoreEclipse.css"/>
    <script src="<?php echo base_url(); ?>assets/js/customjs_folder.js"></script>
    
    <title>folder &middot; Organize your codes.</title>
  </head>
  <body>  
    <div id="wrapper">
       <div id="header">   
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" rel="home" href="/folder/home" title="folder">
                <img style="max-width:100px; margin-top: -9px;" src="<?php echo base_url(); ?>assets/img/banner2.png">
               </a>         
            </div>

            <div class="collapse navbar-collapse" id="navbar">
              <ul class="nav navbar-nav">
                <li class=""><a href="/folder/folder/<?php echo $this->session->userdata('username');  ?>"><i class="fa fa-th-list"></i> My folders<span class="sr-only">(current)</span></a></li>
                <li><a href="/folder/folder/new"><i class="fa fa-plus"></i> New folder</a></li>
                 <li><a href="/folder/folder/others"><i class="fa fa-list-alt"></i> Other Folders</a></li>            
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username');  ?> &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="/folder/profile/<?php echo $this->session->userdata('username'); ?>"><i class="fa fa-user"></i> Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="/folder/feedback"><i class="fa fa-comment"></i> Feedback</a></li>
                    <li><a href="/folder/logout"><i class="fa fa-sign-out"></i> Sign Out</a></li>                
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
      <div id="content_body">