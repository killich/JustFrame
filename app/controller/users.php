<?php
	class Users extends Controller{
        // ����������� - �������, ������� ����������� � ����� �������� ���������� �����������
        // ��� ��� ���������� ����� - ���������� �� ���������� ������ ��������
        function __construct(&$fw){
            // before filoters: ������� - �������, ������� ������ ���������� �����(�����) ��������� ��������
            // ����� ���������� create, registration ������ ���������� �-�� init_filter_and_validator
            $this->before_action( array('create', 'registration'), array('init_filter_and_validator') );   
            
            //$this->after_action(array('index', 'create'), array('after_msg'));
            
            // ����� ������������ ������ ������� ������
            // ����� ���������������� ��� ���������� ����������
            parent::__construct($fw);
        }
        // PUBLIC methods [��������� ������]
        // ������������ �������� �����������
		function index(){
			$this->data['users'] = select_users();              // ������� ��������� ������ (������)
			$this->stdout['content'] = render('index', $this);  // ��������� ����� �������� (��� View)
            layout('layout', $this);                            // ��������� ������ �������� � ������ (��� Layout)
		}
        // ������ ������������ ������ data['flash']
        // ���� ���, ���� ������ (���), �� ����� �������� ��������� �� �������
		function create(){
            // ���� ������� - �� ����������� ��������� � �������� ������ ������������
            if($this->data['validator']->valid($_POST['user'], $this)){
                $this->data['filter']->filter($_POST['user']);
                create_new_user($_POST['user']);                // �-�� ������ (������ � �������) /app/model/users
                $this->add_flash('������� �������');            // ������������ flesh ���������
                go_to('/');                                     // ������� �� ������ ��������
            }
            $this->data['users'] = select_users();              // ������� ������ (������)
            $this->stdout['content'] = render('index', $this);  // ��������� ������ � ������� (View)
            layout('layout', $this);                            // ��������� �������� � ������ (Layout) /app/view/layout
		}
		function delete(){
            delete_user($_GET['id']);                           // ������� ������ - ��������� ������������
            $this->add_flash('������� �������');
            go_to('/');
		}
        // TODO
		function signup(){
            layout('layout', $this);
		}
		function registration(){
            // �������� ������ � ���������
            $f = new UserFilter;
            $v = new UserValidator;
            // �������������� ���������� ������ (��������������)
            $f->filter($_POST['user']);
            // ���� �������
            if($v->valid($_POST['user'], $this)){
                
                new UserBeforeCreateFilter($_POST['user']);                 // ��������� ���������� � ���������� ������
                create_new_user($_POST['user']);                            // ������� ������������ (������)
                $this->add_flash('������������ ������� ���������������');   // ��������� �� �����
                go_to('/');                                                 // ������������� �� ��. ��������
            }
            // ���� �� ������� - ������� �������������
            // �������� �������������
            // ����� ��������� �� ������� (flash �������� ����� layout)
            $this->data['users'] = select_users();          
            $this->stdout['content'] = render('index', $this);
            layout('layout', $this);
		}
        // TODO
		function login(){
            print_r($_POST);
            echo 'login';
            exit;
		}
        // ������� - �������, ������� ����������� �� � �����
        // ��������� ��������
        // PROTECTED methods [���������� ������]
        // �� ������ ������� �����, �� ����� ������� � �������� ������
        
        // ������������� �������� ���������� ��������� ������
        protected function init_filter_and_validator(){
            $this->data['filter'] = new UserFilter;          // ����������
            $this->data['validator'] = new UserValidator;    // ���������
        }
	}
?>