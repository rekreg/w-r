<?php
class Object_u extends Db_object {
  
    
  protected static $db_table = "objects_u";
  protected static $db_table_fields = array('id', 'user_id', 'uniq_id', 'address', 'region_type', 'region', 'area_type', 'area', 'city_type', 'city', 'city_area', 'city_district', 'settlement_type', 'settlement', 'street_type', 'street', 'house_type', 'house', 'block_type', 'block', 'geo_lat', 'geo_lon', 'rooms', 'm2_o', 'm2_g', 'm2_k', 'floor', 'floors', 'balcony', 'loggia', 'wc', 'windows', 'state', 'price', 'currency', 'ipoteka', 'tender', 'how_sell', 'description', 'phone');
    
  public $id;
  public $user_id;
  public $uniq_id;
  public $address;
  public $region_type;
  public $region;
  public $area_type;
  public $area;
  public $city_type;
  public $city;
  public $city_area;
  public $city_district;
  public $settlement_type;
  public $settlement;
  public $street_type;
  public $street;
  public $house_type;
  public $house;
  public $block_type;
  public $block;
  public $geo_lat;
  public $geo_lon;
  
  
    
  public $rooms;
  public $m2_o;
  public $m2_g;
  public $m2_k;
  public $floor;
  public $floors;
  public $balcony;
  public $loggia;
  public $wc;
  public $windows;
  public $state;
  public $price;
  public $currency;
  public $ipoteka;
  public $tender;
  public $how_sell;
  public $description;
  public $phone;
 
    
    
    
   
    public function delete_object() {
        
        if($this->delete()) {
           // $target_path = SITE_ROOT.DS."admin".DS.$this->picture_path();
            
            return true;
        } else {
          
            return false;
            
        }
        
    }
       
    
   public static function find_all_by_user_id($user_id) {
    
        return static::find_by_query("SELECT * FROM ". static::$db_table. " WHERE user_id=".$user_id. " ");
        
    }   
    
      
    public function save() {
        
      if($this->id) {
          $this->update();
          return true;
      } else {
        
              return false; 
               
          }
          
    
        
    }
     
    
    
/*
public static function find_this_query($sql) {
    global $database;   
    $result_set = $database->query($sql);
    $the_object_array = array();
        
        while($row = mysqli_fetch_array($result_set)) {
           
            $the_object_array[] = self::instantation($row);
        
        }
        
    return $the_object_array;
   
    }
            
public static function find_all_objects() {
    
        return self::find_this_query("SELECT * FROM user_objects LIMIT 30");
        
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
        
    $the_object->id = $found_user['id']; 
    $the_object->username = $found_user['username']; 
    $the_object->password = $found_user['password']; 
    $the_object->first_name = $found_user['first_name'];
    $the_object->last_name = $found_user['last_name'];   
        
        
        
      return $the_object;  
    }
      
private function has_the_attribute($the_attribute) {
    
    $object_properties = get_object_vars($this);
    
    return array_key_exists($the_attribute, $object_properties);
     
 }   
    */
    
   /* 
     
    public function create() {
    global $database;
    $sql = "INSERT INTO objects_u (
    address,
    region_type,
    region,
    area_type,
    area,
    city_type,
    city,
    city_area,
    city_district,
    settlement_type,
    settlement,
    street_type,
    street,
    house_type,
    house,
    block_type,
    block,
    geo_lat,
    geo_lon,
    rooms, m2_o, m2_g, m2_k, floor, floors, balcony, loggia, wc, windows, state, price, currency, ipoteka, tender, how_sell, description) ";
    $sql .= "VALUES ('";
        
    // Адрес    
    $sql .= $database->escape_string($this->address)."', '";
    
    $sql .= $database->escape_string($this->region_type)."', '";
    $sql .= $database->escape_string($this->region)."', '";
    $sql .= $database->escape_string($this->area_type)."', '";
    $sql .= $database->escape_string($this->area)."', '";
    $sql .= $database->escape_string($this->city_type)."', '";
    $sql .= $database->escape_string($this->city)."', '";
    $sql .= $database->escape_string($this->city_area)."', '";
    $sql .= $database->escape_string($this->city_district)."', '";
    $sql .= $database->escape_string($this->settlement_type)."', '";
    $sql .= $database->escape_string($this->settlement)."', '";
    $sql .= $database->escape_string($this->street_type)."', '";
    $sql .= $database->escape_string($this->street)."', '";
    $sql .= $database->escape_string($this->house_type)."', '";
    $sql .= $database->escape_string($this->house)."', '";
    $sql .= $database->escape_string($this->block_type)."', '";
    $sql .= $database->escape_string($this->block)."', '";
    $sql .= $database->escape_string($this->geo_lat)."', '";
    $sql .= $database->escape_string($this->geo_lon)."', '";
  
// Сам объект
        
    $sql .= $database->escape_string($this->rooms)."', '";
    $sql .= $database->escape_string($this->m2_o)."', '";
    $sql .= $database->escape_string($this->m2_g)."', '";
    $sql .= $database->escape_string($this->m2_k)."', '";
    $sql .= $database->escape_string($this->floor)."', '";
    $sql .= $database->escape_string($this->floors)."', '";
    $sql .= $database->escape_string($this->balcony)."', '";
    $sql .= $database->escape_string($this->loggia)."', '";
    $sql .= $database->escape_string($this->wc)."', '";
    $sql .= $database->escape_string($this->windows)."', '";
    $sql .= $database->escape_string($this->state)."', '";
    $sql .= $database->escape_string($this->price)."', '";
    $sql .= $database->escape_string($this->currency)."', '";
    $sql .= $database->escape_string($this->ipoteka)."', '";
    $sql .= $database->escape_string($this->tender)."', '";
    $sql .= $database->escape_string($this->how_sell)."', '";
    $sql .= $database->escape_string($this->description)."')";
 
        
    if($database->query($sql)) {
        $this->id = $database->the_insert_id();
        return true;
    } else {
        return false;
    }
    
        
        
    }
    */
        
    
    
    
    
  public static function draw_table_with_obj($objects) {
      $output = '';
      
      if(empty($objects)) {
      
          
       $output .= "<div class='jumbotron text-center'>
  <h1>Хмм! Странно <i class='fa fa-smile-o text-danger' aria-hidden='true'></i></h1>
  <p>У Вас пока нет объявлений. Но вы можете легко его создать.</p>
  <p><a href='new_object.php' class='btn btn-warning btn-lg'><i class='fa fa-wpforms' aria-hidden='true'></i> Добавить объявление</a></p>
</div>";   
          
          
      return $output;     
          
      }
      
      else {
     $output.= "<div class='table-responsive'>";                  
     $output.= "<table class='table table-hover'>
        
        <thead>
        <tr>
          <th></th>
            <th>Комнат</th>
            <th>Адрес</th>
            <th>Этаж/Этажность</th>
          
        </tr>
        
        </thead>
        
        <tbody> ";
            
        
       foreach($objects as $object) {
            
            
        
        $output.= "<tr>";
           
           
              $output.= "<td><div class='action_block'>";
             
                
         $output.= "<a href='apartment.php?id=".$object->id. "' class='btn btn-info btn-xs'><i class='fa fa-eye' aria-hidden='true'></i> <span class='hidden-sm hidden-xs'>Посмотреть</span> </a> ";     

         $output.= "<a href='edit_object.php?id=".$object->id. "' class='btn btn-success btn-xs'><i class='fa fa-pencil' aria-hidden='true'></i> <span class='hidden-sm hidden-xs'>Редактировать</span></a> ";
                    
         $output.= "<a href='delete_object.php?id=".$object->id. "' class='btn btn-danger btn-xs del_object'><i class='fa fa-trash-o' aria-hidden='true'></i> <span class='hidden-sm hidden-xs'>Удалить</span></a> ";

         $output.=  "</div> </td>";
           
           
           
        $output.= "<td>".$object->rooms."-комн </td>";
           
        
         $output.= "<td>".$object->address."</td>";
        
         $output.= "<td>".$object->floor."/".$object->floors."</td>";
            
   
           

        $output.="</tr>";
        
       }
        
    $output.= "</tbody>
    
    
    
    </table></div>";
        
          
          return $output;
        
     } 
      
      
  }  
    
        
    
} // end class Object_u


//$object_u = new Оbject_u();
//$bld =& $building;

?>