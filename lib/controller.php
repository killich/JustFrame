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
		var $fw;
        
		var $data = array();
        var $stdout= array();
        
        var $before_filters= array();
        var $after_filters= array();
        
        // ������� ����������� // �������� ������� ����� ���������
        function __construct($fw){
            // ����������� ������� ������ ���������� ������
            $this->fw = $fw;
            // ������ �������� before
            if(array_key_exists($fw->action, $this->before_filters)){
                foreach($this->before_filters[$fw->action] as $fn){
                    $this->$fn();
                }
            }
            parent::__construct();
        }
        // ������� ���������� // �������� ������� ����� ��������
        function __destruct(){
            $fw = $this->fw;
            // ������ �������� before
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
	function controller_execute(&$fw){
        // removed by ActiveRecord
        //if(file_exists($fw->model_path))        require_once($fw->model_path);          // ����������� ������, ���� ��� ����������
        //if(file_exists($fw->filter_path))       require_once($fw->filter_path);         // ����������� ���������� ������, ���� ��� ����������
        //if(file_exists($fw->validator_path))    require_once($fw->validator_path);      // ����������� ��������� ������, ���� ��� ����������
        controller_exists($fw->controller_path);                                        // �������� ������������� �����������
        require_once($fw->controller_path);            							
        $c = new $fw->controller(&$fw);                                                 // �������� �����������
        $action = $fw->action;
        action_exists($c, $action);                                                     // �������� �� ������������� �������� � �����������
        $c->$action();                                                                  // ����� �������� �����������
        $c->delete_flash();
        unset($c);                                                                      // �������� ������� ����������� (����� ����������� + ������ after ��������)
        exit;
	}
?>