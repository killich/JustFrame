<?php
	class Users extends Controller{
    function __construct(&$framework){
      // before & after filters
      $this->before_action(array('create', 'registration'), array('init_filter_and_validator'));
    }
    
    // PUBLIC
    
    // users/index
    function index(){
      $this->data['users'] = User::all();
      $this->fragment['users'] = fragment('users/index', $this);
      layout('layout', $this);     
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