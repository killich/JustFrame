<?php	
	class Validator{
        var $validations = array();
        var $errors = array();
        // ФУНКЦИИ РЕГИСТРАТОРЫ
        function is_numeric_filed($field){
            $this->validations['is_numeric_filed'][$field] = true;
        }
        function is_less_than($field, $num){
            $this->validations['is_less_than'][$field] = $num;
        }
        function is_less_or_equal($field, $num){
            $this->validations['is_less_or_equal'][$field] = $num;
        }
        function is_greater_than($field, $num){
            $this->validations['is_greater_than'][$field] = $num;
        }
        function is_greater_or_equal($field, $num){
            $this->validations['is_greater_or_equal'][$field] = $num;
        }
        function chars_range($field, $min, $max){
            $this->validations['chars_range'][$field] = array('min'=>$min, 'max'=>$max);
        }
        function not_empty($field){
            $this->validations['not_empty'][$field] = true;
        }
        function is_confirmed($field){
            $this->validations['is_confirmed'][$field] = true;
        }
        function is_email($field){
            $this->validations['is_email'][$field] = true;
        }
        function is_login($field){
            $this->validations['is_login'][$field] = true;
        }
        function is_unique($field, $table){
            $this->validations['is_unique'][$field] = $table;
        }
        // ПРОВЕРКА НА ВАЛИДНОСТЬ
        // В функцию поступает проверяемый объект в виде ассоциативного массива
        function valid($obj, &$controller){
            // Сделаем псевдоним объекта (ссылку на объект), чтобы сократить код
            $v = &$this->validations;
            
            if(is_array($v['is_numeric_filed'])){
                foreach($v['is_numeric_filed'] as $key => $value){
                    $this->valid_numeric_field($obj, $key);
                }
            }   
            if(is_array($v['is_less_than'])){
                foreach($v['is_less_than'] as $key => $value){
                    $this->valid_is_less_than($obj, $key, $value);
                }
            }
            if(is_array($v['is_less_or_equal'])){
                foreach($v['is_less_or_equal'] as $key => $value){
                    $this->valid_is_less_or_equal($obj, $key, $value);
                }
            }
            if(is_array($v['is_greater_than'])){
                foreach($v['is_greater_than'] as $key => $value){
                    $this->valid_is_greater_than($obj, $key, $value);
                }
            }
            if(is_array($v['is_greater_or_equal'])){
                foreach($v['is_greater_or_equal'] as $key => $value){
                    $this->valid_is_greater_or_equal($obj, $key, $value);
                }
            }
            if(is_array($v['chars_range'])){
                foreach($v['chars_range'] as $key => $values){
                    $this->valid_chars_range($obj, $key, $values);
                }
            }
            if(is_array($v['not_empty'])){
                foreach($v['not_empty'] as $key => $values){
                    $this->valid_not_empty($obj, $key, $values);
                }
            }
            if(is_array($v['is_confirmed'])){
                foreach($v['is_confirmed'] as $key => $values){
                    $this->valid_is_confirmed($obj, $key, $values);
                }
            }
            if(is_array($v['is_email'])){
                foreach($v['is_email'] as $key => $values){
                    $this->valid_is_email($obj, $key, $values);
                }
            }
            if(is_array($v['is_login'])){
                foreach($v['is_login'] as $key => $values){
                    $this->valid_is_login($obj, $key, $values);
                }
            }
            if(is_array($v['is_unique'])){
                foreach($v['is_unique'] as $key => $values){
                    $this->valid_is_unique($obj, $key, $values);
                }
            }
            // Если нет ошибкок - вернем true, иначе false (Сокращенная запись if-else конструкции)
            // if(empty($this->errors)){return true;}else{return false;}
            $controller->add_flash($this->errors);
            return (empty($this->errors) ? true  : false); 
        }
        // PROTECTED
        // Закрытые от внешнего мира функции
        // их можно вызвать только внути функций самого объекта
        protected function valid_numeric_field($obj, $field){
            $condition = is_array($obj) && isset($obj[$field]) && is_numeric($obj[$field]);
            if(!$condition){
                $this->errors[$field][] = MUST_BE_NUMERIC;
            }
        }
        protected function valid_is_less_than($obj, $field, $value){
            $condition = is_array($obj) && isset($obj[$field]) && is_numeric($obj[$field]) && ($obj[$field] < $value);
            if(!$condition){
                $this->errors[$field][] = MUST_BE_LESS_THEN." ".$value;
            }
        }
        protected function valid_is_less_or_equal($obj, $field, $value){
            $condition = is_array($obj) && isset($obj[$field]) && is_numeric($obj[$field]) && ($obj[$field] <= $value);
            if(!$condition){
                $this->errors[$field][] = MUST_BE_LESS_OR_EQUAL." ".$value;
            }
        }
        protected function valid_is_greater_than($obj, $field, $value){
            $condition = is_array($obj) && isset($obj[$field]) && is_numeric($obj[$field]) && ($obj[$field] > $value);
            if(!$condition){
                $this->errors[$field][] = MUST_BE_GREATER_THEN." ".$value;
            }
        }
        protected function valid_is_greater_or_equal($obj, $field, $value){
            $condition = is_array($obj) && isset($obj[$field]) && is_numeric($obj[$field]) && ($obj[$field] >= $value);
            if(!$condition){
                $this->errors[$field][] = MUST_BE_GREATER_OR_EQUAL." ".$value;
            }
        }
        protected function valid_chars_range($obj, $field, $values){
            $is_str = is_array($obj) && isset($obj[$field]) && is_string($obj[$field]);
            if(!$is_str){
                $this->errors[$field][] = MUST_BE_STRING;
                return false;
            }
            $length = strlen($obj[$field]);
            $condition = ($length > $values['min']) && ($length <= $values['max']);
            if(!$condition){
                $this->errors[$field][] = MUST_BE_IN_STRING_RANGE." $length (".$values['min']." - ".$values['max'].")";
            }
        }
        protected function valid_not_empty($obj, $field, $value){
            $condition = is_array($obj) && isset($obj[$field]) && empty($obj[$field]);
            if($condition){
                $this->errors[$field][] = MUST_BE_NOT_EMPTY;
            }
        }
        protected function valid_is_confirmed($obj, $field, $value){
            $fields_equal = false;
            $field_confirm = $field."_confirm";
            
            $is_obj = is_array($obj);
            $fields_exists = isset($obj[$field]) && isset($obj[$field_confirm]);
            if($fields_exists){$fields_equal = ($obj[$field] == $obj[$field_confirm]);}
            
            $condition =  $is_obj && $fields_exists && $fields_equal;
            if(!$condition){
                $this->errors[$field][] = MUST_BE_EQUAL . "($field)";
            }
        }
        protected function valid_is_email($obj, $field, $value){
            $pattern = EMAIL_FORMAT;
            preg_match($pattern, $obj[$field], $matches);
            if(!$matches[0]){
                $this->errors[$field][] = MUST_BE_EMAIL." ($field)";
            }
        }
        protected function valid_is_login($obj, $field, $value){
            $pattern = LOGIN_FORMAT;
            preg_match($pattern, $obj[$field], $matches);
            if(!$matches[0]){
                $this->errors[$field][] = MUST_BE_MATCHED." ($field)";
            }
        }
        protected function valid_is_unique($obj, $field, $table){
            $value = $obj[$field];
            // SELECT id FROM users WHERE login = 'killich' ;
            $q = "SELECT id FROM $table WHERE $field = '$value' ;";
            // Если по запросу дает хоть один элемент? то значит не уникально
            if(get_first(q($q))){
                $this->errors[$field][] = MUST_BE_UNIQUE." ($field)";
            }
        }
    }
?>