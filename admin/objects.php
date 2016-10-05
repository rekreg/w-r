<?php
header("Content-Type: text/html; charset=UTF-8"); 
error_reporting(E_ALL & ~E_NOTICE);
require_once("includes/init.php");



if(!$session->is_signed_in()) {
redirect("login.php");
}

$objects = object_u::find_all_by_user_id($session->user_id);


$table = object_u::draw_table_with_obj($objects);

/*echo "<pre>";
print_r($objects);
echo "</pre>";*/

// Инициируем сессию
  //session_start();



//База данных
//require_once("bd/bd_connection.php");
//require_once("bd/show_data.php");

// Подключаем массивы







?>
<?php require_once("includes/header.php")?>
<body>


<?php include("includes/top_nav.php"); ?>

<div class="container">



<div class="row">
<div class="col-sm-12">

<h1 class="text-center">Мои объявления</h1>
    
   
<br><br>
<?php 

  
    
    

  
    
switch ($session->action_checker()) {
    case "update":
        echo $alert->alert_success("Ваше объявление успешно обновлено!"); 
        break;
    case "delete":
       echo $alert->alert_danger("Ваше объявление успешно удалено!"); 
        break;
    
}    
    
    
    
    
    
    
    
    ?>
    
    
    
</div>
</div><!-- end row 3 -->

<div class="row">

    
    
                       
<div class="col-md-12">
   
    <?=$table?>
    
    
    
                        </div>                        
                        
           
    
    
    
    
    
</div>
<!-- Form row -->


<br><br><br><br>

    
    






</div><!-- end container-->

<br>
<br>
<br>
<br>


    
    <?php include("includes/footer.php"); ?>





<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery_price_format.js"></script>
<script src="js/maskedinput.js"></script>
<script src="dist/js/bootstrap-select.js"></script>
<script src="dist/js/i18n/defaults-ru_RU.js"></script>
    
<script src="plugins/bootstrap-confirm-delete/bootstrap-confirm-delete.js"></script>  
 


<script>
  $(document).ready(function () {



$( '.del_object' ).bootstrap_confirm_delete(
{
            
            heading:            'Удаление объявления',
            message:            'Вы уверены, что хотите удалить это объявление?',
            btn_ok_label:       'Да',
            btn_cancel_label:   'Отмена'
           
        }

);

      
 
	
  });
</script> 

   


</body>
</html>