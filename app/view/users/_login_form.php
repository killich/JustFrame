<div class="registration">
    <? _fp('users','registration'); ?>
        Логин           <? itp('user', 'login');            br();?>
        Пароль          <? itp('user', 'password');         br();?>
        Пароль еще раз  <? itp('user', 'password_confirm'); br();?>
        Email           <? itp('user', 'email');            br();?>
        <? br();?>
        Фамилия         <? itp('user', 'surname');          br();?>
        Имя             <? itp('user', 'name');             br();?>
        Отчество        <? itp('user', 'second_name');      br();?>
        <? br();?>
        <? isp('Регистрация'); ?>
    <? fp_(); ?>
    
    <?// print_r($current_user);?>
</div>