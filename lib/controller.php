<?php
  //Класс Контроллера
  class Controller{
    // Сквозные данные
    var $framework;

    var $data = array();
    var $fragment= array();

    var $before_filters= array();
    var $after_filters= array();

    // Базовый конструктор // Вызывает фильтры перед действием
    function __construct($framework){
      // регистрация объекта внутри экземпляра класса
      $this->framework = $framework;
      // запуск фильтров before
      if(array_key_exists($framework->action, $this->before_filters)){
        foreach($this->before_filters[$framework->action] as $fn){
          $this->$fn();
        }
      }
    }// __construct
    
    // Базовый деструктор // Вызывает фильтры после действия
    function __destruct(){
      $framework = $this->framework;
      // запуск фильтров after
      if(array_key_exists($framework->action, $this->after_filters)){
        foreach($this->after_filters[$framework->action] as $fn){
          $this->$fn();
        }
      }
    }// __destruct
    
    // FLASH
    // ==================================================================
    function flash(){
      if(isset($_SESSION['flash'])){
        return $_SESSION['flash'];
      }else{
        return false;
      }
    }
    function add_flash($errors){
      $_SESSION['flash'] = $errors;
    }
    function delete_flash(){
      unset($_SESSION['flash']);
    }
    // ==================================================================   

    // Регистрация фильтров для действий
    // ==================================================================
    function before_action($actions = array(), $filters = array()){
      foreach($actions as $action){
        $this->before_filters[$action] = $filters;
      }
    }
    function after_action($actions = array(), $filters = array()){
      foreach($actions as $action){
        $this->after_filters[$action] = $filters;
      }
    }
    // ==================================================================
    
    // CSS
    function add_css($file){
      $mvc = MVC_PATH_PREFIX;
      $css_file_path = $mvc.PUBLIC_PATH."css/$file.css";
      $this->data['css'][$css_file_path] = true;
    }
    function css(){
      if(!isset($this->data['css'])) return false;
      foreach($this->data['css'] as $k => $v){
        echo "<link rel='stylesheet' href='".$k."' type='text/css' media='screen' />\n";
      }
    }
	}
  
  // Функция использует класс ReflectionMethod, который встроен в PHP5
  // Определяет тип метода заданного класса
  // http://php.net/manual/en/function.method-exists.php
  function is_class_method($type="public", $method, $class){
    $refl = new ReflectionMethod($class, $method);
    switch($type){
      case "static":
      return $refl->isStatic();
      break;
      case "public":
      return $refl->isPublic();
      break;
      case "private":
      return $refl->isPrivate();
      break;
    }
  }
  
  function controller_exists($path){
    if(!file_exists($path)){
      echo 'Не найден файл-обработчик (Controller not found)'; br();
      echo '<a href="/">На главную</a>';
      exit();
    }
  }
  
  function action_exists($controller, $action){
    if(!method_exists($controller, $action)){
      echo 'Не найден метод-обработчик: '. $action .' (Action not found) :: Error code 1 <br />';
      echo '<a href="/">На главную</a>';
      exit();
    }
    if(!is_class_method('public', $action, get_class($controller))){
      echo 'Не найден метод-обработчик: '. $action .' (Action not found) :: Error code 2 <br />';
      echo '<a href="/">На главную</a>';
      exit();
    }
  }
  
  // Исполняет действие Контроллера по данным FrameWork'а
  function controller_execute(&$framework){
    $controller_path = CONTROLLER_PATH.strtolower("$framework->controller.php");
    controller_exists($controller_path);                                          // Проверка существования Контроллера
    require_once($controller_path);
    $controller = new $framework->controller(&$framework);                        // Создание контроллера
    $action = $framework->action;
    action_exists($controller, $action);                                          // Проверка на существование действия в контроллере
    $controller->$action();                                                       // Вызов действия контроллера
    $controller->delete_flash();
    unset($controller);                                                           // Удаление объекта контроллера (вызов деструктора + запуск after фильтров)
    exit;
  }
?>