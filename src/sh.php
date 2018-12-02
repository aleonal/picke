<?php

    $server = Server::create();
    $server -> serverConnect();
    $server -> createUser('jose', 'miner', "jajaj@utep.edu", '80510', 'EE', 'e', 'e', 'e', 'abc123');
    $info = $server -> getSessionInfo('abc123');
    $server -> serverDisconnect();

class Server {
  var $servername = "localhost";
  var $username = "root";
  var $databasename = "mysql";
  var $password = "An1bZ1!@4%$?";
  var $c;

  public function __construct() {
  }

  //returns server instance
  public static function create() {
      $instance = new self();
      return $instance;
  }

  //tests connection
  private function testConnection() {
      if($this -> c == null) return FALSE;
      if($this -> c -> connect_error) {
          return FALSE;
      } return TRUE;
  }

  //create user upon signup
  public function createUser($first, $last, $email, $UTEPID, $fmajor, $smajor, $minor, $concentration, $p) {
    if($this -> testConnection()) {
      $key = hash('sha256', $p);
      $req = 'INSERT INTO `user_info` (uid, firstname, lastname, email, utepid, fmajor, smajor, minor, concentration)
              VALUES ("'.$key.'", "'.$first.'", "'.$last.'", "'.$email.'", "'.$UTEPID.'", "'.$fmajor.'", "'.$smajor.'", "'.$minor.'", "'.$concentration.'" )';

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

  //receives username and information to place in database
  public function updateInfo($uid, $place, $data) {
    if($this -> testConnection()) {
      $req = "UPDATE user_info WHERE 'uid'={$uid} SET {$place}={$data}";
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
  public function getSessionInfo($p) {
    if($this -> testConnection()) {
      $req = "SELECT * FROM user_info";
      $rs = $this -> c -> query($req);

      //looks for user record
      $row = mysqli_fetch_array($rs);
      $key = hash('sha256', $p);
      while($row['uid'] != $key) {
        $row = mysqli_fetch_array($rs);
      }

      return $row;
    } else echo "Not connected to server.";
    return FALSE;
  }

  //closes connection
  public function serverDisconnect() {
    $this -> c -> close();
  }

  //opens connection
  public function serverConnect() {
      $c = new \mysqli($this -> servername, $this -> username, $this -> password, $this -> databasename);
      $this -> c = $c;
    if($this -> c -> connect_error) {
      echo "Connection failed: {$this -> c -> connect_error}";
      return FALSE;
    } echo "Connected successfully \n";

    return TRUE;
  }
}
