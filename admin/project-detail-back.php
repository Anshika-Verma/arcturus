<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<style type="text/css">
    .select2-container--default .select2-selection--multiple{
        width: 220px;
    }
</style>
<?php
    $id = $_GET['id'];
    $project_array = json_decode(get_data_from_id($id,'project_table',$conn),true);

    if($project_array['status'] == 1){
        $status_button = "<a class='btn-sm btn-success'>Done</a>";
    }
    else{
        $status_button = "<a class='btn-sm btn-warning'>Archive</a>";
    }

?>
    <div class='main-content'>
        <div class='page-content'>
            <div class='container-fluid'>

                <!-- start page title -->
                <div class='row'>
                    <div class='col-12'>
                        <div class='page-title-box d-flex align-items-center justify-content-between'>
                            <h4 class='mb-0'>Project Detail</h4>
                            <div class='page-title-right'>
                                <ol class='breadcrumb m-0'>
                                    <li class='breadcrumb-item'><a href='javascript: void(0);'><?php echo $website ?></a></li>
                                    <li class='breadcrumb-item active'></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <!-- complaint details -->
                    <div class='col-md-7'>
                        <div class="d-block">
                            <div class='card'>
                                <div class='card-body'>
                                    <h4 class="heading">Project Details</h4>
                                    <table class="table table-bordered table-striped nowrap" style="border: 1px solid #d8dfec;">
                                            <th>Project Name</th>
                                            <td><?php echo $project_array['project_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <th style="width:150px">Document</th>
                                            <?php 
                                                if($project_array['document'] == ''){
                                                    echo"<td>-</td>";
                                                }
                                                else{
                                                    echo"<td><a class='btn-sm btn-info' target='_blank'  href='../assets/images/document/".$project_array['document']."'><i class='fa fa-eye'></i></a></td>";

                                                } 
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Image/Video</th>
                                            <td style='line-height:2'>
                                            <?php
                                                $selectQuery = " SELECT * FROM image_video_table WHERE project_id = '$id' AND delete_flag = 0 ";
                                                $selectResult = mysqli_query($conn, $selectQuery);

                                                $image_video_count = 0;

                                                if(mysqli_num_rows($selectResult) > 0){
                                                    while($selectArray = mysqli_fetch_array($selectResult)){
                                                        $image_video_count++;

                                                        $attachmentType = $selectArray['type'];
                                                        $attachment = $selectArray['image_video'];

                                                        if($attachmentType == 'video'){
                                                           echo "<a class='btn btn-info' data-bs-toggle='modal' data-bs-target='.viewVideo_".$selectArray['id']."' style='margin-right: 10px;'>View Video</a>";
                                                        }
                                                        else{
                                                           echo "<a class='btn btn-primary' data-bs-toggle='modal' data-bs-target='.viewVideo_".$selectArray['id']."' style='margin-right: 10px;'>View Image</a>";
                                                        }

                                                        echo "<div class='modal fade viewVideo_".$selectArray['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
                                                            <div class='modal-dialog modal-fullscreen'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header' style='background: #e7e3d8;'>
                                                                        <h5 class='modal-title mt-0' id='mySmallModalLabel' style='font-weight: bold; color: #fff;'>Image / Video</h5>
                                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' style='font-weight: bold;'>
                                                                        </button>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                        <div class='row'>
                                                                            <div class='col-md-8'>";
                                                                            
                                                                                if($attachmentType == 'video'){
                                                                                    echo "<div class='player-wrapper'>
                                                                                            <video class='player video-js vjs-default-skin vjs-big-play-centered' crossorigin='anonymous' preload='metadata' controls id='video_player' style='width: 100%; height: 85vh;'> 
                                                                                                <source src='../assets/images/project_image_video/".$attachment."'>
                                                                                            </video>
                                                                                        </div>";
                                                                                }
                                                                                else{
                                                                                    echo "<img class='mt-2 mb-2 detail-attachment' id='image_player' src='../assets/images/project_image_video/".$attachment."' style='width: 100%; height: 85vh; display: none;'>";

                                                                                    echo "<div class='main-container'><div class='image-container'></div></div>";
                                                                                }

                                                                                if($image_video_count == 1){
                                                                                    echo "<div id='image-overlay'></div>";
                                                                                }

                                                                      
                                                                      echo "</div>
                                                                            <div class='col-md-4'>
                                                                                <div class='d-block'>
                                                                                    <div class='card'>
                                                                                        <div class='col-md-12'>
                                                                                            <h4 class='heading m-3'>
                                                                                                Comments
                                                                                                <span class='clear_pins'>Clear Pins</span>
                                                                                                <span class='show_all_pins'>Show All</span>
                                                                                            </h4>
                                                                                        </div>
                                                                                        <div class='card-body cmt-card-body comment_body_card_".$selectArray['id']."'>";
                                                                                            $comment_query = " SELECT * FROM comment_table WHERE image_video_id = '".$selectArray['id']."' ORDER BY id ASC ";
                                                                                            $comment_result = mysqli_query($conn, $comment_query);
                                                                                            
                                                                                            $var = 0;
                                                                                            if(mysqli_num_rows($comment_result) > 0){
                                                                                                while ($comment_array = mysqli_fetch_array($comment_result)) {
                                                                                                    $var++;
                                                                                                    $user_array = json_decode(get_data_from_id($comment_array['user_id'], 'user_table', $conn), true);
                                                                                                        if($comment_array['user_id'] == $_SESSION['id']){
                                                                                                            echo "<div class='message-div-1'><div class=' mb-3 my-comment'>";
                                                                                                        }
                                                                                                        else{
                                                                                                            echo "<div class='message-div'><div class=' mb-3 comment'>";
                                                                                                        }
                                                                                                        echo "<p class='mb-0'>
                                                                                                                    <b>".$user_array['full_name']."</b><br>";
                                                                                                               
                                                                                                                    if($comment_array['x_coordinate'] != 0){
                                                                                                                        echo "<img src='../assets/images/pin-image.png' class='pin_location_button' data-id='".$comment_array['id']."' data-name='".$attachmentType."'> at ".$comment_array['video_seconds']." seconds<br>";
                                                                                                                    }
                                                                                                               
                                                                                                                    echo $comment_array['comment'];
                                                                                                            
                                                                                                        echo "</p><span>".date('d-m-Y h:i A', strtotime($comment_array['create_date']))."</span>";

                                                                                                                if($comment_array['x_coordinate'] != 0){
                                                                                                                    if($comment_array['resolve_flag'] == 0){
                                                                                                                        echo "<span class='resolve_comment' data-id='".$comment_array['id']."' data-name='".$_SESSION['id']."'>Resolve Comment</span>";
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        $resolve_user_data = json_decode(get_data_from_id($comment_array['resolve_by'], 'user_table', $conn), true);

                                                                                                                        echo "<span class='comment_resolved'>Comment Resolved by ".$resolve_user_data['full_name']." on ".date('d-m-Y', strtotime($comment_array['resolve_date']))."</span>";
                                                                                                                    }
                                                                                                                }
                                                                                                  echo "</div>
                                                                                                    </div>";

                                                                                                }
                                                                                            }
                                                                                            else{
                                                                                                echo "<div class='message-div-1'>
                                                                                                        <div class=' mb-3 my-comment'>
                                                                                                            <p class='mb-0'>
                                                                                                                <b>No Comments!</b>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div>";
                                                                                            }

                                                                                  echo "</div>
                                                                                        <div class='col-md-12 card-footer'>
                                                                                            <form id='add-menu-form'>
                                                                                                <div class='comment-bx'>
                                                                                                    <div class='row'>
                                                                                                        <input type='hidden' name='type' value='add-comment'>
                                                                                                        <input type='hidden' name='x_coordinate' value='0'>
                                                                                                        <input type='hidden' name='y_coordinate' value='0'>
                                                                                                        <input type='hidden' name='video_seconds' value='0'>
                                                                                                        <input type='hidden' name='type' value='add-comment'>
                                                                                                        <input type='hidden' name='image_video_id' value='".$selectArray['id']."'>
                                                                                                        <input type='hidden' name='unique_id' value='".$project_array['id']."'>
                                                                                                        <input type='hidden' name='user_id' value='".$_SESSION['id']."'>
                                                                                                        <div class='col-lg-10 col-9'>
                                                                                                            <textarea class='from-control comment-text' placeholder='Enter Your Comment Here...' name='comment' style='width:100%' rows='2'></textarea>
                                                                                                        </div>
                                                                                                        <div class='col-3 col-lg-2'>
                                                                                                            <button type='submit' name='delete' value='Submit' class='btn btn-primary'><i class='fa fa-paper-plane'></i></button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>";
                                                    }
                                                }
                                                else{
                                                    echo "-";
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><?php echo $status_button ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-block">
                            <div class='card'>
                                <div class='card-body'>
                                    <h4 class="heading">Members</h4>
                                    <div class="col-md-12 mb-3 text-right">
                                        <a class="btn btn-primary" data-bs-toggle='modal' data-bs-target='.add<?php echo $project_array['id'] ?>'><i class="fa fa-plus"></i> Add Member</a>
                                    </div>
                                    <table class="table table-bordered table-striped nowrap" style="border: 1px solid #d8dfec;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Member Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <?php  
                                                $member_id = explode(',', $project_array['members_id']);
                                                foreach ($member_id as $key => $value) {
                                                    $userArray = json_decode(get_data_from_id($value, 'user_table', $conn), true);
                                                    if($value){
                                                        $count = $key + 1;
                                                        echo"<tr>
                                                            <td>".$count."</td>
                                                            <td>".$userArray['full_name']."</td>
                                                            <td>".$userArray['email']."</td>
                                                            <td>".$userArray['mobile_number']."</td>
                                                        </tr>";
                                                    }
                                                    else{
                                                        echo"<tr><td colspan='2' class='text-center'>No Data Available</td></tr>";
                                                    }
                                                }
                                                echo"<div class='modal fade Delete_Modal add".$project_array['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title text-white mt-0' id='mySmallModalLabel'>Add Member</h5>
                                                                <button class='btn text-white' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>
                                                                    <i class='fa fa-times'></i>
                                                                </button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <form id='add-menu-form'>
                                                                    <input type='hidden' name='type' value='add-member'>
                                                                    <input type='hidden' name='unique_id' value='".$project_array['id']."'>
                                                                    <div class='form-group col-lg-12 col-12'>
                                                                        <div class='input-label'>
                                                                            <label>Add Member <sup class='text-danger'>*</label>
                                                                        </div>
                                                                        <select class='form-select select' multiple name='member_id[]' data-placeholder='Select Member'>";
                                                                            if($project_array['members_id'] != '' || $project_array['members_id'] != NULL){
                                                                                $member_query = "SELECT * FROM user_table WHERE delete_flag = 0 AND access_token = 'user' AND id NOT IN (".$project_array['members_id'].") ";
                                                                            }
                                                                            else{
                                                                                $member_query = "SELECT * FROM user_table WHERE delete_flag = 0 AND access_token = 'user' ";
                                                                            }
                                                                            $member_result = mysqli_query($conn,$member_query);
                                                                            if (mysqli_num_rows($member_result)> 0) {
                                                                                while ($member_array = mysqli_fetch_array($member_result)){
                                                                                    echo "<option value='".$member_array['id']."'>".$member_array['full_name']."</option>";
                                                                                }
                                                                            }
                                                                        echo"</select>
                                                                    </div>
                                                                    <input type='submit' name='delete' value='Submit' class='btn btn-primary mt-2' style='border-radius: 5px'>
                                                                    <button class='btn btn-danger mt-2' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 5px; margin-left: 10px;'>Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                            ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="d-block">
                            <div class='card'>
                                <div class='card-body'>
                                    <h4 class="heading">Additional Document</h4>
                                    <div class="col-md-12 mb-3 text-right">
                                        <a class="btn btn-primary" data-bs-toggle='modal' data-bs-target='.add-document<?php echo $project_array['id'] ?>'><i class="fa fa-plus"></i> Add Document</a>
                                    </div>
                                    <table id="datatable" class="table table-bordered table-striped nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; overflow-x: auto; text-align: center;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Added By</th>
                                                <th>Document</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <?php  
                                                $document_query = "SELECT * FROM document_table WHERE delete_flag = 0 AND project_id = $id";
                                                $document_result = mysqli_query($conn, $document_query);
                                                $count = 0;
                                                if(mysqli_num_rows($document_result) > 0){
                                                    while($array = mysqli_fetch_array($document_result)){
                                                        $count++;
                                                        $added_by = json_decode(get_data_from_id($array['user_id'], 'user_table', $conn), true);
                                                        echo"<tr>
                                                            <td>".$count."</td>
                                                            <td>".$added_by['full_name']."</td>
                                                            <td><a class='btn-sm btn-info' target='_blank' href='../assets/images/document/".$array['document']."'><i class='fa fa-eye'></i></a></td>
                                                            <td>".date('d-m-Y', strtotime($array['create_date']))."</td>
                                                        </tr>";
                                                    }
                                                }
                                                else{
                                                    echo"<tr><td colspan='4' class='text-center'>No Data Available!</td></tr>";
                                                }
                                                echo"<div class='modal fade Delete_Modal add".$project_array['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title text-white mt-0' id='mySmallModalLabel'>Add Member</h5>
                                                                <button class='btn text-white' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>
                                                                    <i class='fa fa-times'></i>
                                                                </button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <form id='add-menu-form'>
                                                                    <input type='hidden' name='type' value='add-member'>
                                                                    <input type='hidden' name='unique_id' value='".$project_array['id']."'>
                                                                    <div class='form-group col-lg-12 col-12'>
                                                                        <div class='input-label'>
                                                                            <label>Add Member <sup class='text-danger'>*</label>
                                                                        </div>
                                                                        <select class='form-select select' multiple name='member_id[]' data-placeholder='Select Member'>";
                                                                            if($project_array['members_id'] != '' || $project_array['members_id'] != NULL){
                                                                                $member_query = "SELECT * FROM user_table WHERE delete_flag = 0 AND access_token = 'user' AND id NOT IN (".$project_array['members_id'].") ";
                                                                            }
                                                                            else{
                                                                                $member_query = "SELECT * FROM user_table WHERE delete_flag = 0 AND access_token = 'user' ";
                                                                            }
                                                                            $member_result = mysqli_query($conn,$member_query);
                                                                            if (mysqli_num_rows($member_result)> 0) {
                                                                                while ($member_array = mysqli_fetch_array($member_result)){
                                                                                    echo "<option value='".$member_array['id']."'>".$member_array['full_name']."</option>";
                                                                                }
                                                                            }
                                                                        echo"</select>
                                                                    </div>
                                                                    <input type='submit' name='delete' value='Submit' class='btn btn-primary mt-2' style='border-radius: 5px'>
                                                                    <button class='btn btn-danger mt-2' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 5px; margin-left: 10px;'>Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class='modal fade Delete_Modal add-document".$project_array['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title text-white mt-0' id='mySmallModalLabel'>Add Document</h5>
                                                                <button class='btn text-white' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>
                                                                    <i class='fa fa-times'></i>
                                                                </button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <form id='add-menu-form'>
                                                                    <input type='hidden' name='type' value='add-document'>
                                                                    <input type='hidden' name='user_id' value='".$_SESSION['id']."'>
                                                                    <input type='hidden' name='project_id' value='".$project_array['id']."'>
                                                                    <div class='form-group col-lg-12 col-12'>
                                                                        <div class='input-label'>
                                                                            <label>Add Document <sup class='text-danger'>*</label>
                                                                        </div>
                                                                        <input type='file' class='form-control' name='document' accept='.pdf'>
                                                                    </div>
                                                                    <input type='submit' name='delete' value='Submit' class='btn btn-primary mt-2' style='border-radius: 5px'>
                                                                    <button class='btn btn-danger mt-2' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 5px; margin-left: 10px;'>Close</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                            ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class='card'>
                                <div class='card-body'>
                                    <h4 class="heading">Video</h4>
                                    <?php
                                        $selectQuery = " SELECT * FROM image_video_table WHERE project_id = '$id' AND delete_flag = 0 ";
                                        $selectResult = mysqli_query($conn, $selectQuery);

                                        $image_video_count = 0;

                                        if(mysqli_num_rows($selectResult) > 0){
                                            while($selectArray = mysqli_fetch_array($selectResult)){
                                                $image_video_count++;

                                                $attachmentType = $selectArray['type'];
                                                $attachment = $selectArray['image_video'];

                                                if($attachmentType == 'video'){
                                                   echo "<a class='btn btn-info' data-bs-toggle='modal' data-bs-target='.viewVideo_".$selectArray['id']."' style='margin-right: 10px;'>View Video</a>";
                                                }
                                                else{
                                                   echo "<a class='btn btn-primary' data-bs-toggle='modal' data-bs-target='.viewVideo_".$selectArray['id']."' style='margin-right: 10px;'>View Image</a>";
                                                }

                                                echo "<div class='modal fade viewVideo_".$selectArray['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog modal-fullscreen'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header' style='background: #e7e3d8;'>
                                                                <h5 class='modal-title mt-0' id='mySmallModalLabel' style='font-weight: bold; color: #fff;'>Image / Video</h5>
                                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' style='font-weight: bold;'>
                                                                </button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <div class='row'>
                                                                    <div class='col-md-8'>";
                                                                    
                                                                        if($attachmentType == 'video'){
                                                                            echo "<div class='player-wrapper'>
                                                                                    <video class='player video-js vjs-default-skin vjs-big-play-centered' crossorigin='anonymous' preload='metadata' controls id='video_player' style='width: 100%; height: 85vh;'> 
                                                                                        <source src='../assets/images/project_image_video/".$attachment."'>
                                                                                    </video>
                                                                                </div>";
                                                                        }
                                                                        else{
                                                                            echo "<img class='mt-2 mb-2 detail-attachment' id='image_player' src='../assets/images/project_image_video/".$attachment."' style='width: 100%; height: 85vh; display: none;'>";

                                                                            echo "<div class='main-container'><div class='image-container'></div></div>";
                                                                        }

                                                                        if($image_video_count == 1){
                                                                            echo "<div id='image-overlay'></div>";
                                                                        }

                                                              
                                                              echo "</div>
                                                                    <div class='col-md-4'>
                                                                        <div class='d-block'>
                                                                            <div class='card'>
                                                                                <div class='col-md-12'>
                                                                                    <h4 class='heading m-3'>
                                                                                        Comments
                                                                                        <span class='clear_pins'>Clear Pins</span>
                                                                                        <span class='show_all_pins'>Show All</span>
                                                                                    </h4>
                                                                                </div>
                                                                                <div class='card-body cmt-card-body comment_body_card_".$selectArray['id']."'>";
                                                                                    $comment_query = " SELECT * FROM comment_table WHERE image_video_id = '".$selectArray['id']."' ORDER BY id ASC ";
                                                                                    $comment_result = mysqli_query($conn, $comment_query);
                                                                                    
                                                                                    $var = 0;
                                                                                    if(mysqli_num_rows($comment_result) > 0){
                                                                                        while ($comment_array = mysqli_fetch_array($comment_result)) {
                                                                                            $var++;
                                                                                            $user_array = json_decode(get_data_from_id($comment_array['user_id'], 'user_table', $conn), true);
                                                                                                if($comment_array['user_id'] == $_SESSION['id']){
                                                                                                    echo "<div class='message-div-1'><div class=' mb-3 my-comment'>";
                                                                                                }
                                                                                                else{
                                                                                                    echo "<div class='message-div'><div class=' mb-3 comment'>";
                                                                                                }
                                                                                                echo "<p class='mb-0'>
                                                                                                            <b>".$user_array['full_name']."</b><br>";
                                                                                                       
                                                                                                            if($comment_array['x_coordinate'] != 0){
                                                                                                                echo "<img src='../assets/images/pin-image.png' class='pin_location_button' data-id='".$comment_array['id']."' data-name='".$attachmentType."'> at ".$comment_array['video_seconds']." seconds<br>";
                                                                                                            }
                                                                                                       
                                                                                                            echo $comment_array['comment'];
                                                                                                    
                                                                                                echo "</p><span>".date('d-m-Y h:i A', strtotime($comment_array['create_date']))."</span>";

                                                                                                        if($comment_array['x_coordinate'] != 0){
                                                                                                            if($comment_array['resolve_flag'] == 0){
                                                                                                                echo "<span class='resolve_comment' data-id='".$comment_array['id']."' data-name='".$_SESSION['id']."'>Resolve Comment</span>";
                                                                                                            }
                                                                                                            else{
                                                                                                                $resolve_user_data = json_decode(get_data_from_id($comment_array['resolve_by'], 'user_table', $conn), true);

                                                                                                                echo "<span class='comment_resolved'>Comment Resolved by ".$resolve_user_data['full_name']." on ".date('d-m-Y', strtotime($comment_array['resolve_date']))."</span>";
                                                                                                            }
                                                                                                        }
                                                                                          echo "</div>
                                                                                            </div>";

                                                                                        }
                                                                                    }
                                                                                    else{
                                                                                        echo "<div class='message-div-1'>
                                                                                                <div class=' mb-3 my-comment'>
                                                                                                    <p class='mb-0'>
                                                                                                        <b>No Comments!</b>
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>";
                                                                                    }

                                                                          echo "</div>
                                                                                <div class='col-md-12 card-footer'>
                                                                                    <form id='add-menu-form'>
                                                                                        <div class='comment-bx'>
                                                                                            <div class='row'>
                                                                                                <input type='hidden' name='type' value='add-comment'>
                                                                                                <input type='hidden' name='x_coordinate' value='0'>
                                                                                                <input type='hidden' name='y_coordinate' value='0'>
                                                                                                <input type='hidden' name='video_seconds' value='0'>
                                                                                                <input type='hidden' name='type' value='add-comment'>
                                                                                                <input type='hidden' name='image_video_id' value='".$selectArray['id']."'>
                                                                                                <input type='hidden' name='unique_id' value='".$project_array['id']."'>
                                                                                                <input type='hidden' name='user_id' value='".$_SESSION['id']."'>
                                                                                                <div class='col-lg-10 col-9'>
                                                                                                    <textarea class='from-control comment-text' placeholder='Enter Your Comment Here...' name='comment' style='width:100%' rows='2'></textarea>
                                                                                                </div>
                                                                                                <div class='col-3 col-lg-2'>
                                                                                                    <button type='submit' name='delete' value='Submit' class='btn btn-primary'><i class='fa fa-paper-plane'></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                            }
                                        }
                                        else{
                                            echo "-";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>
<?php  
    echo"<div class='modal fade Delete_Modal add_comment".$project_array['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title text-white mt-0' id='mySmallModalLabel'>Add Member</h5>
                    <button class='btn text-white' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>
                        <i class='fa fa-times'></i>
                    </button>
                </div>
                <div class='modal-body'>
                    <form id='add-menu-form'>
                        <input type='hidden' name='type' value='add-comment'>
                        <input type='hidden' name='unique_id' value='".$project_array['id']."'>
                        <input type='hidden' name='user_id' value='".$_SESSION['id']."'>
                        <div class='form-group col-lg-12 col-12'>
                            <div class='input-label'>
                                <label>Add Comment <sup class='text-danger'>*</label>
                            </div>
                            <textarea class='from-control' name='comment' style='width:100%' rows='2'></textarea>
                        </div>
                        <input type='submit' name='delete' value='Submit' class='btn btn-primary mt-2' style='border-radius: 5px'>
                        <button class='btn btn-danger mt-2' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 5px; margin-left: 10px;'>Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>";
?>
