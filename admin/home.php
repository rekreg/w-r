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

<div class="jumbotron">

    <div class="container">
    
    <div class="row">    
        
    <div class="col-xs-12">
        
        
  
        
    <form class="form-inline">
  
   
    

    
  <div class="input-group">
  
<span class="input-group-addon" style="border: 0px; width: 0px; padding: 0px;"></span>
      
      
        <select class="selectpick form-control" name="buy_sell" id="buy_sell" >
          <option>Купить</option>
          <option>Снять</option>
        </select>
                    
      
     <span class="input-group-addon" style=" !important; border: 0px; width: 0px; padding: 0px;"></span>
 
   
          <select class="selectpick form-control " name="object" id="object" style="border-radius: 0px;">
          <option>Квартиру</option>
          <option>Комнату</option>
        </select>
                    
      
      
      
      <span class="input-group-addon" style="border: 0px; width: 0px; padding: 0px;"></span>

   
          <select class="selectpick form-control " name="region" id="region">
          <option>Москва</option>
          <option>Московская область</option>
        </select>
                    
      
      
    <!-- <span class="input-group-btn"> 
  <button type="submit" class="btn btn-default btn-lg">Найти</button>
  </span>-->
  </div>
  
 
        
     
        
        
         
        
        
        
        
        
        
        
        
        
        
        
        
  <!--      

      <div class="form-group">
       <label for="buy_sell" class="sr-only">Password</label>    
          
        <select class="form-control" name="buy_sell" id="buy_sell">
          <option>Купить</option>
          <option>Снять</option>
        </select>
        
    </div>
        
        
      <div class="form-group">
       <label for="object" class="sr-only">Объект</label>    
          
        <select class="form-control" name="object" id="object">
          <option>Квартиру</option>
          <option>Комнату</option>
        </select>
        
    </div>
        
        
         <div class="form-group">
       <label for="region" class="sr-only">Регион</label>    
          
        <select class="form-control" name="region" id="region">
          <option>Москва</option>
          <option>Московская область</option>
        </select>
        
    </div>-->
           
        
        
    <div class="form-group">
  <button type="submit" class="btn btn-default btn-lg">Найти</button>
        </div>    
        
  </form>
        
        
    </div>
    
    
    </div>
    
    
    </div>
    

    
</div>    
    
    
    
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

 
   
   $('#buy_sell').selectpicker({
  title: null,
  container: 'body'
       
});
      
      
      $('#object').selectpicker({
  title: null,
  container: 'body'
         
});   
      
      
      
      $('#region').selectpicker({
  title: null,
  container: 'body'
  
});   
      
   // $('.selectpicker').selectpicker({ 'selectedText': '',style:'btn-lg btn-primary' });  
      
  }); // end document.ready
    
  
    
    
    
</script> 

    
    

   


</body>
</html>