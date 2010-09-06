<?php
	function res2array($res){
        $result= array();
	    if (mysql_num_rows($res) == 0) return array();   
	    while($row = mysql_fetch_assoc($res)){$result[]= $row;}
	    return $result;
	}
	function get_first($res){
	    if (mysql_num_rows($res) == 0) return array();   
	    $row = mysql_fetch_assoc($res);
	    return $row;
	}
	function q($query){
		$result= mysql_query($query) or die("Error: " . mysql_error());
		return $result;
	}
	function fields_build($obj){
        $str = '';
        foreach($obj as $key => $value){$str .= "`".$key."`, ";}
        return substr($str, 0, strlen($str)-2);
	}
	function values_build($obj){
        $str = '';
        foreach($obj as $key => $value){$str .= " '".$obj[$key]."' ,\n";}
        return substr($str, 0, strlen($str)-2);
    }   
?>