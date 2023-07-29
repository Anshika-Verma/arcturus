<?php include 'page-header.php'; ?>
    <div class="container">
        <div class="row h-100 justify-content-center align-items-center" style="padding: 30px; margin-top: 50px;">
            <div class="col-md-9 login">
                <div class="row AppForm shadow-lg">
                    <div class="col-md-6">
                        <div class="AppFormRight position-relative d-flex justify-content-center flex-column align-items-center text-center p-5 text-white">
                            <img src="assets/images/logo.jpeg" class="login-image">
                            <h3>InteractPro</h3>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center" style="padding: 40px;background: #010cfd3b;">
                        <div class="AppFormLeft" id="login">
                            <form id="login-form" style="width: 240px;">
                                <!-- <img src="assets/images/logo.jpeg" style="height: 190px; width:250px;object-fit: contain;margin-top: -33px;"> -->
                                <!-- <h3 style="margin-bottom: 13px;text-align: center;z-index: 1; position: absolute;bottom: 170px; color: #010cfe;">InteractPro</h3> -->
                                <h4 style="margin-bottom: 40px; text-align: center;font-weight: bold; color: #fff;">Login to Continue</h4>
                                <input type="hidden" name="type" value="check-login">
                                <input type="hidden" name="latitude">
                                <input type="hidden" name="longitude">
                                <input type="hidden" name="accuracy">
                                <div class="form-group position-relative mb-4">
                                    <label style="color:#25282b"><b>Username</b></label>
                                    <input type="email" name="username" class="form-control border-right-0 border-left-0 rounded-0 shadow-none" id="username" placeholder="Enter Username">
                                </div>
                                <div class="form-group position-relative mb-4">
                                    <label style="color:#25282b"><b>Password</b></label>
                                    <input type="password" name="password" class="form-control border-right-0 border-left-0 rounded-0 shadow-none" id="password" placeholder="Enter Password">
                                </div>
                                <input type="submit" name="submit" value="Login" class="btn btn-primary form-control index-button py-2">
                                <div class="e-msg text-center pt-2"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'page-footer.php'; ?>