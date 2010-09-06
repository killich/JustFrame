<?php    
    // Just FrameWork - study FrameWork for my students (Ilya aka Killich)
    // Просто Фреймворк - учебный фреймворк (каркас для разработки) для моих учеников (Илья aka Килич)
    // http://zayko.habrahabr.ru
    
    //error_reporting(0);                               // Отключение вывода ошибок
    require_once('./config/consts.php');                // Подключение конфигураций
    require_once('./config/data_base_connect.php');     // Подключение соединения с БД
    require_once(LIB_PATH.'/file_helpers/file.php');    // Базовые функции-помощники работы с файлами
    require_files_from(LIB_PATH);                       // Загрузка всех базовых компонент
    session_open();                                     // Открыть сессию
    
    # ActiveRecord
    //DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD
    require_once('./vendors/activerecord/ActiveRecord.php');
    
    ActiveRecord\Config::initialize(function($cfg){
        $cfg->set_model_directory('./app/models');
        $cfg->set_connections(array('development' => 'mysql://root:@127.0.0.1/moodle?charset=UTF8'));
    });

    $fw = new FrameWork;                                // Создать новый объект класса FrameWork
    controller_execute($fw);                            // Выполнение действия контроллера
    
    // Теперь смело идем в контроллер
    // app/controller/students
    // [removed] смотрим как выполнены вызовы получения данных (МОДЕЛЬ)
    // [removed] смотрим как выполнена Валидация данных (Фильтрация еще не сделана)
    // 3. смотрим как отрисовываются данные в файлах-шаблонах ( views, function render() )
    // 4. смотрим как как готовые куски кода отрисовываются в файле-макете (Layout)
    // 5. смотрим как что такое фильтры after & before
?>