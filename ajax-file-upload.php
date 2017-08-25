<?php 
  // prevent direct access
  $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
  if(!$isAjax) {
    $access_error = 'Invalid!';
    echo $access_error;
    exit;
  }
  $site_url = 'http://localhost/codeBase/AjaxFileUpload/';
  
  $result = array('success'=>1, 'message'=>'', 'file_name' => '', 'file_url'=> '');
  
  //Change File Name
  $path_parts = pathinfo($_FILES["file-upload"]["name"]);
  $fileNewName = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
  
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($fileNewName);
//  $target_file = $target_dir . basename($_FILES["file-upload"]["name"]);
  
  $uploadOk = 1;
  $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
  
  // Check file size
  if ($_FILES["file-upload"]["size"] > 500000) {
    $uploadOk = 0;
    $result['success'] = $uploadOk;
    $result['message'] = "Sorry, your file is too large.";
  }
  
 
  // Allow certain file formats
  if($fileType <> "pdf" AND $fileType <> "doc" AND $fileType <> "docx" AND $fileType <> "xls" AND $fileType <> "xlsx" AND $fileType <> "csv" AND $fileType <> "jpg" AND $fileType <> "png") {
    $uploadOk = 0;
    $result['success'] = $uploadOk;
    $result['message'] = "Sorry, only PDF, DOC, DOCX, XLS, XLSX, CSV, JPG, & PNG files are allowed.";
  }
  
 
  // Check if file already exists
  if(file_exists($target_file)) {
    $uploadOk = 0;
    $result['success'] = $uploadOk;
    $result['message'] = "Sorry, file already exists.";
  }


  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk === 1) {
    if (move_uploaded_file($_FILES["file-upload"]["tmp_name"], $target_file)) {
      $result['success'] = 1;
      $result['message'] = "Your file ". $fileNewName. " has been uploaded successfully.";
      $result['file_name'] = $fileNewName;
      $result['file_url'] = $site_url.$target_file;
    } else {
      $result['success'] = 0;
      $result['message'] = "Sorry, there was an error uploading your file.";
    }
  }
  
  echo json_encode( $result );
  exit;
?>
        