<?php
	class Users extends Controller{
        // Конструктор - функция, которая выполняется в время создания экземпляра контроллера
        // все что выполнится здесь - выполнится до выполнения любого действия
        function __construct(&$fw){
            // before filoters: Фильтры - функции, которые должны выполнится перед(после) указанных действий
            // Перед действиями create, registration должна выполнится ф-ия init_filter_and_validator
            $this->before_action( array('create', 'registration'), array('init_filter_and_validator') );   
            
            //$this->after_action(array('index', 'create'), array('after_msg'));
            
            // Вызов конструктора ПРЕДКА данного класса
            // Чтобы инициализировать все необходимы переменные
            parent::__construct($fw);
        }
        // PUBLIC methods [Публичные методы]
        // Обрабатывают действия контроллера
		function index(){
      $this->data['users'] = User::all();
      $this->stdout['users'] = render('index', $this);  // Отрисовка куска страницы (Вид View)
      echo  $this->stdout['users'];
      //layout('layout', $this);                          // Отрисовка кусков страницы в макете (Вид Layout)
		}
        // Шаблон отрисовывает объект data['flash']
        // Если там, есть ошибки (хеш), то будут выведены сообщения об ошибках
		function create(){
            // Если валидно - то отфильтруем параметры и создадим нового пользователя
            /*
            if($this->data['validator']->valid($_POST['user'], $this)){
                $this->data['filter']->filter($_POST['user']);
                create_new_user($_POST['user']);                // Ф-ия Модели (работа с данными) /app/model/users
                $this->add_flash('Успешно создано');            // формирование flesh сообщений
                go_to('/');                                     // переход на другую страницу
            }
            $this->data['users'] = select_users();              // Выборка данных (Модель)
            $this->stdout['content'] = render('index', $this);  // Отрисовка данных в шаблоне (View)
            layout('layout', $this);                            // Отрисовка шаблонов в макете (Layout) /app/view/layout
            */
		}
		function delete(){
            delete_user($_GET['id']);                           // Функция модели - удаляющая пользователя
            $this->add_flash('Успешно удалено');
            go_to('/');
		}
        // TODO
		function signup(){
            $this->stdout['content'] = render('_login_form', $this);
            layout('layout', $this);
		}
		function registration(){
            /*
            // Создадим фильтр и валидатор
            $f = new UserFilter;
            $v = new UserValidator;
            // Первоначальная фильтрация данных (пердподготовка)
            $f->filter($_POST['user']);
            // Если валидно
            if($v->valid($_POST['user'], $this)){
                
                new UserBeforeCreateFilter($_POST['user']);                 // Вторичная фильтрация и подготовка данных
                create_new_user($_POST['user']);                            // Создать пользователя (модель)
                $this->add_flash('Пользователь успешно зарегистрирован');   // Сообщение на экран
                go_to('/');                                                 // Переадресация на др. страницу
            }
            // Если не валидно - выборка пользователей
            // Отрисока пользователей
            // Показ сообщения об ошибках (flash рисуется через layout)
            $this->data['users'] = select_users();          
            $this->stdout['content'] = render('index', $this);
            */
            echo 'hello from registrator';
            layout('layout', $this);
		}
        // TODO
		function login(){
      print_r($_POST);
      echo 'login';
      exit;
    }
    // Фильтры - функции, которые выполняются До и После
    // основного действия
    // PROTECTED methods [Защищенные методы]
    // их нельзя вызвать извне, но можно вызвать в функциях класса

    // Инициализация объектов фильтрации валидации данных
    protected function init_filter_and_validator(){
      //$this->data['filter'] = new UserFilter;          // Фильтрация
      //$this->data['validator'] = new UserValidator;    // Валидация
    }
	}
?>