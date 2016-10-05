<?php

class Building {

    
    
  protected static $db_table = "buildings";
  protected static $db_table_fields = array('kad_number', 'average_m2_cost', 'flats_cost', 'floor_types', 'flats_type', 'flats_m2', 'status');  
    
    
    
  public $id;
  public $kad_number;
  public $inhabited;
  public $kad_district;
  public $metro;
  public $street_type;
  public $street_name;
  public $dom;
  public $korpus;
  public $stroenie;
  public $floors;
  public $u_floors;
  public $year_of_built;
  public $year_of_use;
  public $walls;
  public $flats;
  public $average_m2_cost;
  public $flats_cost;
  public $floor_types;
  public $flats_type;
  public $flats_m2;
  public $metro_name_1;
  public $metro_name_2;
  public $metro_name_3;
  public $metro_name_4;
  public $metro_name_5;
  
  public $metro_line_1;
  public $metro_line_2;
  public $metro_line_3;
  public $metro_line_4;
  public $metro_line_5;
    
  public $distance_1;
  public $distance_2;
  public $distance_3;
  public $distance_4;
  public $distance_5;
    
  public $duration_1;
  public $duration_2;
  public $duration_3;
  public $duration_4;
  public $duration_5;
    
  public $longitude;
  public $latitude;
  public $district_str;

    
    
    
public static function form_query(){
    
   global $metro,
          $do_metro,
		  $walls_types,
		  $year_of_built_ot,
		  $year_of_built_do,
		  $floors_ot,
		  $floors_do;
    global $database;
		  
		  
/////////// Работа с метро //////////////

   
    
     $metro_sql = "";
    
    
    if($metro && $do_metro == false){
        // Если пользователь выбрал растояние пешком
       
        foreach ($metro as $key => $value){
            $metro_sql .= "metro_name_1 = '{$value}' OR ";  
           
        }
        $metro_sql = rtrim($metro_sql,' OR '); 
    }
    elseif($metro && $do_metro){
        // Если пользователь выбрал растояние пешком
        if($do_metro[0] !== "_") {
        $do_metro_true = $do_metro * 60;
        foreach ($metro as $key => $value){
           for($i=1; $i<=5; $i++){
            $metro_sql .= "(metro_name_{$i} = '{$value}' AND duration_{$i} BETWEEN 1 AND {$do_metro_true} AND (do_metro_kak_{$i} = 'пеш' OR do_metro_kak_{$i} = 'пеш по коорд')) OR ";  
            }
           
        }    
            
            
        } 
        // Если пользователь выбрал растояние транспортом
        else {
           $do_metro_true = substr($do_metro, 1); 
           $do_metro_true = $do_metro_true * 60;
        foreach ($metro as $key => $value){
           for($i=1; $i<=5; $i++){
            $metro_sql .= "(metro_name_{$i} = '{$value}' AND duration_{$i} BETWEEN 1 AND {$do_metro_true} AND (do_metro_kak_{$i} = 'пеш' OR do_metro_kak_{$i} = 'пеш по коорд' OR do_metro_kak_{$i} = 'трансп')) OR ";
            }
           
        }  
            
            
        }
        $metro_sql = rtrim($metro_sql,' OR ');  
       // return $metro_sql;
    }
    else {
    $metro_sql .= "metro_name_1 ='Пражская'";    
    }
		  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 /////////// Работа с растояниями до метро ////////////////   
  /*  
    $do_metro_sql = "";
    
     if($do_metro) {
         
         
        if($do_metro[0] !== "_") {
            
             $do_metro_true = $do_metro * 60;
            
             for($i=1; $i<=5; $i++){
             $do_metro_sql .= "(duration_{$i} < {$do_metro_true} AND (do_metro_kak_{$i} = 'пеш' OR do_metro_kak_{$i} = 'пеш по коорд')) OR ";
             } 
             $do_metro_sql = rtrim($do_metro_sql,' OR ');
                 
         } else {
            
             $do_metro_true = substr($do_metro, 1); 
             $do_metro_true = $do_metro_true * 60;
            
             for($i=1; $i<=5; $i++){
             $do_metro_sql .= "(duration_{$i} < {$do_metro} AND do_metro_kak_{$i} = 'трансп') OR ";
             } 
             $do_metro_sql = rtrim($do_metro_sql,' OR ');   
            
            
            
            
        }
         
         
         
         
     }
     else {
     $do_metro_sql = "";
         $do_metro_sql .= "duration_1 != '' OR duration_2 != '' OR duration_3 != '' OR duration_4 != '' OR duration_4 != ''";
     }
    */
    
    
    
    
    
		  
/////////// Годы постройки ////////////////

if($year_of_built_ot !=="" || $year_of_built_do !=="") {
		if(!$year_of_built_ot) {
			$year_of_built_ot = "1360";
			}
		if(!$year_of_built_do) {
			$year_of_built_do = date('Y');
			}	
		$year_sql ="(year_of_built BETWEEN '{$year_of_built_ot}' AND '{$year_of_built_do}') ";
 } else { $year_sql = "year_of_built BETWEEN 1360 AND 2016"; }
		  
/////////// Работа с этажами //////////////

if($floors_ot !=="" || $floors_do !=="") {
		if(!$floors_ot) {$floors_ot = "1";}
		if(!$floors_do) {$floors_do = "73";}	
		$floor_sql ="(floors BETWEEN '{$floors_ot}' AND '{$floors_do}')";
 } else { $floor_sql = "floors BETWEEN 1 AND 73"; }
 
 
 

   
    
/*SELECT * FROM metro_info, buildings WHERE (metro_name_1 = 'Бульвар Дмитрия Донского' OR metro_name_2 = 'Бульвар Дмитрия Донского' OR metro_name_3 = 'Бульвар Дмитрия Донского' OR metro_name_4 = 'Бульвар Дмитрия Донского' OR metro_name_5 = 'Бульвар Дмитрия Донского') AND (metro_info.dom_id=buildings.id) LIMIT 20;  */  
    
   
   
    
    
$sql = "SELECT * FROM metro_info, buildings WHERE ";
$sql .= "(".$metro_sql.")";
$sql .= " AND ";   
$sql .= "(".$floor_sql.")";
$sql .= " AND ";   
$sql .= "(".$year_sql.")";
$sql .=" AND (metro_info.dom_id=buildings.id)"; 
$sql .= " LIMIT 30";
  
return $sql;   
    

    
}    
    
public function get_table($sql){

$output = "";    
$output .= "
	<div class='table-responsive'>
	<table class='table table-striped table-hover'>
  <thead>
    <tr>
		  <th>Кадастровый номер</th>
	  <th>Год постройки</th>
      <th>Адрес</th>
      <th>Этажность</th>
      <th>Материал стен</th>
       <th>Материал стен</th>
    </tr>
  </thead>
  <tbody>
	";


$query = $this->query($sql);
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	
	//<tr onclick="document.location = 'links.html';">


	  $output .= "<tr onclick=\"window.open('doma.php?id={$row['id']}')\" style='cursor:pointer'>";

	$output .= "<td> {$row['kad_number']}</td>";
		
		$output .= "<td>";
		if($row['year_of_built']) {
			$output .= $row['year_of_built']; }
	    elseif($row['year_of_use']) { 
			$output .= $row['year_of_use'];
			}
		else {
			$output .= "-";
			}
			$output .= "</td>
		<td>";
		 $output .= "{$row['street_type']}. ";
		 $output .= "{$row['street_name']}, ";
		 $output .= "д. {$row['dom']}";
		 if($row['korpus'] ){
		 $output .= ", кор. ".$row['korpus'];
		 }
		 
		  if($row['stroenie'] ){
		 $output .= ", стр. ".$row['stroenie'];
		 }
		 
		 $output .= " </td>
		<td> {$row['floors']}</td>";
		 $output .= "<td> {$row['walls']}</td> 
		</tr>";
	
	
	
	
}

$output .= "</tbody></table> </div> ";
    
    
 return $output;   
    
    
}
    
public static function draw_table($object_array_with_buildings){
global $metro;
$output = "";    
$output .= "
	<div class='table-responsive'>
	<table class='table table-striped table-hover'>
  <thead>
    <tr>
		  <th>Метро</th>
	  <th>Год постройки</th>
      <th>Адрес</th>
      <th>Этажность</th>
      <th>Материал стен</th>
      <th>Данные</th>
    </tr>
  </thead>
  <tbody>
	";


foreach($object_array_with_buildings as $building) {
	
	//<tr onclick="document.location = 'links.html';">


	  $output .= "<tr onclick=\"window.open('doma.php?kad=";
    
    $output .= urlencode($building->kad_number);
    $output .= "')\" style='cursor:pointer'>";

	//$output .= "<td> {$building->metro_name_1}</td>";
		
    
    
    $output .= "<td>";
    
    // if(empty($metro)) {$metro = $metro_2;}
    
    foreach($metro as $value){
        for($i=1; $i<=5; $i++){
            
            $attr = "metro_name_".$i;
          if($building->$attr == $value) {
              $output .= $building->$attr;
              goto end;
          }  
        }
    }
    end:
    $output .= "</td>";
    
    
    
    
    
    
    
    
		$output .= "<td>";
		if($building->year_of_built) {
			$output .= $building->year_of_built; }
	    elseif($building->year_of_use) { 
			$output .= $building->year_of_use;
			}
		else {
			$output .= "-";
			}
			$output .= "</td>";
		 $output .= "<td>";
         
        switch($building->street_type) {
            case "переулок": $output .= "пер. "; break;
            case "пр-кт": $output .= "просп. "; break;
            case "улица": $output .= "ул. "; break;
            case "бульвар": $output .= "бул. "; break;

   
            default:  $output .= "{$building->street_type}. ";
        }
         
         
         
         
         
		 $output .= "{$building->street_name}, ";
		 $output .= "д. {$building->dom}";
		 if($building->korpus){
		 $output .= ", кор. ".$building->korpus;
		 }
		 
		  if($building->stroenie){
		 $output .= ", стр. ".$building->stroenie;
		 }
		 
		 $output .= " </td>
		<td> {$building->floors}</td>";
		 $output .= "<td> {$building->walls}</td>";
         $output .= "<td>";
         if($building->inhabited == "1") {
             
           $output .= " <i class='fa fa-database text-success' aria-hidden='true'></i>";
            
         } else {
             
             $output .= " <i class='fa fa-ban text-danger' aria-hidden='true'></i>";  
             
         }
         
         $output .= "</td>";
		$output .= "</tr>";
	
	
	
	
}

$output .= "</tbody></table> </div> ";
    
    
 return $output;   
    
    
}
    
public function get_full_table($sql, $metro_arr){
global $database;
$output = "";    
$output .= "
	<div class='table-responsive'>
	<table class='table table-striped table-hover'>
  <thead>
    <tr>
      <th>Метро</th>
	  <th>Год постройки</th>
      <th>Адрес</th>
      <th>Этажность</th>
      <th>Материал стен</th>
      <th>Данные</th>
      
      
    </tr>
  </thead>
  <tbody>
	";


$query = self::find_this_query($sql);
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	
	//<tr onclick="document.location = 'links.html';">


	  $output .= "<tr onclick=\"window.open('doma.php?id={$row['id']}')\" style='cursor:pointer'>";

	$output .= "<td>"; 
    
    
    
    foreach($metro_arr as $value){
        
        for($i=1; $i<=5; $i++){
          if($row['metro_name_'.$i] == $value) {
              $output .= $row['metro_name_'.$i];
              goto end;
          }  
        }
    }
    
    end:
    
    
    $output .= "</td>";
		
		$output .= "<td>";
		if($row['year_of_built']) {
			$output .= $row['year_of_built']; }
	    elseif($row['year_of_use']) { 
			$output .= $row['year_of_use'];
			}
		else {
			$output .= "-";
			}
			$output .= "</td>
		<td>";
		 $output .= "{$row['street_type']}. ";
		 $output .= "{$row['street_name']}, ";
		 $output .= "д. {$row['dom']}";
		 if($row['korpus'] ){
		 $output .= ", кор. ".$row['korpus'];
		 }
		 
		  if($row['stroenie'] ){
		 $output .= ", стр. ".$row['stroenie'];
		 }
		 
		 $output .= " </td>
		<td> {$row['floors']}</td>";
		 $output .= "<td> {$row['walls']}</td>";
         
         $output .= "<td>{$row['inhabited']}</td>";
         
        
		$output .="</tr>";
	
	
	
	
}

$output .= "</tbody></table> </div> ";
    
    
 return $output;   
    
    
}    
    
    
    
///// Отрисовка Главной таблицы из из Массива
public static function draw_table_from_array($arr) {
		
		
    
 $output = "
<!-- Modal -->
<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
  <div class='modal-dialog modal-lg' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title text-center' id='myModalLabel'>Квартиры в доме</h4>
      </div>
      <div class='modal-body'>";
      
    
    
  
    
    
	$output .= "<div class='table-responsive'>";
	$output .= "<table class='table table-striped table-hover '>";
	
	$output .=  "
 <thead>
    <tr>
			  <th>№ Кв. </th>
			  <th>Этаж</th>
			  <th>Кол. комнат</th>
			  <th>м2</th>
			  <th>Кадастровая стоимость</th>
    </tr>
  </thead>
  <tbody>
"; 
		
		
		
		
		
		
		foreach($arr as $obj) {
	
				$output .= "<tr>";			  
	$output .= "<td> ";
	if(ctype_digit($obj->apartment)) {$output .= " кв. <span class='label label-warning'>
{$obj->apartment}</span></td>"; }
	elseif($obj->apartment) {
        $output .= " кв. <span class='label label-warning'>
{$obj->apartment}</span></td>";
    
    }
	else {$output .= " - "; }
	$output .= "</td>";						  
							  
	
	$output .= " <td> ";
	if($obj->floor) {$output .= "эт. {$obj->floor}"; }
	else {$output .= " - "; }
	$output .= "</td>";
	
	/*
	$output .= " <td> ";
	if($obj->rooms_str) {$output .= "{$obj->rooms_str}"; }
	else {$output .= " - "; }
	$output .= "</td>	";	*/
							  
	$output .= " <td> ";
	if($obj->rooms) {$output .= "{$obj->rooms}-комнатная"; }
	else {$output .= " - "; }
	$output .= "</td>	";					  
		
	$output .= " <td> ";
	if($obj->m2) {$output .= "{$obj->m2} м²"; }
	else {$output .= " - "; }
	$output .= "</td>	";	
	
	/*$output .= " <td> ";
	if($obj->count_address) {$output .= "{$obj->count_address}"; }
	else {$output .= " - "; }
	$output .= "</td>	";		*/				  
							  
					  
							
		 /* $output .= "<td>";
		
		  if($obj->egrp =="") { $output .= "<span class='label label-warning'><span class='glyphicon glyphicon-minus'></span> ЕГРП</span> "; } 
		  else  { $output .= "<span class='label label-success'><span class='glyphicon glyphicon-ok'></span> ЕГРП</span> ";}
		  if($obj->kadastr =="")  { $output .= "<span class='label label-warning'><span class='glyphicon glyphicon-minus'></span>КАДАСТР</span> ";}
		  else { $output .= "<span class='label label-success'><span class='glyphicon glyphicon-ok'></span> КАДАСТР</span> "; }
		  
		  $output .= "</td>";*/
							 
							 
		  $output .= "<td>";
		  if($obj->kad_price) {
              //$output .= "{$obj->kad_price}"; 
          $output .= number_format($obj->kad_price,0,'',' ');
          $output .= " <i class='fa fa-rub' aria-hidden='true'></i>";
          }
		  else {$output .= " - "; }
		  $output .= "</td>	";	
	
					$output .= " </tr>";
  
					} // foreach($arr as $key => $value)
		
		
		$output .=  " </tbody>";
		  $output .="</table>";
		  $output .="</div>";
    
    $output .= "
    
    </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default center-block' data-dismiss='modal'>Закрыть</button>
      </div>
    </div>
  </div>
</div> ";
    
    
    
    
    
    
	
	return $output;
		} // end function draw_table_from_array($arr)    
    
     
    
    
public static function main_appartment_table($arr) {
    
 if(empty($arr) || $arr->flats == 0){
 $output = " 
 <h2 class='text-center'>Квартиры</h2>

  <div class='alert alert-dismissible alert-warning text-center'>
      <i class='fa fa-ban' aria-hidden='true'></i> 
      НЕТ ДАННЫХ
  </div>";  
     return $output;
 } 
    else {  
$output = "<div class='row'>
<div class='col-xs-12'>
    
<h2 class='text-center'>Квартиры</h2>";
 
 $output .= "<div class='row'>"; 
     
 $output .= "<div class='col-md-6'>";    
     $output .= "<h3 class='text-center'> <i class='fa fa-money' aria-hidden='true'></i> Цены</h3>";

     $output .=  "<div class='panel panel-default'>
  <div class='panel-body'>"; 
    
     
     
     
  $output .= "<div class='table-responsive'>  
   <table class='table' >
  
  <tbody>
    <tr >
     <td class='text-right' style='border-top: 0px;'><br> 
     
     <span class='label label-primary'>Средн. цена м²:</span>
     
     </td>
      <td style='font-size: 300%; border-top: 0px;'>";
 $output .= $arr->average_m2_cost;
 $output .= " руб";  
 $output .= "</td></tr>";
     
     
$output .= "<tr><td class='text-right'>
 <span class='label label-primary'>Динамика за месяц:</span>
</td>";  
$output .= "<td style='height: 80px;'><span class='label label-success' style= 'font-size: 1.1em; font-weight: 200; display: inline-block; padding: 6px; margin: 0px;'> <i class='fa fa-level-up' aria-hidden='true'></i> 0,03 % </span>";

$output .= "</td></tr>";

 
$output .= "<tr><td class='text-right'>
<span class='label label-primary'>Цены квартир:</span>
</td>";  
$output .= "<td>";      
$output .= $arr->flats_cost;
$output .= "</td></tr>";
  
 $output .= " </tbody>
</table> 
    
    </div>";   
     
  $output .= "</div>";
  $output .= "</div>";
  $output .= "</div>";
     
 $output .= "<div class='col-md-6'>"; 
        $output .= "<h3 class='text-center'>  <img src='img/appartment_icon.png'> Параметры квартир</h3>";

     $output .=  "<div class='panel panel-default'>
  <div class='panel-body'>";
     
    
  $output .= "<div class='table-responsive'>  
   <table class='table'>
  
  <tbody>
    <tr>
    <td class='text-right' style='border-top: 0px;'><br> <span class='label label-primary'>Квартир в доме:</span>
</td>
      <td style='font-size: 300%; border-top: 0px;'>";
   $output .= $arr->flats;
    
  $output .= "<!-- Button trigger modal -->
<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal'>
  <i class='fa fa-database' aria-hidden='true'></i> Посмотреть 
</button>";      
     
     
 $output .= "</td></tr>";
     
     
$output .= "<tr><td class='text-right' style='height: 80px;'>

<span class='label label-primary'>Типы квартир:</span>

</td>";  
$output .= "<td>";
$output .= $arr->flats_type;
$output .= "<br>";     
$output .= $arr->floor_types;
$output .= "</td></tr>";

 
$output .= "<tr><td class='text-right'>

<span class='label label-primary'>Метражи:</span>

</td>";  
$output .= "<td>";      
$output .= $arr->flats_m2;
$output .= "</td></tr>";
  
 $output .= " </tbody>
</table> 
    
    </div>
    </div>
     </div>
    
    
    </div>
    
   <br> 
   <hr>
    <br>";
    
//$output .= self::draw_table_from_array($arr);
  
     
$output .= " </div> </div></div> <br><br>";    
 }
    
    
    return $output;
    
    
}        
    
    
    
    
    
    
    
    
 
public static function find_this_query($sql) {
    global $database;   
    $result_set = $database->query($sql);
    $the_object_array = array();
        
        while($row = mysqli_fetch_array($result_set)) {
           
            $the_object_array[] = self::instantation($row);
        
        }
        
    return $the_object_array;
   
    }
            
public static function find_all_buildings() {
    
        return self::find_this_query("SELECT * FROM buildings LIMIT 30");
        
    }
    
public static function find_buildings_by_quantity($number) {
    
        return self::find_this_query("SELECT * FROM buildings WHERE status = '' AND flats > 0 LIMIT {$number}");
        
    }    
    


public static function find_building_by_id($id) {
    $result_set = self::find_this_query("SELECT * FROM buildings WHERE id={$id} LIMIT 1");
    $found_building = mysqli_fetch_array($result_set);
    return $found_building;
    }   
    
    
    
public static function find_building_by_kad($kad) {
    $the_result_array = self::find_this_query("SELECT * FROM metro_info, buildings WHERE kad_number='$kad' AND (metro_info.dom_id=buildings.id) LIMIT 1");
    return !empty($the_result_array) ? array_shift($the_result_array) : false; 
    
  
    
    }    

    
public static function find_building_by_address($obj) {
    $the_result_array = self::find_this_query("SELECT * FROM metro_info, buildings WHERE (street_name='$obj->street' AND dom='$obj->house' AND korpus='$obj->block') AND (metro_info.dom_id=buildings.id) LIMIT 1");
    return !empty($the_result_array) ? array_shift($the_result_array) : false; 
    
  
    
    }     
    
    
    
    
public static function instantation($the_record){
    
    $the_object = new self;            
    
    foreach($the_record as $the_attribute => $value) {
if($the_object->has_the_attribute($the_attribute)){
    $the_object->$the_attribute = $value;
        }
        
    }    
        
   /* $the_object->id = $found_user['id']; 
    $the_object->username = $found_user['username']; 
    $the_object->password = $found_user['password']; 
    $the_object->first_name = $found_user['first_name'];
    $the_object->last_name = $found_user['last_name'];   */
        
        
        
      return $the_object;  
    }
      
private function has_the_attribute($the_attribute) {
    
    $object_properties = get_object_vars($this);
    
    return array_key_exists($the_attribute, $object_properties);
     
 }   


    
   
    protected function clean_properties() {
       global $database;
       $clean_properties = array();
       foreach($this->properties() as $key => $value) {
        $clean_properties[$key] = $database->escape_string($value);   
       }
        return $clean_properties;
    }
    
    
    public function save() {
    return isset($this->id) ? $this->update() : $this->create();
        
    }
    
    public function create() {
     global $database;
        
    $properties = $this->clean_properties();
        
    $sql = "INSERT INTO " .self::$db_table.
    "(".implode(",", array_keys($properties)).")";
    $sql .= "VALUES ('".  implode("','", array_values($properties))        ."')";
 
        
    if($database->query($sql)) {
        $this->id = $database->the_insert_id();
        return true;
    } else {
        return false;
    }
    
        
        
    }
    
    public function update() {
        global $database;
        
        
        $properties = $this->clean_properties();
        $properties_pairs = array();
        
        foreach ($properties as $key => $value) {
         $properties_pairs[] = "{$key}='{$value}'";   
        }
        
        
        
        
        $sql = "UPDATE ".self::$db_table." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id = " .$database->escape_string($this->id);
        
        $database->query($sql);
        
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        

    }
    
    
    
    
        
    public static function update_building($arr, $building_kad) {
        global $database;
        
        
$sql = "UPDATE buildings SET 
average_m2_cost='$arr[averege_m2]',
flats_cost='$arr[price_kvartir_v_dome]',
floor_types='$arr[floor_types]',
flats_type='$arr[unique_rooms]',
flats_m2='$arr[metragi_kvartir_v_dome]',
status='1' 
WHERE kad_number='$building_kad'";
       
        
        
       
        
        $database->query($sql);
        
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
        

    }
    
    
    
    
    
    
    public function delete() {
        
     global $database;
        
        $sql = "DELETE FROM ".self::$db_table." ";
        $sql .= "WHERE id = ". $database->escape_string($this->id); 
        $sql .= " LIMIT 1";
        
        $database->query($sql);
        
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;    
        
        
        
    }
    
    
    
    
    
    
} // end class Building


$building = new Building();
//$bld =& $building;

?>