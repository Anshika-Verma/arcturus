<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>

    <div class='main-content'>
        <div class='page-content'>
            <div class='container-fluid'>

                <!-- start page title -->
                <div class='row'>
                    <div class='col-12'>
                        <div class='page-title-box d-flex align-items-center justify-content-between'>
                            <h4 class='mb-0'>Add Project</h4>
                            <div class='page-title-right'>
                                <ol class='breadcrumb m-0'>
                                    <li class='breadcrumb-item'><a href='javascript: void(0);'><?php echo $website ?></a></li>
                                    <li class='breadcrumb-item active'>Add Project</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-md-12'>
                        <div class='card'>
                            <div class='card-body'>
                                <form id="add-menu-form">
                                    <h4 class='heading'>Add Details</h4>
                                    <div class="row">
                                        <input type="hidden" name="type" value="add-project">
                                        <div class="form-group col-lg-4 col-12">
                                            <div class="input-label">
                                                <label>Project Name <sup class="text-danger">*</sup></label>
                                            </div>
                                            <input type="text" class="form-control" name="project_name" placeholder="Enter Project Name" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-12">
                                            <div class="input-label">
                                                <label>Add Member <sup class="text-danger">*</label>
                                            </div>
                                            <select class="form-select select" multiple name="member_id[]" data-placeholder="Select Member">
                                                <?php
                                                    $member_query = "SELECT * FROM user_table WHERE delete_flag = 0 AND access_token = 'user' ";
                                                    $member_result = mysqli_query($conn,$member_query);
                                                    if (mysqli_num_rows($member_result)> 0) {
                                                        while ($member_array = mysqli_fetch_array($member_result)) {
                                                            echo "<option value='".$member_array['id']."'>".ucfirst(strtolower($member_array['full_name']))."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4 col-12">
                                            <div class="input-label">
                                                <label>Image/Video </label>
                                            </div>
                                            <input type="file" class="form-control" name="files[]" multiple accept="image/*, video/*">
                                        </div>
                                        <div class="form-group col-lg-4 col-12">
                                            <div class="input-label">
                                                <label>Document </label>
                                            </div>
                                            <input type="file" class="form-control" name="project_document" accept=".pdf">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center mt-3">
                                            <input type="submit" class="btn themeBtn" class="align-items-center"  name="submit" value="Submit">
                                            <div class="e-msg"></div>
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

<?php include 'includes/footer.php'; ?>
