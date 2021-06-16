<?php

class Utils
{
  const BR = PHP_EOL;

  //Encapsulation
  public $log;
  private $dateAdded;
  public $flag = false; //no error

  // protected //You can direct access a protected access specifier in a direct child class using $this->

  public function __construct(){
    $this->dateAdded = date('Y-m-d H:i:s');
  }

  public function setLog($log){
    $this->log = $log;
  }

  public function setFlag($flag){
    $this->flag = $flag;
  }

  public function getLog(){
    return $this->log;
  }

  public function createLog()
  {
      $file = fopen(__DIR__.'/../access_log.txt', 'a');
      if($this->flag == true){
        $message = '- '.$this->log.' on '.$this->dateAdded. self::BR;
      }elseif($this->flag == false){
        $message = '- App was '.$this->log.' on '.$this->dateAdded.self::BR;
      }else{
        $message = '- I am groot for now'.self::BR;
      }

      fwrite($file, $message);
      fclose($file);
  }

  public function listStatus()
  {
    return [
      ['id' => 1, 'status' => 'Pending'],
      ['id' => 2, 'status' => 'In Progress'],
      ['id' => 3, 'status' => 'Completed'],
      ['id' => 4, 'status' => 'Canceled']
    ];
  }

  public function destroySession($sessArr, $removeSession)
  {
    foreach($removeSession as $value){
      if(in_array($value, array_keys($sessArr))){
        unset($_SESSION[$value]);
      }
    }
  }

}
