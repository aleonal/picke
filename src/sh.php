<?php
class Server {
  var $servername = "localhost";
  var $dbname = "picke";
  var $username = "user";
  var $password - "pass123";

  public function __construct() {
  }

  //create user upon signup
  public static function createUser($first, $last, $email, $UTEPID, $fmajor, $smajor, $minor, $concentration, $password) {
    if(testConnection()) {
      $key = hash('sha256', $email);
      $req = "INSERT INTO user_info (uid, first, last, email, utepid, first major, second major, minor, concentration, password)
      VALUES (".$key.", ".$first.", ".$last.", ".$email.", ".$UTEPID.", ".$fmajor.", ".$smajor.", ".$minor.", ".$concentration.", ".$password.")";

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
  public static function updateInfo($email, $place, $data) {
    if(testConnection()) {
      $key = hash('sha256', $email);
      $req = "UPDATE user_info SET ".$place."=".$data." WHERE id=".$key.;
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
  public static function getInfo($email) {
    if(testConnection()) {
      $req = "SELECT * FROM user_info"
      $rs = $this -> c -> query($erq);

      //looks for user record
      $row = mysqli_fetch_array($rs);
      $key = hash('sha256', $email);
      while($row['uid'] != $key) {
        $row = mysqli_fetch_array($rs);
      }

      return $row;
    } else echo "Not connected to server.";
    return FALSE;
  }

  //tests connection
  private static function testConnection() {
    if($this -> c -> conncet_error) {
      return FALSE;
    } return TRUE;
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
      die("Connection failed: " . $this -> c -> connect_error);

    echo "Connected successfully";
    return $instance;
  }
}
 ?>
