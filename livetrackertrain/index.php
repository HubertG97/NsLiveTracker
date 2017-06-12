<?php
//post photo to next page
if (isset($_POST['upload'])) {

    if (empty($_POST["photouri"])) {
        $photoUri = $_POST["photouri"];
        $_SESSION["uri"] = $photoUri;
        var_dump($photoUri);
    }
}


?>

<!doctype html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>WebcamJS Test Page</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="https://code.jquery.com/jquery-2.2.2.js"></script>
</head>
<body>
<div class="jumbotron">
<h1>NS LIVE TRACKER</h1>
</div>

<div id="my_photo_booth" class="jumbotron">
    <div id="my_camera"></div>
    

    <!-- First, include the Webcam.js JavaScript Library -->
    <script type="text/javascript" src="js/webcam.js"></script>

    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
        Webcam.set({
            // live preview size
            width: 640,
            height: 480,

            // device capture size
            dest_width: 640,
            dest_height: 480,

            // final cropped size
            crop_width: 640,
            crop_height: 480,

            // format and quality
            image_format: 'jpeg',
            jpeg_quality: 90,

            // flip horizontal (mirror mode)
            flip_horiz: false
        });
        Webcam.attach( '#my_camera' );
    </script>

    <!-- A button for taking snaps -->

    <form>
        <div id="pre_take_buttons">
            <!-- This button is shown before the user takes a snapshot -->
            <input id="button" type="button" value="Foto!" onClick="preview_snapshot()">
        </div>
        <div class="takebutton" id="post_take_buttons" style="display:none">
            <!-- These buttons are shown after a snapshot is taken -->
            <input type=button value="&lt; Take Another" onClick="cancel_preview()">
            <input type=button value="Save Photo &gt;" onClick="save_photo()" style="font-weight:bold;">
        </div>
    </form>
</div>

<div id="results" style="display:none">
    <!-- Your captured image will appear here... -->
</div>

<!-- Code to handle taking the snapshot and displaying it locally -->
<script language="JavaScript">
    // preload shutter audio clip
    var shutter = new Audio();
    shutter.autoplay = false;
    shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

    function preview_snapshot() {
        // play sound effect
        try { shutter.currentTime = 0; } catch(e) {;} // fails in IE
        shutter.play();

        // freeze camera so user can preview current frame
        Webcam.freeze();

        // swap button sets
        document.getElementById('pre_take_buttons').style.display = 'none';
        document.getElementById('post_take_buttons').style.display = '';
    }

    function cancel_preview() {
        // cancel preview freeze and return to live camera view
        Webcam.unfreeze();

        // swap buttons back to first set
        document.getElementById('pre_take_buttons').style.display = '';
        document.getElementById('post_take_buttons').style.display = 'none';
    }

    //ajax call for post
    function upload_photo(photoUri){

        $.ajax({
            url: 'index2.php' ,
            type: 'POST',
            data: photoUri,
            success: function(data) {
                console.log(data);



            }
        });

    }
// save taken photo
    function save_photo() {
        // actually snap photo (from preview freeze) and display it
        Webcam.snap( function(data_uri) {
            var photoUri = data_uri;
            // display results in page
            document.getElementById('results').innerHTML =
                    '<h2 class="title">Hier is uw foto!</h2>' +
                    '<img src="'+data_uri+'"/><br/></br>' +
                        '<Form Name ="form" Method ="POST" ACTION = "index2.php">'+
                        '<input type="hidden"  name="photouri" value=\'' + photoUri + '\'>'+
                    '<input type=submit name=upload value="upload" style="font-weight:bold;">' +
                        '</form>';

            // shut down camera, stop capturing
            Webcam.reset();

            // show results, hide photo booth
            document.getElementById('results').style.display = '';
            document.getElementById('my_photo_booth').style.display = 'none';
        } );
    }
</script>

</body>
</html>