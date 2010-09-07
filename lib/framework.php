<?php
  // Основная задача FrameWork определить по входным данным запроса
  // к какому контроллеру обращается пользователь и какое действие требуется выполнить
	class FrameWork{
		public $action;		
		public $controller;	
		// Конструктор - это функция, которая выполняется
		// при создании объекта класса FrameWork
		function __construct(){
			// Действие и контроллер по-умолчанию
      // определяются в config/consts.php
			$this->action     = ROOT_ACTION;
			$this->controller = ROOT_CONTROLLER;
			// Разбор параметров GET и POST
			// Получение базовых параметров $action и $controller
			// $_POST имеет приоритет над $_GET
			if( isset($_GET['action'])       && !empty($_GET['action'])      )  $this->action = $_GET['action'];
			if( isset($_POST['action'])      && !empty($_POST['action'])     )  $this->action = $_POST['action'];
			if( isset($_GET['controller'])   && !empty($_GET['controller'])  )  $this->controller = $_GET['controller'];
			if( isset($_POST['controller'])  && !empty($_POST['controller']) )  $this->controller = $_POST['controller'];
      // Чистка параметров action, controller
			$this->action_preparation();
			$this->controller_preparation();
		}
    // Проверка на текущую страницу
    function current_page($controller, $action){
      $controller = camelize($controller);
      $action = underscore($action);
      if($controller == $this->controller && $action == $this->action) return true;
      return false;
    }
		// Подготовить переменную action
		protected function action_preparation(){
      $this->action = $this->preparation($this->action);
      $this->action = underscore($this->action);
		}
		// Подготовить переменную controller
    protected function controller_preparation(){
      $this->controller = $this->preparation($this->controller);
      $this->controller = camelize($this->controller);
		}
    protected function preparation($str){
      // Обрезка до 30 символов
      $str = substr($str, 0, 30);
      // Попробуем вырезать потенциально опасные слова
      $match = '/(select|from|drop|update|\?|\<|\>|php|\*)/i';
      $str = preg_replace($match, '', $str);
      return $str;
    }
	}//class FrameWork
?>