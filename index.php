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
    $fw = new FrameWork;                                // Создать новый объект класса FrameWork
    controller_execute($fw);                            // Выполнение действия контроллера
    
    // Теперь смело идем в контроллер
    // app/controller/students
    // 1. смотрим как выполнены вызовы получения данных (МОДЕЛЬ)
    // 2. смотрим как выполнена Валидация данных (Фильтрация еще не сделана)
    // 3. смотрим как отрисовываются данные в файлах-шаблонах ( views, function render() )
    // 4. смотрим как как готовые куски кода отрисовываются в файле-макете (Layout)
    // 5. смотрим как что такое фильтры after & before
?>