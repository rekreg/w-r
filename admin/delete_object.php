<?php require_once("includes/init.php"); 

if(!$session->is_signed_in()) {
//redirect("login.php");
}



if(empty($_GET['id'])) {
    redirect("objects.php");
} else {
    
$object = Object_u::find_by_id($_GET['id']);    
if($object) {
 $object->delete_object();
 $session->action_maker("delete");
 redirect("objects.php");
} else {
    
 redirect("objects.php");   
    
}
    
}
?>
  