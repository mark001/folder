<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/folder_custom.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/css/custom_animation.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/logo.png">
    <title>folder &middot; Sign Up.</title>
  </head>
  <body class="background_image noselect" id='main'>
    <div class="container">
        <div class="imageBanner">
          <img class="img-responsive" style="max-height:150px;" src="<?php echo base_url(); ?>assets/img/banner2.png" draggable="false">
        </div>  
        <div class="container">
            <div class="row vdivide">
                <div class='col-sm-5 col-md-5'>
                  <h3>Create your free folder account now.</h3>
                     <form role="form" method="POST" action="/folder/signing-up">
                       <div id="username_group" class="form-group">
                        <label for="username">Username:</label>
                        <input name="txtUsername" type="text" class="form-control" id="username" placeholder="username"value="">
                        <p id="help-warning-username" class="help-block" style="display:none">Username already exist.</p>
                        <i id="check-user" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
                      </div>

                       <div id="email_group" class="form-group">
                        <label for="email">Email:</label>
                        <input name="txtEmail" type="email" class="form-control" id="email" placeholder="example@folder.com" value="">
                        <p id="help-warning-email" class="help-block" style="display:none">Email already used.</p>
                        <i id="check-email" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
                      </div>

                      <div id="password_group" class="form-group">
                        <label for="pwd">Password:</label>
                        <input name="txtPassword" type="password" class="form-control" id="pwd" placeholder="Password" value="">
                        <p id="help-warning-pwd" class="help-block">Password must contain 8 or more characters!</p>
                        <i id="check-pwd" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
                      </div>

                      <div id="confirmpassword_group" class="form-group">
                        <label for="pwdcon">Confirm Password:</label>
                        <input name="txtConfirmPassword" type="password" class="form-control" id="pwdcon" placeholder="Confirm Password" value="">
                        <p id="help-warning-pwdcon" class="help-block" style="display:none">Passwords does not matched!</p>
                        <i id="check-pwdcon" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
                      </div>

                      <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">SIGN UP</button>
                           <center>I already have an account. <a href="login" style="color:#7eb8f8;">Log In.</a></center>
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
        var un = false;
        var em = false;
        var pas = false;
        var con = false; 

        $(document).ready(function(){

          $('#pwd').change(function(){
            if ($('#pwd').val().length < 8){
              $('#password_group').addClass('has-error');
              $('#password_group').removeClass('has-success');
              pas = false;
            } else {
              $('#password_group').removeClass('has-error');
              $('#password_group').addClass('has-success');
              pas = true;
            }
          });

          $('#pwdcon').change(function(){
            if ($('#pwd') == "" || $('#pwdcon') == ""){
              $('#confirmpassword_group').removeClass('has-success');
              $('#confirmpassword_group').removeClass('has-error');
              $('#help-warning-pwdcon').css('display', 'none');
              $('#check-pwdcon').css('display', 'none');
              con = false;
            } else {
              if (($('#pwd').val() == $('#pwdcon').val())){
                $('#confirmpassword_group').addClass('has-success');
                $('#confirmpassword_group').removeClass('has-error');
                $('#help-warning-pwdcon').css('display', 'none');
                $('#check-pwdcon').css('display', 'block');
                con = true;
              } else {
                $('#confirmpassword_group').addClass('has-error');
                $('#confirmpassword_group').removeClass('has-success');
                $('#help-warning-pwdcon').css('display', 'block');
                $('#check-pwdcon').css('display', 'none');
                con = false;
              }
            }
          });

          $('#email').change(function(){
            var email = $('#email').val();
            $.ajax({
              type: "POST",
              url: "<?php echo base_url() ?>index.php/folder/check_user_email/" + encodeURIComponent(email),
              success: function (data){
                if (email == ""){
                  $('#email_group').removeClass("has-success");
                  $('#email_group').removeClass("has-error");
                  $('#help-warning-email').css('display','none');
                  $('#check-email').css('display','none');
                  em = false;
                } else{
                  if (data == "1"){
                    $('#email_group').removeClass("has-success");
                    $('#email_group').addClass("has-error");
                    $('#help-warning-email').css('display','block');
                    $('#check-email').css('display','none');
                    em = false;
                  } else {
                    $('#email_group').removeClass("has-error");
                    $('#email_group').addClass("has-success");
                    $('#help-warning-email').css('display','none');
                    $('#check-email').css('display','block');
                    em = true;
                  }
                }
              }
            });
          });

          $('#username').change(function(){
            var username = $("#username").val();
            $.ajax({
              type: "POST",
              url: "<?php echo base_url() ?>index.php/folder/check_user_username/" + username,
              success: function (data){
                if (username == ""){
                  $('#username_group').removeClass("has-success");
                  $('#username_group').removeClass("has-error");
                  $('#help-warning-username').css('display','none');
                  $('#check-user').css('display','none');
                  un = false;
                } else{
                  if (data == "1"){
                    $('#username_group').removeClass("has-success");
                    $('#username_group').addClass("has-error");
                    $('#help-warning-username').css('display','block');
                    $('#check-user').css('display','none');
                    un = false;
                  } else {
                    $('#username_group').removeClass("has-error");
                    $('#username_group').addClass("has-success");
                    $('#help-warning-username').css('display','none');
                    $('#check-user').css('display','block');
                    un = true;
                  }
                }
              }
            });
        });
      });

      document.addEventListener('submit', function(e){
          if (!(un)){
            $('#username').focus();
            $('#username_group').addClass("has-error");
            e.preventDefault();
          } else {
            $('#username_group').removeClass("has-error");
          }

          if (!(em)){
            $('#email').focus();
            $('#email_group').addClass("has-error");
            e.preventDefault();
          } else {
            $('#email_group').removeClass("has-error");
          }

          if (!(pas)){
            $('#pwd').focus();
            $('#password_group').addClass("has-error");
            e.preventDefault();
          } else {
            $('#password_group').removeClass("has-error");
          }

          if (!(con)){
            $('#pwdcon').focus();
            $('#confirmpassword_group').addClass("has-error");
            e.preventDefault();
          } else {
            $('#confirmpassword_group').removeClass("has-error");
          }
        });
      </script>
  </div>
</div>
  </body>
  </html>