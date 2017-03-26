<?php
  include('storage.php');
  $storageObject = new storage();
  if($_POST) {
    if ($_POST['method'] == "save") {
      $storageObject->save($_POST['userdata']);
    } else if ($_POST['method'] == "delete") {
      $storageObject->delete($_POST['userdata']);
    } else if ($_POST['method'] == "update") {
      $storageObject->update($_POST['olddata'], $_POST['userdata']);
    }
  }
  if ($_GET['method'] == "getUsers") {
    $storageObject->getUsers();
  } else if($_GET['method'] == "find") {
    $storageObject->find($_GET['userdata']);
  } else if ($_GET['method'] == "delete") {
    $storageObject->delete($_GET['userdata']);
  }
 ?>
