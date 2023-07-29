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
                            <h4 class='mb-0'>User List</h4>
                            <div class='page-title-right'>
                                <ol class='breadcrumb m-0'>
                                    <li class='breadcrumb-item'><a href='javascript: void(0);'><?php echo $website ?></a></li>
                                    <li class='breadcrumb-item active'>User List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="heading">List of Users</h4>
                                  <div class="row">
                                    <!-- <div class="col-md-12 d-flex justify-content-end"> -->
                                         <!-- <a class="btn btn-warning buttons-excel buttons-html5" href="export.php?type=officers" style="float: right;"> Export Report</a> -->
                                    <!-- </div> -->
                                    <div class="col-md-12 mt-3" style="overflow-x: auto;">
                                        <table id="datatable2" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; overflow-x: auto; text-align: center;">
                                            <thead>    
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile Number</th>
                                                    <th>Company Name</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                                <?php
                                                    $getQuery = "SELECT * FROM user_table WHERE delete_flag = '0' AND access_token != 'admin' ORDER BY full_name ASC";
                                                    $getResult = mysqli_query($conn, $getQuery);
                                                    $getCount = 0;

                                                    if(mysqli_num_rows($getResult) > 0){
                                                        while($getArray = mysqli_fetch_array($getResult)){
                                                            $getCount++;
                                                            echo "<tr>
                                                                    <td class='text-center'>".$getCount."</td>
                                                                    <td>".$getArray['full_name']."</td>
                                                                    <td>".$getArray['email']."</td>
                                                                    <td>".$getArray['mobile_number']."</td>
                                                                    <td>".$getArray['company_name']."</td>
                                                                    <td class='text-center'>
                                                                        <a href='edit-user.php?id=".$getArray['id']."' class='btn-sm btn btn-primary'>
                                                                            <i class='fa fa-edit'></i>
                                                                        </a>                                
                                                                        <button class='btn-sm btn btn-danger' data-bs-toggle='modal' data-bs-target='.delete".$getArray['id']."'>
                                                                            <i class='fa fa-trash-alt'></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <div class='modal fade Delete_Modal delete".$getArray['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
                                                                    <div class='modal-dialog'>
                                                                        <div class='modal-content'>
                                                                            <div class='modal-header'>
                                                                                <h5 class='modal-title text-white mt-0' id='mySmallModalLabel'>Delete</h5>
                                                                                <button class='btn text-white' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>
                                                                                    <i class='fa fa-times'></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class='modal-body'>
                                                                                <p>Do you Really want to delete user - <b>".$getArray['full_name']."</b> ?</p>
                                                                                <form class='delete_action'>
                                                                                    <input type='hidden' name='type' value='delete_action'>
                                                                                    <input type='hidden' name='table_name' value='user_table'>
                                                                                    <input type='hidden' name='mode' value='User - ".$getArray['full_name']."'>
                                                                                    <input type='hidden' name='unique_id' value='".$getArray['id']."'>
                                                                                    <input type='submit' name='delete' value='Delete' class='btn btn-danger' style='border-radius: 10px'>
                                                                                    <button class='btn btn-primary' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>Close</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>";
                                                        }
                                                    }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>
