<?php
    class User extends ActiveRecord\Model{
      static $table_name = 'moodle_user';
      static $primary_key = 'id';
    }
?>