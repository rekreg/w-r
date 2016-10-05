<?php

require_once("../includes/init.php");

/*

$photo_name = "d896a6e3277fa98782c1e874693c0f39.jpg";
$photo = Photo::find_photo_by_name($photo_name);    
print_r($photo);
exit;
*/

if(empty($_GET['file_name'])) {
    //redirect("../photos.php");
} else {
    
$photo = Photo::find_photo_by_name($_GET['file_name']);    
if($photo) {

 $photo->delete_photo();

 $output = [];
 echo json_encode($output);
    
    
    
} else {
    
 //redirect("../photos.php");   
    
}
    
}











////////////////////////////////////
/*$remove = $_GET['file_name'];


//$file_name = urldecode($_GET['file_name']);

unlink("images/".$remove);

$output = [];

echo json_encode($output);*/
    


?>