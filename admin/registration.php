<?php 

require_once("includes/init.php");



if($session->is_signed_in()) {
    
 redirect("index.php");   
    
}

// Переменные ошибок
  $incorrect_email = "";
  $email_exist = "";
  $email_empty = "";
  $username_empty = "";
  $password_empty = "";
  $password_2_empty = "";
 



if(isset($_POST['btn_submit'])) {
    
 $email = trim($_POST['email']);
 $username = trim($_POST['username']);
 $password = trim($_POST['password']);
 $password_2 = trim($_POST['password_2']);

 
    
// Ошибки   
    
  if(empty($email) || empty($username) || empty($password) || empty($password_2)) {
      
   $the_message = $alert->alert_danger("Пожалуйста, заполните все данные"); 
      
    
      
    $data_array = array("email", "username", "password", "password_2");

    foreach($data_array as $value) {
    if(empty($$value) && !empty($_POST)) {
        $var = $value."_empty";
        $$var = "text-danger";  
    }
        
        
    }
      
      
      
      
      
  } 
 
 elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  
$the_message = $alert->alert_danger("Введите корректный E-mail адрес");
     
     
     $incorrect_email = "class='text-danger'"; 
     
 }
     
    
  elseif($password !== $password_2){
  
      $the_message = $alert->alert_danger("Пароли не совпадают");
      
  }

    
 else {
     
    if(User::verify_email($email)) {

        $the_message = $alert->alert_danger("Такой E-mail уже зарегистрирован");
        $email_exist = "text-danger"; 
  
        
    }    

 }
    
    
  if(empty($the_message)) {
    
  $user = new User();
                        
  $user->username = $username;
  $user->password = $password;          
  $user->email = $email; 
        
                 
    
    
if($user->create()) {
    
 //$session->login($user_found);
 redirect("congratulations.php");
    
} else {
    
   $the_message = $alert->alert_danger("Упс! Что-то пошло не так!");
    
}

      }
    
}
else {
    
  $email = "";
  $username = "";
  $password = "";
  $password_2 = "";
  $the_message = "";
    
  
  $email_empty = "";
  $username_empty = "";
  $password_empty = "";
  $password_2_empty = "";
    
}




?>

<?php require_once("includes/header.php");?>
<body>
<?php include("includes/top_nav.php"); ?>

  <br>
<div class="container">
    <div class="row">
        <div class='col-md-3'></div>
        <div class="col-md-6">
            <div class="login-box well" style="background: #FFF; border-radius: 0px;">
                

                
                
               
 
                
                
                
                
                
                    <form action="" id="reg_form" method="post">
                        <legend class="text-center">
                   
                         
                            
              <a href="login.php" class="btn" style="font-size: 1.05em;" >Вход</a>
              <a href="registration.php" class="btn active" style="font-size: 1.05em; color: #555" >Регистрация</a>   
                        
                        </legend>
                        
                         <?=$the_message?>
                        <div class="form-group">
             <label for="email" class="control-label <?=$email_empty?><?=$incorrect_email?><?=$email_exist?>">Ваш E-mail</label>
                            <input name="email" value="<?=htmlentities($email)?>" id="email" placeholder="E-mail" type="text" class="form-control input-lg" />
                        </div>
                        
                        
                         <div class="form-group">
                    <label for="username" class="control-label <?=$username_empty?>" >
                        Ваше имя</label>
                            <input name="username" value="<?=htmlentities($username)?>" id="username" placeholder="Имя" type="text" class="form-control input-lg" />
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="control-label <?=$password_empty?>">Придумайте пароль</label>
                            <input id="password" name="password" value="<?=htmlentities($password)?>" placeholder="Пароль" type="password" class="form-control input-lg" />
                        </div>
                        
                        
                         <div class="form-group">
                            <label for="password_2" class="control-label <?=$password_2_empty?>">Повторите пароль</label>
                            <input id="password_2" name="password_2" value="<?=htmlentities($password_2)?>" placeholder="Пароль" type="password" class="form-control input-lg" />
                        </div>
                       <br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-block btn-success" name="btn_submit" id="btn_submit" value="Зарегистрироваться" />
                        </div>
                        
                        <div class="form-group">
                            <hr>
                            <p class="text-center m-t-xs text-sm">Уже зарегистрированны?</p> 
                            <a href="login.php" class="btn btn-primary btn-block ">Войти</a>
                        </div>
                    </form>
                
            </div>
        </div>
        <div class='col-md-3'></div>
    </div>
</div>

<br>
<br>
<br>
<br>


    
    <?php include("includes/footer.php"); ?>


    
 <script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/formValidation.min.js"></script>
<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="formvalidation-dist-v0.7.1/dist/js/language/ru_RU.js"></script>   
    
    
    
    
<script>
 $(document).ready(function(){
     
 $('#reg_form').formValidation({
        // I am validating Bootstrap form
        framework: 'bootstrap',
       // excluded: ':disabled',
        // Feedback icons
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        locale: 'ru_RU',
        // List of fields and their validation rules
        fields: {
            
           
                
                
             
            
           
            
            email: {
                validators: {
                    notEmpty: {
                        //message: 'The password is required and cannot be empty'
                    },
                     
                    regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'Пожалуйста, введите правильный адрес эл. почты'
                        }
                }
            },
            username: {
                validators: {
                    notEmpty: {
                        //message: 'The password is required and cannot be empty'
                    }
                }
            },
            password: {
                validators: {
                    //enabled: false,
                    notEmpty: {
                    //message: 'The password is required and cannot be empty'
                    },
                    stringLength: {
                            min: 3,
                            max: 30,
                            message: 'Пароль должен быть длиной от 3 до 30 символов'
                        }
                }
            },
            password_2: {
                //enabled: false,
                validators: {
                    notEmpty: {
                        //message: 'The password is required and cannot be empty'
                    },
                    identical: {
                    field: 'password',
                    message: 'Пароли не совпадают'

                }
                }
            }
            
           
            
           
         
        }
    });
 // Enable the password/confirm password validators if the password is not empty
      /*  .on('keyup', '[name="password"]', function() {
            var isEmpty = $(this).val() == '';
            $('#reg_form')
                    .formValidation('enableFieldValidators', 'password', !isEmpty)
                    .formValidation('enableFieldValidators', 'password_2', !isEmpty);

            // Revalidate the field when user start typing in the password field
            if ($(this).val().length == 1) {
                $('#reg_form').formValidation('validateField', 'password')
                                .formValidation('validateField', 'password_2');
            }
        }); */
         
     
     
 });   
    
    
    
    </script>
</body>
</html>