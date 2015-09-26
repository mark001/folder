<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/custom_animation.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/folder_custom.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/logo.png">
    <title>folder &middot; Organize your codes.</title>


  </head>
  <body class="background_image noselect" id="main">
    <div class="container">
        <div class="imageBanner">
            <img class="img-responsive" style="max-height:300px;"  src="<?php echo base_url(); ?>assets/img/banner2.png" draggable="false">
        </div>  
        <div class="container">
            <div class="row vdivide">
                <div class='col-sm-5 col-md-5'>
                  <form role="form" method="POST" action="logging-in">   
                      <?php 
                      if($this->session->flashdata("message")  != ''){ 
                        if (strpos($this->session->flashdata("message"), "incorrect") != 0) { 
                      ?>
	                      <div class="has-error">
	                      	<h4 class="help-block" align="center">
		                      	<?php echo $this->session->flashdata("message"); ?>
	                      	 </h4>
	                      </div>
                      <?php
                        } else { ?>
                        <div class="has-success">
                          <h4 class="help-block" align="center">
                            <?php echo $this->session->flashdata("message"); ?>
                           </h4>
                        </div>
                      <?php
                        }
                      } 
                      ?>
                      <div id="username_group" class="form-group">
                        <label for="username">Username or Email:</label>
                        <input name="txtUsername" type="text" class="form-control" id="username" placeholder="username"value="">
                      </div>

                     <div id="password_group" class="form-group">
                        <label for="pwd">Password:</label>
                        <input name="txtPassword" type="password" class="form-control" id="pwd" placeholder="Password" value="">
                      </div>

                       <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">LOG IN</button>
                           <center>
                              <p><a href="password/reset" style="color:#7eb8f8;">Forgot password?</a></p>
                            <p>I don't have an account yet. <a href="sign-up" style="color:#7eb8f8;">Sign Up.</a></p>
                            </center>
                           
                       </div>
                  </form>
                </div>
                <div class="col-sm-7 col-md-7">
                   <h1>Place your codes right. Right here, right now.</h1>
                   <h3>Organize your codes, without limits.</li>
                       </ul>
                   </h3>
                </div>
            </div> 
               
         </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      document.addEventListener('submit', function(e){
          if ($('#username').val() == ""){
            $('#username').focus();
            $('#username_group').addClass("has-error");
            e.preventDefault();
          } else {
            $('#username_group').removeClass("has-error");
          }

          if ($('#pwd').val() == ""){
            $('#password_group').addClass("has-error");
            e.preventDefault();
          } else {
            $('#password_group').removeClass("has-error");
          }
        });
      </script>
  </div>
  </body>
</html>