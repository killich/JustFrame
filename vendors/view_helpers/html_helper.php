<?php
  // tag BR
  function br($print = true){
    if($print){echo "<br />\n";}else{return "<br />\n";}
  }
  // tag A
  function link_to($path = '/', $value = '—сылка', $args = array(), $print = true){
    # префикс дл€ интеграции в другой проект
    $mvc = MVC_PATH_PREFIX;

    // params processing
    $params = '';
      if($args['params']){
      $params = $args['params'];
    }

    // String forming
    $str = "<a href='$mvc$path' $params>$value</a>";

    // print or return
    if($print){echo $str;}else{return $str;}
  }
  // tag LABEL
  function label($txt, $args = array(), $print = true){
    // params processing
    $params = '';
      if($args['params']){
      $params = $args['params'];
    }
    
    // String forming
    $str = "<label $params>$txt</label>";
    
    // print or return
    if($print){echo $str;}else{return $str;}
  }
  
  function content_tag($tag, $txt, $args = array()){
    // params processing
    $params = '';
    if($args['params']){
      $params .= ' '.$args['params'];
    }
    
    // String forming
    $str = "<$tag$params>$txt</$tag>";

    return $str;
  }
?>