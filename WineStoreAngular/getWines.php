<?php
require '../config.php';
//Create database handle and connection
$dbh = new PDO('mysql:host='.DB_HOST.'; dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
//Prepare select statement
$stmt = $dbh->prepare("SELECT wines.name, wines.year, wines.price, wines.color, regions.name AS region FROM wines, regions");
//Execute statement
$stmt->execute(); 
header('Content-Type: application/json');
echo '[';
echo '{"Wines": [';
$totalWines = $stmt->rowCount();
$i = 0;
while ($row = $stmt->fetch()) {
    echo '{';
    echo  '"Name": "' . $row['name'] . '",';
    echo '"Colour": "' . $row['color'] . '", ';
    echo '"Price": "' . $row['price'] . '", ';
    echo '"Year": "' . $row['year'] . '", ';
    echo '"Region": "' . $row['region'] . '"';
    echo "}";
    if(++$i !== $totalWines) {
      echo ",";
    }
}
echo ']},';
//Prepare select statement
$stmt = $dbh->prepare("SELECT regions.name FROM regions");
//Execute statement
$stmt->execute(); 
echo '{"Regions" : [';
$totalRegions = $stmt->rowCount();
$i = 0;
while ($row = $stmt->fetch()) {
    echo '{';
    echo  '"Name": "' . $row['name'] . '"}';
    if(++$i !== $totalRegions) {
      echo ",";
    }
}
echo ']}';
echo ']';
?>