<?php

class Building {

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

public static function find_building_by_id($id) {
    $result_set = self::find_this_query("SELECT * FROM buildings WHERE id={$id} LIMIT 1");
    $found_building = mysqli_fetch_array($result_set);
    return $found_building;
    }   
    
    
    
public static function find_building_by_kad($kad) {
    $the_result_array = self::find_this_query("SELECT * FROM metro_info, buildings WHERE kad_number='$kad' AND (metro_info.dom_id=buildings.id) LIMIT 1");
    return !empty($the_result_array) ? array_shift($the_result_array) : false; 
    
    
    
   /* 
     $the_result_array = self::find_this_query("SELECT * FROM users WHERE id={$id} LIMIT 1");
        
    return !empty($the_result_array) ? array_shift($the_result_array) : false;  */ 
    
    
    
    
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
        
    
} // end class Building


$building = new Building();
//$bld =& $building;

?>