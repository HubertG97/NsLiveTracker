<?php
//require_once ("phpFlickr.php");
//$tag = 'nslt1023rdc';
//function flickr_feed () {
//    $f = new phpFlickr("9e069f94ffc61e36c6d16eb2607be0cf", "c08da6727406c311");
//    $tags = $f->photos_search(array("user_id"=>"140054684@N02", "sort"=>"interestingness-desc","per_page"=>"20"));
//
//
//    $counter="0";
//    foreach ($tags['photo'] as $photo) {
//        if($counter =="0" || $counter =="5" || $counter =="10" || $counter =="15") { $first = " first"; } else { $first = ""; }
//        echo '<div class="flickr-thumb'.$first.'">
//    			<a rel="nofollow" target="_blank" href="http://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'.jpg" title="'.$photo['title'].'">
//    			<img src="http://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'_s.jpg" alt="'.$photo['title'].'"></a>
//    		</div>';
//        $counter++;
//    }
//}
////flickr_feed('ns');
//flickr_feed();

$page = $_SERVER['PHP_SELF'];
$sec = "10";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="style/stylesheet.css">
</head>
<body>
<div class="jumbotron">

    <p>NS live tracker Intercity Dordrecht 19:23</p>

</div>
<div class="pictures">
    <br>
    <iframe src="http://free.timeanddate.com/clock/i54ve166/n16/szw110/szh110/hoc000/hbw4/cf100/hgr0/fav0/fiv0/mqc000/mqs3/mql25/mqw6/mqd96/mhc000/mhs3/mhl20/mhw6/mhd96/mmc000/mms3/mml10/mmw2/mmd96/hhw16/hmw16/hmr4/hsc000/hss3/hsl90" frameborder="0" width="110" height="110"></iframe>
    <br>

    <br>
    <div class="container">


        <?
        //Find flickr feed
        require_once ("phpFlickr.php");
        $tag = 'nslt1023rdc';
        function flickr_feed () {
            $f = new phpFlickr("9e069f94ffc61e36c6d16eb2607be0cf", "c08da6727406c311");
            $tags = $f->photos_search(array("user_id"=>"140054684@N02", "sort"=>"interestingness-desc","per_page"=>"20"));


            $counter="0";
            foreach ($tags['photo'] as $photo) {
                if($counter =="0" || $counter =="5" || $counter =="10" || $counter =="15") { $first = " first"; } else { $first = ""; }
                echo '<img class="box" height="150" width="200" src="http://farm'.$photo['farm'].'.static.flickr.com/'.$photo['server'].'/'.$photo['id'].'_'.$photo['secret'].'.jpg" title="'.$photo['title'].'">';
                $counter++;
            }
        }

        flickr_feed();
        ?>
    </div>
    <br>
    <br>
    <br>


</div>

<footer><a href="https://stud.hosted.hr.nl/0918991/livetracker/Pages/index.html">CLE 3 TEAM ©</a></footer>
</body>
</html>
