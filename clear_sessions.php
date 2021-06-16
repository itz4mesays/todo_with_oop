<?php
session_start();

require __DIR__.'/config/utils.php';

$arrayRem = ['formData', 'errors'];
if(isset($_SESSION)){
  $utils->destroySession($_SESSION, $arrayRem);
}
