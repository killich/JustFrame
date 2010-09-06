<?php
    $c->add_css('flash.css');
    $c->add_css('test.css');
?>
    
<table border="1">
	<tr>
		<th>Идентификатор</th>
		<th>Логин</th>
		<th>email</th>
		<th>crypted_password</th>
		<th>Имя</th>
		<th>Отчество</th>
		<th>Фамилия</th>
		<th>Удаление</th>
		<th>Редактирование</th>
	</tr>
  
	<?php
    $str = '';
    foreach($data['users'] as $user){ 
      $str .= partial('users/user_block', array('user'=>$user->username, 'test'=>'Hello World!'));
    }
    echo $str;
  ?>
</table>
