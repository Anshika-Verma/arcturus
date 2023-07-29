<?php	
    $currentDate =  date('Y-m-d');
    $currentDateTime =  date('Y-m-d H:i:s');
    $currentTime =  date('H:i:s');
    
    function get_number_of_rows($table_name, $conn){
        $getQuery = "SELECT * FROM ".$table_name."   WHERE delete_flag = '0'";
        $getResult = mysqli_query($conn,$getQuery);

        return json_encode(mysqli_num_rows($getResult));
    }

    function get_number_of_rows_two($table_name, $column_name, $column_value, $column_name1, $column_value1, $sign, $conn){
        $getQuery = "SELECT * FROM ".$table_name." WHERE ".$column_name." = '".$column_value."' AND ".$column_name1." ".$sign." '".$column_value1."' ";
        $getResult = mysqli_query($conn,$getQuery);

        return json_encode(mysqli_num_rows($getResult));
    }

    function get_data_from_id($id, $table_name, $conn){
        $editQuery="SELECT * FROM  ".$table_name." WHERE id = '$id'";
        $editResult=mysqli_query($conn,$editQuery);
        $editArray = mysqli_fetch_array($editResult);

        return json_encode($editArray);
    }

    function get_data_from_columns($table_name, $column_name, $column_value, $column_name1, $column_value1, $conn){
        $fetchQuery = "SELECT * FROM  ".$table_name." WHERE ".$column_name." = '".$column_value."' AND ".$column_name1." = '".$column_value1."' ";
        $fetchResult = mysqli_query($conn,$fetchQuery);
        $fetchArray = mysqli_fetch_array($fetchResult);

        return json_encode($fetchArray);
    }

    function get_project_image_video_comments($image_video_id, $user_logged_in_id, $conn){
        $comment_data_array = [];

        $comment_query = " SELECT * FROM comment_table WHERE image_video_id = '$image_video_id' ORDER BY id ASC ";
        $comment_result = mysqli_query($conn, $comment_query);
        
        if(mysqli_num_rows($comment_result) > 0){
            while ($comment_array = mysqli_fetch_array($comment_result)) {
                $temp_array = [];
                
                if($comment_array['user_id'] == $user_logged_in_id){
                    $temp_array['message_div'] = 'message-div-1';
                    $temp_array['comment_card_class'] = 'my-comment';
                }
                else{
                    $temp_array['message_div'] = 'message-div';
                    $temp_array['comment_card_class'] = 'comment';
                }

                if($comment_array['x_coordinate'] != 0){
                    $temp_array['pin_image'] = 1;
                }
                else{
                    $temp_array['pin_image'] = 0;
                }
                
                $temp_array['comment_id'] = $comment_array['id'];
                $temp_array['comment'] = $comment_array['comment'];
                $temp_array['date'] = date('d-m-Y h:i A', strtotime($comment_array['create_date']));
                
                $user_array = json_decode(get_data_from_id($comment_array['user_id'], 'user_table', $conn), true);
                $temp_array['full_name'] = $user_array['full_name'];
                
                $temp_array['x_coordinate'] = $comment_array['x_coordinate'];
                $temp_array['y_coordinate'] = $comment_array['y_coordinate'];
                $temp_array['video_seconds'] = $comment_array['video_seconds'];
                $temp_array['resolve_flag'] = $comment_array['resolve_flag'];
                $temp_array['resolve_date'] = date('d-m-Y', strtotime($comment_array['resolve_date']));
                
                $user_array = json_decode(get_data_from_id($comment_array['resolve_by'], 'user_table', $conn), true);
                $temp_array['resolve_user_name'] = $user_array['full_name'];

                $comment_data_array[] = $temp_array;
            }
        }

        return json_encode($comment_data_array);
    }


?>