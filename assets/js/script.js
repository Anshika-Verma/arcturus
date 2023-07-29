$(document).ready(function() {
    //change selectboxes to selectize mode to be searchable
    $('[data-toggle="tooltip"]').tooltip();
    $('.loading').hide();

    $('form#add-menu-form').submit(function(e) {
        $('.loading').show();
        var thisEl = $(this).find('input[type="submit"]');
        thisEl.val('Please Wait...');
        thisEl.attr('disabled', 'true');
        thisEl.css('pointer-events', 'none');
        var formdata = new FormData(this);
        formdata.append('form', $(this).attr('class'));
        e.preventDefault();
        $.ajax({
            'data': formdata,
            'url': 'insert-data.php',
            'type': 'post',
            'contentType': false,
            'cache': false,
            'processData': false,
            'success': function(response) {
                var json = JSON.parse(response);
                if (!json.error) {
                    $('.modal').modal('hide');
                    $('p.success_text').addClass('success').removeClass('error').text(json.message);
                    $('.successModal').modal('show');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    $('.modal').modal('hide');
                    $('p.fail_text').removeClass('success').addClass('error').text(json.message);
                    $('.failModal').modal('show');
                    setTimeout(function() {
                        $('.failModal').modal('hide');
                    }, 2000);
                    thisEl.val('Submit');
                    thisEl.removeAttr('disabled');
                    thisEl.css('pointer-events', 'auto');
                }
                $('.loading').hide();
            }
        });
    });

    $('form#comment-form').submit(function(e) {
        $('.loading').show();
        var thisEl = $(this).find('input[type="submit"]');
        var formdata = $(this).serializeArray();
        e.preventDefault();
        $.ajax({
            'data': formdata,
            'url': 'insert-data.php',
            'type': 'post',
            'success': function(response) {
                var json = JSON.parse(response);
                if (!json.error) {

                } else {
                }
                $('.loading').hide();
            }
        });
    });

    //panel login js
    $('form#login-form').submit(function(e) {
        e.preventDefault();
        $('input[name="submit"]').val('Please Wait......');
        $('input[name="submit"]').attr('disabled', 'true');
        $('input[name="submit"]').css('pointer-events', 'none');
        var formdata = $(this).serializeArray();
        $.ajax({
            'data': formdata,
            'url': 'ajax.php',
            'type': 'post',
            'success': function(response) {
                var json = JSON.parse(response);
                if (!json.error) {
                    $('div.e-msg').addClass('success').removeClass('error').text(json.message);
                    setTimeout(function() {
                        window.location.href = 'admin/dashboard.php';
                    }, 2000);
                } else {
                    $('input[name="submit"]').val('Submit');
                    $('input[name="submit"]').removeAttr('disabled');
                    $('input[name="submit"]').css('pointer-events', 'auto');
                    $('div.e-msg').addClass('error').removeClass('success').text(json.message);
                }
            }
        });
    });

    // delete action js
    $('form.delete_action').submit(function(e) {
        e.preventDefault();
        var thisEl = $(this);
        thisEl.find('input[name="delete"]').val('Please Wait...');
        thisEl.find('input[name="delete"]').attr('disabled', 'true');
        thisEl.find('input[name="delete"]').css('pointer-events', 'none');
        var formdata = $(this).serializeArray();
        $.ajax({
            'data': formdata,
            'url': 'insert-data.php',
            'type': 'post',
            'success': function(response) {
                var json = JSON.parse(response);
                if (!json.error) {
                    $('body').find('.Delete_Modal').modal('hide');
                    $('body').find('.modal_text').text(json.message);
                    $('body').find('#myModalDelete').modal('show');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    thisEl.find('input[name="delete"]').val('Delete');
                    thisEl.find('input[name="delete"]').removeAttr('disabled');
                    thisEl.find('input[name="delete"]').css('pointer-events', 'auto');
                }
            }
        });
    });

    $('form.status_action').submit(function(e) {
        e.preventDefault();
        var thisEl = $(this);
        thisEl.find('input[name="delete"]').val('Please Wait...');
        thisEl.find('input[name="delete"]').attr('disabled', 'true');
        thisEl.find('input[name="delete"]').css('pointer-events', 'none');
        var formdata = $(this).serializeArray();
        $.ajax({
            'data': formdata,
            'url': 'insert-data.php',
            'type': 'post',
            'success': function(response) {
                var json = JSON.parse(response);
                if (!json.error) {
                    $('body').find('.status_modal').modal('hide');
                    $('body').find('.success_text').text(json.message);
                    $('body').find('.successModal').modal('show');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    thisEl.find('input[name="delete"]').val('Yes');
                    thisEl.find('input[name="delete"]').removeAttr('disabled');
                    thisEl.find('input[name="delete"]').css('pointer-events', 'auto');
                }
            }
        });
    });

    $(".select").select2();
    
});

var window_url = window.location.pathname;
var window_url_array = window_url.split('/');
window_url_array.reverse();
var page_url = window_url_array[0];

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

if(page_url == 'project-detail.php'){

    var x_coordinate = 0;
    var y_coordinate = 0;

    var timer;
    $('body').on('mousedown', '#video_player', function(){
        timer = setTimeout(function(){
            // Get the video element and image overlay element
            var video = document.getElementById("video_player");
            var imageOverlay = document.getElementById("image-overlay");

            var myPlayer = videojs('video_player');
            var whereYouAt = myPlayer.currentTime();
            myPlayer.pause();

            // Add click event listener to the video
            video.addEventListener("click", showImage);

            // Show the image overlay and position the image at the clicked coordinates
            function showImage(event) {
                // Calculate the position within the video container
                var rect = video.getBoundingClientRect();
                x_coordinate = event.clientX - rect.left;
                y_coordinate = event.clientY + 120 - rect.top;

                // Create and position the image
                var image = document.createElement("img");
                image.src = "../assets/images/comment.png";
                image.style.left = x_coordinate + "px";
                image.style.top = y_coordinate + "px";

                // Append the image to the image overlay
                imageOverlay.appendChild(image);

                // Show the image overlay
                imageOverlay.style.display = "block";

                $('body').find('input[name="x_coordinate"]').val(x_coordinate);
                $('body').find('input[name="y_coordinate"]').val(y_coordinate);
                $('body').find('input[name="video_seconds"]').val(whereYouAt);
            }

            $('body').find('.overlay-layer').show();

        }, 1500);
    }).on("mouseup mouseleave",function(){
        clearTimeout(timer);
    });

    $('body').on('click', '.close_overlay_image', function(){
        // clearTimeout(timer);
        // timer = '';
        // $('body').find('.overlay-layer').hide();
        window.location.reload();
    });

    $('body').on('mousedown', '.panolens-canvas', function(){
        console.log('hi');
        // Get the video element and image overlay element
        var video = document.getElementById("image_player");
        var imageOverlay = document.getElementById("image-overlay");

        // Calculate the position within the video container
        var rect = video.getBoundingClientRect();
        x_coordinate = video.clientX - rect.left;
        y_coordinate = video.clientY - rect.top;

        console.log(x_coordinate, y_coordinate);

        // Create and position the image
        var image = document.createElement("img");
        image.src = "../assets/images/comment.png";
        image.style.left = x_coordinate + "px";
        image.style.top = y_coordinate + "px";

        // Append the image to the image overlay
        imageOverlay.appendChild(image);

        // Show the image overlay
        imageOverlay.style.display = "block";

        $('body').find('input[name="x_coordinate"]').val(x_coordinate);
        $('body').find('input[name="y_coordinate"]').val(y_coordinate);
    });

    var project_id = getUrlParameter('id');

    function video_3d(){
        var options = {
            plugins: {
                panorama: {
                    clickAndDrag: true,
                    clickToToggle: true,
                    autoMobileOrientation: true,
                    backToVerticalCenter: false,
                    backToHorizonCenter: false
                }
            }
        };
        var player = videojs('video_player', options, function() {});
    }

    function image_3d(){
        var image_path = $('body').find('.detail-attachment').attr('src');
        const panoramaImage = new PANOLENS.ImagePanorama(image_path);
        const imageContainer = document.querySelector(".image-container");

        const viewer = new PANOLENS.Viewer({
            container: imageContainer,
            autoRotate: true,
            autoRotateSpeed: 0.3,
            controlBar: false,
        });
        viewer.add(panoramaImage);
    }

    function showImage(){
        $.ajax({
            'type' : 'post',
            'data' : 'type=get-coordinates&project_id='+project_id,
            'url' : 'insert-data.php',
            success: function(response){
                var json = JSON.parse(response);
                if(!json.error){
                    for (var i = 0; i < json.coordinates_array.length; i++) {
                        x_value = json.coordinates_array[i]['x_coordinate'];
                        y_value = json.coordinates_array[i]['y_coordinate'];

                        var imageOverlay = document.getElementById("image-overlay");

                        // Create and position the image
                        var image = document.createElement("img");
                        image.src = "../assets/images/comment.png";
                        image.style.left = x_value + "px";
                        image.style.top = y_value + "px";

                        // Append the image to the image overlay
                        imageOverlay.appendChild(image);

                        // Show the image overlay
                        imageOverlay.style.display = "block";
                    }
                }
                if(json.attachment_type == 'all'){
                    video_3d();
                    image_3d();
                }
                else if(json.attachment_type == 'image'){
                    image_3d();
                }
                else{
                    video_3d();
                }
            }
        });
    }

    // showImage();
    closeImage();

    // Close the image overlay
    function closeImage() {
        var imageOverlay = document.getElementById("image-overlay");
        // Remove all child elements from the image overlay
        while (imageOverlay.firstChild) {
           imageOverlay.removeChild(imageOverlay.firstChild);
        }

        // Hide the image overlay
        imageOverlay.style.display = "none";

        x_coordinate = 0;
        y_coordinate = 0;
    }

    $('body').on('click', '.resolve_comment', function(){
        var comment_id = $(this).data('id');
        var resolve_by = $(this).data('name');

        $.ajax({
            'type' : 'post',
            'data' : 'type=resolve_comment&comment_id='+comment_id+'&resolve_by='+resolve_by,
            'url' : 'insert-data.php',
            success: function(response){
                var json = JSON.parse(response);
                if(!json.error){
                    $('body').find('.modal_text').text(json.message);
                    $('body').find('#myModalThankYou').modal('show');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
                else{
                    $('body').find('.modal_text').text(json.message);
                    $('body').find('#myModalWarning').modal('show');
                }
            }
        });
    });
    
    $('body').on('click', '.clear_pins', function(){
        closeImage();
    });
    
    $('body').on('click', '.show_all_pins', function(){
        showImage();
    });
    
    $('body').on('click', '.pin_location_button', function(){
        var comment_id = $(this).data('id');
        var attachment_type = $(this).data('name');
        $.ajax({
            'type' : 'post',
            'data' : 'type=get-comment-coordinates&comment_id='+comment_id,
            'url' : 'insert-data.php',
            success: function(response){
                var json = JSON.parse(response);
                if(!json.error){
                    closeImage();

                    var x_value = json.x_coordinate;
                    var y_value = json.y_coordinate;
                    var imageOverlay = document.getElementById("image-overlay");

                    // Create and position the image
                    var image = document.createElement("img");
                    image.src = "../assets/images/comment.png";
                    image.style.left = x_value + "px";
                    image.style.top = y_value + "px";

                    // Append the image to the image overlay
                    imageOverlay.appendChild(image);

                    // Show the image overlay
                    imageOverlay.style.display = "block";
                    
                    var myPlayer = videojs('video_player');
                    myPlayer.currentTime(30);
                    myPlayer.play();
                    myPlayer.pause();
                }
            }
        });
    });


    $('body').on('click', '.people_list_class', function(){
        var current_user_email = $(this).data('id');

        $('body').find('textarea[name="comment"]').val($('body').find('textarea[name="comment"]').val()+' {{'+current_user_email+'}} ')
    });

}