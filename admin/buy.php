<?php
header("Content-Type: text/html; charset=UTF-8"); 
error_reporting(E_ALL & ~E_NOTICE);
require_once("includes/init.php");



if(!$session->is_signed_in()) {
//redirect("login.php");
}



if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
		  
    foreach($_POST as $key =>$value){
        $$key = $_POST[$key];
    }
  
       
   // $metro = $_POST[metro];
    
    if(empty($metro)) {
    $metro = array(
    0=>'Авиамоторная', 1=>'Автозаводская', 2=>'Академическая', 3=>'Александровский сад', 4=>'Алексеевская', 5=>'Алма-Атинская', 6=>'Алтуфьево', 7=>'Аннино', 8=>'Арбатская', 9=>'Аэропорт', 10=>'Бабушкинская', 11=>'Багратионовская', 12=>'Баррикадная', 13=>'Бауманская', 14=>'Беговая', 15=>'Белорусская', 16=>'Беляево', 17=>'Бибирево', 18=>'Библиотека имени Ленина', 19=>'Битцевский парк', 20=>'Борисово', 21=>'Боровицкая', 22=>'Ботанический сад', 23=>'Братиславская', 24=>'Бульвар Адмирала Ушакова', 25=>'Бульвар Дмитрия Донского', 26=>'Бульвар Рокоссовского', 27=>'Бунинская Аллея', 28=>'Варшавская', 29=>'ВДНХ', 30=>'Владыкино', 31=>'Водный стадион', 32=>'Войковская', 33=>'Волгоградский проспект', 34=>'Волжская', 35=>'Волоколамская', 36=>'Воробьёвы горы', 37=>'Выставочная', 38=>'Выхино', 39=>'Деловой центр', 40=>'Динамо', 41=>'Дмитровская', 42=>'Добрынинская', 43=>'Домодедовская', 44=>'Достоевская', 45=>'Дубровка', 46=>'Жулебино', 47=>'Зябликово', 48=>'Измайловская', 49=>'Калужская', 50=>'Кантемировская', 51=>'Каховская', 52=>'Каширская', 53=>'Киевская', 54=>'Китай-город', 55=>'Кожуховская', 56=>'Коломенская', 57=>'Комсомольская', 58=>'Коньково', 59=>'Котельники', 60=>'Красногвардейская', 61=>'Краснопресненская', 62=>'Красносельская', 63=>'Красные Ворота', 64=>'Крестьянская Застава', 65=>'Кропоткинская', 66=>'Крылатское', 67=>'Кузнецкий Мост', 68=>'Кузьминки', 69=>'Кунцевская', 70=>'Курская', 71=>'Кутузовская', 72=>'Ленинский проспект', 73=>'Лермонтовский проспект', 74=>'Лесопарковая', 75=>'Лубянка', 76=>'Люблино', 77=>'Марксистская', 78=>'Марьина Роща', 79=>'Марьино', 80=>'Маяковская', 81=>'Медведково', 82=>'Международная', 83=>'Менделеевская', 84=>'Митино', 85=>'Молодёжная', 86=>'Мякинино', 87=>'Нагатинская', 88=>'Нагорная', 89=>'Нахимовский проспект', 90=>'Новогиреево', 91=>'Новокосино', 92=>'Новокузнецкая', 93=>'Новослободская', 94=>'Новоясеневская', 95=>'Новые Черёмушки', 96=>'Октябрьская', 97=>'Октябрьское Поле', 98=>'Орехово', 99=>'Отрадное', 100=>'Охотный Ряд', 101=>'Павелецкая', 102=>'Парк культуры', 103=>'Парк Победы', 104=>'Партизанская', 105=>'Первомайская', 106=>'Перово', 107=>'Петровско-Разумовская', 108=>'Печатники', 109=>'Пионерская', 110=>'Планерная', 111=>'Площадь Ильича', 112=>'Площадь Революции', 113=>'Полежаевская', 114=>'Полянка', 115=>'Пражская', 116=>'Преображенская площадь', 117=>'Пролетарская', 118=>'Проспект Вернадского', 119=>'Проспект Мира', 120=>'Профсоюзная', 121=>'Пушкинская', 122=>'Пятницкое шоссе', 123=>'Речной вокзал', 124=>'Рижская', 125=>'Римская', 126=>'Румянцево', 127=>'Рязанский проспект', 128=>'Савёловская', 129=>'Саларьево', 130=>'Свиблово', 131=>'Севастопольская', 132=>'Семёновская', 133=>'Серпуховская', 134=>'Славянский бульвар', 135=>'Смоленская', 136=>'Сокол', 137=>'Сокольники', 138=>'Спартак', 139=>'Спортивная', 140=>'Сретенский бульвар', 141=>'Строгино', 142=>'Студенческая', 143=>'Сухаревская', 144=>'Сходненская', 145=>'Таганская', 146=>'Тверская', 147=>'Театральная', 148=>'Текстильщики', 149=>'Тёплый Стан', 150=>'Технопарк', 151=>'Тимирязевская', 152=>'Третьяковская', 153=>'Тропарёво', 154=>'Трубная', 155=>'Тульская', 156=>'Тургеневская', 157=>'Тушинская', 158=>'Улица 1905 года', 159=>'Улица Академика Янгеля', 160=>'Улица Горчакова', 161=>'Улица Скобелевская', 162=>'Улица Старокачаловская', 163=>'Университет', 164=>'Филёвский парк', 165=>'Фили', 166=>'Фрунзенская', 167=>'Царицыно', 168=>'Цветной бульвар', 169=>'Черкизовская', 170=>'Чертановская', 171=>'Чеховская', 172=>'Чистые пруды', 173=>'Чкаловская', 174=>'Шаболовская', 175=>'Шипиловская', 176=>'Шоссе Энтузиастов', 177=>'Щёлковская', 178=>'Щукинская', 179=>'Электрозаводская', 180=>'Юго-Западная', 181=>'Южная', 182=>'Ясенево'
);
}  
    
   /* 
    foreach($metro as $key => $value){
        
      echo $key. "=>'". $value. "', ";  
        
    }*/
    
    
  $query = Building::form_query();
    
  $buildings = Building::find_this_query($query);
    
  $table = Building::draw_table($buildings);
    
    	  
		  
		   // Помещаем значения в сессию

            $_SESSION['metro'] = $metro;
            $_SESSION['do_metro'] = $do_metro;
			$_SESSION['walls_types'] = $walls_types;
            $_SESSION['year_of_built_ot'] = $year_of_built_ot;
            $_SESSION['year_of_built_do'] = $year_of_built_do;
            $_SESSION['floors_ot'] = $floors_ot;
            $_SESSION['floors_do'] = $floors_do;

		  
		  
		//$output = show_data();
		
		

	// Для JQuery подгатавливаем выбранные районы
	
	$selected_walls_types = "";
	if($walls_types) {
	foreach($walls_types as $key => $value) {
		$selected_walls_types .= "'$value', ";
		}
	}
		
	$selected_metro = "";
	if($metro) {
	foreach($metro as $key => $value) {
		$selected_metro .= "'$value', ";
		}
    // Удаляем последнюю запятую
     $selected_metro = rtrim($selected_metro,', ');  
		
	}
	
	
	
	//echo $selected_metro;
	
	
	
	
	
	}

elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
	
		$metro = $_SESSION['metro'];
		$walls_types = $_SESSION['walls_types'];
		$year_of_built_ot =  $_SESSION['year_of_built_ot'];
		$year_of_built_do = $_SESSION['year_of_built_do'];
		$floors_ot = $_SESSION['floors_ot'];
		$floors_do = $_SESSION['floors_do'];
    
    
    
    
    $query = Building::form_query();
    
  $buildings = Building::find_this_query($query);
    
  $table = Building::draw_table($buildings);
    
    
    
	
	}





?>
<?php require_once("includes/header.php")?>
<body>


<?php include("includes/top_nav.php"); ?>

<div class="container">



<div class="row">
<div class="col-lg-12">

<h1 class="text-center">Поиск домов</h1>
    
<br><br>
</div>
</div><!-- end row 3 -->

<div class="row">
<div class="col-lg-12">
<form method="post" class="form-horizontal" action="">
  
        
    
    
    
    
 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fa fa-map-marker" aria-hidden="true"></i> Месторасположение
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         <img src="img/appartment_icon_buy.png" > Параметры квартиры
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
     
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         <i class="fa fa-building-o" aria-hidden="true"></i> Параметры дома
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
     
     
     
    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        <i class="fa fa-money" aria-hidden="true"></i> Параметры покупки
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>  
     
     
</div>   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        <div class="form-group">
     
         <div class="col-sm-6">
       
     
        <label class="control-label" for="okrug_select">Выберите Метро</label>
     
          
  <select id="metro" name="metro[]" class="selectpicker show-tick form-control" data-live-search="false" data-style="btn-default" data-actions-box="true" multiple>
  
    
<option value="Авиамоторная">Авиамоторная</option>
<option value="Автозаводская">Автозаводская</option>
<option value="Академическая">Академическая</option>
<option value="Александровский сад">Александровский сад</option>
<option value="Алексеевская">Алексеевская</option>
<option value="Алма-Атинская">Алма-Атинская</option>
<option value="Алтуфьево">Алтуфьево</option>
<option value="Аннино">Аннино</option>
<option value="Арбатская">Арбатская</option>
<option value="Аэропорт">Аэропорт</option>
<option value="Бабушкинская">Бабушкинская</option>
<option value="Багратионовская">Багратионовская</option>
<option value="Баррикадная">Баррикадная</option>
<option value="Бауманская">Бауманская</option>
<option value="Беговая">Беговая</option>
<option value="Белорусская">Белорусская</option>
<option value="Беляево">Беляево</option>
<option value="Бибирево">Бибирево</option>
<option value="Библиотека имени Ленина">Библиотека имени Ленина</option>
<option value="Битцевский парк">Битцевский парк</option>
<option value="Борисово">Борисово</option>
<option value="Боровицкая">Боровицкая</option>
<option value="Ботанический сад">Ботанический сад</option>
<option value="Братиславская">Братиславская</option>
<option value="Бульвар Адмирала Ушакова">Бульвар Адмирала Ушакова</option>
<option value="Бульвар Дмитрия Донского">Бульвар Дмитрия Донского</option>
<option value="Бульвар Рокоссовского">Бульвар Рокоссовского</option>
<option value="Бунинская Аллея">Бунинская Аллея</option>
<option value="Варшавская">Варшавская</option>
<option value="ВДНХ">ВДНХ</option>
<option value="Владыкино">Владыкино</option>
<option value="Водный стадион">Водный стадион</option>
<option value="Войковская">Войковская</option>
<option value="Волгоградский проспект">Волгоградский проспект</option>
<option value="Волжская">Волжская</option>
<option value="Волоколамская">Волоколамская</option>
<option value="Воробьёвы горы">Воробьёвы горы</option>
<option value="Выставочная">Выставочная</option>
<option value="Выхино">Выхино</option>
<option value="Деловой центр">Деловой центр</option>
<option value="Динамо">Динамо</option>
<option value="Дмитровская">Дмитровская</option>
<option value="Добрынинская">Добрынинская</option>
<option value="Домодедовская">Домодедовская</option>
<option value="Достоевская">Достоевская</option>
<option value="Дубровка">Дубровка</option>
<option value="Жулебино">Жулебино</option>
<option value="Зябликово">Зябликово</option>
<option value="Измайловская">Измайловская</option>
<option value="Калужская">Калужская</option>
<option value="Кантемировская">Кантемировская</option>
<option value="Каховская">Каховская</option>
<option value="Каширская">Каширская</option>
<option value="Киевская">Киевская</option>
<option value="Китай-город">Китай-город</option>
<option value="Кожуховская">Кожуховская</option>
<option value="Коломенская">Коломенская</option>
<option value="Комсомольская">Комсомольская</option>
<option value="Коньково">Коньково</option>
<option value="Котельники">Котельники</option>
<option value="Красногвардейская">Красногвардейская</option>
<option value="Краснопресненская">Краснопресненская</option>
<option value="Красносельская">Красносельская</option>
<option value="Красные Ворота">Красные Ворота</option>
<option value="Крестьянская Застава">Крестьянская Застава</option>
<option value="Кропоткинская">Кропоткинская</option>
<option value="Крылатское">Крылатское</option>
<option value="Кузнецкий Мост">Кузнецкий Мост</option>
<option value="Кузьминки">Кузьминки</option>
<option value="Кунцевская">Кунцевская</option>
<option value="Курская">Курская</option>
<option value="Кутузовская">Кутузовская</option>
<option value="Ленинский проспект">Ленинский проспект</option>
<option value="Лермонтовский проспект">Лермонтовский проспект</option>
<option value="Лесопарковая">Лесопарковая</option>
<option value="Лубянка">Лубянка</option>
<option value="Люблино">Люблино</option>
<option value="Марксистская">Марксистская</option>
<option value="Марьина Роща">Марьина Роща</option>
<option value="Марьино">Марьино</option>
<option value="Маяковская">Маяковская</option>
<option value="Медведково">Медведково</option>
<option value="Международная">Международная</option>
<option value="Менделеевская">Менделеевская</option>
<option value="Митино">Митино</option>
<option value="Молодёжная">Молодёжная</option>
<option value="Мякинино">Мякинино</option>
<option value="Нагатинская">Нагатинская</option>
<option value="Нагорная">Нагорная</option>
<option value="Нахимовский проспект">Нахимовский проспект</option>
<option value="Новогиреево">Новогиреево</option>
<option value="Новокосино">Новокосино</option>
<option value="Новокузнецкая">Новокузнецкая</option>
<option value="Новослободская">Новослободская</option>
<option value="Новоясеневская">Новоясеневская</option>
<option value="Новые Черёмушки">Новые Черёмушки</option>
<option value="Октябрьская">Октябрьская</option>
<option value="Октябрьское Поле">Октябрьское Поле</option>
<option value="Орехово">Орехово</option>
<option value="Отрадное">Отрадное</option>
<option value="Охотный Ряд">Охотный Ряд</option>
<option value="Павелецкая">Павелецкая</option>
<option value="Парк культуры">Парк культуры</option>
<option value="Парк Победы">Парк Победы</option>
<option value="Партизанская">Партизанская</option>
<option value="Первомайская">Первомайская</option>
<option value="Перово">Перово</option>
<option value="Петровско-Разумовская">Петровско-Разумовская</option>
<option value="Печатники">Печатники</option>
<option value="Пионерская">Пионерская</option>
<option value="Планерная">Планерная</option>
<option value="Площадь Ильича">Площадь Ильича</option>
<option value="Площадь Революции">Площадь Революции</option>
<option value="Полежаевская">Полежаевская</option>
<option value="Полянка">Полянка</option>
<option value="Пражская">Пражская</option>
<option value="Преображенская площадь">Преображенская площадь</option>
<option value="Пролетарская">Пролетарская</option>
<option value="Проспект Вернадского">Проспект Вернадского</option>
<option value="Проспект Мира">Проспект Мира</option>
<option value="Профсоюзная">Профсоюзная</option>
<option value="Пушкинская">Пушкинская</option>
<option value="Пятницкое шоссе">Пятницкое шоссе</option>
<option value="Речной вокзал">Речной вокзал</option>
<option value="Рижская">Рижская</option>
<option value="Римская">Римская</option>
<option value="Румянцево">Румянцево</option>
<option value="Рязанский проспект">Рязанский проспект</option>
<option value="Савёловская">Савёловская</option>
<option value="Саларьево">Саларьево</option>
<option value="Свиблово">Свиблово</option>
<option value="Севастопольская">Севастопольская</option>
<option value="Семёновская">Семёновская</option>
<option value="Серпуховская">Серпуховская</option>
<option value="Славянский бульвар">Славянский бульвар</option>
<option value="Смоленская">Смоленская</option>
<option value="Сокол">Сокол</option>
<option value="Сокольники">Сокольники</option>
<option value="Спартак">Спартак</option>
<option value="Спортивная">Спортивная</option>
<option value="Сретенский бульвар">Сретенский бульвар</option>
<option value="Строгино">Строгино</option>
<option value="Студенческая">Студенческая</option>
<option value="Сухаревская">Сухаревская</option>
<option value="Сходненская">Сходненская</option>
<option value="Таганская">Таганская</option>
<option value="Тверская">Тверская</option>
<option value="Театральная">Театральная</option>
<option value="Текстильщики">Текстильщики</option>
<option value="Тёплый Стан">Тёплый Стан</option>
<option value="Технопарк">Технопарк</option>
<option value="Тимирязевская">Тимирязевская</option>
<option value="Третьяковская">Третьяковская</option>
<option value="Тропарёво">Тропарёво</option>
<option value="Трубная">Трубная</option>
<option value="Тульская">Тульская</option>
<option value="Тургеневская">Тургеневская</option>
<option value="Тушинская">Тушинская</option>
<option value="Улица 1905 года">Улица 1905 года</option>
<option value="Улица Академика Янгеля">Улица Академика Янгеля</option>
<option value="Улица Горчакова">Улица Горчакова</option>
<option value="Улица Скобелевская">Улица Скобелевская</option>
<option value="Улица Старокачаловская">Улица Старокачаловская</option>
<option value="Университет">Университет</option>
<option value="Филёвский парк">Филёвский парк</option>
<option value="Фили">Фили</option>
<option value="Фрунзенская">Фрунзенская</option>
<option value="Царицыно">Царицыно</option>
<option value="Цветной бульвар">Цветной бульвар</option>
<option value="Черкизовская">Черкизовская</option>
<option value="Чертановская">Чертановская</option>
<option value="Чеховская">Чеховская</option>
<option value="Чистые пруды">Чистые пруды</option>
<option value="Чкаловская">Чкаловская</option>
<option value="Шаболовская">Шаболовская</option>
<option value="Шипиловская">Шипиловская</option>
<option value="Шоссе Энтузиастов">Шоссе Энтузиастов</option>
<option value="Щёлковская">Щёлковская</option>
<option value="Щукинская">Щукинская</option>
<option value="Электрозаводская">Электрозаводская</option>
<option value="Юго-Западная">Юго-Западная</option>
<option value="Южная">Южная</option>
<option value="Ясенево">Ясенево</option>
  
 
 
 
        
        
        </select>
       
        </div>
      
          <div class="visible-xs"><br></div>
          
             <div class="col-sm-6">
        <label class="control-label" for="do_metro">До Метро</label>     
            
            <select name="do_metro" id="do_metro" class="selectpicker form-control">
          <option value="0">не важно</option>
         <optgroup label="Пешком">
          <option value="5">до 5 мин. пешком</option>
          <option value="10">до 10 мин. пешком</option>
          <option value="15">до 15 мин. пешком</option>
          <option value="20">до 20 мин. пешком</option>
            </optgroup>
         <optgroup label="Транспортом">
          <option value="_15">до 15 мин. транспортом</option>
          <option value="_30">до 30 мин. транспортом</option>
          <option value="_45">до 45 мин. транспортом</option>
          <option value="_60">до 60 мин. транспортом</option>
            </optgroup>
        </select>
           
               
               
               
            
        </div>
      
     </div>
        
        
    
        
   
    <div class="form-group">
             
         <div class="col-sm-6" id="sandbox-container"> 
        
      <label for="year_of_built_ot" class="control-label">Годы постройки</label>
             
        
             
            <div class="input-daterange input-group" id="datepicker">
    <!--<input type="text" class="form-control" name="start" />-->
                
             <input type="text" name="year_of_built_ot" class="form-control" placeholder="От" id="year_of_built_ot" value="<?=$year_of_built_ot?>">
         
                
                
    <span class="input-group-addon"> - </span>
  <!--  <input type="text" class="form-control" name="end" />-->
                
            <input type="text" name="year_of_built_do" id="year_of_built_do" class="form-control" placeholder="До" value="<?=$year_of_built_do?>">     
                
</div>    
             
             
             
             
        </div>
     <div class="visible-xs"><br></div>
             
         <div class="col-sm-6"> 
        
      
             
        <label for="floors_ot" class="control-label">Этажность дома</label>
             
        
             
            <div class="input-daterange input-group" id="datepicker">
    <!--<input type="text" class="form-control" name="start" />-->
                
             <input type="text" name="floors_ot" id="floors_ot" class="form-control" placeholder="От" value="<?=$floors_ot?>">
         
                
                
    <span class="input-group-addon"> - </span>
  <!--  <input type="text" class="form-control" name="end" />-->
                
             <input type="text" name="floors_do" id="floors_do" class="form-control" placeholder="До" value="<?=$floors_do?>">
                
</div>    
             
             
             
             
        </div>
        
    </div>
              
             
             
             
             
    
    
    
    
    
    
   <!-- 
 
    <div class="form-group">
      <label for="floors_ot" class="col-lg-2 control-label">Этажность дома</label>
      <div class="col-lg-10">
          
          
          
          
<div class="row">
  <div class="col-xs-6">
     <input type="number" name="floors_ot" id="floors_ot" class="form-control" placeholder="От" value="<?=$floors_ot?>">
  </div>
  <div class="col-xs-6">
    <input type="number" name="floors_do" id="floors_do" class="form-control" placeholder="До" value="<?=$floors_do?>">
  </div>
            
</div>   
          
          
          
          
          

       
      
      </div>
    </div>
    
    -->
    
    
    <br>
    
    <div class="form-group">
      <div class="col-xs-12">
       <input type="submit" class="btn btn-block btn-success" value="Поиск">

      </div>
    </div>
 
</form>
</div>
</div>
<!-- Form row -->


<br><br><br><br>

    
    


<div class="row">

<div class="col-lg-12">
<?php
    //show_data_2()
    ?>

<?php 
echo $table;
             
  $b = new Building();
  echo $b->form_query();             
             
/* $buildings = Building::find_all_buildings();
    
      foreach($buildings as $building) {
          
         // echo $building->id." ". $building->floors."<br>";
       
          
  echo $building->street_type;
          echo " ";
  echo $building->street_name;
          echo " ";
  echo $building->dom;
          echo " ";
  echo $building->korpus;
          echo " ";
  echo $building->stroenie;
          echo "<br>";
          
          
          
      }      */            
             
             
             
             
             
/*$found_building = Building::find_building_by_id(1);
             
    echo $found_building['kad_number'];  */       

  /*           
   $result_set = Building::find_all_buildings();            
        while($row = mysqli_fetch_array($result_set)){
            
            echo $row['kad_number']."<br>";
            
        }  */                         
             
?>
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
<script src="js/maskedinput.js"></script>
<script src="dist/js/bootstrap-select.js"></script>
<script src="dist/js/i18n/defaults-ru_RU.js"></script>
    
    
<!--Выбор годов постройки плагин -->
<script src="plugins/bootstrap-datepicker-1/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/bootstrap-datepicker-1/locales/bootstrap-datepicker.ru.min.js"></script>  


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


      
      
// ГОДЫ
 /*     
 $("#year_of_built_ot").mask("9999",{placeholder:"____"});
  $("#year_of_built_do").mask("9999",{placeholder:"____"});
     */
      
     // $year_of_built_ot
      
 $('#year_of_built_ot').priceFormat({
    prefix: '',
    centsSeparator: '',
    thousandsSeparator: '',
    centsLimit: 0,
    limit: 4,
    clearOnEmpty: true
});    
      
$('#year_of_built_do').priceFormat({
    prefix: '',
    centsSeparator: '',
    thousandsSeparator: '',
    centsLimit: 0,
    limit: 4,
    clearOnEmpty: true
});    
      
      
      
      
//  Разбиваем Этажи на разряды
// http://jquerypriceformat.com/
  
 
// Разбиваем этажи 
      
$('#floors_ot').priceFormat({
    prefix: '',
    centsSeparator: '',
    thousandsSeparator: ' ',
    centsLimit: 0,
    limit: 2,
    clearOnEmpty: true
});
      
$('#floors_do').priceFormat({
    prefix: '',
    centsSeparator: '',
    thousandsSeparator: ' ',
    centsLimit: 0,
    limit: 2,
    clearOnEmpty: true
});
      

      
      
$('#sandbox-container .input-daterange').datepicker({
    format: "yyyy",
    startDate: "-500y",
    endDate: "01/01/2016",
    startView: 2,
    minViewMode: 2,
    maxViewMode: 2,
    autoclose: true
});

	
  });
</script> 

   


</body>
</html>