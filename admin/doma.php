<?php
header("Content-Type: text/html; charset=UTF-8"); 
error_reporting(E_ALL & ~E_NOTICE);
require_once("includes/init.php");



if(!$session->is_signed_in()) {
//redirect("login.php");
}




// Инициируем сессию
  //session_start();



//База данных
//require_once("bd/bd_connection.php");
//require_once("bd/show_data.php");

// Подключаем массивы




if($_SERVER['REQUEST_METHOD'] == 'GET') {
	
		  
   $dom_kad = urldecode($_GET[kad]);
	
   
    
    
    
      $building = Building::find_building_by_kad($dom_kad);

      $objects = Object_m::find_all_objects_by_kad($dom_kad);
     
     
	 // $object = new Object_m();
    
     // $objects = $object->find_all_objects_by_kad($dom_kad);
     // $count_flat = $objects->flats_amount;
    
      /*$flats_amount = Object_m::get_flats($objects);
      $unique_rooms = Object_m::unique_rooms($objects);
      $floor_types = Object_m::floor_types($objects);
      $metragi_kvartir_v_dome = Object_m::metragi_kvartir_v_dome($objects);

        $draw_table_from_array = Object_m::draw_table_from_array($objects);*/
    
    
    $main_appartment_table = Object_m::main_appartment_table($objects);
    
    
    
    // Object_m::find_all_objects_by_kad($dom_kad);
    // $objects = Object_m::$flats_arr;
     //$count_flat = Object_m::$flats_in_building;
    
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


?>
<?php require_once("includes/header.php")?>
<body>


<?php include("includes/top_nav.php"); ?>

<div class="container">



<div class="row">
<div class="col-lg-12">

<h1 class="text-center">  
 <?php 
   
    if($building->street_type) {
    echo $building->street_type;
    echo " ";
    }
    
    if($building->street_name) {
    echo $building->street_name;     
    }
    
    if($building->dom) {
    echo ", д. ";
    echo $building->dom;     
    }
    
    if($building->korpus) {
    echo ", к. ";
    echo $building->korpus;     
    }
    if($building->stroenie) {
    echo ", стр. ";
    echo $building->stroenie;     
    }
    
    ?>   
    
    </h1>
    

<br><br>
</div>
</div><!-- end row 3 -->

    
    
    
    
 <div class="row">
<div class="col-lg-6">
    
 <h3 class="text-center"><i class="fa fa-building" aria-hidden="true"></i>  Дом</h3>
<div class="panel panel-default">
  <div class="panel-body">    
      
      
 <table class="table">

  <tbody>
    <tr>
      <td class="nice_td nice_td_header" style="border-top: 1px solid #FFF">
          Этажей в доме 
        </td>
   <td class="nice_td" style="border-top: 1px solid #FFF">
       <?=$building->floors?>  
         
        
        
        </td>
     
    </tr>
      
      
    <tr>
      <td class="nice_td nice_td_header" > 
         
    Подземных этажей 

        </td>
         <td class="nice_td">
         
        
        <?=$building->u_floors?> 
        </td>
     
    </tr>
      
    
    <tr>
      <td class="nice_td nice_td_header">
          
         Год постройки
        </td>
         <td class="nice_td">
         <?=$building->year_of_built?> 
         
        
        </td>
  
    </tr>
    <tr >
      <td class="nice_td nice_td_header" style="height: 40px;">
         
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
    
      <h3 class="text-center"><i class="fa fa-map" aria-hidden="true"></i>  Месторасположение</h3>   
<div class="panel panel-default">
  <div class="panel-body">
      
      
          
 <table class="table">

  <tbody>
    <tr>
        <td class="nice_td nice_td_header" style="border-top: 1px solid #FFF">
            Округ 
        </td>
         <td class="nice_td" style="border-top: 1px solid #FFF">
         <?=$okrug?>  
        
        </td>
     
    </tr>
    <tr>
      <td class="nice_td nice_td_header">
           Район 
              </td>
        <td class="nice_td">
         
       <?=$building->district_str?>
        </td>
  
    </tr>
    <tr >
      <td class="nice_td nice_td_header">
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
    </div>
    
    
    
    
    
 <?=$main_appartment_table?>
    
    
    
    
    
    
    
    
    
<div class="row">
<div class="col-lg-12">
<?php 
    
echo "<pre>";
 print_r($building);   
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
<script src="dist/js/bootstrap-select.js"></script>
<script src="dist/js/i18n/defaults-ru_RU.js"></script>


<script>
  $(document).ready(function () {

 $('#metro').selectpicker({
  selectedTextFormat: 'count > 1',
  liveSearch: true
});

$('#metro').selectpicker('val', [<?=$selected_metro?>]);

     


 $('#do_metro').selectpicker({
  title: null
});


$('#do_metro').selectpicker('val', '<?=$do_metro?>');      

	
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
            '<strong>Офис Яндекса в Москве</strong>',
            '<br/>',
            'Адрес: 119021, Москва, ул. Льва Толстого, 16',
            '<br/>',
            'Подробнее: <a href="https://company.yandex.ru/">https://company.yandex.ru</a>',
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