<?php
class Server {
  var $servername = "localhost";
  var $dbname = "picke";

  public function __construct() {
  }

  //closes connection
  public static function serverDisconnect() {
    $this -> c -> close();
  }

  //returns server instance with open connection
  public static function serverConnect() {
    $instance = new self();

    $this -> c = new mysqli($servername, $username, $password, $dbname);
    if($this -> c -> connect_error)
      die("Connection failed: " . $c -> connect_error);

    echo "Connected successfully"
    return $instance;
  }
}
 ?>
