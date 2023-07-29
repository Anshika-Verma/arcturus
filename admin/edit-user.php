<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>
<?php  
    $id = $_GET['id'];
    $array = json_decode(get_data_from_id($id, 'user_table', $conn), true);
?>

    <div class='main-content'>
        <div class='page-content'>
            <div class='container-fluid'>

                <!-- start page title -->
                <div class='row'>
                    <div class='col-12'>
                        <div class='page-title-box d-flex align-items-center justify-content-between'>
                            <h4 class='mb-0'>Edit User</h4>
                            <div class='page-title-right'>
                                <ol class='breadcrumb m-0'>
                                    <li class='breadcrumb-item'><a href='javascript: void(0);'><?php echo $website ?></a></li>
                                    <li class='breadcrumb-item active'>Edit User</li>
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
                                    <h4 class='heading'>Personal Details</h4>
                                    <div class="row">
                                        <input type="hidden" name="type" value="edit-user">
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <div class="form-group col-lg-3 col-12">
                                            <div class="input-label">
                                                <label>Full Name <sup class="text-danger">*</sup></label>
                                            </div>
                                            <input type="text" class="form-control" name="full_name" value="<?php echo $array['full_name'] ?>" placeholder="Enter Full Name" required>
                                        </div>
                                        <div class="form-group col-lg-3 col-12">
                                            <div class="input-label">
                                                <label>Email <sup class="text-danger">*</sup></label>
                                            </div>
                                            <input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $array['email'] ?>" required>
                                        </div>
                                        <div class="form-group col-lg-3 col-12">
                                            <div class="input-label">
                                                <label>Mobile Number <sup class="text-danger">*</sup></label>
                                            </div>
                                            <input type="text" class="form-control" name="mobile_number" placeholder="Enter Mobile Number" required onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="10" value="<?php echo $array['mobile_number'] ?>">
                                        </div>
                                        <div class="form-group col-lg-3 col-12">
                                            <div class="input-label">
                                                <label>Company Name <sup class="text-danger">*</sup></label>
                                            </div>
                                            <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" required value="<?php echo $array['company_name'] ?>">
                                        </div>
                                        <div class="form-group col-lg-3 col-12">
                                            <div class="input-label">
                                                <label>Password <sup class="text-danger">*</sup></label>
                                            </div>
                                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required value="<?php echo $array['password'] ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-center mt-3">
                                            <input type="submit" class="btn themeBtn" class="align-items-center"  name="submit" value="Update">
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
