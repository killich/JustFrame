<?php
    // Контроллер авторизации пользователя
	class AuthController{
        var $current_user = array();
        function __construct(){
            // Проверить сессию
            // найти запись в таб пользователей
            // разобрать в ассоциативный массив
            // сохранить
        }
    }
    // Базовый Класс Контроллера, пусть он через наследование реализует
    // функционал примесей (mixins)
	class BaseController extends AuthController{
        // Просто в базовом контроллере произведем вызов родительского конструктора
        function __construct(){
            parent::__construct();
        }
    }
    /*=============================================================================*/
	//Класс Контроллера
	class Controller extends BaseController{
		// Сквозные данные
		var $fw;
        
		var $data = array();
        var $stdout= array();
        
        var $before_filters= array();
        var $after_filters= array();
        
        // Базовый конструктор // Вызывает фильтры перед действием
        function __construct($fw){
            // регистрация объекта внутри экземпляра класса
            $this->fw = $fw;
            // запуск фильтров before
            if(array_key_exists($fw->action, $this->before_filters)){
                foreach($this->before_filters[$fw->action] as $fn){
                    $this->$fn();
                }
            }
            parent::__construct();
        }
        // Базовый деструктор // Вызывает фильтры после действия
        function __destruct(){
            $fw = $this->fw;
            // запуск фильтров before
            if(array_key_exists($fw->action, $this->after_filters)){
                foreach($this->after_filters[$fw->action] as $fn){
                    $this->$fn();
                }
            }
        }
        // FLASH!
        function flash(){if(isset($_SESSION['flash'])){return $_SESSION['flash'];}else{return false;}}
        function add_flash($errors){$_SESSION['flash'] = $errors;}
        function delete_flash(){unset($_SESSION['flash']);}
        // Регистрация фильтров для действий
        function before_action($actions = array(), $filters = array()){
            foreach($actions as $action){
               $this->before_filters[$action] = $filters;
            }
        }
        // Регистрация фильтров для действий
        function after_action($actions = array(), $filters = array()){
            foreach($actions as $action){
               $this->after_filters[$action] = $filters;
            }
        }
        function add_css($file){
          $mvc = MVC_PATH_PREFIX;
          $css_file_path = $mvc.PUBLIC_PATH."css/".$file;
          $this->data['css'][$css_file_path] = true;
        }
        function css_print(){
            if(!isset($this->data['css'])) return false;
            foreach($this->data['css'] as $k => $v){
                echo "<link rel='stylesheet' href='".$k."' type='text/css' media='screen' />\n";
            }
        }
	}
    // Функция использует класс ReflectionMethod, который встроен в PHP5
    // Определяет тип метода заданного класса
    // http://php.net/manual/en/function.method-exists.php
    function is_class_method($type="public", $method, $class) {
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
            echo 'Не найден метод-обработчик: '. $action .' (Action not found) :: Error code 1'; br();
            echo '<a href="/">На главную</a>';
            exit();
        }
        if(!is_class_method('public', $action, get_class($controller))){
            echo 'Не найден метод-обработчик: '. $action .' (Action not found) :: Error code 2'; br();
            echo '<a href="/">На главную</a>';
            exit();
        }
    }
	// Исполняет действие Контроллера по данным FrameWork'а
	function controller_execute(&$fw){
        // removed by ActiveRecord
        //if(file_exists($fw->model_path))        require_once($fw->model_path);          // Подключение Модели, если она существует
        //if(file_exists($fw->filter_path))       require_once($fw->filter_path);         // Подключение Фильтрации Модели, если она существует
        //if(file_exists($fw->validator_path))    require_once($fw->validator_path);      // Подключение Валидации Модели, если она существует
        controller_exists($fw->controller_path);                                        // Проверка существования Контроллера
        require_once($fw->controller_path);            							
        $c = new $fw->controller(&$fw);                                                 // Создание контроллера
        $action = $fw->action;
        action_exists($c, $action);                                                     // Проверка на существование действия в контроллере
        $c->$action();                                                                  // Вызов действия контроллера
        $c->delete_flash();
        unset($c);                                                                      // Удаление объекта контроллера (вызов деструктора + запуск after фильтров)
        exit;
	}
?>