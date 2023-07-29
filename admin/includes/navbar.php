    <body>

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            
            <header id="page-topbar">
                <div class="navbar-header" style="background:#2d91ae !important">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" style="background:#2d91ae !important">
                            <a href="dashboard.php" class="logo logo-dark">
                            </a>

                            <a href="dashboard.php" class="logo logo-light">
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                            <i class="fa fa-fw fa-bars" style="color: #fff;"></i>
                        </button>

                        
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="uil-minus-path" style="color: #fff;"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="../assets/images/admin.png"
                                    alt="Header Avatar">
                                <?php 

                                    $getUser = json_decode(get_data_from_id($user_id,'user_table', $conn), true) ;

                            
                                    echo"<span class='d-none d-xl-inline-block ms-1 fw-medium font-size-15' style='color: #fff;'>".$getUser['full_name']."</span>";
                                ?>
                                <i class="uil-angle-down d-none d-xl-inline-block font-size-15" style="color: #fff;"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="logout.php"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sign out</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>