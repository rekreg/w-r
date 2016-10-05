<?php 


class Alert {


    
    
    
    
public function alert_danger($txt) {
    
   $the_message = "
<div class='alert alert-dismissible alert-danger text-center'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    
    $the_message .= "<i class='fa fa-exclamation-circle' aria-hidden='true'></i> ";
  $the_message .= $txt;
    
 $the_message .= "</div>"; 
    
    return $the_message;
    
    
    
    
}     
    
    
public function alert_warning($txt) {
    
   $the_message = "
<div class='alert alert-dismissible alert-warning text-center'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    
    $the_message .= "<i class='fa fa-exclamation-circle' aria-hidden='true'></i> ";
  $the_message .= $txt;
    
 $the_message .= "</div>"; 
    
    return $the_message;
    
    
    
    
}     
        
   
public function alert_success($txt) {
    
   $the_message = "
<div class='alert alert-dismissible alert-success text-center'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    
    $the_message .= "<i class='fa fa-exclamation-circle' aria-hidden='true'></i> ";
  $the_message .= $txt;
    
 $the_message .= "</div>"; 
    
    return $the_message;
    
    
    
    
}     
   
   
public function alert_info($txt) {
    
   $the_message = "
<div class='alert alert-dismissible alert-info text-center'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>";
    
    $the_message .= "<i class='fa fa-exclamation-circle' aria-hidden='true'></i> ";
  $the_message .= $txt;
    
 $the_message .= "</div>"; 
    
    return $the_message;
    
    
    
    
}     
   


} // end class Alert



$alert = new Alert();

?>