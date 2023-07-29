                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © InteractPro
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class='modal fade successModal'>
            <div class='modal-dialog' style='margin-top: 15%;'>
                <div class='modal-content'>
                    <div class='modal-body' align="center">
                        <p><img src="../assets/images/success-icon.png" style="width: 200px;"></p>
                        <p class="success_text text-muted mt-5" style="font-size: 24px; font-weight: bold;"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal fade' id='myModalDelete' style="margin-top:10px">
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body' align="center">
                        <p><img src="../assets/images/delete.png" style="width: 200px;"></p>
                        <p class="modal_text mt-3" style="font-size: 14px; font-weight: bold;"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal fade failModal'>
            <div class='modal-dialog' style='margin-top: 15%;'>
                <div class='modal-content'>
                    <div class='modal-body' align="center">
                        <p><img src="../assets/images/fail-icon.png" style="width: 200px;"></p>
                        <p class="fail_text mt-5" style="font-size: 20px; font-weight: bold;"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal fade' id='myModalThankYou'>
            <div class='modal-dialog' style='margin-top: 15%;'>
                <div class='modal-content'>
                    <div class='modal-body' align="center">
                        <p><img src="../assets/images/success-icon.png" style="width: 200px;"></p>
                        <p class="modal_text text-muted mt-5" style="font-size: 24px; font-weight: bold;"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class='modal fade' id='myModalWarning'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-body' align="center" style="border: 2px solid #000; border-radius: 5px;">
                        <p><img src="../assets/images/warning-icon.png" style="width: 200px;"></p>
                        <p class="modal_text" style="font-size: 18px; font-weight: bold;"></p>
                        <div class="row">
                            <div class="col-md-12 " align="center">
                                <input type='submit' name='close' value='Okay, Got It!' class='btn btn-warning' data-bs-dismiss='modal' aria-label='Close' style='border-radius: 10px'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- JAVASCRIPT -->
        <script src="../assets/libs/jquery/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../assets/libs/node-waves/waves.min.js"></script>
        <script src="../assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="../assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <script src="../assets/js/pages/form-validation.init.js"></script>

        <!-- Required datatable js -->
        <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="../assets/libs/jszip/jszip.min.js"></script>
        <script src="../assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="../assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="../assets/js/pages/datatables.init.js"></script>

        <!-- <script src="../assets/js/pages/dashboard.init.js"></script> -->
        <script src="../assets/js/pages/form-editor.init.js"></script>
        <script src="../assets/libs/_ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
        <script src="../assets/libs/tinymce/tinymce.min.js"></script>
        <!--- excel sheet convert js cdn---->
        <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

        <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYujZRE_xymZz_X1WIzZuCoQaLH3hUWi8&libraries=places"></script> -->
        <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

        <script src='https://vjs.zencdn.net/5.10.4/video.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/r76/three.js'></script>
        <script src='https://rawgit.com/yanwsh/videojs-panorama/master/dist/videojs-panorama.v5.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js" integrity="sha512-uWKImujbh9CwNa8Eey5s8vlHDB4o1HhrVszkympkm5ciYTnUEQv3t4QHU02CUqPtdKTg62FsHo12x63q6u0wmg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../assets/js/panolens.min.js"></script>

        <script src="../assets/js/app.js"></script>
        <script src="../assets/js/script.js?v=<?php echo $version_code; ?>"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        


    </body>

</html>