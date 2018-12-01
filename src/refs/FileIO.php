<?php
  function storefile($filename, $data = null, $isM = false) {
    if($isM) {
      $file = '../refs/'.$filename.'.txt';
    } else $file = '../usr/'.$filename.'.txt';

    $fp = fopen($file, 'a');
    $fputs($fp, $data);
    $fputs($fp, "\n");
    fclose($fp);
  }

  function readFromFile($filename, $isU = false) {
    if($isU) {
      $file = '../usr/'.$filename.'.txt';
    } else $file = '../refs/'.$filename.'.txt';

    $fp = fopen($file, 'r');
    $data = "";
    while(!feof($fp)) {
      $data = fgets($fp);
      fgets($fp);
    }
    return $data;
  }

  function fileFound($filename) {
    $files = scandir('../refs/');
    for($i = 0; $i < count($files); $i++) {
      if($filename.'.txt' === $files[$i]) return true;
    }
    return false;
  }
 ?>
