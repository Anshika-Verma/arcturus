<?php

  include '../assets/file/connection.php';
  include '../assets/file/db_functions.php';
    
  date_default_timezone_set('Asia/Kolkata');

  $response = array();

  $dm_base_title = 'New Project';

  // delete query
  if($_POST['type'] == 'delete_action') {
    $table_name = strip_tags(filter_input(INPUT_POST, 'table_name', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $unique_id = strip_tags(filter_input(INPUT_POST, 'unique_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $mode = $_POST['mode'];
    
    $deleteQuery = "UPDATE ".$table_name." SET delete_flag = '1' WHERE id='$unique_id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if($deleteResult){
      $response['error'] = false;
      $response['message'] = $mode.' deleted successful!';
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please try again!';
    }
  }

  // delete query
  if($_POST['type'] == 'delete_image') {
    $table_name = strip_tags(filter_input(INPUT_POST, 'table_name', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $unique_id = strip_tags(filter_input(INPUT_POST, 'unique_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $mode = $_POST['mode'];
    $column_name = $_POST['column_name'];
    
    $deleteQuery = "UPDATE ".$table_name." SET ".$column_name." = '' WHERE id='$unique_id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if($deleteResult){
      $response['error'] = false;
      $response['message'] = $mode.' deleted successful!';
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please try again!';
    }
  }

  //add-comment
  if($_POST['type'] == 'add-comment'){
    $project_id = strip_tags(filter_input(INPUT_POST, 'unique_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $user_id = strip_tags(filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $image_video_id = strip_tags(filter_input(INPUT_POST, 'image_video_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $x_coordinate = strip_tags(filter_input(INPUT_POST, 'x_coordinate', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $y_coordinate = strip_tags(filter_input(INPUT_POST, 'y_coordinate', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $video_seconds = strip_tags(filter_input(INPUT_POST, 'video_seconds', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $comment = $_POST['comment'];

    $insertQuery = "INSERT INTO comment_table (user_id, project_id, image_video_id, x_coordinate, y_coordinate, video_seconds, comment, create_date) VALUES ('$user_id', '$project_id', '$image_video_id', '$x_coordinate', '$y_coordinate', '$video_seconds', '$comment', '".date('Y-m-d H:i:s')."') ";
    $insertResult = mysqli_query($conn, $insertQuery);

    if($insertResult){

      $headers = "From: contact@mysticalproductions.co.in\r\n";
      $headers .= "Reply-To: contact@mysticalproductions.co.in\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

      $project_data = json_decode(get_data_from_id($project_id,'project_table',$conn), true);

      $mail_subject = "New Comment Added to the Project - ".$project_data['project_name'];

      $members_id = explode(',', $project_data['members_id']);
      $member_name = array();

      foreach ($members_id as $key => $value) {
        $user_array = json_decode(get_data_from_id($value,'user_table',$conn),true);

        mail($user_array['email'], $mail_subject , $comment , $headers);
      }

      $response['error'] = false;
      $response['message'] = 'Comment Added Successful';
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please try again!';
    }
  }

  //add-member
  if($_POST['type'] == 'add-member'){
    $unique_id = strip_tags(filter_input(INPUT_POST, 'unique_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $member_id = $_POST['member_id'];

    $checkQuery = " SELECT * FROM project_table WHERE id = '$unique_id' ";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkArray = mysqli_fetch_array($checkResult);
    
    if($checkArray['members_id'] != '' || $checkArray['members_id'] != NULL){
      $member_ids = implode(',', $member_id);
      $member_ids = $checkArray['members_id'] .','. $member_ids;
    }
    else{
      $member_ids = implode(',', $member_id);
    }
    $insertQuery = "UPDATE project_table SET members_id = '$member_ids' WHERE id = $unique_id ";
    $insertResult = mysqli_query($conn, $insertQuery);

    if($insertResult){
      $response['error'] = false;
      $response['message'] = 'Member Added Successful';

      $headers = "From: kapoor.rohit95@gmail.com\r\n";
      $headers .= "Reply-To: kapoor.rohit95@gmail.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

      $project_data = json_decode(get_data_from_id($unique_id,'project_table',$conn), true);

      $mail_subject = "New Project - ".$project_data['project_name']." has been assigned to you ";
      $comment = "Hi, New Project - ".$project_data['project_name']." has been assigned to you";

      foreach ($member_id as $key => $value) {
        $user_array = json_decode(get_data_from_id($value,'user_table',$conn),true);
        mail($user_array['email'], $mail_subject, $comment, $headers);
      }
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please try again!';
    }
  }

  //add-user
  if($_POST['type'] == 'add-user'){
    $email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $mobile_number = strip_tags(filter_input(INPUT_POST, 'mobile_number', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $password = strip_tags(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $full_name = $_POST['full_name'];
    $company_name = $_POST['company_name'];

    $checkQuery = " SELECT * FROM user_table WHERE delete_flag = 0 AND (email = '$email' OR mobile_number = '$mobile_number') ";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkArray = mysqli_fetch_array($checkResult);
    
    if(mysqli_num_rows($checkResult) > 0){
      if($checkArray['email'] == $email){
        $response['error'] = true;
        $response['message'] = 'Email Already Registered!, Please try another email';
      }
      elseif($checkArray['mobile_number'] == $mobile_number){
        $response['error'] = true;
        $response['message'] = 'Mobile Number Already Registered!, Please try another number'; 
      }
    }
    else{
      $insertQuery = "INSERT INTO user_table (full_name, email, mobile_number, password, company_name, access_token) VALUES('$full_name', '$email', '$mobile_number', '".sha1($password)."', '$company_name', 'user') ";
      $insertResult = mysqli_query($conn, $insertQuery);

      if($insertResult){
        $response['error'] = false;
        $response['message'] = 'User Added Successful';
      }
      else{
        $response['error'] = true;
        $response['message'] = 'Please try again!';
      }
    }
  }

  //edit-user
  if($_POST['type'] == 'edit-user'){
    $id = strip_tags(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $email = strip_tags(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $mobile_number = strip_tags(filter_input(INPUT_POST, 'mobile_number', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $password = strip_tags(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $full_name = $_POST['full_name'];
    $company_name = $_POST['company_name'];

    $checkQuery = " SELECT * FROM user_table WHERE delete_flag = 0 AND (email = '$email' OR mobile_number = '$mobile_number') AND id != $id ";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkArray = mysqli_fetch_array($checkResult);
    
    if(mysqli_num_rows($checkResult) > 0){
      if($checkArray['email'] == $email){
        $response['error'] = true;
        $response['message'] = 'Email Already Registered!, Please try another email';
      }
      elseif($checkArray['mobile_number'] == $mobile_number){
        $response['error'] = true;
        $response['message'] = 'Mobile Number Already Registered!, Please try another number'; 
      }
    }
    else{
      $password_array = json_decode(get_data_from_id($id, 'user_table', $conn), true);
      if($password == $password_array['password']){
        $insertQuery = "UPDATE user_table SET full_name = '$full_name', email = '$email', mobile_number = '$mobile_number', company_name = '$company_name', password = '$password' WHERE id = $id ";
      }
      else{
        $insertQuery = "UPDATE user_table SET full_name = '$full_name', email = '$email', mobile_number = '$mobile_number', company_name = '$company_name', password = '".sha1($password)."' WHERE id = $id ";
      }
      $insertResult = mysqli_query($conn, $insertQuery);

      if($insertResult){
        $response['error'] = false;
        $response['message'] = 'Details Updated Successful';
      }
      else{
        $response['error'] = true;
        $response['message'] = 'Please try again!';
      }
    }
  }

  // add-project
  if($_POST['type'] == 'add-project'){
    $project_name = strip_tags(filter_input(INPUT_POST, 'project_name', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $member_id = $_POST['member_id'];

    $member_ids = implode(',', $member_id);

    $extension = array("pdf", "PDF");
    $image_save_location = "../assets/images/document/";

    if(isset($_FILES['project_document']) && $_FILES['project_document']['name'] != ''){
      $project_document = time().rand(1000, 9999).addslashes($_FILES['project_document']['name']);
      $file_tmp = $_FILES["project_document"]["tmp_name"];
      
      $ext = pathinfo($project_document, PATHINFO_EXTENSION);

      if(in_array($ext, $extension)) {
        $str = $project_document;
        $pattern = "/php/i";
      
        if(preg_match($pattern, $str)){
          $response['error'] = true;
          $response['message'] = 'Please try again!';
        }
        else{
          move_uploaded_file($file_tmp = $_FILES["project_document"]["tmp_name"], $image_save_location."/".$project_document);
          $project_document = $project_document;
        }
      }
    }
    else{
      $project_document = '';
    }

    $insertQuery = "INSERT INTO project_table (project_name,  members_id, document) VALUES ('$project_name', '$member_ids', '$project_document') ";
    $insertResult = mysqli_query($conn, $insertQuery);

    if($insertResult){
      $id = mysqli_insert_id($conn);

      $uploads = '';

      for($i=0;$i<count($_FILES['files']['name']);$i++) {
        // if($i >= 2){
        //   $Error = true;
        //   $response['message'] = 'Please Upload only 2 Attachment';
        //   $response['error'] = true;
        // }
        // else{
          $Error = false;
          $rand = rand(1000,9999);
          
          $files = $rand.$_FILES['files']['name'][$i];

          $ext1 = pathinfo($files, PATHINFO_EXTENSION);

          if($ext1 == 'mp3' || $ext1 == 'mp4' || $ext1 == 'MP3' || $ext1 == 'MP4'){
            $attachment_type = 'video';
          }
          else{
            $attachment_type = 'picture';
          }
        
          if(preg_match("/{php}/i", $files)){
            break;
          }
          else{  
            $target_dir ='../assets/images/project_image_video/';
            $loc = $target_dir . basename($rand.$_FILES['files']['name'][$i]);
            
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $loc)) {
              $imageUpload = true;

            }
            else{
                $imageUpload = false;
            }

            if($imageUpload){
              $uploads .= ','.$files;
            }
          }
        // }
      }
      if($Error == false){
        $files = substr($uploads, 1);
        $file = explode(',', $files);

        foreach ($file as $key => $value) {
          $ext1 = pathinfo($value, PATHINFO_EXTENSION);

          if($ext1 == 'mp3' || $ext1 == 'mp4' || $ext1 == 'MP3' || $ext1 == 'MP4'){
            $attachment_type = 'video';
          }
          else{
            $attachment_type = 'picture';
          }

          if($value != ''){
            $attachmentQuery = "INSERT INTO image_video_table (project_id, type, image_video) VALUES ('$id', '$attachment_type', '$value') ";
            $attachmentResult = mysqli_query($conn, $attachmentQuery);
          }
        }

        $response['error'] = false;
        $response['message'] = 'Project Added Successful';

        $headers = "From: contact@mysticalproductions.co.in\r\n";
        $headers .= "Reply-To: contact@mysticalproductions.co.in\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $mail_subject = "New Project - ".$project_name." has been assigned to you ";

        $membersId = explode(',', $member_ids);
        $member_name = array();

        foreach ($membersId as $key => $value) {
          
          $user_array = json_decode(get_data_from_id($value,'user_table',$conn),true);
          
          mail($user_array['email'], $mail_subject, $mail_subject, $headers);
        }
      }
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please try again!';
    }
  }

  //edit-project
  if($_POST['type'] == 'edit-project'){
    $id = strip_tags(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $project_name = strip_tags(filter_input(INPUT_POST, 'project_name', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $member_id = $_POST['member_id'];

    $member_ids = implode(',', $member_id);

    $updateQuery = "UPDATE project_table SET members_id = '$member_ids', project_name = '$project_name' WHERE id = $id ";
    $updateResult = mysqli_query($conn, $updateQuery);

    if($updateResult){
      $response['error'] = false;
      $response['message'] = 'Details Updated Successful';
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please try again!';
    }
  }

  //edit-document
  if ($_POST['type'] == 'edit-document') {
    $id = strip_tags(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

    $extension = array("png", "PNG","jpg", "JPG","jpeg", "JPEG", "webp", "pdf", "PDF");
    $document_save_location = "../assets/images/document/";

    $ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
    $document = time().rand(1000, 9999).addslashes($_FILES['document']['name']);
    $file_tmp = $_FILES["document"]["tmp_name"];

    
    $ext1 = pathinfo($document, PATHINFO_EXTENSION);

    if(in_array($ext1, $extension)) {
      $str1= $document;
      $pattern1 = "/php/i";
      
      if(preg_match($pattern1, $str1)){
        $response['error'] = true;
        $response['message'] = 'Please choose a correct document!';
      }
      else{
        move_uploaded_file($file_tmp = $_FILES["document"]["tmp_name"], $document_save_location."/".$document);

        $Query = "UPDATE project_table SET document = '$document' WHERE id ='$id'";
        $Result = mysqli_query($conn, $Query);

        if($Result){
          $response['error'] = false;
          $response['message'] = 'Document Updated Successfully !!';
        }
        else{
          $response['error'] = true;
          $response['message'] = 'Please Try Again!';
        }
      }
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please choose the correct Document file!';
    }
  }

  //add-document
  if ($_POST['type'] == 'add-document') {
    $id = strip_tags(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $user_id = strip_tags(filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $project_id = strip_tags(filter_input(INPUT_POST, 'project_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

    $extension = array("png", "PNG","jpg", "JPG","jpeg", "JPEG", "webp", "pdf", "PDF");
    $document_save_location = "../assets/images/document/";

    $ext = pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
    $document = addslashes($_FILES['document']['name']);
    $file_tmp = $_FILES["document"]["tmp_name"];

    
    $ext1 = pathinfo($document, PATHINFO_EXTENSION);

    if(in_array($ext1, $extension)) {
      $str1= $document;
      $pattern1 = "/php/i";
      
      if(preg_match($pattern1, $str1)){
        $response['error'] = true;
        $response['message'] = 'Please choose a correct document!';
      }
      else{
        move_uploaded_file($file_tmp = $_FILES["document"]["tmp_name"], $document_save_location."/".$document);

        $insertQuery = "INSERT INTO document_table (project_id, user_id, document) VALUES ('$project_id', '$user_id', '$document')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if($insertResult){
          $response['error'] = false;
          $response['message'] = 'Document Added Successfully !!';
        }
        else{
          $response['error'] = true;
          $response['message'] = 'Please Try Again!';
        }
      }
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please choose the correct Document file!';
    }
  }

  // update_status
  if($_POST['type'] == 'update_status') {
    $table_name = strip_tags(filter_input(INPUT_POST, 'table_name', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $unique_id = strip_tags(filter_input(INPUT_POST, 'unique_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $status = strip_tags(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

    $deleteQuery = "UPDATE ".$table_name." SET status = $status WHERE id='$unique_id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if($deleteResult){
      $response['error'] = false;
      $response['message'] = 'Status Updated Successful';
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please try again';
    }
  }

  // get-coordinates
  if($_POST['type'] == 'get-coordinates'){
    $project_id = strip_tags(filter_input(INPUT_POST, 'project_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

    $project_data = json_decode(get_data_from_id($project_id, 'project_table', $conn), true);

    $attachment_query = "SELECT * FROM image_video_table WHERE project_id = '$project_id' ";
    $attachment_result = mysqli_query($conn, $attachment_query);

    $image_flag = 0;
    $video_flag = 0;
    
    while($attachment_array = mysqli_fetch_array($attachment_result)){
      if($attachment_array['type'] == 'video'){
        $video_flag++;
      }
      if($attachment_array['type'] == 'picture'){
        $image_flag++;
      }
    }

    if($image_flag > 0 && $video_flag > 0){
      $attachment_type = 'all';
    }
    else if($image_flag > 0){
      $attachment_type = 'image';
    }
    else{
      $attachment_type = 'video';
    }

    $get_comments_query = "SELECT * FROM comment_table WHERE project_id = '$project_id' AND x_coordinate != 0 ";
    $get_comments_result = mysqli_query($conn, $get_comments_query);

    if(mysqli_num_rows($get_comments_result) > 0){
      
      $coordinates_array = [];

      while($get_comments_array = mysqli_fetch_array($get_comments_result)){
        $coordinates_array[] = ['x_coordinate'=>$get_comments_array['x_coordinate'], 'y_coordinate'=>$get_comments_array['y_coordinate']];
      }

      $response['error'] = false;
      $response['coordinates_array'] = $coordinates_array;
      $response['attachment_type'] = $attachment_type;
    }
    else{
      $response['error'] = true;
      $response['attachment_type'] = $attachment_type;
    }
  }

  // get-comment-coordinates
  if($_POST['type'] == 'get-comment-coordinates'){
    $comment_id = strip_tags(filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

    $comment_data = json_decode(get_data_from_id($comment_id, 'comment_table', $conn), true);
    
    $response['x_coordinate'] = $comment_data['x_coordinate'];
    $response['y_coordinate'] = $comment_data['y_coordinate'];
    $response['video_seconds'] = $comment_data['video_seconds'];

    $response['error'] = false;
  }

  // resolve_comment
  if($_POST['type'] == 'resolve_comment'){
    $comment_id = strip_tags(filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
    $resolve_by = strip_tags(filter_input(INPUT_POST, 'resolve_by', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

    $update_query = "UPDATE comment_table SET resolve_flag = 1, resolve_by = '$resolve_by', resolve_date = '".date('Y-m-d H:i:s')."' WHERE id = '$comment_id' ";
    $update_result = mysqli_query($conn, $update_query);

    if($update_result){
      $response['error'] = false;
      $response['message'] = 'Comment is Resolved';
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please try again!';
    }
  }

  // delete-comment
  if($_POST['type'] == 'delete-comment'){
    $comment_id = strip_tags(filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

    $update_query = "DELETE FROM comment_table WHERE id = '$comment_id' ";
    $update_result = mysqli_query($conn, $update_query);

    if($update_result){
      $response['error'] = false;
      $response['message'] = 'Pin is Deleted';
    }
    else{
      $response['error'] = true;
      $response['message'] = 'Please try again!';
    }
  }

  echo json_encode($response);

?>