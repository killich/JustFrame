<?php
    $c->add_css('flash.css');
    $c->add_css('test.css');
?>
<div class="registration">
    <? _fp('users','registration');
        label('�����');
        itp('user', 'login');
        
        label('������');          
        itp('user', 'password');

        label('������ ��� ���');
        itp('user', 'password_confirm');
        
        label('Email');
        itp('user', 'email');

        label('�������');
        itp('user', 'surname');
        
        label('���');
        itp('user', 'name');
        
        label('��������');
        itp('user', 'second_name');

        label(submit('�����������',0));
        
      fp_();
    ?>
    
    <?// print_r($current_user);?>
</div>