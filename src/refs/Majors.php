<?php
require_once '../refs/FileIO.php'

class Major {
  var $name;
  var $coreC;
  var $majrC;

  public function __construct() {
  }

  private static function loadCore() {

  }

  private static function loadMajr() {

  }

  public static function createFile($n) {
    $instance = new self();
    $instance -> name = $n;
    $instance -> coreC = loadCore();
    $instance -> majrC = loadMajr();
    return $instance;
  }

  public static function fromJsonString($data) {
    $major = json_decode($data);
    $instance = Major::load($major->)
  }
}
?>
