<?php

require ROOT.'/libs/core/Menu.php';

class Home
{
  public $prop1 = "";

  public function init($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function getTitle()
  {

      return "<h1>" . $this->prop1 . "</h1>" . "<br />";
  }
}
 
$obj = new Home;

$obj->init("Welcome To The Orders Preview System");

echo $obj->getTitle();

?>