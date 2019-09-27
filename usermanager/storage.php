<?php
interface iStorage
{
  public function save($data);
  public function find($data);
  public function delete($data);
}

class storage implements iStorage {

 private $filename = 'userdata.txt';

public function getFile($mode) {
  if ( !file_exists('userdata.txt') ) {
      throw new Exception('File not found.');
  } else {
    $file = fopen('userdata.txt', $mode);
    if(!$file) {
      throw new Exception('File failed to open');
    } else {
      return $file;
    }
  }
}

  public function save($data) {
    $userfile = $this->getFile('r');
    $contents = fread($userfile, filesize('userdata.txt'));
    fclose($userfile);
    $userfile = $this->getFile('w');
    $pattern = '/\]/i';
    $contents = preg_replace($pattern, '', $contents);
    //$contents = str_replace("]","", $filestring);
    $contents = $contents.','.$data.']';
    //ftruncate($userfile, 0);
    fwrite($userfile, $contents);
    fclose($userfile);
  }
  public function find($data) {
    $userfile = $this->getFile('r');
    $contents = fread($userfile, filesize('userdata.txt'));
    fclose($userfile);
    $jsonstring = json_decode($contents, true);
    $searchstring = json_decode($data, true);
    $searchcontext = $searchstring['searchContext'];
    foreach($jsonstring as $item) {
        if($searchcontext == "userName") {
          if(array_key_exists('userName', $item)) {
            if($item['userName'] == $searchstring['userName']) {
              echo '['.json_encode($item).']';
              break;
            }
          }
        } else if ($searchcontext == "name") {
          if((strtolower($item['firstName']) == strtolower($searchstring['firstName'])) && (strtolower($item['lastName']) == strtolower($searchstring['lastName']))) {
            echo '['.json_encode($item).']';
            break;
          }
        }
    }
  }
  
  public function delete($data) {
    $userfile = $this->getFile('r');
    $contents = fread($userfile, filesize('userdata.txt'));
    fclose($userfile);
    $contents = str_replace($data, '{}', $contents);
    $userfile = $this->getFile('w');
    fwrite($userfile, $contents);
    fclose($userfile);
    $this->getUsers();
  }
  
  public function update($olddata, $data) {
    $userfile = $this->getFile('r');
    $contents = fread($userfile, filesize('userdata.txt'));
    fclose($userfile);
    $contents = str_replace($olddata, $data, $contents);
    $userfile = $this->getFile('w');
    fwrite($userfile, $contents);
    fclose($userfile);
    $this->getUsers();
  }
  
  public function getUsers() {
    $userfile = $this->getFile('r');
    $contents = fread($userfile, filesize('userdata.txt'));
    fclose($userfile);
    echo $contents;
  }
}
 ?>
