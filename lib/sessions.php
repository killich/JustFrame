<?php
	function session_open(){
		$sid= session_id();
		if( empty($sid) ) session_start();
	}
	function session_close(){
		$sid= session_id();
		if( !empty($sid) ){
			if( isset($_COOKIE[session_name()]) ) setcookie(session_name(), '', time()-42000, '/');
			session_destroy();
		}
	}
?>