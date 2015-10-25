<!--start content-->
<div class="container">
  <div class="content_container">
     <h1>Feedback</h1>
        <p class="lead">Encountered bugs, or anything unusual? Please let the developers know.</p>
        
        <div class="row">
          <div class="container-fluid">
             <ul class="nav nav-tabs">
                <li class="active"><a aria-expanded="false" href="feedback.php#problem" data-toggle="tab">Problem</a></li>
                <li class=""><a aria-expanded="flase" href="feedback.php#suggestion" data-toggle="tab">Suggestion</a></li>  
             </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="problem">
                <form action="reporting" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">                   <fieldset>
                    <legend>Problem</legend>
                    <input type="hidden" name="reportType" value="1">
                    <div class="form-group">
                      <label for="select" class="col-lg-2 control-label">Intensity</label>
                      <div class="col-lg-10">
                        <?php $intensity = array(1, 2, 3, 4, 5); ?>
                        <select class="form-control" id="select" name="cboIntensity">
                          <?php foreach($intensity as $value) { ?>
                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                          <?php } ?>
                        </select>
                         <span class="help-block">5 as Highest impact, 1 as Lowest impact.</span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="textArea" class="col-lg-2 control-label">Details*</label>
                      <div class="col-lg-10">
                        <textarea class="form-control" rows="3" id="textArea" name="txtDetails" required></textarea>
                        <span class="help-block">Please provide as much details as possible from the encountered problem. <i>*required field</i></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="textArea" class="col-lg-2 control-label">Screenshot</label>
                      <div class="col-lg-10">
                        <span class="help-block">You may provide a screenshot to understand better the problem.</span>
                        <div class="col-sm-2 col-md-2">
                            <label for="feedback">
                              <div id="image-cropper-square">
                                <img class="profile noselect" name="imgScreenShot" id="feedbackImg" src="<?php echo base_url(); ?>assets/img/placeholder.png">
                              </div>
                            </label>
                            <input id="feedback" type="file" name="imgScreenShot"  accept ="image/**" onchange="readURLFeedback(this);">  
                            
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" id="cancel" class="btn btn-default">Cancel</button>
                      </div>
                    </div>
                  </fieldset>
                </form>
            </div>
            <div class="tab-pane fade" id="suggestion">
              <form action="reporting" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
                <fieldset>
                  <legend>Suggestion</legend>
                  <input type="hidden" name="reportType" value="2">
                  <p>We would love to hear your suggestion.</p>
                  <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Details</label>
                    <div class="col-lg-10">
                      <textarea class="form-control" rows="3" id="textArea" name="txtDetails"></textarea>
                      <span class="help-block">Tell us what you think about <img style="max-width:30px; margin-top:-5px;" src="<?php echo base_url(); ?>assets/img/banner2.png">. And what you can do more for it.</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Concept</label>
                    <div class="col-lg-10">
                      <span class="help-block">You may provide your concept image.</span>
                      <label for="suggest">
                        <div id="image-cropper-square">
                          <img class="profile noselect" name="imgScreenShot" id="suggestImg" src="<?php echo base_url(); ?>assets/img/placeholder.png">
                        </div>
                      </label>
                      <input type="file" id="suggest" name="imgScreenShot" accept="image/*" onchange="readURLSuggest(this);">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="reset" id="cancel" class="btn btn-default">Cancel</button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
        </div>
  </div>
</div>
<script>
  function readURLFeedback(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#feedbackImg')
          .attr('src', e.target.result)
          .width(auto)
          .height(200);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
    function readURLSuggest(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#suggestImg')
          .attr('src', e.target.result)
          .width(auto)
          .height(200);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  $('#cancel').click(function(){
    location.reload('true');
  });
</script>
<!--end content-->
