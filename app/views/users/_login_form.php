<?php
    $c->add_css('flash.css');
    $c->add_css('test.css');
?>
<div class="registration">
    <? _fp('users','registration');
        label('Логин');
        itp('user', 'login');
        
        label('Пароль');          
        itp('user', 'password');

        label('Пароль еще раз');
        itp('user', 'password_confirm');
        
        label('Email');
        itp('user', 'email');

        label('Фамилия');
        itp('user', 'surname');
        
        label('Имя');
        itp('user', 'name');
        
        label('Отчество');
        itp('user', 'second_name');

        label(submit('Регистрация',0));
        
      fp_();
    ?>
    
    <?// print_r($current_user);?>
</div>