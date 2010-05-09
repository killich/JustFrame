<?php
	$database = mysql_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD);
	mysql_select_db(DATABASE_NAME, $database);
?>