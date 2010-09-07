<?php
    /**************************************************************************************************/
    // FORM START and FORM START PRINT
	// echo f('students', 'test', 'x=y&z=7', true, "class='block' style='display:none'");
    // <form method='post' action='?controller=students&amp;action=test&amp;x=y&amp;z=7' enctype='multipart/form-data' class='block' style='display:none' >
	function _f($controller, $action, $params = array()){
        $mvc = MVC_PATH_PREFIX;
        
        //, $mp = false, $etc = ''
        $str = "<form ";
        if(!empty($params['method'])){
            $str .= "method='".$params['method']."' ";
        }else{
            $str .= "method='post' ";
        };
        // Если есть добавить параметры
        if(!empty($params['params'])){$p = "&amp;".htmlspecialchars($params['params']);}
        // Формируем действие
        $str .= "action='$mvc$controller/$action/$p' ";
        // Если передача файлов
        if($params['multipart']){$str .= "enctype='multipart/form-data' ";}
        // прочее
        if(!empty($params['etc'])){$str .= $params['etc']." ";}
        $str .= '>';
        return $str;
	}
    function _fp($controller, $action, $params = array()){
        echo _f($controller, $action, $params);
    }
    // FORM END and FORM END PRINT
    function f_(){return '</form>';}
    function fp_(){echo f_();}
    /**************************************************************************************************/
    // INPUT TEXT and INPUT TEXT PRINT
    function it($obj, $name, $value = '', $params = ''){
        $str = "<input type='text' ";
        // формируем имя
        if(!empty($obj)){$str .= "name='".$obj."[$name]"."' ";}
        else{$str .= "name='$name' ";}
        // формируем значение
        if(!empty($value)){$str .= "value='$value' ";}
        // прочее
        if(!empty($params)){$str .= "$params ";}
        $str .= " />\n";
        return $str;
    }
    function itp($obj, $name, $value = '', $params = ''){
        echo it($obj, $name, $value, $params = '');
    }
    /**************************************************************************************************/
    // INPUT SUBMIT and INPUT SUBMIT PRINT
    function submit($value = '', $print = true){
        if(!empty($value)){$value ="value = '$value'";}
        $str = "<input name='submit' type='submit' $value />\n";
        
        // print or return
        if($print){echo $str;}else{return $str;}
    }
    /**************************************************************************************************/
?>