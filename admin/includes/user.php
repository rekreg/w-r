<?php 

class User extends Db_object {
  
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'name', 'surname', 'patronymic', 'gender', 'password', 'email', 'account_type', 'phone');
    public $id;
    public $username;
    public $name;
    public $surname;
    public $patronymic;
    public $gender;
    public $password;
    public $email;
    public $account_type;
    public $phone;
 

    
    public static function verify_user($email, $password){
    global $database;
    $email = $database->escape_string($email);
    $password = $database->escape_string($password);
        
    $sql = "SELECT * FROM ".self::$db_table." WHERE ";
    $sql .= "email = '{$email}' ";
    $sql .= "AND ";
    $sql .= "password = '{$password}' ";
    $sql .= "LIMIT 1";

    $the_result_array = self::find_by_query($sql);
        
    return !empty($the_result_array) ? array_shift($the_result_array) : false;  
        
        
        
    }
    
    
   
       public function save() {
        
      if($this->id) {
          $this->update();
          return true;
      } else {
        
              return false; 
               
          }
 
       }

} // end User class





?>