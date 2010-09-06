<?php	
	class Filter{
        var $filters = array();
        // тсмйжхх пецхярпюрнпш
        function trim_field($field){
            $this->filters['trim_field'][$field] = true;
        }
        function trim_all(){
            $this->filters['trim_all'] = true;
        }
        function mysql_protect_all(){
            $this->filters['mysql_protect_all'] = true;
        }
        function delete_unnecessary_params(&$obj, $to_save=array()){
            foreach($obj as $key => $value){
                if(!array_key_exists($key, $to_save)){unset($obj[$key]);}
            }
        }
        // SQL save; preg_replace(MYSQL_RESERVED_WORDS, "&nbsp;\$1", 'KILL KILLICH drop drop');
        // тхкэрпюжхъ
        function filter(&$obj){
            $f = &$this->filters;
            if($f['mysql_protect_all']){
                $this->filter_mysql_protect_all($obj, $key);
            }
            if(is_array($f['trim_field'])){
                foreach($f['trim_field'] as $key => $value){
                    $this->filter_trim_field($obj, $key);
                }
            }
            if($f['trim_all']){
                $this->filter_trim_all(&$obj);
            }
        }
        // лерндш-тхкэрпш
        protected function filter_trim_field(&$obj, $key){
            if($obj[$key]){
                $obj[$key] = trim($obj[$key]);
            }
        }
        protected function filter_trim_all(&$obj){
            foreach($obj as $key => $value){
                $obj[$key] = trim($obj[$key]);
            }
        }
        protected function filter_mysql_protect_all(&$obj){
            foreach($obj as $key => $value){
                $obj[$key] = preg_replace(MYSQL_RESERVED_WORDS, "&nbsp;\$1", $obj[$key]);
            }
        }
    }
?>