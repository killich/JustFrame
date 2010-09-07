<?php
    // ���������� ����������� ������������
	class AuthController{
        var $current_user = array();
        function __construct(){
            // ��������� ������
            // ����� ������ � ��� �������������
            // ��������� � ������������� ������
            // ���������
        }
    }
    // ������� ����� �����������, ����� �� ����� ������������ ���������
    // ���������� �������� (mixins)
	class BaseController extends AuthController{
        // ������ � ������� ����������� ���������� ����� ������������� ������������
        function __construct(){
            parent::__construct();
        }
    }
    /*=============================================================================*/
	//����� �����������
	class Controller extends BaseController{
		// �������� ������
		var $framework;
        
		var $data = array();
        var $stdout= array();
        
        var $before_filters= array();
        var $after_filters= array();
        
        // ������� ����������� // �������� ������� ����� ���������
        function __construct($framework){
            // ����������� ������� ������ ���������� ������
            $this->framework = $framework;
            // ������ �������� before
            if(array_key_exists($framework->action, $this->before_filters)){
                foreach($this->before_filters[$framework->action] as $fn){
                    $this->$fn();
                }
            }
            parent::__construct();
        }
        // ������� ���������� // �������� ������� ����� ��������
        function __destruct(){
            $framework = $this->framework;
            // ������ �������� before
            if(array_key_exists($framework->action, $this->after_filters)){
                foreach($this->after_filters[$framework->action] as $fn){
                    $this->$fn();
                }
            }
        }
        // FLASH!
        function flash(){if(isset($_SESSION['flash'])){return $_SESSION['flash'];}else{return false;}}
        function add_flash($errors){$_SESSION['flash'] = $errors;}
        function delete_flash(){unset($_SESSION['flash']);}
        // ����������� �������� ��� ��������
        function before_action($actions = array(), $filters = array()){
            foreach($actions as $action){
               $this->before_filters[$action] = $filters;
            }
        }
        // ����������� �������� ��� ��������
        function after_action($actions = array(), $filters = array()){
            foreach($actions as $action){
               $this->after_filters[$action] = $filters;
            }
        }
        function add_css($file){
          $mvc = MVC_PATH_PREFIX;
          $css_file_path = $mvc.PUBLIC_PATH."css/$file.css";
          $this->data['css'][$css_file_path] = true;
        }
        function css_print(){
          if(!isset($this->data['css'])) return false;
          foreach($this->data['css'] as $k => $v){
            echo "<link rel='stylesheet' href='".$k."' type='text/css' media='screen' />\n";
          }
        }
	}
    // ������� ���������� ����� ReflectionMethod, ������� ������� � PHP5
    // ���������� ��� ������ ��������� ������
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
            echo '�� ������ ����-���������� (Controller not found)'; br();
            echo '<a href="/">�� �������</a>';
            exit();
        }
    } 
    function action_exists($controller, $action){
        if(!method_exists($controller, $action)){
            echo '�� ������ �����-����������: '. $action .' (Action not found) :: Error code 1'; br();
            echo '<a href="/">�� �������</a>';
            exit();
        }
        if(!is_class_method('public', $action, get_class($controller))){
            echo '�� ������ �����-����������: '. $action .' (Action not found) :: Error code 2'; br();
            echo '<a href="/">�� �������</a>';
            exit();
        }
    }
	// ��������� �������� ����������� �� ������ FrameWork'�
	function controller_execute(&$framework){
        controller_exists($framework->controller_path);                                        // �������� ������������� �����������
        require_once($framework->controller_path);            							
        $controller = new $framework->controller(&$framework);                                                 // �������� �����������
        $action = $framework->action;
        action_exists($controller, $action);                                                     // �������� �� ������������� �������� � �����������
        $controller->$action();                                                                  // ����� �������� �����������
        $controller->delete_flash();
        unset($controller);                                                                      // �������� ������� ����������� (����� ����������� + ������ after ��������)
        exit;
	}
?>