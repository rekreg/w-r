<?php
ini_set('max_execution_time', 600);
header("Content-Type: text/html; charset=UTF-8"); 
error_reporting(E_ALL & ~E_NOTICE);
require_once("includes/init.php");




//while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
while($building = Building::find_buildings_by_quantity(1)) {	
		 
	
        $kad_number = $building[0]->kad_number;

        $objects = Object_m::find_all_objects_by_kad($kad_number);

        $data_arr = Object_m::get_data_by_building($objects);
    
        Building::update_building($data_arr, $kad_number);

    
    
    }
     
     
	 
    
    
   // $main_appartment_table = Object_m::main_appartment_table($objects);
    
    
  
  




?>
<?php require_once("includes/header.php")?>
<body>


<?php include("includes/top_nav.php"); ?>

<div class="container">



<div class="row">
<div class="col-lg-12">

<h1 class="text-center">  
 Data to DB
    </h1>
    

<br><br>
</div>
</div><!-- end row 3 -->

    
    
  
    
    

    
    
    
    
    
    
    
<div class="row">
<div class="col-lg-12">
<?php 
    
echo "<pre>";
 print_r($building);   
echo "</pre>";
    
   
        
        
        
echo "<hr>";
echo "<pre>";
 print_r( $data_arr);   
echo "</pre>";
    
echo "<hr>";
echo "<pre>";
 print_r($objects);   
echo "</pre>";
    
    
   
    
    
    
    ?>
</div>
</div>


<br><br><br><br>

    
    


<div class="row">

<div class="col-lg-12">

</div>
</div>






</div><!-- end container-->

<br>
<br>
<br>
<br>


    
    <?php include("includes/footer.php"); ?>





<script src="js/jquery-2.1.4.min.js"></script>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="js/bootstrap.min.js"></script>




   


</body>
</html>