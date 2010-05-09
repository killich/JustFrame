<?php
	// Базовые строковые функции
	// sometimes from [Kohana_Inflector]
	// 'students from russia' => 'StudentsFromRussia'
	function camelize($str){
		$str = 'x'.ucwords(strtolower(trim($str)));
		$str = ucwords(preg_replace('/[\s_]+/', ' ', $str));
		return substr(str_replace(' ', '', $str), 1);
	}
	// 'students from russia' => 'students_from_russia'
	function underscore($str){
		return preg_replace('/\s+/', '_', trim($str));
	}
	function nbsp2space($str){
		return preg_replace('/&nbsp;/', ' ', trim($str));
	}
	function space2nbsp($str){
		return preg_replace('/\ /', '&nbsp;', trim($str));
	}
?>