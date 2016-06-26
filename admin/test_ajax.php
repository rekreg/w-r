<?php
header("Content-Type: text/html; charset=UTF-8"); 
error_reporting(E_ALL & ~E_NOTICE);



?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <title>ЖК Синяя Птица / ул. Старокачаловская, д. 6</title>
 
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">

<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="dist/js/bootstrap-select.js"></script>
<script src="dist/js/i18n/defaults-ru_RU.js"></script>


<script>
  $(document).ready(function(){
    $("button").click(function(){
        $.post("content.php",
        {
          name: "Андрей",
          city: "Москва"
        },
        function(data,status){
           $("#div1").html(data);
        });
    });
});
</script>   
    
    
    
    
</head>
<body>
 <div class="container"> 
     <div class="row">
         <div class="col-lg-12">
  <div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>

<button class="btn btn-info">Get External Content</button>  
    </div>
    </div>
     </div>
    
    
</body>
</html>