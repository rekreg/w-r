<?php 
$name="";
$city="";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $name = $_POST['name'];
    $city = $_POST['city'];
    
    echo "Привет, ".$name. "! Ты живешь в лучшем городе России, который называется ".$city;
    
    
}




?>