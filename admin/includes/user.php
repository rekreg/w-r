<?php 

class User {
  
    public $id;
    public $username;
    public $password;
    public $email;
 
    public static function find_all_users() {
    
        return self::find_this_query("SELECT * FROM users");
        
    }
    
    public static function find_user_by_id($id) {
    $the_result_array = self::find_this_query("SELECT * FROM users WHERE id={$id} LIMIT 1");
        
    return !empty($the_result_array) ? array_shift($the_result_array) : false;     
        
        
        
   /*if(!empty($the_result_array)) {
    $first_item = array_shift($the_result_array);
    return $first_item; 
   } else { return false; }*/
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
    
    
    
    public static function verify_user($email, $password){
    global $database;
    $email = $database->escape_string($email);
    $password = $database->escape_string($password);
        
    $sql = "SELECT * FROM users WHERE ";
    $sql .= "email = '{$email}' ";
    $sql .= "AND ";
    $sql .= "password = '{$password}' ";
    $sql .= "LIMIT 1";

    $the_result_array = self::find_this_query($sql);
        
    return !empty($the_result_array) ? array_shift($the_result_array) : false;  
        
    }
    
    
    public static function verify_email($email){
    global $database;
    $email = $database->escape_string($email);
        
    $sql = "SELECT * FROM users WHERE ";
    $sql .= "email = '{$email}' ";
    $sql .= "LIMIT 1";

    $the_result_array = self::find_this_query($sql);
        
    return !empty($the_result_array) ? true : false;  
        
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
    

      
    public function create() {
    global $database;
    $sql = "INSERT INTO users (username, password, email) ";
    $sql .= "VALUES ('";
    $sql .= $database->escape_string($this->username)."', '";
    $sql .= $database->escape_string($this->password)."', '";
    $sql .= $database->escape_string($this->email)."')";
 
        
    if($database->query($sql)) {
        $this->id = $database->the_insert_id();
        return true;
    } else {
        return false;
    }
    
        
        
    }
    
    
    
    
    
    
    
    
    
} // end User class





?>