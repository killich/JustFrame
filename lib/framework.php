<?php	
	class FrameWork{
		public $model;
		public $model_path;
		
		public $action;
		public $view_path;
		
		public $controller;
		public $controller_path;
		
		// ����������� - ��� �������, ������� �����������
		// ��� �������� ������� ������ FrameWork
		function __construct(){
			// �������� � ���������� ��-���������
			$this->action = ROOT_ACTION;
			$this->controller = ROOT_CONTROLLER;
			// ������ ���������� GET � POST
			// ��������� ������� ���������� $action � $controller
			// $_POST ����� ��������� ��� $_GET
			if(isset($_GET['action'])		&& !empty($_GET['action']))			$this->action = $_GET['action'];
			if(isset($_POST['action'])		&& !empty($_POST['action']))		$this->action = $_POST['action'];
			if(isset($_GET['controller'])	&& !empty($_GET['controller']))		$this->controller = $_GET['controller'];
			if(isset($_POST['controller'])	&& !empty($_POST['controller']))	$this->controller = $_POST['controller'];
			// ����� ���������� action, controller
			$this->action_preparation();
			$this->controller_preparation();
      
      // Removed ==> ActiveRecord
			// ������������ ���������� � ������
			//$this->model_path = MODEL_PATH.$this->controller.'.php';
			//$this->validator_path = VALIDATION_PATH.$this->controller.'.php';
			//$this->filter_path = FILTRATION_PATH.$this->controller.'.php';
      
			$this->view_path = VIEW_PATH.$this->controller."/";
			$this->controller_path = CONTROLLER_PATH.$this->controller.'.php';       

		}
        function current_page($controller, $action){
            $controller = camelize($controller);
            $action = underscore($action);
            if($controller == $this->controller && $action == $this->action) return true;
            return false;
        }
		// ����������� ���������� action
		protected function action_preparation(){
      $this->action = $this->preparation($this->action);
      $this->action = underscore($this->action);
		}
		// ����������� ���������� controller
    protected function controller_preparation(){
      $this->controller = $this->preparation($this->controller);
      $this->controller = camelize($this->controller);
		}
    protected function preparation($str){
      // ������� �� 30 ��������
      $str = substr($str, 0, 30);
      // ��������� �������� ������������ ������� �����
      $match = '/(select|from|drop|update|\?|\<|\>|php|\*)/i';
      $str = preg_replace($match, '', $str);
      return $str;
    }
	}//class FrameWork
?>