<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <!--  <link rel="stylesheet" href="css/bootstrap-readable.css">-->
   <link rel="stylesheet" href="css/bootstrap-cerulean.css">
<!--      <link rel="stylesheet" href="css/bootstrap-cosmo.css">
-->
  <!--  <link rel="stylesheet" href="css/bootstrap-yeti.css">-->
 <!--<link rel="stylesheet" href="css/bootstrap-journal.css">-->
  <link rel="stylesheet" href="css/styles.css">
  <title>Bootstrap</title>
  <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="js/yandex-map.js" type="text/javascript"></script>
</head>

<body>





<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
      Мос ЖК
<!--  ГЕГЕДОМ -->      
      </a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Покупка </a></li>
        <li><a href="#">Продажа</a></li>
        <li><a href="#">Обмен </a></li>
        
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">КОНТАКТЫ</a></li>
      </ul>
    </div>
  </div>
</nav>



<div class="container">


<div class="row">


<div class="col-lg-12">

<ul class="breadcrumb">
  <li><a href="#">Москва</a></li>
  <li><a href="#">СЗАО</a></li>
  <li><a href="#">Щукино</a></li>
    <li><a href="#">М. Щукинская</a></li>

  
  
  <li class="active">ул. Авиационная, д. 79</li>
  
</ul>

</div>


</div> <!-- end row 1 -->



<div class="row">

<div class="col-lg-6 col-md-6 text-center">




<div class="panel panel-default">
  <div class="panel-body bg-warning">
   
    Жилой Комплекс: <br> <strong>Алые Паруса</strong>
  </div>
</div>



</div>

<div class="col-lg-6 col-md-6 text-center">



<div class="panel panel-default">
  
  <div class="panel-body">
  Дома в составе комплекса: <br>
   <strong> ул. Авиационная, дома</strong>
    <a href="#" class="btn btn-default btn-xs">77</a>,
    <a href="#" class="btn btn-default btn-xs">77 к.1</a>,
    <a href="#" class="btn btn-default btn-primary disabled btn-xs">79</a>,
    <a href="#" class="btn btn-default btn-xs">79 А</a>,
        <a href="#" class="btn btn-default btn-xs">79 Б</a>,
 <a href="#" class="btn btn-default btn-xs">79 к.1</a>
    
    
    
  </div>
</div>


<!--
<strong>Дома в составе комплекса:</strong><br>
ул. Авиационная, дома 77, 77 к.1, 79, 79 А, 79 Б, 79 к.1
-->


</div>




</div><!--end row 2 -->







<div class="row">

<div class="col-lg-12">

<ul class="nav nav-tabs">
  <li class="active "><a href="#about" data-toggle="tab" aria-expanded="true" onClick="demoReload();"><img src="img/block25.png" width="16" height="16" alt=""/> О доме</a></li>
  <li class=""><a href="#pano" data-toggle="tab" aria-expanded="false">
  <img src="img/panoramic1.png" width="16" height="16" alt=""/> Панорама</a></li>
  <li class=""><a href="#flat" data-toggle="tab" aria-expanded="false">
  <img src="img/plan1.png" width="16" height="16" alt=""/> Квартиры</a></li>
  
  
 </ul>
<div id="myTabContent" class="tab-content">

  <div class="tab-pane fade active in" id="about">
    
    		<div class="row" style="padding-top: 10px;">
    
    <div class="col-lg-6 col-md-6">
    
    <table class="table table-condensed table-hover ">
 
  <tbody>
    
    <tr>
      <td class="info text-right" style="width:50%;">Построен:</td>
      <td>2001</td>
    </tr>
     
     <tr>
      <td class="info text-right">Материал стен:</td>
      <td>Монолитно-кирпичные</td>
    </tr>
    
     <tr>
      <td class="info text-right">Этажей в доме:</td>
      <td>35</td>
    </tr>
    
    
  </tbody>
</table> 

    
    </div>
    
    
    <div class="col-lg-6 col-md-6">
    
    
    <table class="table table-hover table-condensed ">
 
  <tbody>
    
     <tr>
      <td class="info text-right">Подъездов:</td>
      <td>5</td>
    </tr>
    
    <tr>
      <td class="info text-right">Лифтов:</td>
      <td>12-пассажирских, 6-грузовых</td>
    </tr>
    
    
   <tr>
      <td class="info text-right" style="width:50%;">Квартир в доме:</td>
      <td>506</td>
    </tr>
   
  </tbody>
</table> 

    
    </div>
    
    
    
    
    
    </div> <!-- END ROW -->
    
    <div class="row">
    <div class="col-lg-6" >
     
 <!--   <img src="img/al-parusa.jpg" class="img-thumbnail gk_gallery"> 
    
    ////////////////// Начало КАРУСЕЛИ-->
    
    <div class="img-thumbnail" >
    
    
    
    
    <div id="carousel1" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel1" data-slide-to="0" class="active"></li>
    <li data-target="#carousel1" data-slide-to="1"></li>
    <li data-target="#carousel1" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active" ><img src="images/1.png" alt="First slide image" class="center-block" >
      <div class="carousel-caption">
        <!--<h3>First slide Heading</h3>
        <p>First slide Caption</p>-->
      </div>
    </div>
    <div class="item"><img src="images/2.png" alt="Second slide image" class="center-block" >
      <div class="carousel-caption">
        <!--<h3>Second slide Heading</h3>
        <p>Second slide Caption</p>-->
      </div>
    </div>
    <div class="item"><img src="images/3.png" alt="Third slide image" class="center-block" >
      <div class="carousel-caption">
       <!-- <h3>Third slide Heading</h3>
        <p>Third slide Caption</p>-->
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel1" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>
    
    
    
    
    </div>
    
    
    
    <!-- ///////////////Конец КАРУСЕЛИ-->
    
    
  
    
    </div>
          <div class="visible-sm visible-xs visible-md" style="height: 20px;"></div>

        <div class="col-lg-6">
       
        <div id="map" class="img-thumbnail">
      
 </div>       
        
        
        
        
        </div>

     
    
    
    
    </div>
    
    
  </div>
  
  
  
  <div class="tab-pane fade" id="pano">
  <div style="height:10px;"></div>
   <script src="//panoramas.api-maps.yandex.ru/embed/1.x/?lang=ru&ll=37.45070752%2C55.8058187&ost=dir%3A357.61579532814216%2C7.5961647727272945~span%3A123.15906562847611%2C80.00000000000001&size=%2C531&l=stv"></script>
   
    
   <!--<iframe src="https://www.google.com/maps/embed?pb=!1m0!3m2!1sen!2sru!4v1441570048660!6m8!1m7!1skiOTjOYYp2gpm7n8HS9Exw!2m2!1d55.80952950399188!2d37.44940320094688!3f179.43567583398826!4f1.6581459041856732!5f0.7820865974627469" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>-->
    
    
  </div>
  
  
  
  
  
  <div class="tab-pane fade" id="flat">
 
  <div style="height:10px;"></div>
    <table class="table table-hover table-condensed ">
 
  <tbody>
    
     <tr>
      <td class="info text-right">Всего квартир в доме:</td>
      <td>506</td>
    </tr>
    
    <tr>
      <td class="info text-right">1-комнатные:</td>
      <td>от 56 - 78 м2</td>
    </tr>
    
    
   <tr>
      <td class="info text-right" style="width:50%;">2-комнатные:</td>
      <td>от 70 - 95 м2</td>
    </tr>
   
  </tbody>
</table> 

 
 
  </div>
  
  
 
  
</div>



</div>


</div> <!-- end row 3 -->


<br><br>
<div class="row zayavka" style="padding-bottom: 15px; padding-top: 30px;">
<div class="col-lg-6 col-md-6">
<form class="form-horizontal">
    
    
    
    
    
                  
         
             
              
      <div class="row">
 <h3 class="text-center col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1" style="padding:0px; padding-top: 7px; padding-bottom: 7px; margin-top:0px; margin-bottom: 26px; border-bottom: 0px solid #317eac; color: #555555">Оставить заявку Агенту:</h3>

  		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1"> 
        <div class="form-group">
  
  
    		<div class="btn-group btn-group-justified" data-toggle="buttons">
              <label class="btn btn-default">
                <input type="radio" name="options" id="option1" autocomplete="off"> Купить
              </label>
             
             
              <label class="btn btn-default">
                <input type="radio" name="options" id="option4" autocomplete="off"> Снять
              </label>
             
             </div>
 			</div>
    
    
    
     <div class="form-group">
             
             
              
   
    		<div class="btn-group btn-group-justified " data-toggle="buttons">
              <label class="btn btn-default">
                <input type="radio" name="options" id="option1" autocomplete="off"> 
                1-к<span class="hidden-xs">ом</span>
              </label>
              <label class="btn btn-default">
                <input type="radio" name="options" id="option2" autocomplete="off"> 
                2-к<span class="hidden-xs">ом</span>
              </label>
              <label class="btn btn-default">
                <input type="radio" name="options" id="option3" autocomplete="off"> 
                3-к<span class="hidden-xs">ом</span>
              </label>
              <label class="btn btn-default">
                <input type="radio" name="options" id="option4" autocomplete="off"> 
                4-к<span class="hidden-xs">ом</span>
              </label>
              <label class="btn btn-default">
                <input type="radio" name="options" id="option5" autocomplete="off"> 
                5-к<span class="hidden-xs">ом</span>
              </label>
              
              <label class="btn btn-default">
                <input type="radio" name="options" id="option5" autocomplete="off"> 
                6-к<span class="hidden-xs">ом</span>
              </label>
 			</div>
          </div>
    
    
    
    
    
    
    
    
    
    
    
    
    	
   
   
  
      <div class="form-group">
              
             <!-- <label class="text-center">Ваше имя:</label>-->
              
              	 <input type="text" class="form-control" placeholder="Ваше имя">
  
		</div>
        
        
        
        
           <div class="form-group">
              
            <!--  <label class="text-center">Ваш телефон:</label>-->
              
              	 <input type="text" class="form-control" placeholder="Ваш телефон">
  
		</div>
   
   
 
 
  <div class="form-group">
              
             <!-- <label class="text-center">Ваш email:</label>-->
              
              	 <input type="text" class="form-control" placeholder="Ваш email">
  
		</div>
  
  
 

  
  
  
  
  
  
  
  
    
    
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Получить варианты</button>
      </div>
    </div>
     	</div>

</form>

</div>

<div class="col-lg-6  col-md-6">
 
	<div class="row">
    
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-4 col-sm-4 col-xs-offset-3 col-xs-6">
         <div class="panel panel-default">
          <div class="panel-heading ">
            <h3 class="panel-title text-center ">Агент на объекте: </h3>
          </div>
          <div class="panel-body" >
           <img src="img/Andrey.jpg" width="400" height="400" class="img-responsive img-thumbnail">
          </div>
  
   <div class="panel-footer text-center" >
  <h3 style="margin:0px; margin-bottom:7px; color:#555; font-size:130%;"> Николаев Андрей </h3>
    <span class="text-info" style="font-size:130%; color:#555;">
   <span class="glyphicon glyphicon-phone"></span> 
   
   8 (926) 320-56-04 </span>
   
   </div>
   	</div>
  	</div>
  
</div>


</div>

</div> <!--end row 4-->









</div> <!-- end container -->





<div class="container" style="margin-top: 30px;">


<div class="row">
<section class="col-lg-12">
<h1 class="text-center" style="margin-bottom: 5px;">Оказываем полное сопровождение сделок с недвижимостью</h1>
</section>
</div>

<div class="row">
 <section class="col-lg-offset-4 col-lg-4" style="margin-bottom: 40px;">


  
  
  <div class="btn-group btn-group-justified">
  <a href="#" class="btn btn-success active">Покупка</a>
  <a href="#" class="btn btn-success">Найм</a>
</div>




  
</section>
</div>



<div class="row what_to_include">

 

    <section class="col-sm-6 col-md-4 col-lg-4">
      <img class="icon" src="img/search.jpg" alt="Icon">
      <h3>Поиск квартиры</h3>
      <p>Подбираем квартиру по вашим параметрам.</p>
    </section>

    <section class="col-sm-6 col-md-4 col-lg-4">
      <img class="icon" src="img/avans.jpg" alt="Icon">
      <h3>Внесение аванса</h3>
      <p>Организуем безопасное внесение аванса продавцу.</p>
    </section>

    <section class="col-sm-6 col-md-4 col-lg-4">
      <img class="icon" src="img/check_flat.jpg" alt="Icon">
      <h3>Проверка квартиры</h3>
      <p>Проверка юридической чистоты квартиры и дееспоспобности продавца.</p>
    </section>

    <section class="col-sm-6 col-md-4 col-lg-4">
      <img class="icon" src="img/dkp.jpg" alt="Icon">
      <h3>Подготовка договора</h3>
      <p>Подготавливаем договор купли-продажи квартиры.</p>
    </section>

    <section class="col-sm-6 col-md-4 col-lg-4">
      <img class="icon" src="img/deal.jpg" alt="Icon">
      <h3>Проведение сделки</h3>
      <p>Полностью сопровождаем Вас в процессе сделки.</p>
    </section>

    <section class="col-sm-6 col-md-4 col-lg-4">
      <img class="icon" src="img/end.jpg" alt="Icon">
      <h3>Передача квартиры</h3>
      <p>Организуем передачу квартиры, подписываем акт приема-передачи.</p>
    </section>   
  </div><!-- row -->  


</div> <!--end container-->






<br><br>
<br>
<br>
<br>

<hr />
    <footer class="container" style="height: 40px;">
      <p class="text-right">
      
     
    
     
«Русские ЖК» - <?=date('Y')?> г.
<br>
 По любым вопросам: masreg@bk.ru
  
<br><br>
      </p>

    </footer>


<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/script.js"></script>
</body>
</html>