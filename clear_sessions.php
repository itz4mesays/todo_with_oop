<?php
session_start();

require __DIR__.'/config/utils.php';

$arrayRem = ['formData', 'errors', 'success_msg'];
if(isset($_SESSION)){
  $utils = new Utils();
  $utils->destroySession($_SESSION, $arrayRem);
}
