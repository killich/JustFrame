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

	<?php while ($user = mysql_fetch_assoc($data['users'])) { ?>
	<tr>
		<td><?php echo $user["id"]; ?></td>
		<td><?php echo $user["login"]; ?></td>
        <td><?php echo $user["email"]; ?></td>
        <td><?php echo $user["crypted_password"]; ?></td>

        <td><?php echo $user["name"]; ?></td>
        <td><?php echo $user["second_name"]; ?></td>
        <td><?php echo $user["surname"]; ?></td>          
		<td>
			<a href="/users/delete/id=<?php echo $user["id"]; ?>">Удалить</a>
		</td>
		
		<td>
			<a href="/users/edit/id=<?php echo $user["id"]; ?>">Редактировать</a>
		</td>
	</tr>
	<?php } ?>                      
</table>

<?php _l('/users/signup', 'Регистрация', true, array('etc'=>"class='signup'")); ?>