<?php    
    // Just FrameWork - study FrameWork for my students (Ilya aka Killich)
    // ������ ��������� - ������� ��������� (������ ��� ����������) ��� ���� �������� (���� aka �����)
    // http://zayko.habrahabr.ru
    
    //error_reporting(0);                               // ���������� ������ ������
    require_once('./config/consts.php');                // ����������� ������������
    require_once('./config/data_base_connect.php');     // ����������� ���������� � ��
    require_once(LIB_PATH.'/file_helpers/file.php');    // ������� �������-��������� ������ � �������
    require_files_from(LIB_PATH);                       // �������� ���� ������� ���������
    session_open();                                     // ������� ������
    $fw = new FrameWork;                                // ������� ����� ������ ������ FrameWork
    controller_execute($fw);                            // ���������� �������� �����������
    
    // ������ ����� ���� � ����������
    // app/controller/students
    // 1. ������� ��� ��������� ������ ��������� ������ (������)
    // 2. ������� ��� ��������� ��������� ������ (���������� ��� �� �������)
    // 3. ������� ��� �������������� ������ � ������-�������� ( views, function render() )
    // 4. ������� ��� ��� ������� ����� ���� �������������� � �����-������ (Layout)
    // 5. ������� ��� ��� ����� ������� after & before
?>