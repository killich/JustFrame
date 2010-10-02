<?php
	class Users extends Controller{
    // FILTERS
    function __construct(&$framework){
      // before & after filters
      $this->before_action(array('create', 'registration'), array('init_filter_and_validator'));
      
      // Не удаляйте родительский конструктор (иницилизируйте в других контроллерах)
      // он инициализирует переменные с некоторй важной информацией
      parent::__construct($framework);
    }
    
    // PUBLIC
    // users/index
    function index(){
      $this->data['users'] = User::all();
      $this->fragment['users'] = fragment('users/index', $this);
      haml_layout('haml-layout', $this);
      //layout('layout', $this);
      //param1 = Путь к файлам
      //param2 = Путь к скомпилированным шаблонам
      //param3 = Родительский парсер
      //$parser = new HamlParser(VIEW_PATH.'users');
      //echo $parser->setFile('haml-test.haml');
    }

    // PROTECTED
    protected function init_filter_and_validator(){

    }
	}
/*
  //echo  $this->fragment['users'];
  // $this->add_flash('Успешно удалено');
  //go_to('/');
*/
?>