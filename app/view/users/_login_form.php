<div class="registration">
    <? _fp('users','registration'); ?>
        �����           <? itp('user', 'login');            br();?>
        ������          <? itp('user', 'password');         br();?>
        ������ ��� ���  <? itp('user', 'password_confirm'); br();?>
        Email           <? itp('user', 'email');            br();?>
        <? br();?>
        �������         <? itp('user', 'surname');          br();?>
        ���             <? itp('user', 'name');             br();?>
        ��������        <? itp('user', 'second_name');      br();?>
        <? br();?>
        <? isp('�����������'); ?>
    <? fp_(); ?>
    
    <?// print_r($current_user);?>
</div>