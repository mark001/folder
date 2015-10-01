<!-- start of content -->
<div id="main" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Reports</h1>
  <?php if (empty($reports)) { ?>
    <div class="alert alert-info">
      <h4>There are no recent report! <a id="link" href="" style="color:black">(<i class="fa fa-refresh"></i> refresh)</a></h4>
    </div>
  <?php } else { ?>
    <?php foreach($reports as $report) { ?>
    <form class="form-horizontal" role="form">
      <input id="<?php echo $report['report_id'] ?>" type="hidden" value="<?php echo $report['report_id'] ?>">
      <fieldset>
        <div class="subcontent_container">
          <div class="form-group">
            <label for="datePosted" class="col-lg-2 control-label">Date posted</label>
            <div class="col-lg-3">
              <input class="form-control" id="datePosted" type="text" value="<?php echo date_format(date_create($report['report_date']), 'm/d/Y g:ia'); ?>" readonly>
            </div>
            <label for="intensity" class="col-lg-2 control-label">Intensity</label>
            <div class="col-lg-5">
              <input class="form-control" id="intensity" type="text" value="<?php echo $report['report_intensity'] ?>" readonly>
            </div>
          </div>
       
          <div class="form-group">
            <label for="details" class="col-lg-2 control-label">Details</label>
            <div class="col-lg-10">
              <textarea class="form-control" rows="3" id="details" style="resize:vertical;" readonly><?php echo $report['report_details'] ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="screenshot" class="col-lg-2 control-label">Screenshot</label>
            <div class="col-lg-10">
              <?php $src= str_replace('C:/xampp/htdocs/folder/', base_url() , $report['screenshot']) ?>
              <img src="<?php echo $src; ?>" width="150" height="150">
            </div>
          </div>
          <div class="form-group">
            <div class="container-fluid text-right">
              <h4>
                <div class="checkbox">
                  <label>
                    <input name="" id="asRead" value="Public"  type="checkbox"> Mark as read
                  </label>
                </div>
              </h4>
            </div>
          </div>
      </fieldset>
    </form> <br/>
  <?php
    } 
  } 
  ?>
</div>
<script type="text/javascript">
  /*$('#asRead').change(function(){
          $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>index.php/folder_admin/read/" + username,
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
    });*/
</script>
<!-- end of content -->