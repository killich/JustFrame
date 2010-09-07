<?php    
  // Just FrameWork - study FrameWork for my students (Ilya aka Killich)
  // Просто Фреймворк - учебный фреймворк (каркас для разработки) для моих учеников (Илья aka Килич)
  // http://zayko.habrahabr.ru
  
  /*
    Частица (Partial)   - небольшой HTML элемент, составляющий более крупный HTML блок fragment
    Фрагмент (Fragment) - фрагмент HTML кода, составляющий HTML страницу
    Макет (layout)      - HTML макет страницы. В него вставляется ряд подготовленных фрагментов
    
    Контроллер (Controller) - логический блок связанных функций-обработчиков
    Действие (Action)       - функция-обработчик некоторого действия
    
    Фильтр - Filter (before/after)  - функция, определяемая в контроллере, которая выполняется перед/после указанного действия.
                                      Выгода использования фильтра заключается в том, что можно вынести некоторый повторяющийся функционал
                                      в действиях (Actions) "за скобку"
  */
    
  //error_reporting(0);                               // Отключение вывода ошибок
  require_once('./config/consts.php');                // Подключение конфигураций
  require_once('./config/data_base_connect.php');     // Подключение соединения с БД
  require_once(LIB_PATH.'/file_helpers/file.php');    // Базовые функции-помощники работы с файлами
  require_files_from(LIB_PATH);                       // Загрузка всех базовых компонент
  session_open();                                     // Открыть сессию
  
  // ActiveRecord
  // DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD
  require_once('./vendors/activerecord/ActiveRecord.php');
  
  ActiveRecord\Config::initialize(function($cfg){
    $cfg->set_model_directory(MODEL_PATH);
    $cfg->set_connections(array('development' => 'mysql://'.DATABASE_USER.':'.DATABASE_PASSWORD.'@'.DATABASE_HOST.'/'.DATABASE_NAME.'?charset=UTF8'));
  });

  $framework = new FrameWork;         // Создать новый объект класса FrameWork
  controller_execute($framework);     // Выполнение действия контроллера на основе данных фреймворка
  
  /*
  echo <<<_END_
    Very long message
  _END_;
  */
?>