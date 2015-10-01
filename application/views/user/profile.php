
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
					<form class="form-horizontal" role="form">
	                  <fieldset>
	                    <legend>Account Info</legend>
	                    <div id="right-align">
	                    	<a class="btn btn-default btn-sm" id="edit" data-toggle="collapse" data-target="#edit_submit"><i class="fa fa-edit"></i> Edit</a>

	                    </div>
	                    <div class="form-group">
	                      <label for="username" class="col-lg-2 control-label">Username</label>
	                      <div class="col-lg-10">
	                        <input type="text" class="form-control" id="username" name="txtUsername" placeholder="username" value="<?php echo $user['username']; ?>" required readonly>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label for="email" class="col-lg-2 control-label">Email</label>
	                     <div class="col-lg-10">
	                        <input type="text" class="form-control" id="email" name="txtEmail" placeholder="myname@folder.com" value="<?php echo $user['email']; ?>" required readonly>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label for="fname" class="col-lg-2 control-label">First Name</label>
	                      <div class="col-lg-10">
	                        <input type="text" class="form-control" id="fname" name="txtFname" placeholder="Myna" required readonly>
	                      </div>
	                    </div>
	                     <div class="form-group">
	                      <label for="lname" class="col-lg-2 control-label">Last Name</label>
	                      <div class="col-lg-10">
	                        <input type="text" class="form-control" id="lname" name="txtLname" placeholder="Mefolder" required readonly>
	                      </div>
	                    </div>
	                    <div class="collapse" id="edit_submit">
	                        <div class="form-group" >
			                    <div class="col-lg-10 col-lg-offset-2">
			                      <button type="submit" class="btn btn-primary">Update</button>
			                      <a  class="btn btn-default" id="cancel_edit" data-toggle="collapse" data-target="cancel_edit">Cancel</a>
			                    </div>
			                </div>
		            	</div>
	                  </fieldset>
	                </form>
	                <form class="form-horizontal" role="form">
	                  <fieldset>
	                    <legend>Security</legend>
	                    
	                    <div class="form-group">
	                      <label for="password" class="col-lg-2 control-label">Password</label>
	                      <div class="col-lg-10">
		                    <div id="right-align">
		                    	<a href="#" class="btn btn-default btn-sm" href="#" data-toggle="collapse" data-target="#pass"><i class="fa fa-edit"></i> Change Password</a>
		                   	</div>
		                   	<div class="collapse" id="pass">
		                   		<div class="container-fluid">
		                   		<form class="form-horizontal" role="form">
		                   			<div class="form-group">
				                      <label for="currentPassword" class="col-lg-2 control-label">Current</label>
				                     <div class="col-lg-10">
				                        <input type="password" class="form-control" id="currentPassword" name="pwdCurrentPassword" value="<?php echo $user['password']; ?>" required>
				                      </div>
				                    </div>
				                    <div class="form-group">
				                      <label for="newPassword" class="col-lg-2 control-label">New</label>
				                     <div class="col-lg-10">
				                        <input type="password" class="form-control" id="newPassowrd" name="pwdNewPassword" value="<?php echo $user['password']; ?>" required>
				                      </div>
				                    </div>
				                    <div class="form-group">
				                      <label for="confirmPassword" class="col-lg-2 control-label">Confirm New</label>
				                     <div class="col-lg-10">
				                        <input type="password" class="form-control" id="confirmPassowrd" name="pwdConfirmPassword" required>
				                      </div>
				                    </div>
				                    <div class="form-group">
					                    <div class="col-lg-10 col-lg-offset-2">
					                      <button type="submit" class="btn btn-primary">Change</button>
					                      <button type="reset" class="btn btn-default">Cancel</button>
					                    </div>
					                </div>
		                   		</form>
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


document.getElementById('edit').onclick = function(){
	document.getElementById('username').removeAttribute('readonly');
	document.getElementById('email').removeAttribute('readonly');
	document.getElementById('fname').removeAttribute('readonly');	
	document.getElementById('lname').removeAttribute('readonly');
	if (document.getElementById('edit_submit').style.display != 'block'){
		document.getElementById('edit_submit').style.display = 'block';
	}
	else{
		document.getElementById('edit_submit').style.display = 'none';
	}
};
document.getElementById('cancel_edit').onclick = function(){	
	document.getElementById('username').setAttribute('readonly','readonly');
	document.getElementById('email').setAttribute('readonly','readonly');
	document.getElementById('fname').setAttribute('readonly','readonly');	
	document.getElementById('lname').setAttribute('readonly','readonly');
	document.getElementById('edit_submit').style.display = 'none';
};
</script>