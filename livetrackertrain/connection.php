<?php

// Start the session since phpFlickr uses it but does not start it itself
session_start();

require_once('phpflickr-master/phpFlickr.php');

// Create new phpFlickr object: new phpFlickr('[API Key]','[API Secret]')
$flickr = new phpFlickr('[0b14c95a8a834b0aecd909d0536c92bf]','[f5c7305bd707be51]', true);

// Authenticate;  need the "IF" statement or an infinite redirect will occur
if(empty($_GET['frob'])) {
$flickr->auth('write'); // redirects if none; write access to upload a photo
}
else {
// Get the FROB token, refresh the page;  without a refresh, there will be "Invalid FROB" error
$flickr->auth_getToken($_GET['frob']);
header('Location: flickr.php');
exit();

    
}
?>