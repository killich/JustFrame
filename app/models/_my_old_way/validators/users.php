<?php
	class UserValidator extends Validator{
        function __construct(){
            $this->not_empty('login');
            $this->not_empty('password');
            $this->not_empty('email');
            $this->not_empty('name');
            $this->not_empty('second_name');
            $this->not_empty('surname');
            
            $this->is_login('login');
            $this->is_unique('login', 'users');

            //$this->is_password('password');
            $this->is_confirmed('password');
            $this->chars_range('password', 5, 15);
            
            $this->is_email('email');

            $this->chars_range('name', 3, 30);
            $this->chars_range('second_name', 2, 30);
            $this->chars_range('surname', 2, 30);
                                    
            //$this->is_numeric_filed('years');
            //$this->is_less_than('years', 70);
            //$this->is_less_or_equal('years', 70);
            //$this->is_greater_than('years', 12);
            //$this->is_greater_or_equal('years', 12);
            //$this->chars_range('name', 6, 40);
            //$this->chars_range('class', 2, 4);
            //$this->unique('students', 'name');
            //$this->is_email('email');
        }
	}
?>