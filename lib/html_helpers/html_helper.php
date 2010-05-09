<?php
	// tag <br />
	function br($print = true){
		if($print){echo '<br />';}
        else{return '<br />';}
	}
    
    // tag <a> </a>
    function link_to($path = '/', $value = '—сылка', $print = true, $params = array()){
        $str = "<a href='".$path."' ";
        if($params['etc']){$str .= $params['etc'] . " ";}
        $str .= ">".$value."</a>";
        if($print){echo $str;}else{return $str;}
    }
    function _l($path = '/', $value = '—сылка', $print = true, $params = array()){
        return link_to($path, $value, $print, $params);
    }
    // tag <label> </label>
    function _label($txt){
        echo "<label>$txt</label>";
    }
?>