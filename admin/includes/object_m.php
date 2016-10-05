<?php

class Object_m {

    
  protected static $db_table = "objects";
  protected static $db_table_fields = array('parent_kad_number', 'kad_number', 'obj_type', 'region', 'district', 'place', 'street', 'streetType', 'house', 'building', 'structure', 'apartment', 'floor', 'rooms', 'm2', 'kad_price');  
    
  public $id;
  public $parent_kad_number;
  public $kad_number;
  public $obj_type;
  public $region;
  public $district;
  public $place;
  public $street;
  public $streetType;
  public $house;
  public $building;
  public $structure;
  public $apartment;
  public $floor;
  public $rooms;
  public $m2;
  public $kad_price;
   
 // public $flats_array;
 // public $flats_amount;
    
 // public static $flats_arr;    
//  public $flats_in_building;
 
  /*
  __construct(){
      
      
      
  }*/
    
    
   
   

public static function find_this_query($sql) {
    global $database;   
    $result_set = $database->query($sql);
    $the_object_array = array();
        
        while($row = mysqli_fetch_array($result_set)) {
           
            $the_object_array[] = self::instantation($row);
        
        }
    return $the_object_array;
   
    }
            
public static function find_all_objects_by_kad($parent_kad) {
    
    
    return self::find_this_query("SELECT * FROM objects WHERE parent_kad_number='{$parent_kad}'");
      
    // $the_object = new self;
    // $the_object->flats_array = $flats_array;
    
    //self::set_building_data($flats_array);
   
    // return $flats_array;
    
    
    }

    
 // Количество квартир   
public static function get_flats($arr_with_obj){

    $count_flat = 0;
        foreach($arr_with_obj as $obj) {
        if($obj->obj_type == "квартира") {
            $count_flat++;
            }
          }
          
        return $count_flat;
    
    
}

/// Уникальные комнаты из Массива ////////////////////////////
public static function unique_rooms($arr){
				  
$max_col_comnat = 1;
		
		//Вычленяем все комнаты из массива и узнаем какая из них самая большая
		
		$arr_with_rooms = array();
		foreach ($arr as $obj) {
			$arr_with_rooms[] =$obj->rooms;
		}
		// Самая многокомнатная квартира в доме
		$max_col_comnat = max($arr_with_rooms);
		
		
		$arr_with_m2 = array();
			for($i = 1; $i <= $max_col_comnat; $i++) {
				
				foreach($arr as $obj) {
				  if($obj->rooms == $i && $obj->m2 !=="") { $arr_with_m2[$i][] = $obj->m2; }
						  } // end foreach($arr as $key => $value)
						
		       	} // for($i = $max_col_comnat; $i >=1; $i--)
			
			 $unique_rooms_output = "";
			
			for($y = 1; $y <= $max_col_comnat; $y++) {
				//&& count($arr_with_m2[$y]) !==1
				  if($arr_with_m2[$y]){
				          $unique_rooms_output .= "{$y}, ";
				  }
				
				}

		 // Убираем в конце лишние ", "
						$unique_rooms_output =  substr($unique_rooms_output, 0, -2);
    
    
        $unique_rooms_output = "<strong>".$unique_rooms_output."</strong>";

    
						$unique_rooms_output .= " - комнатные";	
						
						return $unique_rooms_output; 
		
			} // unique_rooms()
	    
    
    
///// Сколько уровневые квартиры есть в доме 
public static function floor_types($arr) {
	
	$matches = array();
	foreach($arr as $obj) {
	if($obj->floor && $obj->floor != 0) {
		preg_match_all('!\d+!', $obj->floor, $matches[]);
		if(strrpos($obj->floor,"М") || strrpos($obj->floor,"м")) { 
				$mansarda = "Есть квартиры с мансардами";
		  }
	}
	}
	
	
	$all_floor = array();
	foreach($matches as $key => $value) {
		foreach($value as $key2 => $value2) {
				
				$all_floor[] = array_unique($value2);
				
		} 
		}
		
		$unique_floor = array();
	foreach($all_floor as $key => $value) {	
			$unique_floor[] = count($value);
	}
		
	$unique_floor = array_unique($unique_floor);
	
	$output = "";
	foreach($unique_floor as $key => $value) {
	 $output .= "{$value}, " ;
		}
	
	$output =  substr($output, 0, -2);
    $output = "<strong>".$output."</strong>";
	$output .= " уровневые квартиры";

	if($mansarda) { $output .= "<br> {$mansarda}";}
	return $output;
	}
    

    
///// Метражи квартир в доме
public static function metragi_kvartir_v_dome($arr) {
		
		$max_col_comnat = 1;
		
		//Вычленяем все комнаты из массива и узнаем какая из них самая большая
		
		$arr_with_rooms = array();
		foreach ($arr as $obj) {
			$arr_with_rooms[] =$obj->rooms;
		}
		// Самая многокомнатная квартира в доме
		$max_col_comnat = max($arr_with_rooms);
		
		
		
		$arr_with_m2 = array();
			
        for($i = 1; $i <= $max_col_comnat; $i++) {
				
				foreach($arr as $obj) {
				  if($obj->rooms == $i && $obj->m2 !=="" && $obj->obj_type == "квартира") { $arr_with_m2[$i][] = $obj->m2; }
						  } // end foreach($arr as $key => $value)
						
		       	} // for($i = $max_col_comnat; $i >=1; $i--)
			
			 $output = "";
			
			for($y = 1; $y <= $max_col_comnat; $y++) {
				
				//&& 
				  if($arr_with_m2[$y]){
				 
				 
				 if(count($arr_with_m2[$y]) !== 1) {
				  $curent_min = min($arr_with_m2[$y]);
				  $curent_max = max($arr_with_m2[$y]);
				  
				   $output .= "<strong> {$y} ком: </strong> {$curent_min} - {$curent_max} м²<br>"; }
				   
				   else {
					   $curent_one = min($arr_with_m2[$y]);
					   $output .= "<strong> {$y} ком: </strong> {$curent_one} м²<br>";
					   }
				  // <span class="label label-info">Info
				  }
				
				}
		
		
		
		return $output;

		
		} // end function metragi_kvartir_v_dome($arr)  
    
    

///// Переобразуме числа в 11.2 миллиона
    
public static function nice_number($n) {
        // first strip any formatting;
        $n = (0+str_replace(",","",$n));
        
        // is this a number?
        if(!is_numeric($n)) return false;
        
        // now filter it;
        if($n>1000000000000) return round(($n/1000000000000),1).' трил';
        else if($n>1000000000) return round(($n/1000000000),1).' млрд';
        else if($n>1000000) return round(($n/1000000),1).' млн';
        else if($n>1000) return round(($n/1000),1).' тыс.';
        
        return number_format($n);
    }
    
    
    
    
///// Цены квартир в доме
public static function price_kvartir_v_dome($arr) {
		
		$max_col_comnat = 1;
		
		//Вычленяем все комнаты из массива и узнаем какая из них самая большая
		
		$arr_with_rooms = array();
		foreach ($arr as $obj) {
			
            $arr_with_rooms[] =$obj->rooms;
		}
		// Самая многокомнатная квартира в доме
		$max_col_comnat = max($arr_with_rooms);
		
		
		
		$arr_with_price = array();
			
			for($i = 1; $i <= $max_col_comnat; $i++) {
				
				foreach($arr as $obj) {
if($obj->rooms == $i && $obj->kad_price !== "" && $obj->kad_price != 0 && $obj->obj_type == "квартира"){ $arr_with_price[$i][] = $obj->kad_price; }
						  } // end foreach($arr as $key => $value)
						
		       	} // for($i = $max_col_comnat; $i >=1; $i--)
			
			 $output = "";
			
			for($y = 1; $y <= $max_col_comnat; $y++) {
				
				//&& 
				  if($arr_with_price[$y]){
				 
				 
				 if(count($arr_with_price[$y]) !== 1) {
				  $curent_min = min($arr_with_price[$y]);
				  $curent_max = max($arr_with_price[$y]);
				  
				   $output .= "<strong> {$y} ком: </strong>";
                    
                 
                $output .= 
                    
                self::nice_number($curent_min) . " - ".
                self::nice_number($curent_max) . "<br>";
                    
              //  number_format($curent_min,0,'',' ')." - ".number_format($curent_max,0,'',' ')."<br>";
                 }
				   
				   else {
					   $curent_one = min($arr_with_price[$y]);
					   $output .= "<strong> {$y} ком: </strong>";
                $output .= self::nice_number($curent_one) . "<br>";

					   }
				  // <span class="label label-info">Info
				  }
				
				}
		
		
		
		return $output;

		
		} // end function price_kvartir_v_dome($arr)       
    

    
    
    
//// Средняя стоимость метра в доме
    
public static function averege_m2($arr) { 

$av_m2_arr = array();

foreach($arr as $obj) {
   $av_m2_arr[] = $obj->kad_price/$obj->m2;
}    

$averege_m2 = array_sum($av_m2_arr) / count($av_m2_arr);
return $averege_m2;    
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
    
    
// Данные по квартирам 
    
public static function main_appartment_table($arr) {
    
 if(empty($arr)){
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
 $output .= number_format(self::averege_m2($arr),0,'',' ');
 $output .= " руб";  
 $output .= "</td></tr>";
     
     
$output .= "<tr><td class='text-right'>
 <span class='label label-primary'>Динамика:</span>
</td>";  
$output .= "<td> ..... <br><br>";

$output .= "</td></tr>";

 
$output .= "<tr><td class='text-right'>
<span class='label label-primary'>Цены квартир:</span>
</td>";  
$output .= "<td>";      
$output .= self::price_kvartir_v_dome($arr);
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
 $output .= self::get_flats($arr);
    
  $output .= "<!-- Button trigger modal -->
<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal'>
  <i class='fa fa-database' aria-hidden='true'></i> Посмотреть 
</button>";      
     
     
 $output .= "</td></tr>";
     
     
$output .= "<tr><td class='text-right'>

<span class='label label-primary'>Типы квартир:</span>

</td>";  
$output .= "<td>";
$output .= self::unique_rooms($arr);
$output .= "<br>";     
$output .= self::floor_types($arr);
$output .= "</td></tr>";

 
$output .= "<tr><td class='text-right'>

<span class='label label-primary'>Метражи:</span>

</td>";  
$output .= "<td>";      
$output .= self::metragi_kvartir_v_dome($arr);
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
    
$output .= self::draw_table_from_array($arr);
  
     
$output .= " </div> </div></div> <br><br>";    
 }
    
    
    return $output;
    
    
}    

  
    
    
public static function get_data_by_building($arr){
  
    $data_arr = array();
    
 if(empty($arr)){
 // Если массив объектов пуст
    $data_arr[averege_m2] = "0"; 
    $data_arr[price_kvartir_v_dome] = "0"; 
    $data_arr[unique_rooms] = "0"; 
    $data_arr[floor_types] = "0"; 
    $data_arr[metragi_kvartir_v_dome] = "0";
     
     
 } 
    else {  

 $data_arr[averege_m2] = number_format(self::averege_m2($arr),0,'',' ');


$data_arr[price_kvartir_v_dome] = self::price_kvartir_v_dome($arr);

$data_arr[unique_rooms] = self::unique_rooms($arr);

$data_arr[floor_types] = self::floor_types($arr);
     
$data_arr[metragi_kvartir_v_dome] = self::metragi_kvartir_v_dome($arr);

    
}   
 return $data_arr;   
}
    
    
    
public static function find_object_by_id($id) {
    $result_set = self::find_this_query("SELECT * FROM user_objects WHERE id={$id} LIMIT 1");
    $found_object = mysqli_fetch_array($result_set);
    return $found_object;
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
    
    
    
    protected function properties() {
        
     //return get_object_vars();   
    $properties = array();
       foreach(self::$db_table_fields as $db_field) {
           
        if(property_exists($this, $db_field)){
            
           $properties[$db_field] = $this->$db_field; 
            }   
           
       } 
        
        return $properties;
        
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
    
    public function delete() {
        
     global $database;
        
        $sql = "DELETE FROM ".self::$db_table." ";
        $sql .= "WHERE id = ". $database->escape_string($this->id); 
        $sql .= " LIMIT 1";
        
        $database->query($sql);
        
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;    
        
        
        
    }
    
    
    
    
    
    
        
    
} // end class Object_му


//$object_u = new Оbject_u();
//$bld =& $building;

?>