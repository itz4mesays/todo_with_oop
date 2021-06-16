<?php
require('user.php');
require('todo.php');

class Admin extends User
{
  // private type = 'Administrator';

  public function __construct(){
    parent::__construct();
  }
}
