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
    $user = User::find_by_id($_GET['id']);
    
    if(isset($_POST['update'])) {
        
    if($user) {
        
    
        
        
        
      // Обрабатываем POST массив  
        foreach($_POST as $key =>$value){
        if($key == "phone") {
           
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
            
            
    
$user->$key = $clean_phone;
            
        } else {    
        $user->$key = trim($_POST[$key]); }
    }
    
   
      
        
        
        if($user->save()){
           $session->action_maker("update");
           
          /* echo "<pre>";
            print_r($_POST);
           echo "</pre>";
            echo "<hr>";
            echo $user->phone;*/
           //redirect("edit_profile.php");  
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

<h1 class="text-center">Редактировать Профиль</h1>
    
 
<br><br>
</div>
</div><!-- end row 3 -->

<div class="row">
<div class="col-md-10 col-md-offset-1">


    
 <?php 
 if ($session->action_checker() == "update") {
    
       echo $alert->alert_success("Ваш профиль успешно обновлен!"); 
    
}    
    
    
    
    ?>   
    
    
    
    
    
<form class="form-horizontal" id="add_object_form" action="" method="post">
  <fieldset>
  
   
    
 <div class="form-group">
    <label class="col-sm-3 control-label">Ваш еmail:</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?=$user->email?></p>
    </div>
  </div>
       
       
   
  
    <div class="form-group">
      <label for="username" class="col-sm-3 control-label">Ваше имя:</label>
    <div class="col-sm-8 inputGroupContainer">
       <div class="input-group">
        <input type="text" name="username" class="form-control" id="username" placeholder="Ваше имя" value="<?=$user->username?>">
        <span class="input-group-addon">
           
         <i class="fa fa-user" aria-hidden="true" style="width: 20px;"></i>  
           </span>
       </div> 
    </div>   
    </div>
      
      
      
      
      
    <!--<div class="form-group">
      <label for="name" class="col-sm-3 control-label">Имя:</label>
    <div class="col-sm-8 inputGroupContainer">
       <div class="input-group">-->
        <input type="hidden" name="name" class="form-control" id="name" value="<?=$user->name?>">
       <!-- <span class="input-group-addon">
           
         <i class="fa fa-user" aria-hidden="true" style="width: 20px;"></i>  
           </span>
       </div> 
    </div>   
    </div> -->
      
      
   <!-- <div class="form-group">
      <label for="surname" class="col-sm-3 control-label">Фамилия:</label>
    <div class="col-sm-8 inputGroupContainer">
       <div class="input-group">-->
        <input type="hidden" name="surname" class="form-control" id="surname" value="<?=$user->surname?>">
        <!--<span class="input-group-addon">
           
         <i class="fa fa-user" aria-hidden="true" style="width: 20px;"></i>  
           </span>
       </div> 
    </div>   
    </div>  -->
      
      
   <!-- <div class="form-group">
      <label for="patronymic" class="col-sm-3 control-label">Отчество:</label>
    <div class="col-sm-8 inputGroupContainer">
       <div class="input-group">-->
        <input type="hidden" name="patronymic" class="form-control" id="patronymic" value="<?=$user->patronymic?>">
      <!--  <span class="input-group-addon">
           
         <i class="fa fa-user" aria-hidden="true" style="width: 20px;"></i>  
           </span>
       </div> 
    </div>   
    </div>   
      -->
      
      
<!--    <div class="form-group">
      <label for="gender" class="col-sm-3 control-label">Пол:</label>
    <div class="col-sm-8 inputGroupContainer">
       <div class="input-group">-->
        <input type="hidden" name="gender" class="form-control" id="gender" value="<?=$user->gender?>">
     <!--   <span class="input-group-addon">
           
         <i class="fa fa-user" aria-hidden="true" style="width: 20px;"></i>  
           </span>
       </div> 
    </div>   
    </div>   -->
      
        
      
      
      
      
      
              <div class="form-group">

    <label for="account_type" class="col-sm-3 control-label">Тип акаунта:</label>
    
              <div class="col-sm-5">


    <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-default <?=($user->account_type==1) ? "active" : ""; ?>">
            <input type="radio" name="account_type" value="1"  <?=($user->account_type==1) ? "checked" : ""; ?> >собственник
        </label>
        <label class="btn btn-default <?=($user->account_type==2) ? "active" : ""; ?>">
            <input type="radio" name="account_type" value="2" <?=($user->account_type==2) ? "checked" : ""; ?>>риэлтор
        </label>
        
    </div>
        </div>

    </div>
        
     
    
 
      
      
      
      
      
      

    
     <div class="form-group">
      
         <label for="phone" class="col-sm-3 control-label">Ваш телефон:</label>
      
         
                
<!--    <div class="col-sm-8">
     
         <input type="tel" name="phoneNumber" class="form-control" id="phoneNumber"  />
       
      
    </div>   -->
         
         
         
     <div class="col-sm-8 inputGroupContainer">
       <div class="input-group">
       <input type="tel" name="phone" class="form-control" id="phone" value="<?=$user->phone?>" >
        <span class="input-group-addon">
     <i class="fa fa-lg fa-mobile" aria-hidden="true" style="width: 20px;"></i>
        </span>
        </div> 

    </div>    
         
         
        
          
         
    </div>
    
   
     
    

      
 <!--  
    
      <div class="form-group">
      <label for="description" class="col-sm-3 control-label">О себе:</label>
      <div class="col-sm-8">
       
          
        <textarea class="form-control" type="description" name="description" id="description" placeholder="Расскажите немного о себе" maxlength="2000" rows="3" value=""><?=$object->description?></textarea>

  
      
      </div>
    </div>
    
  -->
  
    <div class="form-group">
      <div class="col-sm-8 col-sm-offset-3">
      
          
        <input type="submit" class="btn btn-primary btn-lg" name="update" value="Сохранить" />  
          
          
        <!--<a href="objects.php" class="btn btn-danger btn-lg">Отмена</a>-->
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

<!--<script src="js/jquery_price_format.js"></script>

<script src="js/maskedinput.js"></script>

<script src="dist/js/bootstrap-select.js"></script>
<script src="dist/js/i18n/defaults-ru_RU.js"></script>-->

<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/formValidation.min.js"></script>
<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/language/ru_RU.js"></script>
    
    

<script type="text/javascript" src="plugins/intl-tel-input-9.0-2.3/build/js/intlTelInput.min.js"></script>    

    
    
    
<script type="text/javascript" src="plugins/jQuery-Mask-Plugin/dist/jquery.mask.min.js"></script>
  
    
    
    

<!--ДАДАТА подсказки -->   
    
<!--[if lt IE 10]>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>
<![endif]-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.suggestions/16.5.1/js/jquery.suggestions.min.js"></script>

    
   
    
    

<script>
  $(document).ready(function () {
      
   
      
    $("#username").suggestions({
  serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
  token: "14f522fdfb0d70138138f6d41a4faeebcfb4e805",
  type: "NAME",
  onSelect: function(suggestion) {
    console.log(suggestion);
      var obj = suggestion.data;
       $("#name").val(obj.name);
       $("#surname").val(obj.surname);
       $("#patronymic").val(obj.patronymic);
      
      function gender2str(gender) {
        switch(gender) {
            case "MALE": return "Мужчина"; break;
            case "FEMALE": return "Женщина"; break;
            case "UNKNOWN": return "Не определен"; break;
        }  
        return "";  
}
      //var ru_genger = 
      
       $("#gender").val(gender2str(obj.gender));

      
      
  }
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
      
  // $("#phone").intlTelInput("<?=$user->phone?>");

/*
      
   $("#phoneNumber").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });   
  
    
      */
      
   /////////////// Пошла Валидация форм  
      
      
     $('#add_object_form')
     
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

            

            
            username: {
                validators: {
                    notEmpty: {
                        //message: 'The password is required and cannot be empty'
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
                },
            
       /* description: {
                validators: {
                    stringLength: {
                        min: 30,
                        max: 2000,
                        message: 'Пожалуйста, напишите о себе хотябы 30 символов, но не больше 2000'
                    },
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            },*/
          
            
            account_type: {
                validators: {
                    notEmpty: {
                        //message: 'The color is required'
                    }
                }
            }
            
           
        }
    })// Revalidate the number when changing the country
        .on('click', '.country-list', function() {
            $('#add_object_form').formValidation('revalidateField', 'phoneNumber');
        });
      
      

      
      
      

  
      
      
      
 }); // end document.ready
    
  
    
    
    
</script> 

    
    

   


</body>
</html>