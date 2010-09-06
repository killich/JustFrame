<?php
  require_once(__DIR__.'/../../config/consts.php');
	
  // ВЫПОЛНИТЬ ШАБЛОН
  // Откыть запись в буфер, вывести туда код, получить содержимое буфера, очистить буфер	
	function template_evalute($file, &$c){
    // РЕГИСТРАЦИЯ ПЕРЕМЕННЫХ
    // Переменная FrameWork - содержит action, controller
    // Переменная Data - данные передаваемые шаблону
    // Переменная StdOut - свякие фрагменты передаваемые на отрисовку
    // Переменная CurrentUser - должен быть текущий пользователь
    $fw = &$c->fw;
    $data = &$c->data;
    $stdout = &$c->stdout;
    $current_user = &$c->current_user;
    
    // ВЫПОЛНЕНИЕ ШАБЛОНА
		$file_text = file_get_contents($file);
		$code = ' ?>'.$file_text.'<?php ';
		$output = '';
		ob_start();
			eval($code);
			$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
  
  // ОТРИСОВАТЬ ФРАГМЕНТ (например, users/some_partial ==> users/_some_partial.php)
  // $file = "a/b" ==> $path = "a/_b.php"
  function partial($file, $vars = array()){
    // Получить содержимое файла-шаблона
    $path = explode('/', $file);
    $path = "$path[0]/_$path[1].php";
    $file_text = file_get_contents(__DIR__."/../../".VIEW_PATH."/$path");
    
    // SOURCE: array('user'=>'John') ==> CODE: $user = $vars['user'];
    $code = '';
    foreach($vars as $n => $v){
      $code .= '$'.$n.' = &$vars['."'$n'".'];';
    }
    // Регистрация переменных фрагмента
    eval($code);
    
    // Выполнить шаблон
    $code = '';
		$code = ' ?>'.$file_text.'<?php ';
		$output = '';
		ob_start();
			eval($code);
			$output = ob_get_contents();
		ob_end_clean();
		return $output;
  }
    
  // ОТРИСОВАТЬ ФРАГМЕНТ ВИДА (например, users/some_partial ==> users/_some_partial.php)
  // $file = "a/b" ==> $path = "a/_b.php"
  function mvc_partial($file){
    $path = explode('/', $file);
    $path = "$path[0]/_$path[1].php";
		$file_text = file_get_contents(__DIR__."/../../".VIEW_PATH."/$path");
		$code = ' ?>'.$file_text.'<?php ';
		$output = '';
		ob_start();
			eval($code);
			$output = ob_get_contents();
		ob_end_clean();
		return $output;
  }
  
  // ОТРИСОВАТЬ ШАБЛОН
	function render($file, &$c){
    $file = $c->fw->view_path."$file.php";
    return template_evalute($file, $c);
	}
  
  // ОТРИСОВАТЬ МАКЕТ
  function layout($layout, &$c){
    // Регистрация переменных
    $fw = &$c->fw;
    $data = &$c->data;
    $stdout = &$c->stdout;
    $current_user = &$c->current_user;
    // Подключение макета
    require_once(LAYOUT_PATH."$layout.php");
  }
  
  // REDIRECT  
  function go_to($path){
    header("Location: $path");
    exit;
  }
  
  function flash(){
    $flash = $_SESSION['flash'];
    if(!isset($flash)) return false;        
    echo "<div class='flash'>";
    if(is_string($flash)){echo $flash;}
    else{
        foreach($flash as $key => $values){
            echo "<h3 class='flash_header'>$key</h3>";
            foreach($values as $index => $msg){
                echo "<p class='flash_msg'>$msg</p>";
            }
        }
    }
    echo "</div>";
  }
?>