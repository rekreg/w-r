<?php 

class Session {
  
private $signed_in = false;
public $user_id;
public $email;

public $action;

public $current_uniq_id;
    
    
function __construct(){
session_start(); 
$this->check_the_login();
}
    

public function is_signed_in() {
  return $this->signed_in;  
}
    
    
public function login($user) {
    
 if($user) {
    
    //$this->user_id = $user->id;
    //$SESSION['user_id'] = $user->id;
     $this->user_id = $_SESSION['user_id'] = $user->id;
     $this->email = $_SESSION['email'] = $user->email;
     $this->signed_in = true;
 }   
    
    
}
    
public function action_maker($action){
    
if($action == "update") {
    $this->action = $_SESSION['action'] = "update";
}
elseif($action == "delete") {
  
    $this->action = $_SESSION['action'] = "delete";
    
}
    
    
}
    
    
public function action_checker(){
    
if($_SESSION['action'] == "update") {
    unset($_SESSION['action']);
    return "update";
    
}
elseif($_SESSION['action'] == "delete") {
    unset($_SESSION['action']);
    return "delete";
    
} else {
    unset($_SESSION['action']);
    return false;
    
}
    
    
}
       
    
public function logout() {
    
unset($_SESSION['user_id']); 
unset($this->user_id);
$this->signed_in = false;
    
}
    

private function check_the_login() {
    
    if(isset($_SESSION['user_id'])) {
        
       $this->user_id = $_SESSION['user_id'];
       $this->email = $_SESSION['email'];
       $this->signed_in = true;     
        
    } else {
     
        unset($this->user_id);
        $this->signed_in = false;
        
    }
    
    
}    
    
    
  
public function set_current_uniq_id($id) {
 
 $pos = strpos($_SERVER["HTTP_REFERER"], "new_object");
 if ($pos === false) { $this->delete_current_uniq_id(); }
    
 if($id === "new") {    
  
     if($this->user_id) {
      
    if(empty($_SESSION['current_uniq_id'])) {
        
        $prefix = $this->user_id."_";
        $this->current_uniq_id = uniqid($prefix);
        $_SESSION['current_uniq_id'] = $this->current_uniq_id;
       // return true;
    } else {
        $this->current_uniq_id = $_SESSION['current_uniq_id'];
    }
                    
                    }
     
 } else {
     
     $_SESSION['current_uniq_id'] = $id;
     
 }
    
    
    
}
   
 
public function delete_current_uniq_id() {
    
    if($_SESSION['current_uniq_id']) {
       unset($_SESSION['current_uniq_id']);
        $this->current_uniq_id = null;
        return true;
    } else {
       return false;   
    }
    
}
    
    
} // end Session class

$session = new Session();

?>