<?php
header("Content-Type: text/html; charset=UTF-8"); 
error_reporting(E_ALL & ~E_NOTICE);
require_once("includes/init.php");


if(!$session->is_signed_in()) {
redirect("login.php");
}





if($_GET[id]) {
	
		  
   $object_id = $_GET[id];
   $apartment = Object_u::find_by_id($object_id);

    
   $building = Building::find_building_by_address($apartment); 
    
   $user = User::find_by_id($session->user_id);
    
// Формируем телефон
   $p = $user->phone;
    
   $phone = "8 (".$p[2].$p[3].$p[4].") ".$p[5].$p[6].$p[7]."-".$p[8].$p[9]."-".$p[10].$p[11];
    
   
    
    
    
    
    
    
    
     
    // Формируем адрес
    
    $address = "";
    
    if($apartment->street_type) {
     $address .= $apartment->street_type. " ";   
    }
    if($apartment->street) {
     $address .= $apartment->street. ", ";   
    }
    if($apartment->house_type) {
     $address .= $apartment->house_type. " ";   
    }
    if($apartment->house) {
     $address .= $apartment->house;   
    }
    
     if($apartment->block_type) {
     $address .= ", ".$apartment->block_type. " ";   
    }
     if($apartment->block) {
     $address .= $apartment->block. " ";   
    }
    
    // Формируем Балкон/Лоджия STRING
    $balcon_loggia_str = "";
    if($apartment->balcony) {
    
    switch($apartment->balcony) {
    case 1:  $balcon_loggia_str .= "1-балкон"; break; 
    case 2:  $balcon_loggia_str .= "2-балкона"; break;  
    case 3:  $balcon_loggia_str .= "3-балкона"; break;
    case 4:  $balcon_loggia_str .= "4-балкона"; break;
    case 5:  $balcon_loggia_str .= "5-балконов"; break;
    default: $balcon_loggia_str .= "0-балконов"; break;      
     }  
    }
    if($apartment->loggia) {
    // Добавляем пробел   
    if($apartment->balcony) { $balcon_loggia_str.= ", ";}
        
    switch($apartment->loggia) {
    case 1:  $balcon_loggia_str .= "1-лоджия"; break; 
    case 2:  $balcon_loggia_str .= "2-лоджии"; break;  
    case 3:  $balcon_loggia_str .= "3-лоджии"; break;
    case 4:  $balcon_loggia_str .= "4-лоджии"; break;
    case 5:  $balcon_loggia_str .= "5-лоджий"; break;
    default: $balcon_loggia_str .= "0-лоджий"; break;      
     }  
        
        
    }
    
    if($apartment->balcony == 0 && $apartment->loggia == 0) {
     $balcon_loggia_str = "нет";   
    }
    
    
	
    
   //$main_appartment_table = Building::main_appartment_table($building);
    
    
    
   
    // Узнаем округ
   
    switch($building->kad_district) {
        case "01": $okrug = "Центральный"; break;
        case "02": $okrug = "Северо-Восточный"; break;
        case "03": $okrug = "Восточный"; break;
        case "04": $okrug = "Юго-Восточный"; break;
        case "05": $okrug = "Южный"; break;
        case "06": $okrug = "Юго-Западный"; break;
        case "07": $okrug = "Западный"; break;
        case "08": $okrug = "Северо-Западный"; break;
        case "09": $okrug = "Северный"; break;
        case "10": $okrug = "Зеленоградский"; break;
        default: $okrug = "Не определен"; break;
	
	}


    // Географические координаты
    
    $coord = $building->latitude.", ".$building->longitude;
    
    
    // Работа с растояние до метро
    
    
   for($i=1; $i<=3; $i++){ 
   
      $var = "distance_".$i;
     
       
    if($building->$var){
      
        $distance = $building->$var;
        
    if($distance < 1000) {
     $distance = $distance.= " м";   
    } else {
        $distance =  $distance / 1000;
        $distance = round($distance, 1);
        $distance = $distance .= " км";
    }
        
        
    }
    else {
      $distance = " - ";  
    }
    $$var = $distance;
   } 

}
else {
    
redirect("index.php");    
}

?>
<?php require_once("includes/header.php")?>
<body>


<?php include("includes/top_nav.php"); ?>

<div class="container">

<div class="row">
<div class="col-md-12">
    
 <ul class="breadcrumb">
  <li><a href="#"><?=$apartment->city_type." ".$apartment->city?></a></li>
  <li><a href="#"><?=$apartment->city_area. " АО"?></a></li>
  <li><a href="#"><?=str_replace("р-н", "", $apartment->city_district);?></a></li>
  <li class="active"><?=$address?></li>
</ul>   

    
    
</div>   
    
    
</div>

<div class="row">
<div class="col-md-12">


    
    
    
    
<h1 class="text-center">  
<?=$apartment->address?> 
    
    </h1>
    

<br>
</div>
</div>
    

<div class="row">
<div class="col-md-12">


    
    
    
<!--    
<h2 class="text-center bg-danger">  
  <?=$apartment->rooms."-комнатная"?> 
     <span style="display: inline-block; padding: 0px 7px 0px 7px; border: 1px solid #317eac; border-radius: 3px;"> 
    <?=$apartment->m2_o." м² |"?>
    <?=$apartment->m2_g." м² |"?>
    <?=$apartment->m2_k." м²"?>
    </span>
    <?=$apartment->floor."-этаж"?>
   
    
    
    </h2>
   --> 

<br>
</div>
</div>

    
    
    
    
 <div class="row">
<div class="col-lg-6">
    
 <h3 class="text-center">
     <img src="img/appartment_icon.png"> 
     <?=$apartment->rooms?>-комнатная квартира </h3>
<div class="panel panel-default">
  <div class="panel-body">    
      
  
      
<!--      
<table class="table">

  <tbody>
    <tr>
     <td class="bg-danger nice_td nice_td_header" style="border-top: 1px solid #FFF; ">
        Комнат
        </td> 
        
          <td class="nice_td" style="border-top: 1px solid #FFF; ">
         <?=$apartment->rooms?>-комнатная
        </td>
      
      </tr>
    </tbody>
      </table>
     -->
 <table class="table">

  <tbody>
    <tr>
      <td class="bg-info nice_td nice_td_header" style="border-top: 1px solid #FFF">
          Общая площадь
        </td>
   <td class="nice_td" style="border-top: 1px solid #FFF">
       <?=$apartment->m2_o?> м²  
         
        
        
        </td>
     
    </tr>
      
      
    <tr>
      <td class="bg-info nice_td nice_td_header" > 
         
    Жилая площадь 

        </td>
         <td class="nice_td">
         
        
        <?=$apartment->m2_g?> м² 
        </td>
     
    </tr>
      
    
    <tr>
      <td class="bg-info nice_td nice_td_header">
          
         Площадь кухни
        </td>
         <td class="nice_td">
         <?=$apartment->m2_k?> м² 
         
        
        </td>
  
    </tr>
    <tr >
      <td class="bg-info nice_td nice_td_header" style="height: 40px;">
         
          Этаж
        
        </td>
        <td class="nice_td">
          
           <?=$apartment->floor?> из  <?=$apartment->floors?>
         
        </td>
      
    </tr>
    
  </tbody>
</table>    
   
      
      
<table class="table">

  <tbody>
    <tr>
      <td class="bg-info nice_td nice_td_header" style="border-top: 1px solid #FFF">
         Окна
        </td>
   <td class="nice_td" style="border-top: 1px solid #FFF">
       <?=$apartment->windows?>  
         
        
        
        </td>
     
    </tr>
      
      
    <tr>
      <td class="bg-info nice_td nice_td_header" > 
         
    Состояние квартиры 

        </td>
         <td class="nice_td">
         
        
        <?=$apartment->state?> 
        </td>
     
    </tr>
      
    
    <tr>
      <td class="bg-info nice_td nice_td_header">
          
         Санузел
        </td>
         <td class="nice_td">
         <?=$apartment->wc?> 
         
        
        </td>
  
    </tr>
    <tr >
      <td class="bg-info nice_td nice_td_header" style="height: 40px;">
         
          Балкон / Лоджия
        
        </td>
        <td class="nice_td">
          
           <?=$balcon_loggia_str?>
         
        </td>
      
    </tr>
    
  </tbody>
</table> 
    
    
  <table class="table">

  <tbody>
    <tr>
     <td class="bg-info nice_td nice_td_header" style="border-top: 1px solid #FFF; text-align: center">
        Описание
        </td> 
      </tr>
      <tr>
        
          <td class="nice_td" style="border-top: 1px solid #FFF; text-align: justify;">
         <?=$apartment->description?>
        </td>
      
      </tr>
    </tbody>
      </table>
      
      
            
      
      
            
<table class="table" style="margin-bottom: 5px;">

  <tbody>
    <tr>
     <td class="bg-warning nice_td nice_td_header" style="border-top: 1px solid #FFF; text-align: center; font-size: 1.5em; font-weight: bold;">
       <?=number_format($apartment->price,0,'',' ');?>
         руб.
         
         
         
        </td> 
      </tr>
     
    </tbody>
      </table>
   
            
<table class="table">

  <tbody>
    <tr>
     
        
        <td class="ipoteka_tender_how_sell_TD" style="border-top: 1px solid #FFF">
        
       <span class="label label-primary"><?=($apartment->how_sell == 1) ? "Свободная продажа" : "Альтернатива";?></span>
        </td>
        
       <td class="ipoteka_tender_how_sell_TD" style=" border-top: 1px solid #FFF">
         <span class="label label-primary"><?=($apartment->tender == 1) ? "Возможен торг" : "";?></span>
       
        </td>
        
        <td class="ipoteka_tender_how_sell_TD" style=" border-top: 1px solid #FFF">
      <span class="label label-primary"><?=($apartment->ipoteka == 1) ? "Возможна Ипотека" : "";?></span>
       
        </td>
        
        
        
        
      </tr>
     
    </tbody>
      </table>
       

      
      
      
    </div> 
     </div> 
    
    
    
    
    
    
    
    
     </div>
     
     
<div class="col-lg-6">
    
      <h3 class="text-center"><i class="fa fa-camera" aria-hidden="true"></i>  Фото</h3>   
<div class="panel panel-default">
  <div class="panel-body">
      

      
      
      
      
    <img src="img/no_photo.png" alt="..." class="center-block img-thumbnail"> 
</div>          
 
    
</div>
    
   
   <h3 class="text-center">
    
  <i class="fa fa-user" aria-hidden="true"></i> 
    <?=($user->account_type == 2) ? "Риэлтор": "Собственник"?>  
    
    
    
    </h3>
    
<div class="panel panel-primary">
<div class="panel-body">
    

      
<div class="text-center" style="font-size: 1.5em"> 
    <?=$user->username?>   
</div>

 <div class="text-center" style="font-size: 1.5em; font-weight: bold;">
 <i class="fa fa-phone" aria-hidden="true"></i> <?=$phone?>
</div> 
      
      
  </div>
</div>    
    
    
    
    

    
          
         
</div>
    </div>
    
   
    
  
    
    
    
    
    
    
    
      
 <div class="row">
<div class="col-lg-6">

    
     <h3 class="text-center"><i class="fa fa-map" aria-hidden="true"></i>  Месторасположение</h3>   
<div class="panel panel-default">
  <div class="panel-body">
      
      
          
 <table class="table">

  <tbody>
    <tr>
        <td class="bg-info nice_td nice_td_header" style="border-top: 1px solid #FFF">
            Округ 
        </td>
         <td class="nice_td" style="border-top: 1px solid #FFF">
         <?=$okrug?>  
        
        </td>
     
    </tr>
    <tr>
      <td class="bg-info nice_td nice_td_header">
           Район 
              </td>
        <td class="nice_td">
         
       <?=$building->district_str?>
        </td>
  
    </tr>
    <tr >
      <td class="bg-info nice_td nice_td_header">
          Метро 
        </td>
      <td class="nice_td">
       
          <table style="width: 100%;">
        <tr>
            <td>
           <?=$building->metro_name_1?>
            </td>
       <td style="text-align: right;">
          
            <span class="label label-warning"> <?=$distance_1?></span>

            <td></tr>  
          </table>
               
          <table style="width: 100%;">
        <tr><td><?=$building->metro_name_2?></td>
       <td style="text-align: right;">
          <span class="label label-warning"> <?=$distance_2?></span>
            <td></tr>  
          </table>

          <table style="width: 100%;">
        <tr><td><?=$building->metro_name_3?></td>
       <td style="text-align: right;">
            <span class="label label-warning"> <?=$distance_3?></span>
            <td></tr>  
          </table>
        
              
              </td>
      
    </tr>
    
  </tbody>
</table>
    <br>  
      
      
      
      
      
   <div id="map" style="width: 100%; height: 400px;" class="center-block img-thumbnail">
  </div>
</div>          
 
    
</div>
    
    
    
    
    
     </div>
     
     
<div class="col-lg-6">
    
     
    
   
    
    
    
    
          
         
</div>
    </div>
    
 <div class="row">
<div class="col-lg-6">
    
 <h3 class="text-center"><i class="fa fa-building" aria-hidden="true"></i>  Дом</h3>
<div class="panel panel-default">
  <div class="panel-body">    
      
      
 <table class="table">

  <tbody>
    <tr>
      <td class="bg-info nice_td nice_td_header" style="border-top: 1px solid #FFF">
          Этажей в доме 
        </td>
   <td class="nice_td" style="border-top: 1px solid #FFF">
       <?=$building->floors?>  
         
        
        
        </td>
     
    </tr>
      
      
    <tr>
      <td class="bg-info nice_td nice_td_header" > 
         
    Подземных этажей 

        </td>
         <td class="nice_td">
         
        
        <?=$building->u_floors?> 
        </td>
     
    </tr>
      
    
    <tr>
      <td class="bg-info nice_td nice_td_header">
          
         Год постройки
        </td>
         <td class="nice_td">
         <?=$building->year_of_built?> 
         
        
        </td>
  
    </tr>
    <tr >
      <td class="bg-info nice_td nice_td_header" style="height: 40px;">
         
          Стены
        
        </td>
        <td class="nice_td">
          
           <?=$building->walls?>
         
        </td>
      
    </tr>
    
  </tbody>
</table>    
    <br> 
    <!--  <div class="hight: 10px; bockground: red;">
      </div>-->
     <img src="img/no_photo.png" alt="..." class="center-block img-thumbnail">   
      
      
    </div> 
     </div> 
    
    
 
    
    
    
     </div>
     
     
<div class="col-lg-6">
    
    
    
    
          
         
</div>
    </div>      
    
    

 <?=$main_appartment_table?>

    
    

    
    
    
 <!--   
    
<div class="row">
<div class="col-lg-12">
<?php 
    
echo "<pre>";
 print_r($building);   
echo "</pre>";
    
    
   echo "<hr>"; 
    echo "<pre>";
 //print_r($objects);   
echo "</pre>";
    
    
    
    
    ?>
</div>
</div>

-->
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
<script src="dist/js/bootstrap-select.js"></script>
<script src="dist/js/i18n/defaults-ru_RU.js"></script>


<script>
  $(document).ready(function () {


	
  });
</script>
    
<script>
ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
        center: [<?=$coord?>],
        zoom: 16,
        // Обратите внимание, что в API 2.1 по умолчанию карта создается с элементами управления.
        // Если вам не нужно их добавлять на карту, в ее параметрах передайте пустой массив в поле controls.
        controls: []
    });

    var myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
        balloonContentBody: [
            '<address>',
            '<strong>Жилой дом</strong>',
            '<br/>',
            '<?=$address?>',
            '</address>'
        ].join('')
    }, {
         // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: 'img/placeholder.png',
            // Размеры метки.
            iconImageSize: [30, 40],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-15, -40]
    });

    myMap.geoObjects.add(myPlacemark);
});
   
    
    
    
/*Пример*/    
    
 /*ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [55.79847978, 37.52067150],
            zoom: 16
        }, {
            searchControlProvider: 'yandex#search'
        }),
        myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: 'Собственный значок метки'
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: '../img/my_placeholder.png',
            // Размеры метки.
            iconImageSize: [30, 40],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-15, -40]
        });

    myMap.geoObjects.add(myPlacemark);
});
   
    */
    
    
    
</script>

   


</body>
</html>