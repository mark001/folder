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
    <title>folder &middot; Password Reset.</title>


  </head>
  <body class="background_image noselect" id="main">
   <body class="background_image noselect" id="main">
    <div class="container">
        <div class="imageBanner">
            <img class="img-responsive" style="max-height:150px;"  src="<?php echo base_url(); ?>assets/img/banner2.png" draggable="false">
        </div>  
        <div class="container">
            <div class="row vdivide">
                <div class='col-sm-5 col-md-5'>
                  <form role="form" method="POST" action="<?php echo base_url("login"); ?>">   
                      <h3>Reset Password</h3>
                      <div id="email_group" class="form-group">
                        <label for="email">Email:</label>
                        <input name="txtEmail" type="email" class="form-control" id="email" placeholder="example@folder.com" value="">
                        <p id="help-warning-email" class="help-block" style="display:none">Email does not exist.</p>
                        <i id="check-email" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
                      </div>
                      <hr>
                      <i>A temporary password will be sent to your email. You may change it later in your profile options.</i>
                      <hr>
                       <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">RESET</button>
                           <center>
                            <p>I don't have an account yet. <a href="/folder/sign-up" style="color:#7eb8f8;">Sign Up.</a></p>
                            </center>
                           
                       </div>
                  </form>
                </div>
                <div class="col-sm-7 col-md-7">
                   <h1>Place your codes right. Right here, right now.</h1>
                   <h3>Organize your codes, without limits.</h3>
                </div>
            </div> 
               
         </div>
    </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script>
     $('#email').change(function(){
            var email = $('#email').val();
            $.ajax({
              type: "POST",
              url: "<?php echo base_url() ?>index.php/folder/check_user_email/" + encodeURIComponent(email),
              success: function (data){
                if (email == ""){
                  $('#email_group').removeClass("has-success");
                  $('#email_group').addClass("has-error");
                  $('#help-warning-email').css('display','none');
                  $('#check-email').css('display','none');
                  em = false;
                } else{
                  if (data == "1"){
                    $('#email_group').addClass("has-success");
                    $('#email_group').removeClass("has-error");
                    $('#help-warning-email').css('display','none');
                    $('#check-email').css('display','block');
                    em = true;
                  } else {
                    $('#email_group').addClass("has-error");
                    $('#email_group').removeClass("has-success");
                    $('#help-warning-email').css('display','block');
                    $('#check-email').css('display','none');
                    em = false;
                  }
                }
              }
            });
          });
      </script>
    </div>
  </body>
</html>