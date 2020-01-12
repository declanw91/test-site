<?php
  include('storage.php');
  $storageObject = new storage();
  $method = $_SERVER['REQUEST_METHOD'];
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = file_get_contents('php://input');
    $json = json_decode($post);
    if ($json ->userAction == "save") {
      $storageObject->save($json ->userData);
    } else if ($json ->userAction == "delete") {
      $storageObject->delete($json ->userData);
    } else if ($json ->userAction == "update") {
      $storageObject->save($json ->userData);
    }
  } else if($_GET) {
    //echo "get";
    if ($_GET['method'] == "getUsers") {
      $storageObject->getUsers();
    } else if($_GET['method'] == "find") {
      $storageObject->find($_GET['userdata']);
    } else if ($_GET['method'] == "delete") {
      $storageObject->delete($_GET['userdata']);
    }
  }
 ?>
