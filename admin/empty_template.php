<?php
header("Content-Type: text/html; charset=UTF-8"); 
error_reporting(E_ALL & ~E_NOTICE);
require_once("includes/init.php");



if(!$session->is_signed_in()) {
//redirect("login.php");
} 




if($_SERVER['REQUEST_METHOD'] == 'POST') {



} // end if($_SERVER['REQUEST_METHOD'] == 'POST')


?>
<?php require_once("includes/header.php")?>
<body>


<?php include("includes/top_nav.php"); ?>

<div class="container">






</div><!-- end container-->

<br>
<br>
<br>
<br>


    
    <?php include("includes/footer.php"); ?>





<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="dist/js/bootstrap-select.js"></script>
<script src="dist/js/i18n/defaults-ru_RU.js"></script>

<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/formValidation.min.js"></script>
<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/language/ru_RU.js"></script>
    
    
    
    
    

    
    

<!--ДАДАТА подсказки -->   
    
<!--[if lt IE 10]>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>
<![endif]-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.suggestions/16.5.1/js/jquery.suggestions.min.js"></script>

    
    
 
    

    
    
    
    
    
    
    
    
    
    
    

<script>
  $(document).ready(function () {

 
   
   
      
      
      
  }); // end document.ready
    
  
    
    
    
</script> 

    
    

   


</body>
</html>