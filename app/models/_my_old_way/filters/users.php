<?php
	class UserFilter extends Filter{
        function __construct(){
            $this->trim_field('login');     // �������� ���� �� �������� � ������ � ����� ������
            $this->trim_all();              // �������� ��� ���� �� ��������
            $this->mysql_protect_all();     // ������� ������� �������� ����� MySQL
        }
	}
	class UserBeforeCreateFilter extends Filter{
        function __construct(&$obj){
            // ��������, ������� ��������������� ����� ����������� ������
            $obj['id'] = '';
            $obj['crypted_password'] = $obj['password'].'_TEST';
            // ��������, ������� ����������� � ����������
            $to_save = array(   'id'=>true,
                                'login'=>true,
                                'crypted_password'=>true,
                                'email'=>true,
                                'name'=>true,
                                'second_name'=>true,
                                'surname'=>true
                            );
            // �������� ���� ��������, ����� �����������
            $this->delete_unnecessary_params($obj, $to_save);
        }
	}
?>