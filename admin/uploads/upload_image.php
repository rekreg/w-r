<?php 
// upload.php


require_once("../includes/init.php");








// 'images' refers to your file input name attribute
if (empty($_FILES['images'])) {
    echo json_encode(['error'=>'No files found for upload.']); 
    // or you can throw an exception 
    return; // terminate
}









// get the files posted
$images = $_FILES['images'];

// get user id posted
$userid = empty($_POST['userid']) ? '' : $_POST['userid'];

// get user name posted
$username = empty($_POST['username']) ? '' : $_POST['username'];

// a flag to see if everything is ok
$success = null;

// file paths to store
$paths= [];

// get file names
$filename = $images['name'][0];

// get file size
$filesize = $images['size'][0];




//////////////// Проверяем ошибки загрузки ///////////

////////////// ЕСЛИ ЛЕВЫЙ ТИП ФАЙЛА
$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
$detectedType = exif_imagetype($_FILES['images']['tmp_name'][0]);
$error = !in_array($detectedType, $allowedTypes);

if($error) {
 
    $error_str = "Ошибка! Файл (".$filename.") не является изображением ";
     echo json_encode(['error' => "{$error_str}"]); 
    // or you can throw an exception 
    return; // terminate
    
    
}


//////////// Если Файл больше 12 мб

if($filesize > 12582912) {
    
   
    
    
   function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
     $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
}  
    
    
    
    
    $f_size_str = formatBytes($filesize, $precision = 2);
    
    
    
    $error_str = "Ошибка! Файл (".$filename.") слишком большой ".$f_size_str. ". Максимальный размер файла - 12 MB";
     echo json_encode(['error' => "{$error_str}"]); 
    // or you can throw an exception 
    return; // terminate


}








// loop and process files
//for($i=0; $i < count($filenames); $i++){
    
    $ext = explode('.', basename($filename));

    $code = md5(uniqid());

    $new_file_name = $code . "." . array_pop($ext);

    $target = "images" . DIRECTORY_SEPARATOR . $new_file_name;

    if(move_uploaded_file($images['tmp_name'][0], $target)) {
        $success = true;
        $path = $target;
    } else {
        $success = false;
        break;
        
    }
//}

// check and process based on successful status 
if ($success === true) {
    // call the function to save all data to database
    // code for the following function `save_data` is not 
    // mentioned in this example
    //save_data($userid, $username, $paths);

    // store a successful response (default at least an empty array). You
    // could return any additional response info you need to the plugin for
    // advanced implementations.
    $output = [];
    // for example you can get the list of files uploaded this way
     //$output = ['uploaded' => $path];
    
    
    
} elseif ($success === false) {
    $output = ['error'=>'Error while uploading images. Contact the system administrator'];
    // delete any uploaded files
        unlink($path);
    
   
} else {
    $output = ['error'=>'No files were processed.'];
}

// return a json encoded response for plugin to process successfully
//echo json_encode($output);

$key = $code;
$url = 'uploads/delete_uploaded_file.php?file_name='.$new_file_name;
echo json_encode([
    'initialPreview' => [
       "uploads/{$path}"

//"<img src='{$paths[0]}' class='file-preview-image' width='120px' >"

    ],
    //'initialPreviewAsData' => 'true', 
    //'initialPreviewFileType' => 'image',
     

    'initialPreviewConfig' => [
        ['caption' => "{$filename}", 'size' => "{$filesize}", 'width' => '120px', 'url' => $url, 'key' => $key],
    ],
    'append' => true // whether to append these configurations to initialPreview.
                     // if set to false it will overwrite initial preview
                     // if set to true it will append to initial preview
                     // if this propery not set or passed, it will default to true.
]);

?>