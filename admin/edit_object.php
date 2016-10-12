<?php
header("Content-Type: text/html; charset=UTF-8"); 
error_reporting(E_ALL & ~E_NOTICE);
require_once("includes/init.php");



if(!$session->is_signed_in()) {
redirect("login.php");
} 


 

if(empty($_GET['id'])) {
    
 redirect("objects.php");   
    
} else {
    
    $object = Object_u::find_by_id($_GET['id']);
    
    // Берем из базы уникальный ID
    $_SESSION['current_uniq_id'] = $object->uniq_id;
    $session->set_current_uniq_id();

    
    $photo_arr = Photo::find_photos_by_obj_uniq_id($object->uniq_id);
   
    $photos_info = Photo::get_photo_paths($photo_arr);
    
    
    if(isset($_POST['update'])) {
        
    if($object) {
        
    
        
        
        
      // Обрабатываем POST массив  
        foreach($_POST as $key =>$value){
            
            if($key == "price") {
              $object->$key = str_replace(' ', '', trim($_POST[$key]));  
               //$object->$key = trim($_POST[$key]); 
            } 
            elseif ($key == "phone") {
           
$clean_phone = trim($_POST[$key]);
$wrong_characters = array(" ", "(", ")", "-");
$clean_phone = str_replace($wrong_characters, "", $clean_phone);  
 

if($clean_phone[0] == 8) {            
$ptn = "/^8/";  // Regex
$rpltxt = "+7";  // Replacement string
$clean_phone = preg_replace($ptn, $rpltxt, $clean_phone);       
}
elseif($clean_phone[0] == 7) {
    
$clean_phone = "+".$clean_phone;    
}
            
            
    
$object->$key = $clean_phone;
            
        }
            
            elseif($key != "update" && $key != "images") {
              $object->$key = trim($_POST[$key]); 
            }   
    }
    
        
    // Дополнительно обрабатываем чекбоксы
    if(empty($_POST['ipoteka'])) {
     $object->ipoteka = 0;   
    }
    if(empty($_POST['tender'])) {
     $object->tender = 0;   
    }
        
        
        
        
        
        if($object->save()){
           $session->action_maker("update");
           
          /* echo "<pre>";
            print_r($_POST);
           echo "</pre>";*/
           redirect("objects.php");  
        } else {
            
            echo "Ошибка!";
        }
       
        
    }    
        
    }
    
}






?>
<?php require_once("includes/header.php")?>
<body>


<?php include("includes/top_nav.php"); ?>

<div class="container">



<div class="row">
<div class="col-md-12">

<h1 class="text-center">Редактировать объявление</h1>
    
 
<br><br>
</div>
</div><!-- end row 3 -->

<div class="row">
<div class="col-md-10 col-md-offset-1">


<form class="form-horizontal" id="add_object_form" action="" method="post">
  <fieldset>
    <legend>Адрес квартиры</legend>
      
    <div class="form-group">
        
        
        <div class="col-md-3"></div>
         <div class="col-md-8">
         <div id="address_alert" class="alert alert-dismissible alert-warning" style="font-size: 95%">
                Введите адрес объекта, подсказки Вам помогут
             </div>  
        
        </div>
        
        
      <label for="address" class="col-md-3 control-label">Адрес:</label>
        <div class="col-md-8">
  
             <input type="text" name="address" class="form-control" id="address" placeholder="Введите адрес квартиры" value="<?=$object->address?>">
            
        <div id="input_status"></div>
             
          <!--<input type="hidden" id="fias_level" name="fias_level" value="">-->
            
            
    <!--  Скрытые поля -->     
      <input type="hidden" name="region_type" id="region_type">
      <input type="hidden" name="region" id="region">
      <input type="hidden" name="area_type" id="area_type">
      <input type="hidden" name="area" id="area">
      <input type="hidden" name="city_type" id="city_type">
      <input type="hidden" name="city" id="city">
      <input type="hidden" name="settlement_type" id="settlement_type">
      <input type="hidden" name="settlement" id="settlement">
      <input type="hidden" name="street_type" id="street_type">
      <input type="hidden" name="street" id="street">
      <input type="hidden" name="house_type" id="house_type">
      <input type="hidden" name="house" id="house">
      <input type="hidden" name="block_type" id="block_type">
      <input type="hidden" name="block" id="block">
      <input type="hidden" name="city_area" id="city_area">
      <input type="hidden" name="city_district" id="city_district">
      <input type="hidden" name="geo_lat" id="geo_lat">
      <input type="hidden" name="geo_lon" id="geo_lon">
     
            
            
            
            
            
   
      
    </div>
    
        
        
       
    </div>
    
    
   
    

       
       
      
      
         <legend>Параметры квартиры</legend>
     
    
         
    <div class="form-group">
    
    
        <label for="rooms" class="col-md-3 control-label">Комнат</label>

    
   <div class="col-md-4 selectContainer">
  
   
                    <select name="rooms" id="rooms" class="form-control">

                        
                        
                        <?php 
             for($i = 1; $i < 9; $i++) {
             echo "<option ";
        if($i == $object->rooms) { echo "selected "; }
             echo "value='". $i."'> ";
             echo $i."-комнатная </option>";
                        }
                        ?>




                    </select>
                    
      
  
  
  </div>
        
    
      
</div>
      
      
      
      
      
      
      
      

    <div class="form-group">
      <label for="m2_o" class="col-md-3 control-label">Общая площадь</label>
    <div class="col-md-4 inputGroupContainer">
       <div class="input-group">
        <input type="text" name="m2_o" class="form-control" id="m2_o" placeholder="Общая площадь" value="<?=$object->m2_o?>">
        <span class="input-group-addon">м²</span>
       </div> 
    </div>   
    </div>
    
    
      <div class="form-group">
      <label for="m2_g" class="col-md-3 control-label">Жилая площадь</label>
     
    <div class="col-md-4 inputGroupContainer">
       <div class="input-group">
        <input type="text" name="m2_g" class="form-control" id="m2_g" placeholder="Жилая площадь" value="<?=$object->m2_g?>">
        <span class="input-group-addon">м²</span>
        </div> 

    </div>   

    </div>
    
     <div class="form-group">
      <label for="m2_k" class="col-md-3 control-label">Площадь кухни</label>
      
         
                
    <div class="col-md-4 inputGroupContainer">
       <div class="input-group">
        <input type="text" name="m2_k" class="form-control" id="m2_k" placeholder="Площадь кухни" value="<?=$object->m2_k?>">
        <span class="input-group-addon">м²</span>
       </div>
    </div>   
          
         
    </div>
    
    
     <div class="form-group">
      <label for="floors" class="col-md-3 control-label">Этажей в доме</label>
      <div class="col-md-4">
       

  
      
        <input type="text" name="floors" class="form-control" id="floors" placeholder="Этажность" value="<?=$object->floors?>">

              
          
                
                </div>
    </div>
    
            
            
            
            <div class="form-group">
      <label for="floor" class="col-md-3 control-label">Ваш этаж</label>
      <div class="col-md-4">
       

  
          <input type="text" name="floor" class="form-control" id="floor" placeholder="Этаж" value="<?=$object->floor?>">
      

              
          
                
                </div>
    </div>
      
      
      
    
         
             <legend>Дополнительные параметры </legend>

    
    
        <div class="form-group">
    
    <label for="balcony" class="col-md-3 control-label">Балконов</label>
   <div class="col-md-4 selectContainer">
        <select name="balcony" id="balcony" class="form-control">
          
            
                   
                        <?php 
             for($i = 0; $i < 7; $i++) {
             echo "<option ";
        if($object->balcony == $i) { echo "selected "; }
             echo "value='". $i."'> ";
             if($i == 0) {
              echo "нет </option>";  
             } else { 
             echo $i. " </option>"; }
                        }
                        ?>

 
            
            
            
            
            
            
       </select>
  </div>

</div>
      
       <div class="form-group">
    
    <label for="loggia" class="col-md-3 control-label">Лоджий</label>
   <div class="col-md-4 selectContainer">
        <select name="loggia" id="loggia" class="form-control">
            
            
            
            
                  <?php 
             for($i = 0; $i < 7; $i++) {
             echo "<option ";
        if($object->loggia == $i) { echo "selected "; }
             echo "value='". $i."'> ";
             if($i == 0) {
              echo "нет </option>";  
             } else { 
             echo $i. " </option>"; }
                        }
                        ?>
            
            
            
       </select>
  </div>

</div>
      
      
  <div class="form-group">
    
    <label for="wc" class="col-md-3 control-label">Санузел</label>
   <div class="col-md-4 selectContainer">
        <select name="wc" id="wc" class="form-control">
            
           <?php
            
            $wc_arr = array(
                "Раздельный",
                "Совмещенный",
                "2-санузла",
                "3-санузла",
                "4-санузла"
            );
            
foreach($wc_arr as $value){
    echo "<option ";
    if($object->wc == $value) {echo "selected ";}
    echo "value='".$value."'>";
    echo $value."</option>";
}
            

            ?> 
            
            
            
       
       </select>
  </div>

</div>
      
      
      
      
<div class="form-group">
    
    <label for="windows" class="col-md-3 control-label">Окна</label>
   <div class="col-md-4 selectContainer">
        <select name="windows" id="windows" class="form-control">
          
            <?php
            
            $windows_arr = array(
                "На улицу",
                "Во двор",
                "Улица + Двор",
                "На три стороны",
                "На четыре стороны"
            );
            
foreach($windows_arr as $value){
    echo "<option ";
    if($object->windows == $value) {echo "selected ";}
    echo "value='".$value."'>";
    echo $value."</option>";
}
            

            ?>   
            
            
            
            
            
            
            
            
       </select>
  </div>

</div>
      
      
      
      
      
<div class="form-group">
    
    <label for="state" class="col-md-3 control-label">Состояние квартиры</label>
   <div class="col-md-4 selectContainer">
        <select name="state" id="state" class="form-control">
            
            
         <?php
            $state_arr = array(
                "Без отделки",
                "Требует ремонта",
                "Среднее состояние",
                "Хорошее состояние",
                "Косметический ремонт",
                "Евро ремонт",
                "Эксклюзивный ремонт"
            );
            
foreach($state_arr as $value){
    echo "<option ";
    if($object->state == $value) {echo "selected ";}
    echo "value='".$value."'>";
    echo $value."</option>";
}
            ?>       
            


       </select>
  </div>

</div>
  
    

  
      
   <?php 
      echo "<pre>";
      print_r($photos);
      echo "</pre>";
      echo $object->uniq_id;
      
      ?>
    <legend>
        <span>Фотографии</span>
      </legend>
      <div class="form-group">
            <div class="col-md-12">
          
                   <!-- <label>Preview File Icon</label>-->
                    <div class="text-center">
           
                        
               <input id="images" name="images[]" type="file" multiple class="file-loading" accept="image/*">       
                        
                        
                    </div>
          </div>
                </div>  
      
      
            
      
      
      
      
      
         <legend>Стоимость</legend>

    
    <div class="form-group">
    
    
        <label for="price" class="col-md-3 control-label">Цена</label>

    
   <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
    <input name="price" id="price" type="text" class="form-control" value="<?=$object->price?>">
  
   <span class="input-group-btn">
   
                    <select name="currency" id="currency" class="form-control" >
                          
            <?php
            $currency_arr = array(
                "₽", "$", "€"
            );
            
foreach($currency_arr as $value){
    echo "<option ";
    if($object->currency == $value) {echo "selected ";}
    echo "value='".$value."'>";
    echo $value."</option>";
}
            ?>                    
                        
                        
                        
                        
                        
                        
                    </select>
                    
    </span>
  
  </div>
  
  </div>
        
     
        
        
</div>
      
      
      
      
   <div class="form-group">
        <!-- The feedback icon will be placed here -->
        <span id="alertDayIcon"></span>

            <div class="col-md-4 col-md-offset-3">
                <div class="checkbox">
                    <label>
   <input type="checkbox" value="1" name="ipoteka" <?=($object->ipoteka) ? "checked" : ""; ?> /> Возможна Ипотека
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" name="tender" <?=($object->tender) ? "checked" : ""; ?> /> Возможен Торг
                    </label>
                </div>
                
            </div>

            

        <!-- The container to place the error of checkboxes -->
        <div id="alertDayMessage"></div>
    </div>   
      
      
      
      
      
      
      
      
      
      
 
              <div class="form-group">

    <label for="how_sell" class="col-md-3 control-label">Продается как</label>
    
              <div class="col-md-5">


    <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-default <?=($object->how_sell==1) ? "active" : ""; ?>">
            <input type="radio" name="how_sell" value="1"  <?=($object->how_sell==1) ? "checked" : ""; ?> >Свободная продажа
        </label>
        <label class="btn btn-default <?=($object->how_sell==2) ? "active" : ""; ?>">
            <input type="radio" name="how_sell" value="2" <?=($object->how_sell==2) ? "checked" : ""; ?>>Альтернатива
        </label>
        
    </div>
        </div>

    </div>
         
      
      
      
      
      
      
      
      
    
             <legend>Описание</legend>

    
      <div class="form-group">
      <label for="description" class="col-md-3 control-label">Описание</label>
      <div class="col-md-8">
       
          
        <textarea class="form-control" type="description" name="description" id="description" placeholder="Описание объекта" maxlength="2000" rows="3" value=""><?=$object->description?></textarea>


          
          
          
          
        <span class="help-block"><p id="characterLeft" class="help-block ">Вы достигли придела</p></span> 
      </div>
    </div>
    
  
      
      
      
      
      
         
      
        <legend>
                 
             <span>Контактные данные</span>    
      
      </legend>
      
    
     <div class="form-group">
      
         <label for="phone" class="col-md-3 control-label">Ваш телефон:</label>
      
       
         
     <div class="col-md-4 inputGroupContainer">
       <div class="input-group">
       <input type="tel" name="phone" class="form-control" id="phone" value="<?=$object->phone?>" placeholder="8 (000) 000-00-00" >
        <span class="input-group-addon">
     <i class="fa fa-lg fa-mobile" aria-hidden="true" style="width: 20px;"></i>
        </span>
        </div> 

    </div>    
         
         
        
          
         
    </div>
    
   
     
      
      <br><hr><br><br>
       
      
      
      
      
      
      
      
  
    <div class="form-group">
      <div class="col-md-8 col-md-offset-3">
      
          
        <input type="submit" class="btn btn-primary btn-lg" name="update" value="Обновить объявление" />  
          
          
        <a href="objects.php" class="btn btn-danger btn-lg">Отмена</a>
      </div>
    </div>
  </fieldset>
</form>
</div>
</div>
<!-- Form row -->


<br><br><br><br>

    
    


<div class="row">

<div class="col-md-12">

</div>
</div>






</div><!-- end container-->

<br>
<br>
<br>
<br>


    
    <?php include("includes/footer.php"); ?>





<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery_price_format.js"></script>
<script src="dist/js/bootstrap-select.js"></script>
<script src="dist/js/i18n/defaults-ru_RU.js"></script>

<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/formValidation.min.js"></script>
<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/language/ru_RU.js"></script>
    
    
<!-- ФАЙЛ ИНПУТ -->
    
<script src="js/plugins/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>

<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
     This must be loaded before fileinput.min.js -->
<!--<script src="js/lib/bootstrap-fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>-->

<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
<script src="js/plugins/bootstrap-fileinput/js/plugins/purify.min.js" type="text/javascript"></script>

<!-- the main fileinput plugin file -->
<script src="js/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>

<!-- bootstrap.js below is needed if you wish to zoom and view file content 
     in a larger detailed modal dialog -->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>-->

<!-- optionally if you need a theme like font awesome theme you can include 
    it as mentioned below -->
<!--<script src="js/lib/bootstrap-fileinput/themes/fa/theme.js"></script>-->

<!-- optionally if you need translation for your language then include 
    locale file as mentioned below -->
<script src="js/plugins/bootstrap-fileinput/js/locales/ru.js"></script>    
    

<!--ДАДАТА подсказки -->   
    
<!--[if lt IE 10]>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>
<![endif]-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.suggestions/16.5.1/js/jquery.suggestions.min.js"></script>

    
<script type="text/javascript" src="plugins/intl-tel-input-9.0-2.3/build/js/intlTelInput.min.js"></script>    

<script type="text/javascript" src="plugins/jQuery-Mask-Plugin/dist/jquery.mask.min.js"></script>   
    
    
    
    
    
    
    
    
    
    
    
    
    

<script>
  $(document).ready(function () {


      
        
    var $input = $("#images");
    $input.fileinput({
    language: 'ru',
    uploadUrl: "uploads/upload_image_oop.php", // server upload action
    uploadAsync: true,
    allowedFileExtensions: ['jpg', 'jpeg', 'gif', 'png'],
    showRemove: false, // hide remove button
    showUpload: false,
	showCaption: false,
    showClose: false,
    fileActionSettings: {
    dragIcon: '<i class="glyphicon glyphicon-ok-sign file-icon-large text-success"></i>',
    //showDrag: false,
    showZoom: false
    
    
    },
        
   
   
    dropZoneClickTitle: "<br>(или нажмите Добавить фото)",   
        
    showBrowse: false,
    browseOnZoneClick: true,
    //maxFileSize: 1000,
    
   // deleteUrl: "delete_uploaded_file.php?file_name=all",
   // minFileCount: 1,
    maxFileCount: 25,
        
    <?php
        if($photos_info) {
            
         echo $photos_info;  
            
            
        }
        
        ?>    
        
       
    initialPreviewAsData: true // identify if you are sending preview data only and not the markup

    //
        
        
        
        
        
        
        
        
    //        
        
}).on("filebatchselected", function(event, files) {
    // trigger upload method immediately after files are selected
    $input.fileinput("upload");
/*}).on('filesorted', function(e, params) {
    console.log('File sorted params', params);*/
/*}).on('fileuploaded', function(e, params) {
    console.log('File uploaded params', params);*/
}).on('fileuploaderror', function(event, data, msg) {
    var form = data.form, files = data.files, extra = data.extra,
        response = data.response, reader = data.reader;
    //console.log('File upload error');
        //console.log(msg);
        //fileinput("upload");
       // $input.fileinput('cancel');
   // get message
   //alert(msg);
});
         
      
      
      
      
      
      
      
      
      
      
      
 
      
    $('#add_object_form')
        .find('[name="phone"]')
            .intlTelInput({
                utilsScript: 'plugins/intl-tel-input-9.0-2.3/build/js/utils.js',
                autoPlaceholder: true,
                onlyCountries: ["ru"]
                //allowDropdown: false
                
            });
    
     
      
  $('#phone').mask('0 (000) 000-00-00');        
            
      
      
      
      
      
      
$('#metro').selectpicker({
  selectedTextFormat: 'count > 1',
  liveSearch: true
});

$('#currency').selectpicker({
  title: null,
  container: 'body'
});
      
$('#rooms').selectpicker({
 title: "Не выбрано"
});
      


      $('#balcony').selectpicker({
// title: "Не выбрано"
});
      
     $('#loggia').selectpicker({
// title: "Не выбрано"
});
      $('#wc').selectpicker({
 title: "Не выбрано"
});
      
     $('#windows').selectpicker({
 title: "Не выбрано"
});
      
    $('#state').selectpicker({
 title: "Не выбрано"
});
      
   
      
      
 //  Разбиваем Цену на разряды
// http://jquerypriceformat.com/
  
 $('#price').priceFormat({
    prefix: '',
    centsSeparator: '',
    thousandsSeparator: ' ',
    centsLimit: 0,
    limit: 12,
    clearOnEmpty: true
});
      
// Разбиваем этажи 
      
$('#floor').priceFormat({
    prefix: '',
    centsSeparator: '',
    thousandsSeparator: ' ',
    centsLimit: 0,
    limit: 2,
    clearOnEmpty: true
});
      
$('#floors').priceFormat({
    prefix: '',
    centsSeparator: '',
    thousandsSeparator: ' ',
    centsLimit: 0,
    limit: 2,
    clearOnEmpty: true
});
      
      


// Ограничение TextAria в 500 символов
      
$('#characterLeft').text('2000 символов осталось');
    $('#description').keyup(function () {
        var max = 2000;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('Вы достигли предела');
            $('#characterLeft').addClass('red');
            $('#btnSubmit').addClass('disabled');            
        } 
        else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' символов осталось');
            $('#btnSubmit').removeClass('disabled');
            $('#characterLeft').removeClass('red');            
        }
    });    


	
      
      
  
      
      
      
   // Комнаты  
 $('#rooms').change(function(){
           if($(this).val()=='default'){
} else {
    $(this).selectpicker('setStyle', 'btn-success');
}   
      
  });
      
      
   /*   
      $(document).on("click","#test-element",function() {
    alert("click");
});*/
      
      
   // Цена  
 $(document).on("blur", "#price", function(){
           if($(this).val() !==""){
       
         $('#currency').selectpicker('setStyle', 'btn-danger', 'remove');       
        $('#currency').selectpicker('setStyle', 'btn-success');
 
               
} else if($(this).val() == "") {
  

     $('#currency').selectpicker('setStyle', 'btn-danger');
} else {
        $('#currency').selectpicker('setStyle', 'btn-success');
  
    
}
      
  }); 
      
      
   
      
 
      
      
      
      
/*            
     (function($) { 
       
      FormValidation.Validator.checkFiasLevel = {
        validate: function(validator, $field, options) {
            var value = $field.val();
          
             //var fias_level = $("#fias_level").val();
        // var fias_level = $('#fias_level').val();

            
            var fias_level = $('#add_object_form').find('[name="fias_level"]').val();
            
            if (value === '') {
                return true;
            }

            // Check the password strength
            if (fias_level == 1 || fias_level == 3) {
                return {
                    valid: false,
                    message: 'Пожалуйста, введите город'
                };
            }

            // The password doesn't contain any uppercase character
            if (fias_level == 4 || fias_level == 6) {
                return {
                    valid: false,
                    message: 'Пожалуйста, введите улицу'
                }
            }

            // The password doesn't contain any uppercase character
            if (fias_level == 7) {
                return {
                    valid: false,
                    message: 'Пожалуйста, введите номер дома'
                }
            }

           

            return true;
        }
    };      
         
 }(window.jQuery));  */ 
     
       
    
      
      
   /////////////// Пошла Валидация форм  
      
      
     $('#add_object_form')
         .find('[name="rooms"]')
            .selectpicker()
            .change(function(e) {
                // revalidate the language when it is changed
                $('#add_object_form').formValidation('revalidateField', 'rooms');
            })
            .end()
     
     .find('[name="balcony"]')
            .selectpicker()
            .change(function(e) {
                // revalidate the language when it is changed
                $('#add_object_form').formValidation('revalidateField', 'balcony');
            })
            .end()
     
        .find('[name="loggia"]')
            .selectpicker()
            .change(function(e) {
                // revalidate the language when it is changed
                $('#add_object_form').formValidation('revalidateField', 'loggia');
            })
            .end()
     
     .find('[name="wc"]')
            .selectpicker()
            .change(function(e) {
                // revalidate the language when it is changed
                $('#add_object_form').formValidation('revalidateField', 'wc');
            })
            .end()
     
     
      .find('[name="windows"]')
            .selectpicker()
            .change(function(e) {
                // revalidate the language when it is changed
                $('#add_object_form').formValidation('revalidateField', 'windows');
            })
            .end()
     
     

     
     
     .find('[name="state"]')
            .selectpicker()
            .change(function(e) {
                // revalidate the language when it is changed
                $('#add_object_form').formValidation('revalidateField', 'state');
            })
            .end()
         .formValidation({
        // I am validating Bootstrap form
        framework: 'bootstrap',
        excluded: ':disabled',
        // Feedback icons
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        locale: 'ru_RU',
        // List of fields and their validation rules
        fields: {
            /* address: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    },
                    checkFiasLevel: {
                        message: 'The color is required'
                    }
                }
            },*/
            
        
            
            
            
            m2_o: {
                validators: {
                    notEmpty: {
                        //message: 'The password is required and cannot be empty'
                    },
                    between: {
                            min: 'm2_g',
                            max: 20000,
                            message: 'Общая площадь не может быть меньше жилой'
                        }
                },
                
                
              onSuccess: function(e, data) {
                    // data.fv is the plugin instance
                    // Revalidate the end date if it's not valid
                    if (!data.fv.isValidField('m2_g')) {
                        data.fv.revalidateField('m2_g');
                    }
                }   
                
                
            },
            
            m2_g: {
                validators: {
                    notEmpty: {
                        //message: 'The password is required and cannot be empty'
                    },
                    between: {
                            min: 1,
                            max: 'm2_o',
                            message: 'Жилая площадь не может быть больше общей'
                        }
                },
                 onSuccess: function(e, data) {
                    // data.fv is the plugin instance
                    // Revalidate the end date if it's not valid
                    if (!data.fv.isValidField('m2_o')) {
                        data.fv.revalidateField('m2_o');
                    }
                }  
            },
            
            m2_k: {
                validators: {
                    notEmpty: {
                        //message: 'The password is required and cannot be empty'
                    }
                }
            },
            
           floor: {
                validators: {
                    notEmpty: {
                        //message: 'The password is required and cannot be empty'
                    },
                    between: {
                            min: 1,
                            max: 'floors',
                            message: 'Ваш этаж не может быть больше этажности дома'
                        }
                },
                
                
              onSuccess: function(e, data) {
                    // data.fv is the plugin instance
                    // Revalidate the end date if it's not valid
                    if (!data.fv.isValidField('floors')) {
                        data.fv.revalidateField('floors');
                    }
                }   
                
                
            },
            
            floors: {
                validators: {
                    notEmpty: {
                        //message: 'The password is required and cannot be empty'
                    },
                    between: {
                            min: 'floor',
                            max: 100,
                            message: 'Ваш этаж не может быть выше этажности дома'
                        }
                },
                
                
              onSuccess: function(e, data) {
                    // data.fv is the plugin instance
                    // Revalidate the end date if it's not valid
                    if (!data.fv.isValidField('floor')) {
                        data.fv.revalidateField('floor');
                    }
                }   
                
                
            },
            
            
            
            balcony: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },
                         
            loggia: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },
            
            rooms: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },
            
                 wc: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },
            
              windows: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },
            
              state: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },
            
              price: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },
            
            how_sell: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },
            
            description: {
                validators: {
                    stringLength: {
                        max: 2000
                       // message: 'The review must be less than 500 characters long'
                    },
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },
            
            
               phone: {
          validators: {
            notEmpty: {
                        message: 'Пожалуйста, введите номер телефона'
                    },
              callback: {
            callback: function(value, validator, $field) {
            var isValid = value === '' || $field.intlTelInput('isValidNumber'),
             err     = $field.intlTelInput('getValidationError'),
                    message = null;
                 switch (err) {
              case intlTelInputUtils.validationError.INVALID_COUNTRY_CODE:
             message = 'Код страны не действительный';
                 break;

             case intlTelInputUtils.validationError.TOO_SHORT:
              message = 'Номер телефона слишком короткий';
                break;

             case intlTelInputUtils.validationError.TOO_LONG:
          message = 'Номер телефона слишком длинный';
             break;

             case intlTelInputUtils.validationError.NOT_A_NUMBER:
            message = 'Номер телефона слишком короткий';
                 break;

             default:
          message = 'Номер телефона не действительный';
                                        break;
                                }

              return {
                   valid: isValid,
                 message: message
                                };
                            }
                        }
                    }
                }
            
        }
    });
      
      
      
      
      
      
      
        // Подсказки 
      
      (function($) {
      
    
       $("#address").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "14f522fdfb0d70138138f6d41a4faeebcfb4e805",
        type: "ADDRESS",
        geoLocation: true,
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: showSelected
         /*onSelect: function(suggestion) {
            showSelected;
        }*/
    });
        
        
 
        
    function join(arr /*, separator */) {
  var separator = arguments.length > 1 ? arguments[1] : ", ";
  return arr.filter(function(n){return n}).join(separator);
}

function showSelected(suggestion) {
  var address = suggestion.data;
  
    
    
  $("#region_type").val(join([
    join([address.region_type], " ")
   
  ]));  
    
  $("#region").val(join([
    join([address.region], " ")
  ]));
    
  
  $("#area_type").val(join([
    join([address.area_type], " ")
  ]));
    
  $("#area").val(join([
    join([address.area], " ")
  ]));
    
    
    
   $("#city_type").val(join([
    join([address.city_type], " ")
  ]));  
    
    
  $("#city").val(join([
    join([address.city], " ")
  ]));
    
    
    
$("#city_area").val(join([
    join([address.city_area], " ")
  ]));
    
    
$("#city_district").val(join([
    join([address.city_district], " ")
  ]));
    
   
    
   $("#settlement_type").val(join([
    join([address.settlement_type], " ")
  ])); 
    
    
 $("#settlement").val(join([
    join([address.settlement], " ")
  ]));
    
  $("#street_type").val(
    join([address.street_type], " ")
  );
    
 $("#street").val(
    join([address.street], " ")
  );  
    
    
  $("#house_type").val(join([
    join([address.house_type], " "),
  ]));
    
  $("#house").val(join([
    join([address.house], " "),
  ])); 
    
    
   $("#block_type").val(join([
    join([address.block_type], " ")
  ]));  
    
 $("#block").val(join([
    join([address.block], " ")
  ]));  
    
    
    
 /* $("#flat_type").val(
    join([address.flat_type], " ")
  );
    
 $("#flat").val(
    join([address.flat], " ")
  );*/
    
    
  $("#geo_lat").val(join([
    join([address.geo_lat], " ")
  ]));
    
    
$("#geo_lon").val(join([
    join([address.geo_lon], " ")
  ]));
    
    
    
    
    
    var fias_level = address.fias_level;
    var city = address.city;

    // Добавляем код в скрытое поле
    $("#fias_level").val(fias_level);
    
    console.log(fias_level);
    
   // $("#hidden_field").val(address.fias_level);
  //  Делаем подсказки пользователю
    

   
   var icon_red = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>";
   var icon_green = "<i class='fa  fa-check' aria-hidden='true'></i>"; 
   var form_group = $("#address").parents("div.form-group");    

   var status_warning = "<span class='glyphicon glyphicon-warning-sign form-control-feedback' aria-hidden='true'></span><span class='sr-only'>(warning)</span>"; 
    
   var status_success = "<span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span><span class='sr-only'>(success)</span>";
    
    if(fias_level == 1 && (city =="Москва" || city =="Санкт-Петербург" || city == "Севастополь")) {
       $("#address_alert").removeClass("alert-success");
       $("#address_alert").addClass("alert-warning");  
         
         $("#address_alert").html(icon_red + " Введите улицу");
        form_group.removeClass("has-success has-feedback");
        form_group.addClass("has-warning has-feedback");
       $("#input_status").html(status_warning);  
         

    }
    
    else if(fias_level == 1 || fias_level == 3) {
     $("#address_alert").removeClass("alert-success");
     $("#address_alert").addClass("alert-warning");
        
    $("#address_alert").html(icon_red + " Введите город");
   
    form_group.removeClass("has-success has-feedback");
    form_group.addClass("has-warning has-feedback");
    
     $("#input_status").html(status_warning);  
    }
  
    else if(fias_level == 4 || fias_level == 6) {
        
     $("#address_alert").removeClass("alert-success");
    $("#address_alert").addClass("alert-warning");
        
        
        
        
       $("#address_alert").html(icon_red + " Введите улицу");
        form_group.removeClass("has-success has-feedback");
        form_group.addClass("has-warning has-feedback");
       $("#input_status").html(status_warning);  
    }
    
    else if(fias_level == 7) {
       
        $("#address_alert").removeClass("alert-success");
       $("#address_alert").addClass("alert-warning");
        
        $("#address_alert").html(icon_red + " Введите номер дома");
       form_group.removeClass("has-success has-feedback");
        form_group.addClass("has-warning has-feedback");
       $("#input_status").html(status_warning);  
    }
    
    else if(fias_level == 8) {
       $("#address_alert").html(icon_green + " Ваш адрес принят");
      
       form_group.removeClass("has-warning has-feedback");
        form_group.addClass("has-success has-feedback");
        $("#input_status").html(status_success);  

         
         
         $("#address_alert").removeClass("alert-warning");
         $("#address_alert").addClass("alert-success");  

        
         

    } 
    
    else {
        
        $("#address_alert").removeClass("alert-success");
       $("#address_alert").addClass("alert-warning");
        
        $("#address_alert").html(icon_red + " Введите адрес объекта");
       form_group.removeClass("has-success has-feedback");
        form_group.addClass("has-warning has-feedback");
       $("#input_status").html(status_warning);   
        
        
    }
    
    
    
   
    
    
    
}
        
      
      
      
      
 })(jQuery);     
      
      
      
 
   $("#address").keyup(function(){
       
     
       var icon_red = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>";
   var icon_green = "<i class='fa  fa-check' aria-hidden='true'></i>"; 
   var form_group = $("#address").parents("div.form-group");    

   var status_warning = "<span class='glyphicon glyphicon-warning-sign form-control-feedback' aria-hidden='true'></span><span class='sr-only'>(warning)</span>"; 
    
   var status_success = "<span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span><span class='sr-only'>(success)</span>";
       
       
       
       
       
       
       if($(this).val() == ""){
       $("#address_alert").removeClass("alert-success");
       $("#address_alert").addClass("alert-warning");
       $("#address_alert").html("Введите адрес объекта, подсказки Вам помогут");
       form_group.removeClass("has-success has-feedback");
        form_group.addClass("has-warning has-feedback");
       $("#input_status").html(status_warning);     
       
       }
       
       
       
   });   
      
      
   /*   
    $('#add_object_form').on('submit', function(e){
    // validation code here
    if($("#address").val() === "") {
      e.preventDefault();
        $("#address").focus()
        //$(fieldSelector).
    } else {}
  });  */
      
      
      
  }); // end document.ready
    
  
    
    
    
</script> 

    
    

   


</body>
</html>