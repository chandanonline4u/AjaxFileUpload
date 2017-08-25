<!DOCTYPE>
<html>
  <head>
    <title>Ajax File Upload</title>
    <link href="styles.css" type="text/css" rel="stylesheet" />
  </head>
  
  <body>
    <div id="page">
      <section class="section">
        <div class="container">
          <h1>Ajax File Upload</h1>
          <div class="form-wrapper">
            <div class="alert hidden"></div>
            <form name="file-upload" method="post" action="ajax-file-upload.php" class="form-upload" enctype="multipart/form-data">
              <input type="file" name="file-upload" id="file-upload" value="" class="input-file" />
              <input type="submit" name="uplaod" id="upload" value="Upload" class="btn-upload" />
            </form>
          </div><!-- .form-wrapper -->
        </div><!-- .container -->
      </section><!-- .section -->
      
    </div><!-- #page -->
    
    <script src="javascripts/jquery.min.js" type="text/javascript"></script>
    <script src="javascripts/jquery.form.min.js" type="text/javascript"></script>
    <script src="javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="javascripts/custom-functions.js" type="text/javascript"></script>
  </body>
</html>
        
        
  
        
        