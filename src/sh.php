<?php
class Server {
  var $servername = "localhost";
  var $dbname = "picke";
  var $username = "user";
  var $password - "pass123";

  public function __construct() {
  }

  //create user upon signup
  public static function createUser($first, $last, $email, $UTEPID, $fmajor, $smajor, $minor, $concentration, $p) {
    if(testConnection()) {
      $key = cH($p);
      $req = "INSERT INTO user_info (uid, first, last, email, utepid, first major, second major, minor, concentration)
      VALUES (".$key.", ".$first.", ".$last.", ".$email.", ".$UTEPID.", ".$fmajor.", ".$smajor.", ".$minor.", ".$concentration.")";

      if($this -> c -> query($req) === TRUE) {
        echo "User created successfully.";
        return TRUE;
      } else {
        echo "Error creating record: ".$this -> c -> error;
        return FALSE;
      }
    } else echo "Not connected to server.";
    return FALSE;
  }

  //recieves username and information to place in database
  public static function updateInfo($uid, $place, $data) {
    if(testConnection()) {
      $req = "UPDATE user_info SET ".$place."=".$data." WHERE uid=".$uid.;
      if($this -> c -> query($req) === TRUE) {
        echo "Record updated successfully.";
        return TRUE;
      } else {
        echo "Error updating record: ".$this -> c -> error;
        return FALSE;
      }
    } else echo "Not connected to server.";
    return FALSE;
  }

  //returns complete user data from database
  public static function getSessionInfo($p) {
    if(testConnection()) {
      $req = "SELECT * FROM user_info"
      $rs = $this -> c -> query($erq);

      //looks for user record
      $row = mysqli_fetch_array($rs);
      $key = cH($p);
      while($row['uid'] != $key) {
        $row = mysqli_fetch_array($rs);
      }

      return $row;
    } else echo "Not connected to server.";
    return FALSE;
  }

  //closes connection
  public static function serverDisconnect() {
    $this -> c -> close();
  }

  //opens connection
  public static function serverConnect() {
    $this -> c = new mysqli($servername, $username, $password, $dbname);
    if($this -> c -> connect_error) {
      echo "Connection failed: ".$this -> c -> connect_error);
      return FALSE;
    } echo "Connected successfully";

    return TRUE;
  }

  //returns server instance
  public static function create() {
    $instance = new self();
    return $instance;
  }

  //tests connection
  private static function testConnection() {
    if($this -> c -> conncet_error) {
      return FALSE;
    } return TRUE;
  }

  //hashes password
  private static function cH($p) {
    return hash('sha256', $p);
  }
}
 ?>
