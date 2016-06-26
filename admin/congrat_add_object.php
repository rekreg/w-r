<?php 

require_once("includes/init.php");



if(!$session->is_signed_in()) {
    
 //redirect("login.php");   
    
}





?>

<?php require_once("includes/header.php");?>
<body>
<?php include("includes/top_nav.php"); ?>

<div class="container">
	<div class="row">
    
    <div class="col-xs-12">
    
     <div class="jumbotron text-center center-block" style="">
   <h2>Ваше объявление добавлено!</h2>
  
  <p>Оно появится в поиске в течении 30 мин. после проверки модератором.</p>
         
         <a href="new_object.php" class="btn btn-lg btn-success">
         
             Добавить еще одно объявление
         
         </a>
  
  


  <br>
  <!--<p><a class="btn btn-info btn-lg" href="egrp-online.php" role="button">Заказать еще одну выписку из ЕГРП</a></p>-->
  
  
  </div>

    
    
    </div>
    
    
    
    
    </div>
</div>


    
    <?php include("includes/footer.php"); ?>

<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>