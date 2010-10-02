<?php
  // Получение массива с именами файлов данной директории
  function directory_files($dir_path){
    $arr = array();
    $dir = opendir($dir_path);
    while($file = readdir($dir)){
      if($file!='.' && $file!='..' && filetype($dir_path.$file)=='file'){
        $arr[] = $file;
      }
    }
    return $arr;
  }
  // Подключение файлов в указанном каталоге
  function require_files_from($dir_path){
    $files = directory_files("$dir_path/");
      foreach($files as $file){
        require_once("$dir_path/$file");
    }
  }
  // Подключение вендоров
  function vendor($name){
    require_once(VENDORS_PATH."$name/init.php");
  }
?>