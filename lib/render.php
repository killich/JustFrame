<?php
  require_once(__DIR__.'/../config/consts.php');
  define("VIEW_TEMPLATES_PATH", __DIR__."/../".VIEW_PATH);
	
  // ��������� ������
  // ������ ������ � �����, ������� ���� ���, �������� ���������� ������, �������� �����	
	function template_evalute($file, &$controller){
    // ����������� ����������
    // ���������� FrameWork - �������� action, controller
    // ���������� Data - ������ ������������ �������
    // ���������� View_Fragment - ������ ��������� ������������ �� ���������
    $framework = &$controller->framework;
    $data = &$controller->data;
    $layout = &$controller;
    $view_fragment = &$controller->view_fragment;
    
    // ���������� �������
		$file_text = file_get_contents($file);
		$code = ' ?>'.$file_text.'<?php ';
		$output = '';
		ob_start();
			eval($code);
			$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
  
  // ���������� �������� (��������, users/some_partial ==> users/_some_partial.php)
  // $file = "a/b" ==> $path = "a/_b.php"
  function _partial($file, $vars = array()){
    // �������� ���������� �����-�������
    $path = explode('/', $file);
    $path = "$path[0]/_$path[1].php";
    $file_text = file_get_contents(VIEW_TEMPLATES_PATH."/$path");
    
    // SOURCE: array('user'=>'John') ==> CODE: $user = $vars['user'];
    $code = '';
    foreach($vars as $n => $v){
      $code .= '$'.$n.' = &$vars['."'$n'".'];';
    }
    // ����������� ���������� ���������
    eval($code);
    
    // ��������� ������
    $code = '';
		$code = ' ?>'.$file_text.'<?php ';
		$output = '';
		ob_start();
			eval($code);
			$output = ob_get_contents();
		ob_end_clean();
		return $output;
  }
    
  // ���������� �������� ���� (��������, users/some_partial ==> users/_some_partial.php)
  // $file = "a/b" ==> $path = "a/_b.php"
  function mvc_partial($file){
    $path = explode('/', $file);
    $path = "$path[0]/_$path[1].php";
		$file_text = file_get_contents(VIEW_TEMPLATES_PATH."/$path");
		$code = ' ?>'.$file_text.'<?php ';
		$output = '';
		ob_start();
			eval($code);
			$output = ob_get_contents();
		ob_end_clean();
		return $output;
  }
  
  // ���������� ��������
	function fragment($file, &$controller){
    $path = explode('/', $file);
    $path = "$path[0]/$path[1].php";
    $path = VIEW_TEMPLATES_PATH."$path";
    return template_evalute($path, $controller);
	}
  
  // ���������� �����
  function layout($file, &$controller){
    // ����������� ����������
    $framework = &$controller->framework;
    $data = &$controller->data;
    $layout = &$controller;
    $fragment = &$controller->fragment;
    // ����������� ������
    require_once(LAYOUT_PATH."$file.php");
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