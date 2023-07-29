<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php  
    $id = $_GET['id'];
    $array = json_decode(get_data_from_id($id, 'project_table', $conn), true);
?>

    <div class='main-content'>
        <div class='page-content'>
            <div class='container-fluid'>

                <!-- start page title -->
                <div class='row'>
                    <div class='col-12'>
                        <div class='page-title-box d-flex align-items-center justify-content-between'>
                            <h4 class='mb-0'>Edit Project</h4>
                            <div class='page-title-right'>
                                <ol class='breadcrumb m-0'>
                                    <li class='breadcrumb-item'><a href='javascript: void(0);'><?php echo $website ?></a></li>
                                    <li class='breadcrumb-item active'>Edit Project</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-8 col-12'>
                        <div class='card'>
                            <div class='card-body'>
                                <form id="add-menu-form">
                                    <h4 class='heading'>Edit Details</h4>
                                    <div class="row">
                                        <input type="hidden" name="type" value="edit-project">
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <div class="form-group col-lg-6 col-12">
                                            <div class="input-label">
                                                <label>Project Name <sup class="text-danger">*</sup></label>
                                            </div>
                                            <input type="text" class="form-control" name="project_name" placeholder="Enter Project Name" required value="<?php echo $array['project_name'] ?>">
                                        </div>
                                        <div class="form-group col-lg-6 col-12">
                                            <div class="input-label">
                                                <label>Add Member <sup class="text-danger">*</label>
                                            </div>
                                            <select class="form-select select" multiple name="member_id[]" data-placeholder="Select Member" required>
                                                <?php
                                                    $member_query = "SELECT * FROM user_table WHERE delete_flag = 0 AND access_token = 'user' AND id NOT IN (".$array['members_id'].") ";
                                                    $member_result = mysqli_query($conn,$member_query);
                                                    
                                                    if (mysqli_num_rows($member_result)> 0) {
                                                        while ($member_array = mysqli_fetch_array($member_result)) {
                                                            echo "<option value='".$member_array['id']."'>".$member_array['full_name']."</option>";
                                                        }
                                                    }

                                                    $member_query = "SELECT * FROM user_table WHERE delete_flag = 0 AND access_token = 'user' AND id IN (".$array['members_id'].") ";
                                                    $member_result = mysqli_query($conn,$member_query);
                                                    if (mysqli_num_rows($member_result)> 0) {
                                                        while ($member_array = mysqli_fetch_array($member_result)){
                                                            echo "<option value='".$member_array['id']."' selected>".$member_array['full_name']."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-12 text-center mt-4">
                                            <label></label>
                                            <input type="submit" class="btn themeBtn" class="align-items-center"  name="submit" value="Update">
                                            <div class="e-msg"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="heading">Document</h4>
                                <div class="container">
                                    <div class="row mt-3">
                                        <?php if($array['document'] != '') { ?>
                                            <div class="col-md-12 text-center">
                                               <iframe src="../assets/images/document/<?php echo $array['document'] ?>" style='width: 100%;height:200px;object-fit: contain;'></iframe>
                                            </div>
                                            <div class="col-md-12 text-center" style="padding-top: 20px;">
                                            <?php
                                                echo"<button type='button' class='btn btn-danger waves-effect waves-light' data-bs-toggle='modal' data-bs-target='.Delete".$array['id']."'>Delete</button>";
                                            ?>
                                            </div>
                                        <?php } else { ?>
                                            <form id="add-menu-form">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="type" value="edit-document">
                                                    <input type="hidden" name="id" value="<?php echo $array['id']; ?>" >
                                                    <input type="file" name="document" class="form-control" accept=".pdf" required>
                                                </div>
                                                <div class="col-md-12 text-center" style="padding-top: 20px;">
                                                    <div class="e-msg"></div>
                                                     <input type="submit" class="btn themeBtn align-items-center w-50"  name="submit" value="Update">
                                                </div>
                                            </form>
                                            
                                        <?php } ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>
<?php
    echo"<div class='modal fade Delete_Modal Delete".$array['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title text-white mt-0' id='mySmallModalLabel'>Delete</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                    </button>
                </div>
                <div class='modal-body'>
                    <p>Do you really want to delete Document?</p>
                    <form class='delete_action'>
                        <input type='hidden' name='type' value='delete_image'>
                        <input type='hidden' name='table_name' value='project_table'>
                        <input type='hidden' name='mode' value='Document'>
                        <input type='hidden' name='column_name' value='document'>
                        <input type='hidden' name='unique_id' value='".$array['id']."'>
                        <input type='submit' name='delete' value='Delete' class='btn btn-danger' style='border-radius: 10px'>
                        <button class='btn btn-primary' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>";
?>
