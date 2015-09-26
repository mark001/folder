<div class="col-sm-4 col-md-3 sidebar">
  <h4> Folders</h4>
  <ul class="nav nav-sidebar navbar-collapse">
    <li class="active"><a href="#">Folder Name</a></li>
    <li><a href="#" class="" >Folder 1</a></i>
    <li><a href="#">Subfolder 1</a></li>
    <li><a href="#">fileOne.js</a></li>
    <li><a href="#">Subfolder 2</a></li>
    <li><a href="#">Subfolder 3</a></li>
    <li><a href="">anotherfile.js</a></li>
    <li><a href="">morefile.js</a></li>
  </ul>          
  <ul class="nav nav-sidebar">
    <li><a href="">Folder Name</a></li>
    <li><a href="">Sub Folder 2</a></li>
    <li><a href="">file.js</a></li>
    <li><a href="">anotherfile.js</a></li>
    <li><a href="">morefile.js</a></li>
  </ul>
</div>

<!--main content-->
<?php 
  $jsType = '';
  $myfile = "C:/xampp/htdocs/sample/project/hello.java";
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


<div class="col-sm-5 col-sm-offset-4 col-md-7 col-md-offset-3 main">
  <h1 class="page-header">Folder Name</h1>
  <h2 class="sub-header">File Name</h2>
    <div class="form-group">
        <div class="col-lg-12">
          <pre class="form-control brush: <?php echo $type; ?>;" rows="10">
            <?php 
              echo $data;
            ?>
          </pre>
        </div>
    </div>

</div>
<!---end main content-->

<!--right sidebar-->
<div class="col-sm-2 col-sm-offset-8 col-md-2 col-md-offset-10 sidebar">
    <h4> Controls</h4>
    <ul class="nav nav-sidebar">
      <li><a href="#"><span class="fa fa-sitemap"></span> Create Branch</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-arrow-up"></span> Push</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-arrow-down"></span> Pull</a></li>
      <li><a href="#"><span class="fa fa-file-archive-o"></span> Download as ZIP</a></li>
  </div>
<!--end right sidebar-->
  </body>
</html>
