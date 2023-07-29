<?php 
  include '../assets/file/connection.php';
  
  if(!empty($_POST['tehsil'])){ 
    $tehsilId = $_POST['tehsil'];

    $tehsilQuery = "SELECT * FROM block_table WHERE tehsil_id = '$tehsilId' AND delete_flag='0' ";
    $tehsilResult = mysqli_query($conn, $tehsilQuery);

    if(mysqli_num_rows($tehsilResult)>0){
      echo '<option value="" selected disabled>ब्लॉक चुनें</option>';
      while($tehsilArray = mysqli_fetch_array($tehsilResult)){
        echo '<option value="'.$tehsilArray['id'].'">'.ucfirst(strtolower($tehsilArray['block_name'])).'</option>';
      }
    }
    else{
      if($tehsilId == 'all'){
        echo '<option value="all" selected>समस्त</option>';
      }
      else{
        echo '<option value="">ब्लॉक उपलब्ध नहीं है</option>'; 
      }
    }
  }


  if(!empty($_POST['block'])){ 
    $blockId = $_POST['block'];

    $blockQuery = "SELECT * FROM department_table WHERE block_id = '$blockId' AND delete_flag='0' ";
    $blockResult = mysqli_query($conn, $blockQuery);

    if(mysqli_num_rows($blockResult)>0){
      echo '<option value="" selected disabled>ग्राम पंचायत चुनें</option>';
      while($blockArray = mysqli_fetch_array($blockResult)){
        echo '<option value="'.$blockArray['id'].'">'.ucfirst(strtolower(ucwords($blockArray['department_name']))).'</option>';
      }
    }
    else{
      if($blockId == 'all'){
        echo '<option value="all" selected>समस्त</option>';
      }
      else{
        echo '<option value="">ग्राम पंचायत उपलब्ध नहीं है</option>'; 
      }
    }
  }

  if(!empty($_POST['select_type'])){ 
    $select_type = $_POST['select_type'];

    $userQuery = "SELECT * FROM user_table WHERE access_token = '$select_type' AND delete_flag = '0' ";
    $userResult = mysqli_query($conn, $userQuery);

    if(mysqli_num_rows($userResult)>0){
      echo '<option value="" selected disabled>नाम चुनें</option>';
      while($userArray = mysqli_fetch_array($userResult)){
        if($userArray['mobile'] == 0 || $userArray['mobile'] == '' ){
          echo '<option value="'.$userArray['id'].'">'.ucfirst(strtolower($userArray['full_name'])).' ('.$userArray['email'].')</option>';
        }
        else{
          echo '<option value="'.$userArray['id'].'">'.ucfirst(strtolower($userArray['full_name'])).' ('.$userArray['mobile'].')</option>';
        }
      }
    }
    else{
      echo '<option value="">User not available</option>'; 
    }
  }

  if(!empty($_POST['officer_type'])){ 
    $officer_type = $_POST['officer_type'];

    if($officer_type == 'vdo'){
      $userQuery = "SELECT * FROM user_table WHERE officer_type = 'bdo' AND delete_flag = '0' ";
    }
    elseif($officer_type == 'bdo'){
      $userQuery = "SELECT * FROM user_table WHERE officer_type IN ('ddo', 'dpro') AND delete_flag = '0' ";
    }

    $userResult = mysqli_query($conn, $userQuery);

    if(mysqli_num_rows($userResult)>0){
      echo '<option value="" selected disabled>सुपरवाइज़र चुनें</option>';
      while($userArray = mysqli_fetch_array($userResult)){
        echo '<option value="'.$userArray['id'].'">'.ucfirst(strtolower($userArray['full_name'])).' ('.$userArray['mobile'].') - <b>'.ucfirst(strtoupper($userArray['officer_type'])).'</b></option>';
      }
    }
    else{
      echo '<option value="">कोई डेटा नहीं मिला</option>'; 
    }
  }

  if(!empty($_POST['select_user_type'])){ 
    // $officer_type = $_POST['officer_type'];

    $userQuery = "SELECT * FROM user_table WHERE access_token = 'user' AND delete_flag = '0' ORDER by full_name ASC ";
    $userResult = mysqli_query($conn, $userQuery);

    if(mysqli_num_rows($userResult)>0){
      echo '<option value="" selected disabled>उपयोगकर्ता चुनें</option>';
      while($userArray = mysqli_fetch_array($userResult)){
        if($userArray['mode'] == 'mobile'){
          echo '<option value="'.$userArray['id'].'">'.ucfirst(strtolower($userArray['full_name'])).' ('.$userArray['mobile'].')</option>';
        }
        else{
          echo '<option value="'.$userArray['id'].'">'.ucfirst(strtolower($userArray['full_name'])).' ('.$userArray['email'].')</option>';
        }
      }
    }
    else{
      echo '<option value="">कोई डेटा नहीं मिला</option>'; 
    }
  }

  if(!empty(isset($_POST['emailId'])) && isset($_POST['emailId'])){
   $emailInput= $_POST['emailId'];
   checkEmail($conn, $emailInput);
  
  }

  function checkEmail($conn, $emailInput){
    $query = "SELECT * FROM user_table WHERE email = '$emailInput'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      echo "<span style='color:red'>ईमेल पहले से मौजूद है </span>";
    }
  }

  if(!empty(isset($_POST['mobileId'])) && isset($_POST['mobileId'])){
   $mobileInput= $_POST['mobileId'];
   checkMobile($conn, $mobileInput);
  
  }

  function checkMobile($conn, $mobileInput){
    $query = "SELECT * FROM user_table WHERE mobile = '$mobileInput'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      echo "<span style='color:red'>मोबाइल नंबर पहले से मौजूद है</span>";
      
    }
  }
?>