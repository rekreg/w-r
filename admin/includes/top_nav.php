
<nav class="navbar navbar-inverse" style="border-radius:0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="font-family: Play; letter-spacing: 2px;"><span style="color: #001a33; background: #e6f2ff; padding: 2px; border-radius: 3px; margin-right: 4px">ГЕГЕ</span>ДОМ</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Жилые Дома </a></li>
       <!-- <li class="active"><a href="buy.php">Квартиры</a></li>-->
         <!-- <li><a href="#">Риэлторы</a></li>
                  <li><a href="#">Сервисы</a></li>-->

     
       </ul>
    
      <ul class="nav navbar-nav navbar-right">
       <!-- <li><a href="new_object.php" style="color: orange;"><i class="fa fa-fw fa-plus-circle" aria-hidden="true"></i>
             Новое объявление</a></li>-->
       
    <?php 
      if(!$session->is_signed_in()) {
          echo "<li><a href='login.php'>Вход / Регистрация</a></li>";
 } else {
          
   require_once("user_nav.php");       
      }    
          
          ?>
          
      </ul>
        
        <a href="new_object.php" class="btn btn-sm btn-warning navbar-btn navbar-right" style="margin-right: 7px;">
         <!--   <i class="fa fa-fw fa-plus" aria-hidden="true"></i>-->
           <i class="fa fa-wpforms" aria-hidden="true"></i>
            
            Новое объявление</a>
    </div>
  </div>
</nav>
