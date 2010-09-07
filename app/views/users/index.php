<?php
    $layout->add_css('flash');
    $layout->add_css('test');
?>
    
<table border="1">
  <?php
    $h = array('Идентификатор', 'Логин', 'email', 'crypted_password', 'Имя');
    $str = '';
    foreach($h as $v){
      $str .= "<th>$v</th>";
    }
    echo "<tr>$str</th>";
  ?>
  
	<?php
    $str = '';
    foreach($data['users'] as $user){ 
      $str .= _partial('users/user_block', array('login'=>$user->username, 'test'=>'Hello World!'));
    }
    echo "<tr>$str</tr>";
  ?>
</table>
