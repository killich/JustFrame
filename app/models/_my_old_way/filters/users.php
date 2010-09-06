<?php
	class UserFilter extends Filter{
        function __construct(){
            $this->trim_field('login');     // Очистить поле от пробелов в начале и конце строки
            $this->trim_all();              // Очистить все поля от пробелов
            $this->mysql_protect_all();     // Закрыть опасные ключевые слова MySQL
        }
	}
	class UserBeforeCreateFilter extends Filter{
        function __construct(&$obj){
            // Значения, которые устанавливаются перед сохранением данных
            $obj['id'] = '';
            $obj['crypted_password'] = $obj['password'].'_TEST';
            // Значения, которые допускаются к сохранению
            $to_save = array(   'id'=>true,
                                'login'=>true,
                                'crypted_password'=>true,
                                'email'=>true,
                                'name'=>true,
                                'second_name'=>true,
                                'surname'=>true
                            );
            // Удаление всех значений, кроме разрешенных
            $this->delete_unnecessary_params($obj, $to_save);
        }
	}
?>