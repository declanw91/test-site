<?php
require '../config.php';
try {
  //Create database handle and connection
  $conn = new PDO("sqlsrv:server=".DB_HOST."; database =".DB_NAME, DB_USERNAME, DB_PASSWORD);
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
  //Prepare select statement
  $stmt = $conn->prepare("SELECT wines.name, wines.year, wines.price, wines.color, regions.RegionName AS region FROM wines, regions");
  //Execute statement
  $stmt->execute(); 
  header('Content-Type: application/json');
  echo '[';
  echo '{"Wines": [';
  $result = $row = $stmt->fetchAll();
  $totalWines = count($result);
  $totalWines--;
  for($i = 0; $i <= $totalWines;) {
    echo '{';
      echo  '"Id": "' . $i . '",';
      echo  '"Name": "' . $result[$i]['name'] . '",';
      echo '"Colour": "' . $result[$i]['color'] . '", ';
      echo '"Price": "' . $result[$i]['price'] . '", ';
      echo '"Year": "' . $result[$i]['year'] . '", ';
      echo '"Region": "' . $result[$i]['region'] . '"';
      echo "}";
      $i++;
      if(!is_null($result[$i]['name'])) {
        echo ',';
      }
  }
  echo ']},';
  //Prepare select statement
  $stmt = $conn->prepare("SELECT regions.RegionName FROM regions");
  //Execute statement
  $stmt->execute(); 
  echo '{"Regions" : [';
  $regionResult = $row = $stmt->fetchAll();
  $totalRegions = count($regionResult);
  $i = 0;
  for($i = 0; $i < $totalRegions;) {
    echo '{';
      echo  '"Name": "' . $regionResult[$i]['RegionName'] . '"}';
      $i++;
      if(!is_null($regionResult[$i]['RegionName'])) {
        echo ",";
      }
  }
  echo ']}';
  echo ']';
}
catch(PDOException $e) {
  // do some error handling here e.g.:
  // - display message to the user
  // - send an email to the webmaster
  // - log the error
  // and finally:
  print_r($e);
}
?>