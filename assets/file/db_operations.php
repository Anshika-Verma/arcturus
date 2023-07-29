<?php
    if(isset($_SESSION['set']) && ($_SESSION['set'] == 'done') && ($_SESSION['website'] == 'new_project')){
        $user_id = $_SESSION['id'];
        $access_token = $_SESSION['access_token'];
        $auth_token = $_SESSION['auth_token'];

       /* date_default_timezone_set('Asia/Kolkata');

        $checkQuery = "SELECT * FROM user_access_table WHERE user_id = '$user_id' ORDER BY id desc LIMIT 1";
        $checkResult = mysqli_query($conn,$checkQuery);
        $checkArray = mysqli_fetch_array($checkResult);

        if($checkArray['auth_token'] == $auth_token) {
            $current_time = date('Y-m-d H:i:s');

            $updateQuery = "UPDATE user_access_table SET last_access_time = '$current_time' WHERE id = '".$checkArray['id']."'";
            $updateResult = mysqli_query($conn,$updateQuery);
        }
        else{
            echo "<script>window.location.href='logout.php';</script>";
        }*/
    }
    else{
        echo "<script>window.location.href='logout.php';</script>";
    }
    
    include 'db_functions.php';
    

    $website = 'InteractPro'; 

?>