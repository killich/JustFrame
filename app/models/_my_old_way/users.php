<?php
    // ������� ��������
	function create_new_user($obj= array()){
        $values = values_build($obj);
        $fields = fields_build($obj);
		$q="
			INSERT INTO users ($fields)
			VALUES ($values);
		";
		mysql_query($q) or die("Invalid query: " . mysql_error());
	}
    // ������� ��������� �� ��������� �������
	function select_users(){
		$q="
			SELECT * FROM users LIMIT 0 , 30
		";
		$res= mysql_query($q) or die("Invalid query: " . mysql_error());
		return $res;
	}
    // ������� ��������
	function delete_user($id){
		$q="
			DELETE FROM users WHERE id=$id
		";
		mysql_query($q) or die("Invalid query: " . mysql_error());
	}
?>