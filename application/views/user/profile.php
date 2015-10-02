
<script>
	function getFile(){
   		document.getElementById("upfile").click();
 	}

 	function sub(obj){
	    var file = obj.value;
	    var fileName = file.split("\\");
	    document.getElementById("upload").innerHTML = fileName[fileName.length-1];
	    document.myForm.submit();
	    event.preventDefault();
  	}

</script>
<style>
#right-align{
	text-align: right;
}
</style>
<div class="container">
	<div class="content_container">
		<h1>Profile</h1>
			<?php if($this->session->flashdata('message') != ''){ ?>
				<div id="alert" class="alert alert-success fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <h4><?php echo $this->session->flashdata('message'); ?></h4>
				</div>
			<?php } ?>
			<div class="container">
				<div class="col-sm-2 col-md-2">
					<label for="profile-image">
						<div id="image-cropper">
							<img class="profile noselect" id="prof" src="<?php echo base_url(); ?>assets/img/profile.png">
						</div>
					</label>
					<!--experimental upload
					<input id="profile-image" type="file" onchange="readURL(this);">	
					<script>
						function readURL(input){
							if(input.files && input.files[0]){
								var reader = new FileReader();
								reader.onload = function(e){
									$('#prof')
										.attr('src', e.target.result)
										.width(auto)
										.height(200);
								};
								reader.readAsDataURL(input.files[0]);
							}
						}
					</script>
					-->
				</div>
				<div class="col-sm-8 col-md-8">
					<form id="account" action="/folder/edit/profile/<?php echo $this->session->userdata('username') ?>"  method="POST" class="form-horizontal" role="form">
	                  <fieldset>
	                    <legend>Account Info</legend>
	                    <div id="right-align">
	                    	<a class="btn btn-default btn-sm" id="edit" data-toggle="collapse" data-target="#edit_submit"><i class="fa fa-edit"></i> Edit</a>
	                    </div>
	                    <div class="form-group">
	                      <label for="username" class="col-lg-2 control-label">Username</label>
	                      <div id="username_group" class="col-lg-10">
	                        <input type="text" class="form-control" id="username" name="txtUsername" placeholder="username" value="<?php echo $this->session->userdata('username') ?>" required readonly>
                       		<i id="check-user" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
	                        <p id="help-warning-username" class="help-block" style="display:none">Username already exist.</p>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label for="email" class="col-lg-2 control-label">Email</label>
	                     <div id="email_group" class="col-lg-10">
	                        <input type="text" class="form-control" id="email" name="txtEmail" placeholder="myname@folder.com" value="<?php echo $this->session->userdata('email') ?>" required readonly>
	                        <i id="check-email" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
	                        <p id="help-warning-email" class="help-block" style="display:none">Email already used.</p>
	                      </div>
	                    </div>
	                    <div class="collapse" id="edit_submit">
	                        <div class="form-group" >
			                    <div class="col-lg-10 col-lg-offset-2">
			                      <button type="submit" class="btn btn-primary" id="update_edit">Update</button>
			                      <a  class="btn btn-default" id="cancel_edit">Cancel</a>
			                    </div>
			                </div>
		            	</div>
	                  </fieldset>
	                </form>
	            <form id="security" action="/folder/change/password/<?php echo $this->session->userdata('username') ?>" method="POST" class="form-horizontal" role="form">
	              <fieldset>
	                <legend>Security</legend>
	                <div class="form-group">
	                  <label for="password" class="col-lg-2 control-label">Password</label>
	                  <div class="col-lg-10">
	                    <div id="right-align">
	                    	<a href="#" id="change_password" class="btn btn-default btn-sm" data-toggle="collapse" data-target="#pass"><i class="fa fa-edit"></i> Change Password</a>
	                   	</div>
	                   	<div class="collapse" id="pass">
	                   		<div class="container-fluid">
	                   			<div class="form-group">
			                    	<label for="currentPassword" class="col-lg-2 control-label">Current</label>
				                    <div id="currentpassword_group" class="col-lg-10">
				                    	<input type="password" class="form-control" id="currentPassword" name="txtCurrentPassword" value="<?php echo $this->session->userdata('password') ?>" readonly>
				                    </div>
			                    </div>
			                    <div class="form-group">
			                    	<label for="newPassword" class="col-lg-2 control-label">New</label>
				                    <div  id="newpassword_group" class="col-lg-10">
				                    	<input type="password" class="form-control" id="newPassword" name="txtNewPassword" required>
				                      	<i id="check-newpwd" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
				                    	<p id="help-warning-newpwd" class="help-block">Password must contain 8 or more characters!</p>
				                    </div>
			                    </div>
			                    <div class="form-group">
			                    	<label for="confirmPassword" class="col-lg-2 control-label">Confirm New</label>
			                    	<div id="confirmpassword_group" class="col-lg-10">
			                        	<input type="password" class="form-control" id="confirmPassword" name="txtConfirmPassword" required>
                        				<i id="check-conpwd" class="fa fa-check-circle" style="float:right; color:green; display:none;"></i>
			                        	<p id="help-warning-conpwd" class="help-block" style="display:none">Passwords does not matched!</p>
			                     	</div>
			                    </div>
			                    <div class="form-group">
				                    <div class="col-lg-10 col-lg-offset-2">
				                      <button type="submit" class="btn btn-primary">Change</button>
				                      <button type="reset" class="btn btn-default" id="cancel_change">Cancel</button>
				                    </div>
				                </div>
	                   		</div>
	                   	</div>
	                  </div>
	                </div>
	              </fieldset>
	            </form>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	var em = true;
	var un = true;
	var newpas = false;
	var con = false;

	$('#edit').click(function(){
		if ($('#username').attr('readonly')){
			$('#username').removeAttr('readonly');
			$('#email').removeAttr('readonly');
		} else {
			$('#username').val("<?php echo $this->session->userdata('username') ?>");
			$('#email').val("<?php echo $this->session->userdata('email') ?>");
			$('#username').attr('readonly','readonly');
			$('#email').attr('readonly','readonly');
			$('#username_group').removeClass("has-success");
			$('#username_group').removeClass("has-error");
			$('#help-warning-username').css('display','none');
			$('#check-user').css('display','none');
			$('#email_group').removeClass("has-success");
			$('#email_group').removeClass("has-error");
			$('#help-warning-email').css('display','none');
			$('#check-email').css('display','none');
			un = true;
			em = true;
		}
	});

	$('#change_password').click(function(){
		$('#currentPassword').val("<?php echo $this->session->userdata('password') ?>");
		$('#newPassword').val("");
		$('#confirmPassword').val("");
		$('#newpassword_group').removeClass('has-error');
		$('#newpassword_group').removeClass('has-success');
		$('#help-warning-newpwd').css('display', 'block');
		$('#check-newpwd').css('display', 'none');
		$('#confirmpassword_group').removeClass('has-success');
		$('#confirmpassword_group').removeClass('has-error');
		$('#help-warning-conpwd').css('display', 'none');
		$('#check-conpwd').css('display', 'none');
		newpas = false;
		con = false;
	});

	$('#cancel_edit').click(function(){
		$('#username').val("<?php echo $this->session->userdata('username') ?>");
		$('#email').val("<?php echo $this->session->userdata('email') ?>");
		$('#username_group').removeClass("has-success");
		$('#username_group').removeClass("has-error");
		$('#help-warning-username').css('display','none');
		$('#check-user').css('display','none');
		$('#email_group').removeClass("has-success");
      	$('#email_group').removeClass("has-error");
      	$('#help-warning-email').css('display','none');
      	$('#check-email').css('display','none');
      	un = true;
		em = true;
	});

	$('#cancel_change').click(function(){
		$('#currentPassword').val("<?php echo $this->session->userdata('password') ?>");
		$('#newPassword').val("");
		$('#confirmPassword').val("");
		$('#newpassword_group').removeClass('has-error');
		$('#newpassword_group').removeClass('has-success');
		$('#help-warning-newpwd').css('display', 'block');
		$('#check-newpwd').css('display', 'none');
		$('#confirmpassword_group').removeClass('has-success');
		$('#confirmpassword_group').removeClass('has-error');
		$('#help-warning-conpwd').css('display', 'none');
		$('#check-conpwd').css('display', 'none');
		newpas = false;
		con = false;
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
            } else if (email == "<?php echo $this->session->userdata('email') ?>"){
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
            } else if (username == "<?php echo $this->session->userdata('username') ?>"){ 
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

	$('#newPassword').change(function(){
        if ($('#newPassword').val().length < 8){
          $('#newpassword_group').addClass('has-error');
          $('#newpassword_group').removeClass('has-success');
          $('#help-warning-newpwd').css('display', 'block');
          $('#check-newpwd').css('display', 'none');
          newpas = false;
        } else {
          $('#newpassword_group').removeClass('has-error');
          $('#newpassword_group').addClass('has-success');
          $('#help-warning-newpwd').css('display', 'none');
          $('#check-newpwd').css('display', 'block');
          newpas = true;
        }
     });

	$('#confirmPassword').change(function(){
        if ($('#newPassword') == "" || $('#confirmPasswordd') == ""){
          $('#confirmpassword_group').removeClass('has-success');
          $('#confirmpassword_group').removeClass('has-error');
          $('#help-warning-conpwd').css('display', 'none');
          $('#check-conpwd').css('display', 'none');
          con = false;
        } else {
          if (($('#newPassword').val() == $('#confirmPassword').val())){
            $('#confirmpassword_group').addClass('has-success');
            $('#confirmpassword_group').removeClass('has-error');
            $('#help-warning-conpwd').css('display', 'none');
            $('#check-conpwd').css('display', 'block');
            con = true;
          } else {
            $('#confirmpassword_group').addClass('has-error');
            $('#confirmpassword_group').removeClass('has-success');
            $('#help-warning-conpwd').css('display', 'block');
            $('#check-conpwd').css('display', 'none');
            con = false;
          }
        }
      });

	$('#account').submit(function(e){
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
	});

	$('#security').submit(function(e){
		if (!(newpas)){
			$('#newPassword').focus();
			$('#password_group').addClass("has-error");
			e.preventDefault();
		} else {
		$('#newpassword_group').removeClass("has-error");
		}

		if (!(con)){
			$('#confirmPassword').focus();
			$('#confirmpassword_group').addClass("has-error");
			e.preventDefault();
		} else {
			$('#confirmpassword_group').removeClass("has-error");
		}
	});

	/*document.addEventListener('submit', function(e){
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

		if (!(newpas)){
			$('#newPassword').focus();
			$('#password_group').addClass("has-error");
			e.preventDefault();
		} else {
		$('#newpassword_group').removeClass("has-error");
		}

		if (!(con)){
			$('#confirmPassword').focus();
			$('#confirmpassword_group').addClass("has-error");
			e.preventDefault();
		} else {
			$('#confirmpassword_group').removeClass("has-error");
		}
	});*/
});
</script>