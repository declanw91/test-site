<?php
    // Requires the cofig file and imports the settings
    require('../config.php');
    // Includes the functions from the external file
    include('functions.php');
    // Join session
    session_start();
    // Get file and key from URL
    $file = $_GET['file'];
    $fid = $_GET['fileKey'];
    // Create a database connection
    $dbh = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Prepare a select statement to get file id
    $search = $dbh->prepare("SELECT id FROM downloads WHERE downloads.Source = :f");
    // Bind in the name of the file
    $search->bindValue(":f", $file);
    // Execute statement
    $search->execute();
    // Get file id and store it
    while ($row = $search->fetch()) {
        $pId = $row['id'];
    }
    // Prepare a select statement to check log
    $check = $dbh->prepare("SELECT * FROM log WHERE log.UserId= :u AND log.PurchaseId= :p");
    // Bind in user id
    $check->bindValue(":u", $_SESSION['User']);
    // Bind in file id
    $check->bindValue(":p", $pId);
    // Execute statement
    $check->execute();
    // If user has downlaoded file before
    if ($check->rowCount() >= 1) {
        $file = substr($file, 10);
        downloadFile($file);
    // If user has not downlaoded file before and it is a valid link
    } else if (($check->rowCount() == 0) && ($fid == md5($_SESSION['User']))) {
        $file = substr($file, 10);
        downloadFile($file);
        // Prepare an insert statement to log purchase
        $stmt = $dbh->prepare("INSERT INTO log VALUES('', :u, :pi, now())");
        // Bind in user name and id of the item
        $stmt->bindValue(":u", $_SESSION['User']);
        $stmt->bindValue(":pi", $pId);
        // Execute statement
        $stmt->execute();
    } else {
        // Invalid link found so redirect to the home page
        header('Location: http://www.declanwright.co.uk/BlogStore');
    }
?>