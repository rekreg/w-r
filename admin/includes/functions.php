<?php 

function __autoload($class){
    
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";

if(file_exists($the_path)) {
    
    require_once($the_path);
    
} else {
    
  die("This file name {$class}.php was not found man....");  
    
}


}

function redirect($location){
 header("Location: {$location}");   
}

   
function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
     $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
}  
    
    




?>