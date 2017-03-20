<?php

    // Include all the required libraries
    require_once('library/googlecart.php');
    require_once('library/googleitem.php');
    require_once('library/googleshipping.php');
    require_once('library/googletax.php');
    //Requires the cofig file and imports the settings
    require '../config.php';
    //Import the functions from the external file
    include 'functions.php';
    //Start the session
    session_start();
    // Create a cart item to be used for purchase
    $cart = new GoogleCart(MERCHANT_ID, MERCHANT_KEY, "sandbox", "GBP");
    // Connect to the database
    $dbh = new PDO('mysql:host=localhost; dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Prepare and execute a select state to get product details
    $stmt = $dbh->prepare("SELECT * FROM downloads WHERE Source= :f");
    $stmt->bindValue(":f", $_POST['file']);
    $stmt->execute();
    // Get information from database result and create a item
    while ($row = $stmt->fetch()) {
        $item = new GoogleItem($row['Name'], $row['Description'], 1,
                        $row['Price']);
    }
    // Set the download link and key and add it to item
    $item->SetURLDigitalContent("http://www.declanwright.co.uk/BlogStore/download.php?file=" . $_POST['file'] . '&fileKey=' . md5($_SESSION['User']), '' . md5(time()), "Download" . $_POST['file']);
    // Add item to the cart
    $cart->AddItem($item);
    //Create and then add a tax rule
    $tax = new GoogleDefaultTaxRule(0.20);
    // Ensure area is set to the UK so correct tax is applied
    $tax->AddPostalArea("GB");
    $tax->SetCountryArea("GB");
    $cart->AddDefaultTaxRules($tax);
    // Specify and attach the return link
    $cart->SetContinueShoppingUrl("http://www.declanwright.co.uk/BlogStore/");
    // Make a purchase request to the server
    list($status, $error) = $cart->CheckoutServer2Server("", "");
    // If the above request fails print out an error report
    echo "<p>HTTP status: " . $status . "</p>";
    echo "<p>An error has occured. Process has failed. Error details:</p>";
    echo $error;
?>
