<?php
  // tag BR
  function br($print = true){
    if($print){echo '<br />';}
    else{return '<br />';}
  }

  // tag A
  function link_to($path = '/', $value = '—сылка', $args = array(), $print = true){
    # префикс дл€ интеграции в другой проект
    if(INJECTION_MODE){$mvc = MVC_PATH_PREFIX;}
    $mvc_prefix = '';

    // params processing
    $params = '';
      if($args['params']){
      $params = $args['params'];
    }

    // String forming
    $str = "<a href='$mvc$path' $params ";
    $str .= ">".$value."</a>";

    // print or return
    if($print){echo $str;}else{return $str;}
  }
  function _l($path = '/', $value = '—сылка', $args = array(), $print = true){
    return link_to($path, $value, $args, $print);
  }
  // tag LABEL
  function _label($txt, $print = true){
    $str = "<label>$txt</label>";
    // print or return
    if($print){echo $str;}else{return $str;}
  }
?>