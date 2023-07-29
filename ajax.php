<?php 

	include 'assets/file/connection.php';
	$response = array();
	
	date_default_timezone_set('Asia/Kolkata');

	if($_POST['type'] == 'check-login'){
		$username = strip_tags(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
		$password = sha1(strip_tags(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

		$checkUserQuery = "SELECT * FROM user_table WHERE email = '$username' AND delete_flag = 0 ";
		$checkUserResult = mysqli_query($conn, $checkUserQuery);

		if(mysqli_num_rows($checkUserResult) > 0){
			$checkQuery = "SELECT * FROM user_table WHERE email = '$username' AND password = '$password' ";
			$checkResult = mysqli_query($conn, $checkQuery);
			
			if(mysqli_num_rows($checkResult) > 0){
				$checkArray = mysqli_fetch_array($checkResult);

				$response['error'] = false;
				$response['message'] = 'Login Successfully';
				$response['url'] = $checkArray['access_token'];
				session_start();

				$auth_token = session_id();

				// $insertQuery = "INSERT INTO user_access_table(user_id, auth_token,latitude,longitude,accuracy) VALUES ('".$checkArray['id']."', '$auth_token','$latitude','$longitude','$accuracy')";
				// $insertResult = mysqli_query($conn, $insertQuery);

				$_SESSION['id'] = $checkArray['id'];
				$_SESSION['auth_token'] = $auth_token;
				$_SESSION['access_token'] = $checkArray['access_token'];
				$_SESSION['set'] = 'done';
				$_SESSION['website'] = 'new_project';
			}
			else{
				$response['error'] = true;
				$response['message'] = 'Incorrect Credentials';
			}
		}
		else{
			$response['error'] = true;
			$response['message'] = 'User Not Exist!';
		}
	}

	echo json_encode($response);

?>