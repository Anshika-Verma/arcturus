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
                            <h4 class='mb-0'>Projects List</h4>
                            <div class='page-title-right'>
                                <ol class='breadcrumb m-0'>
                                    <li class='breadcrumb-item'><a href='javascript: void(0);'><?php echo $website ?></a></li>
                                    <li class='breadcrumb-item active'>Projects List</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="heading">List of Projects</h4>
                                  <div class="row">
                                    <!-- <div class="col-md-12 d-flex justify-content-end"> -->
                                         <!-- <a class="btn btn-warning buttons-excel buttons-html5" href="export.php?type=officers" style="float: right;"> Export Report</a> -->
                                    <!-- </div> -->
                                    <div class="col-md-12 mt-3" style="overflow-x: auto;">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; overflow-x: auto; text-align: center;">
                                            <thead>    
                                                <tr>
                                                    <th>#</th>
                                                    <th>Create Date</th>
                                                    <th>Project Name</th>
                                                    <th>Members</th>
                                                    <th>Status</th>
                                                    <th>Activity</th>
                                                </tr>
                                            </thead>
                                             <tbody>
                                                <?php
                                                    $getQuery = " SELECT * FROM project_table WHERE delete_flag = 0 AND status != 2 ";
                                                    if($_SESSION['access_token'] == 'user'){ 
                                                        $getQuery .= " AND ".$_SESSION['id']." IN (members_id) ";
                                                    }
                                                    $getQuery .= " ORDER BY id DESC";
                                                    $getResult = mysqli_query($conn, $getQuery);
                                                    $getCount = 0;

                                                    if(mysqli_num_rows($getResult) > 0){
                                                        while($getArray = mysqli_fetch_array($getResult)){
                                                            $getCount++;

                                                            $members_id = explode(',', $getArray['members_id']);
                                                            $member_name = array();
                                                            foreach ($members_id as $key => $value) {
                                                                $user_array = json_decode(get_data_from_id($value,'user_table',$conn),true);

                                                                $member_name[] = $user_array['full_name'];
                                                            }
                                                                // print_r($member_name);
                                                            $members_name = implode(', ', $member_name);

                                                            if($getArray['status'] == 0){
                                                                $status_btn = "<button class='btn-sm btn btn-warning' data-bs-toggle='modal' data-bs-target='.done".$getArray['id']."'>Work In Progress
                                                                        </button>";
                                                            }
                                                            elseif($getArray['status'] == 1){
                                                                $status_btn = "<button class='btn-sm btn btn-success' data-bs-toggle='modal' data-bs-target='.archive".$getArray['id']."'>Done
                                                                        </button>";
                                                            }
                                                            else{
                                                                $status_btn = "<button class='btn-sm btn btn-success'>Archive</button>";
                                                            }
                                                            
                                                            echo "<tr>
                                                                    <td class='text-center'>".$getCount."</td>
                                                                    <td>".date('d-m-Y', strtotime($getArray['create_date']))."</td>
                                                                    <td>".$getArray['project_name']."</td>
                                                                    <td style='text-align:left'>".$members_name."<br>
                                                                    </td>
                                                                    <td class='text-center'>
                                                                        ".$status_btn."
                                                                    </td>
                                                                    <td class='text-center'>
                                                                        <a class='btn-sm btn btn-info' href='project-detail.php?id=".$getArray['id']."'>
                                                                            <i class='fa fa-eye'></i>
                                                                        </a>
                                                                        <a href='edit-project.php?id=".$getArray['id']."' class='btn-sm btn btn-primary'>
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
                                                                                <p>Do you Really want to delete Project - <b>".$getArray['project_name']."</b> ?</p>
                                                                                <form class='delete_action'>
                                                                                    <input type='hidden' name='type' value='delete_action'>
                                                                                    <input type='hidden' name='table_name' value='project_table'>
                                                                                    <input type='hidden' name='mode' value='Project - ".$getArray['full_name']."'>
                                                                                    <input type='hidden' name='unique_id' value='".$getArray['id']."'>
                                                                                    <input type='submit' name='delete' value='Delete' class='btn btn-danger' style='border-radius: 10px'>
                                                                                    <button class='btn btn-primary' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>Close</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='modal fade status_modal archive".$getArray['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
                                                                    <div class='modal-dialog'>
                                                                        <div class='modal-content'>
                                                                            <div class='modal-header'>
                                                                                <h5 class='modal-title text-white mt-0' id='mySmallModalLabel'>Project Status</h5>
                                                                                <button class='btn text-white' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>
                                                                                    <i class='fa fa-times'></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class='modal-body'>
                                                                                <p>Mark this Project as <b>Archive</b> ?</p>
                                                                                <form class='status_action'>
                                                                                    <input type='hidden' name='type' value='update_status'>
                                                                                    <input type='hidden' name='table_name' value='project_table'>
                                                                                    <input type='hidden' name='status' value='2'>
                                                                                    <input type='hidden' name='unique_id' value='".$getArray['id']."'>
                                                                                    <input type='submit' name='delete' value='Yes' class='btn btn-primary' style='border-radius: 10px'>
                                                                                    <button class='btn btn-danger' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>No</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='modal fade status_modal done".$getArray['id']."' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
                                                                    <div class='modal-dialog'>
                                                                        <div class='modal-content'>
                                                                            <div class='modal-header'>
                                                                                <h5 class='modal-title text-white mt-0' id='mySmallModalLabel'>Project Status</h5>
                                                                                <button class='btn text-white' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>
                                                                                    <i class='fa fa-times'></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class='modal-body'>
                                                                                <p>Would you like to make it <b>Done</b> ?</p>
                                                                                <form class='status_action'>
                                                                                    <input type='hidden' name='type' value='update_status'>
                                                                                    <input type='hidden' name='table_name' value='project_table'>
                                                                                    <input type='hidden' name='status' value='1'>
                                                                                    <input type='hidden' name='unique_id' value='".$getArray['id']."'>
                                                                                    <input type='submit' name='delete' value='Yes' class='btn btn-primary' style='border-radius: 10px'>
                                                                                    <button class='btn btn-danger' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px; margin-left: 10px;'>No</button>
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
