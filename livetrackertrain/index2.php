<?php
require_once("phpFlickr.php");
$trainId = "NSLT1023RDC";
$trainDesc = "A train to Rotterdam";
$photoUri = isset($_POST['photouri']) ? $_POST['photouri'] : '';
$buttonCount = 1;

//prepare for upload
if (isset($photoUri) && $buttonCount == 1){


   $buttonCount++;

   define('UPLOAD_DIR', 'user_photo/');


   $photoUri = str_replace('data:image/jpeg;base64,', '', $photoUri);
   $photoUri = str_replace(' ', '+', $photoUri);

   $data = base64_decode($photoUri);
   $file = UPLOAD_DIR . uniqid() . '.jpeg';

   $success = file_put_contents($file, $data);

   uploadPhoto($file, $trainId, $trainDesc, $trainId);

   $buttonCount = 0;
   header("location: index.php");
}
//upload photo to flickr
function uploadPhoto($path, $title, $trainDesc, $trainId) {
   $apiKey = "9e069f94ffc61e36c6d16eb2607be0cf";
   $apiSecret = "c08da6727406c311";
   $permissions  = "write";
   $token        = "72157665784198805-8cb30e758a5e47a4";

   $f = new phpFlickr($apiKey, $apiSecret, true);
   $f->setToken($token);
   return $f->sync_upload($path, $title, $trainDesc, $trainId);
}


