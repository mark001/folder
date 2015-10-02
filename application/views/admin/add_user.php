<!-- start of content -->
<div id="main" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header"><?php echo $title; ?></h1>
  <div class='col-sm-5 col-md-5'>
   <form id="form" role="form" method="POST" action="<?php if(!empty($user)) {echo "/folder/administrator/accounts/update/".$user['username'];} 
   else { echo "/folder/administrator/accounts/create"; } ?>">
    <input id="username_hidden" type="hidden" value="<?php echo $user['username'] ?>">
    <input id="email_hidden" type="hidden" value="<?php echo $user['email'] ?>">
    <div id="username_group" class="form-group">
      <label for="username">Username:</label>
      <input name="txtUsername" type="text" class="form-control" id="username" placeholder="username"value="<?php echo $user['username'] ?>">
      <i id="check-user" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
      <p id="help-warning-username" class="help-block" style="display:none">Username already exist.</p>
    </div>

    <div id="email_group" class="form-group">
      <label for="email">Email:</label>
      <input name="txtEmail" type="email" class="form-control" id="email" placeholder="example@folder.com" value="<?php echo $user['email'] ?>">
      <i id="check-email" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
      <p id="help-warning-email" class="help-block" style="display:none">Email already used.</p>
    </div>

    <div id="password_group" class="form-group">
      <label for="pwd">Password:</label>
      <input name="txtPassword" type="password" class="form-control" id="pwd" placeholder="Password" value="<?php echo $user['password'] ?>">
      <i id="check-pwd" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
      <p id="help-warning-pwd" class="help-block">Password must contain 8 or more characters!</p>
    </div>

    <div id="confirmpassword_group" class="form-group">
      <label for="pwdcon">Confirm Password:</label>
      <input name="txtConfirmPassword" type="password" class="form-control" id="pwdcon" placeholder="Confirm Password" value="<?php echo $user['password'] ?>">
      <i id="check-pwdcon" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
      <p id="help-warning-pwdcon" class="help-block" style="display:none">Passwords does not matched!</p>
    </div>

    <div id="usertype_group" class="form-group">
      <?php 
        $usertypes = array('administrator', 'client');
        $usertype = null;
        if ($user['user_type'] != null) 
            $usertype = $user['user_type']=='1'?'administrator':'client';
      ?>
      <label for="usertype">User Type:</label>
      <select name="cboUserType" id="usertype" class="form-control">
        <?php foreach($usertypes as $value) { ?>
          <option <?php echo $value==$usertype?'selected':''; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
        <?php } ?>
      </select>
    </div>

     <div class="form-group">
          <button type="submit" class="btn btn-primary"><?php echo $btn; ?></button>
          <?php if (isset($user)){ ?><button id="cancel" type="button" class="btn btn-default">Cancel</button><?php } ?>
     </div> 
    </form>
    <script type="text/javascript">
      var un = false;
      var em = false;
      var pas = false;
      var con = false; 

      $(document).ready(function(){
        if ($('#username').val() != "" || $('#email').val() != "" && $('#pwd').val() != "" || $('#pwdcon').val() != ""){
          un = true;
          em = true;
          pas = true;
          con = true;
        }

        $('#pwd').change(function(){
          if ($('#pwd').val().length < 8){
            $('#password_group').addClass('has-error');
            $('#password_group').removeClass('has-success');
            $('#help-warning-pwd').css('display', 'block');
            $('#check-pwd').css('display', 'none');
            pas = false;
          } else {
            $('#password_group').removeClass('has-error');
            $('#password_group').addClass('has-success');
            $('#help-warning-pwd').css('display', 'none');
            $('#check-pwd').css('display', 'block');
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
            url: "/folder/check/email/" + encodeURIComponent(email),
            success: function (data){
              if (email == ""){
                $('#email_group').removeClass("has-success");
                $('#email_group').removeClass("has-error");
                $('#help-warning-email').css('display','none');
                $('#check-email').css('display','none');
                em = false;
              } else if (email == $('#email_hidden').val()){
                $('#email_group').removeClass("has-success");
                $('#email_group').removeClass("has-error");
                $('#help-warning-email').css('display','none');
                $('#check-email').css('display','none');
                em = true;
              } else {
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
            url: "/folder/check/username/" + username,
            success: function (data){
              if (username == ""){
                $('#username_group').removeClass("has-success");
                $('#username_group').removeClass("has-error");
                $('#help-warning-username').css('display','none');
                $('#check-user').css('display','none');
                un = false;
              } else if (username == $('#username_hidden').val()){
                $('#username_group').removeClass("has-success");
                $('#username_group').removeClass("has-error");
                $('#help-warning-username').css('display','none');
                $('#check-user').css('display','none');
                un = true;
              } else {
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
<!-- end of content -->