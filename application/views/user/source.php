<style>
  #right-pane{
      float:right;
      position: absolute;
  }

  #left-pane{
    float:left;
    position: absolute;
  }

</style>

<?php 
  $jsType = '';
  $myfile = 'C:\xampp\htdocs\folder\assets\hello.java';
  $handle = fopen($myfile, 'r');
  $data = fread($handle, filesize($myfile));
  $info = new SplFileInfo($myfile);
  $type = $info->getExtension();
  switch($type){
    case 'java': $jsType = 'shBrushJava';
           break;

    case 'Css' : $jsType = 'shBrushCss';
           break;

    case 'js' : $jsType = 'shBrushJScript';
          break;

    case 'php' : $jsType = 'shBrushPhp';
           break;

  }
  fclose($handle);
?>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/shCore.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/scripts/<?php echo $jsType?>.js"></script>
<script type="text/javascript">SyntaxHighlighter.all();</script>
<div class="container-fluid">
<!--left pane-->
<div class="col-xs-4 col-sm-4 col-md-3" id="left-pane">
  <h4> Folders</h4>

  <ul class="nav nav-sidebar">
    <li><a href="#" data-toggle="collapse" data-target="#folder1">Folder Name <span class="badge">4</span></a><li>
      <div id="folder1" class="collapse">
        <ul>
        <li><a href="#" data-toggle="collapse" data-target="#subfolder1">Subfolder 1 <span class="badge">5</span></a></li>
          <div id="subfolder1" class="collapse">
            <ul>
                <li><a href="#">fileOne.js</a></li>
                <li><a href="#">Subfolder 2</a></li>
                <li><a href="#">Subfolder 3</a></li>
                <li><a href="">anotherfile.js</a></li>
                <li><a href="">morefile.js</a></li>
            </ul>   
          </div>
        <li><a href="#">Subfolder 3</a></li>
        <li><a href="">anotherfile.js</a></li>
        <li><a href="">morefile.js</a></li>
           
    </div>
   <li><a href="#" data-toggle="collapse" data-target="#folder2">Folder Name <span class="badge">5</span></a><li>
      <div id="folder2" class="collapse">
      <ul>
        <li><a href="">Folder Name</a></li>
        <li><a href="">Sub Folder 2</a></li>
        <li><a href="">file.js</a></li>
        <li><a href="">anotherfile.js</a></li>
        <li><a href="">morefile.js</a></li>
      </ul>
    </div>
 </ul>
</div>

<!--main content-->
<div class="col-xs-6 col-xs-offset-4 col-sm-6 col-sm-offset-4 col-md-7 col-md-offset-3 main">
  <div class="content_container">
    <h1 class="page-header">Folder Name</h1>
    <h3 class="sub-header">File Name</h3>
      <div class="form-group">
          <div>
            <pre class="form-control brush: <?php echo $type; ?>;" rows="10">
              <?php 
                echo $data;
              ?>
            </pre>
          </div>
      </div>
  </div>
</div>
<!---end main content-->

<!--right sidebar-->
<div class="col-xs-2 col-xs-offset-10 col-sm-2 col-sm-offset-10 col-md-2 col-md-offset-10 " id="right-pane">
    <h4> Controls</h4>
    <ul class="nav nav-sidebar">
      <li><a href="#"><span class="fa fa-sitemap"></span> Create Branch</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-arrow-up"></span> Push</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-arrow-down"></span> Pull</a></li>
      <li><a href="#"><span class="fa fa-file-archive-o"></span> Download as ZIP</a></li>
  </div>
<!--end right sidebar-->
</div>
