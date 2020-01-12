<?php
interface iStorage
{
  public function save($data);
  public function find($data);
  public function delete($data);
}

class storage implements iStorage {

 private $filename = 'userdata.json';

public function getFile($mode) {
  if ( !file_exists('userdata.json') ) {
      throw new Exception('File not found.');
  } else {
    $file = fopen('userdata.json', $mode);
    if(!$file) {
      throw new Exception('File failed to open');
    } else {
      return $file;
    }
  }
}

  public function save($data) {
    $userfile = $this->getFile('w');
    $contents = json_encode($data);
    fwrite($userfile, $contents);
    fclose($userfile);
  }
  public function find($data) {
    $userfile = $this->getFile('r');
    $contents = fread($userfile, filesize('userdata.json'));
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
    $this->save($data);
  }
  
  public function update($olddata, $data) {
    
  }
  
  public function getUsers() {
    $userfile = $this->getFile('r');
    $contents = fread($userfile, filesize('userdata.json'));
    fclose($userfile);
    echo $contents;
  }
}
 ?>
