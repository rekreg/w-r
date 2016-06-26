<?php 

require_once("includes/init.php");



if($session->is_signed_in()) {
    
 redirect("index.php");   
    
}

if(isset($_POST['submit'])) {
    
 $email = trim($_POST['email']);
 $password = trim($_POST['password']);
 
/// Method to check database user
    
$user_found = User::verify_user($email, $password);    
     
    
    
if($user_found) {
    
 $session->login($user_found);
 redirect("index.php");
    
} else {
    
    $the_message = $alert->alert_danger("Неправильная пара E-mail / Пароль");
    
    
}
    
    
}
else {
    
  $email = "";
  $password = "";
  $the_message = "";
    
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
                

                
                
               
 
                
                
                
                
                
                    <form action="" method="post">
                        <legend class="text-center">
                            
              <a href="login.php" class="btn active" style="font-size: 1.05em; color: #555" >Вход</a>
              <a href="registration.php" class="btn" style="font-size: 1.05em;">Регистрация</a>
                        
                        </legend>
                        
                         <?=$the_message?>
                        <div class="form-group">
                            <label for="username-email">Ваш E-mail</label>
                            <input name="email" value="<?=htmlentities($email)?>" id="username-email" placeholder="E-mail" type="text" class="form-control input-lg" />
                        </div>
                        <div class="form-group">
                            <label for="password">Ваш пароль</label>
                            <input id="password" name="password" value="<?=htmlentities($password)?>" placeholder="Пароль" type="password" class="form-control input-lg" />
                        </div>
                        <div class="input-group">
                          <div class="checkbox" style="margin-top: 0px; padding-top: 0px; margin-bottom: 17px;">
                            <label>
                              <input id="login-remember" type="checkbox" name="remember" value="1"> Запомнить меня
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-block btn-success" name="submit" value="Войти" />
                        </div>
                        <span class='text-center'><a href="/resetting/request" class="text-sm">Забыли пароль?</a></span>
                        <div class="form-group">
                            <hr>
                            <p class="text-center m-t-xs text-sm">Еще не зарегистрированны?</p> 
                            <a href="registration.php" class="btn btn-primary btn-block ">Регистрация</a>
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
</body>
</html>