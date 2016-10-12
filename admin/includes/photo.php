<?php 

class Photo extends Db_object {
    
    
    protected static $db_table = "photos";
    protected static $db_table_fields = array('id', 'obj_uniq_id', 'new_img_name', 'width', 'height', 'size', 'path');
    public $id;
    public $obj_uniq_id;
    public $img_name;
    public $width;
    public $height;
    public $size;
    
    
    public $code;
    public $new_img_name;

    public $tmp_path;  
    public $upload_directory = "images";
    
    public $path;
    
    public $errors = array();
    public $upload_errors_array = array(
    UPLOAD_ERR_OK => 'There is no error, the file uploaded with success',
    UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
    UPLOAD_ERR_NO_FILE => 'No file was uploaded',
    UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
    UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.',
);
    
 
    
    
    
    
   
private function get_current_uniq_id() {
    
    if($this->obj_uniq_id){
      return $this->obj_uniq_id;  
    }
    elseif($_SESSION['current_uniq_id']){
      return $_SESSION['current_uniq_id'];  
    } 
    else {
        
        return null;
    } 
    
    
}
      
    
    
private function set_uploaded_dir($num) {
    
    $arr = explode("_", $num);
    $user_id = $arr[0];
    $uniq_id = $arr[0];
    
    
    
    $user_dir_path = SITE_ROOT.DS."admin".DS."uploads".DS."images".DS.$user_id;
    
    $object_path = $user_dir_path.DS.$num;
    
    // Если не существует папки Юзера, то создаем её
    
     if (!file_exists($user_dir_path)) {
    
        mkdir($user_dir_path, 0777, true);
         
        if(!file_exists($object_path)) {
       
            mkdir($object_path, 0777, true);
            return $object_path;  
        
        } else {
          
            return $object_path;
        }  
    
  
    // Если существует папка юзера, то создаем только папку файла     
     } else {
         
        if(!file_exists($object_path)) {
       
            mkdir($object_path, 0777, true);
            return $object_path;  
        
        } else {
          
            return $object_path;
        }       
     }
    
    
    
    
}    
    
    
    
    
    
 // This is passing $_FILES['uploaded_file'] as an argument  

public function set_file($file) {
      
        
        
if(empty($file) || !$file || !is_array($file)) { 
$this->errors[] = "There was no file uploaded here";
return false; 
} 

else {      
        
    
    //$this->obj_uniq_id = $session->get_current_uniq_id();
    
    $this->obj_uniq_id = $this->get_current_uniq_id();
    
    
    
    $dir_path = $this->set_uploaded_dir($this->obj_uniq_id);
    
    
    $this->img_name = basename($file['name'][0]);    
      
    
    $ext = explode('.', basename($this->img_name));
    $this->code = md5(uniqid());
    $this->new_img_name = $this->code . "." . array_pop($ext);
          
    
    //$this->path = $this->upload_directory .DS. $this->new_img_name;
    
    $this->path = $dir_path.DS.$this->new_img_name;
    
    
    $this->size = $file['size'][0];    

    
    $this->tmp_path = $file['tmp_name'][0]; 
    
    
    
    $data = getimagesize($file['tmp_name'][0]);
    $this->width = $data[0];
    $this->height = $data[1];
    
    
    
    
    }
    
    } // end set_file($file)
    
    
    
    
    public function picture_path() {
        
        return SITE_ROOT .DS. 'admin' .DS. 'uploads' .DS. $this->upload_directory .DS. $this->new_img_name;
        
    }
    
    
    public function save() {
        
      if($this->id) {
          $this->update();
      } else {
          
          if(!empty($this->errors)) {
              return false;
          }
          
          if(empty($this->img_name) || empty($this->tmp_path)) {
          $this->errors[] = "the file was not available";  
           return false;
          }
          
        
          
          
          
          if(file_exists($this->path)) {
          $this->errors[] = "The file {$this->filename} already exists";
              return false;
          }
          
          if(move_uploaded_file($this->tmp_path, $this->path)) {
            
              if($this->create()) {
                  unset($this->tmp_path);
                  return true;
                  
              }
              
              
          } else {
            
              $this->errors[] = "the file directory probably does not have permission";
              return false; 
               
          }
          
      } 
        
    }
    
    
    
    
    
    
    public function wrong_image() {
        
        
   ////////////// ЕСЛИ ЛЕВЫЙ ТИП ФАЙЛА
$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
$detectedType = exif_imagetype($this->tmp_path);
$error = !in_array($detectedType, $allowedTypes);

if($error) {
 
    return true;
    
    
} else {
    
    return false;
    
}   
        
        
        
        
        
        
    }
    
    
    
    public function wrong_size() {
        
    //////////// Если Файл больше 12 мб
if($this->size > 12582912) {    
   return true;
} else {
    return false;
}    
                
    }
    
    
    
    
    
   public static function find_photo_by_name($name) {
       
    $query = "SELECT * FROM ". static::$db_table." WHERE new_img_name='{$name}' LIMIT 1";
    
   // return $query;   
       
    $the_result_array = static::find_by_query($query);
        
    return !empty($the_result_array) ? array_shift($the_result_array) : false;     
        
  
    } 
    
    
   public static function find_photos_by_obj_uniq_id($id) {
       
    $query = "SELECT * FROM ". static::$db_table." WHERE obj_uniq_id='{$id}'";
    
   // return $query;   
       
    $the_result_array = static::find_by_query($query);
        
    return !empty($the_result_array) ? $the_result_array : false;     
        
  
    } 

   public static function get_photo_paths($arr) {
    
    if(empty($arr)) { return NULL; }   
       
    $output = "initialPreview: [";
       
       foreach ($arr as $obj) {
       
       $user_id = explode("_", $obj->obj_uniq_id);
       $path = $user_id[0] ."/". $obj->obj_uniq_id."/".$obj->new_img_name;
       
       $output .= "'http://localhost:8888/w-r/admin/uploads/images/".$path."',";
           
                    }  
       $output = rtrim($output, ",");   
       $output .= "],";   
       
   
       
    $output .= "initialPreviewConfig: [";   
  
    foreach ($arr as $obj) {
    
    $output .= "{caption: '". $obj->new_img_name. "', ";    
    $output .= "size: ". $obj->size. ", "; 
    $output .= "width: '120px', ";  
    $output .= "url: 'uploads/delete_uploaded_file.php?file_name=". $obj->new_img_name. "'},";

    }   
    
    $output = rtrim($output, ",");   
    $output .= "],";
   
     
       
     return $output;   
       
   }
    
    
    
    
    
    public function delete_photo_from_db() {
        
     global $database;
        
        $sql = "DELETE FROM ".static::$db_table." ";
        $sql .= "WHERE new_img_name = '". $database->escape_string($this->new_img_name)."'"; 
        $sql .= " LIMIT 1";
        
        $database->query($sql);
        
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;    
        
        
        
    } 
    
    public function delete_photo() {
        
        if($this->delete_photo_from_db()) {
            
            $target_path = $this->path;
            
            return unlink($target_path)? true: false;
        } else {
          
            return false;
            
        }
        
    }
    
    
    
    
    
} // end class Photo




?>