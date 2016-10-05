<?php 
// upload.php


require_once("../includes/init.php");




// 'images' refers to your file input name attribute
if (empty($_FILES['images'])) {
    echo json_encode(['error'=>'No files found for upload.']); 
    // or you can throw an exception 
    return; // terminate
}





$success = null;
//$message = "";
    
$photo = new Photo();
$photo->set_file($_FILES['images']);  
    
    
// Проверяем ошибки

if($photo->wrong_image()) {
    echo json_encode(['error' => "Ошибка! Файл (".$photo->img_name.") не является изображением "]); 
    return; // terminate
 } 

if($photo->wrong_size()) {
    
  $f_size_str = formatBytes($photo->size, $precision = 2);
  echo json_encode(['error' => "Ошибка! Файл (".$photo->img_name.") слишком большой ".$f_size_str. ".<br> Максимальный размер файла - 12 MB"]); 
  return; // terminate   
}




    

if($photo->save()) {
    $success = true;
   // $message = "Photo uploaded Succesfully";
    
    
} else {
    $success = false;
  //  $message = join("<br>", $photo->errors);
     
}   
    





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
        unlink($photo->path);
    
   
} else {
    $output = ['error'=>'No files were processed.'];
}

// return a json encoded response for plugin to process successfully
//echo json_encode($output);
$key = $photo->code;

$url_preview = $photo->path;
$url_preview = str_replace("/Applications/mampstack-5.4.38-0/apache2/htdocs/w-realtor/admin/", "http://localhost:8080/w-realtor/admin/", $url_preview);



$url_delete = 'uploads/delete_uploaded_file.php?file_name='.$photo->new_img_name;
echo json_encode([
    'initialPreview' => [
       //"uploads/{$photo->path}"
 //"{$url_preview}"
        $url_preview
//"<img src='{$paths[0]}' class='file-preview-image' width='120px' >"

    ],
    //'initialPreviewAsData' => 'true', 
    //'initialPreviewFileType' => 'image',
     

    'initialPreviewConfig' => [
        ['caption' => "{$photo->img_name}", 'size' => "{$photo->size}", 'width' => '120px', 'url' => $url_delete, 'key' => $key],
    ],
    'append' => true // whether to append these configurations to initialPreview.
                     // if set to false it will overwrite initial preview
                     // if set to true it will append to initial preview
                     // if this propery not set or passed, it will default to true.
]);

?>