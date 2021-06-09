<?php

class Utils
{
  //Encapsulation
  public $log;
  private $dateAdded;
  public $flag = false; //no error

  public function __construct($log, $flag){
    $this->dateAdded = date('Y-m-d H:i:s');
    $this->log = $log;
    $this->flag = $flag;
  }

  public function getLog(){
    return $this->log;
  }

  public function createLog()
  {
      $file = fopen('./access_log.txt', 'a');
      if($this->flag == true){
        $message = '- '.$this->log.' on '.$this->dateAdded;
      }elseif($this->flag == false){
        $message = '- App was '.$this->log.' on '.$this->dateAdded;
      }else{
        $message = '- I am groot for now';
      }

      fwrite($file, $message);
      fclose($file);
  }

}
