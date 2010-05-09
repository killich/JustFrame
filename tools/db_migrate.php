<?php
	require_once('../config/consts.php');
	require_once("../config/data_base_connect.php");

	$sql="CREATE DATABASE IF NOT EXISTS ".DATABASE_NAME.";";
	mysql_query($sql) or die("Invalid query: " . mysql_error());

	$sql="USE ".DATABASE_NAME.";";
	mysql_query($sql) or die("Invalid query: " . mysql_error());
	
    $sql="
        CREATE TABLE `users` (
            `id` int(11) NOT NULL auto_increment,
            `zip` varchar(255) default NULL,
            `login` varchar(255) default NULL,
            `email` varchar(255) default NULL,
            
            `name` varchar(255) default NULL,
            `second_name` varchar(255) default NULL,
            `surname` varchar(255) default NULL,
        
            `crypted_password` varchar(40) default NULL,
            `salt` varchar(40) default NULL,

            `remember_token` varchar(255) default NULL,
            `remember_token_expires_at` datetime default NULL,
            `avatar_file_name` varchar(255) default NULL,
                
            `last_login_at` datetime default NULL,
            `created_at` datetime default NULL,
            `updated_at` datetime default NULL,

            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM;
    ";
	mysql_query($sql) or die("Invalid query: " . mysql_error());
	
	echo ('database create done!');
?>