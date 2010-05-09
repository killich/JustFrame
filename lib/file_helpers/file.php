<?php
	// ��������� ������� � ������� ������ ������ ����������
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
	// ����������� ������ � ��������� ��������
	function require_files_from($dir_path){
        $files = directory_files($dir_path);
        foreach($files as $file){
            require_once($dir_path.$file);
        }
	}
?>