<?php
	require_once('../config/consts.php');
	require_once("../config/data_base_connect.php");

	$sql="DROP DATABASE ".DATABASE_NAME.";";

	mysql_query($sql) or die("Invalid query: " . mysql_error());
	
	echo ('database deleted!');
?>