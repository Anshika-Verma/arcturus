<!----========== Left Sidebar Start ==========--->
<div class="vertical-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box text-center">
        <a href="dashboard.php" class="logo logo-dark">
            <span class="logo-sm">
                <!-- <img src="../assets/images/logo.jpeg"  alt="logo" height="25" style="margin: 0px -19px;"> -->
            </span>
            <span class="logo-lg">
                <img src="../assets/images/logo.jpeg"  alt="logo"  style="margin-top: 2px; height: 45px;" alt="logo" height="50">
                <h6 style=" font-size: 18px;color: #0a15fc;">InteractPro</h6>
            </span>
        </a>
        <a href="dashboard.php" class="logo logo-light"></a>
    </div>
    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars "></i>
    </button>
    <div data-simplebar class="sidebar-menu-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->

            <ul class='metismenu list-unstyled' id='side-menu'>
                <li>
                    <a href='dashboard.php' class='waves-effect'><i><img src="../assets/images/icons/dashboard.png"></i><span> Dashboard </span></a>
                </li>
                <?php if($_SESSION['access_token'] == 'admin'){ ?>
                    <hr class="text-white">
                    <li class="menu-title">Users</li>
                    <li>
                        <a href='add-user.php' class='waves-effect'><i><img src="../assets/images/icons/employees.png"></i><span> Add User </span></a>
                    </li>
                    <li>
                        <a href='user-list.php' class='waves-effect'><i><img src="../assets/images/icons/shortlist.png"></i></i><span> Users List </span></a>
                    </li>
                <?php } ?>
                <hr class="text-white">
                <li class="menu-title">Projects</li>
                <?php if($_SESSION['access_token'] == 'admin'){ ?>
                    <li>
                        <a href='add-project.php' class='waves-effect'><i><img src="../assets/images/icons/project.png"></i><span> Add Project </span></a>
                    </li>
                <?php } ?>
                <li>
                    <a href='projects-list.php' class='waves-effect'><i><img src="../assets/images/icons/project-list.png"></i><span> Projects List </span></a>
                </li>
                <li>
                    <a href='projects-archive.php' class='waves-effect'><i><img src="../assets/images/icons/project-list.png"></i><span> Projects Archive </span></a>
                </li>
                <!-- <li>
                    <a href='Project-report.php' class='waves-effect'><i><img src="../assets/images/icons/report.png"></i><span> Projects Report </span></a>
                </li> -->
                <hr class="text-white">
                <!-- <li> -->
                    <!-- <a href='send-mail.php' class='waves-effect'><i><img src="../assets/images/icons/gmail.png"></i><span> Send Mail</span></a> -->
                <!-- </li> -->
                <li>
                    <a href='logout.php' class='waves-effect'><i><img src="../assets/images/icons/switch.png"></i><span> Log Out</span></a>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End--->   