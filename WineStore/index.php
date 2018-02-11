<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Online Wine Store</title>
        <link rel="stylesheet" type="text/css" href="wineStoreStyle.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div id="header">
            <h1> Shalom Wines</h1>
            <div id="selectForm">
                <form action="" method="POST">
                    <input type="submit" name="colour" value="Red"/>
                    <input type="submit" name="colour" value="White"/>
                    <input type="submit" name="colour" value="Rose"/>
                </form>
            </div>
        </div>
        <div id="pageBody">
            <div id="components">
                <div id="databaseSearch">
                    <?php

                    //Initialises all the variables needed for the application
                    function initialise() {
                        $_SESSION['selections'] = array();
                        $_SESSION['runningTotal'] = array();
                        $_SESSION['numOfSelections'] = 0;
                        $wineList = array();
                        $priceList = array();
                    }
                    require '../config.php';
                    session_start(); //Start session
                    if (isset($_POST['colour'])) { //If submit is pressed on selectForm
                        $_SESSION['colour'] = $_POST['colour']; //Store colour in session
                    }
                    if (isset($_SESSION['colour'])) { //If a colour has been selected and stored in the session
                        //Make a database search by creating a database object and preparing a select statement and then entering the user's selected colour into it. Then print the results
                        $i = 0;
                        echo '<h2 class="Title">' . $_SESSION['colour'] . ' Wine List</h2>'; //Print title
                        $dbh = new PDO('mysql:host='.DB_HOST.'; dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD); //Create database handle and connection
                        $stmt = $dbh->prepare("SELECT wines.name, wines.year, wines.price, regions.name AS region FROM wines, regions WHERE color= :r AND regions.id=wines.region_id"); //Prepare MySQL statement with placeholder
                        $stmt->bindValue(":r", $_SESSION['colour']); //Bind placeholder to user's selected colour
                        $stmt->execute(); //Execute statement
                        //Print results out in a table with add buttons and quantity text field
                        echo '<table border=3>';
                        echo "<tr><td>Name</td><td>Price</td><td>Year</td><td>Region</td></tr>";
                        while ($row = $stmt->fetch()) {
                            echo '<tr>';
                            print "<td> " . $row['name'] . "</td> ";
                            $wineList[] = $row['name'];
                            $priceList[] = $row['price'];
                            echo "<td> £" . $row['price'] . "</td> ";
                            echo "<td> " . $row['year'] . "</td> ";
                            echo "<td> " . $row['region'] . "</td> ";
                            echo '<td> <form action="" method="POST"><input type="hidden" name="id" value="' . $i . '"/>
                              <input class="qty" type="text" name="qty" value="1" maxlength="2"/> <br/>
                              <input class="add" type="Submit" name="selected" value="Add"/></form></td>';
                            echo "</tr>";
                            $i++;
                        }
                        echo "</table>";
                        echo "<br/>";
                    } else { //Default action
                        initialise();
                        echo '<h2 class="Title"> Wine List </h2>';
                    }
                    echo '<p><a href="../examples.html">Back to Portfolio</a></p>';
                    ?>
                </div>
                <div id="basket">
                    <h3 class="title"> Shopping Cart </h3>
                    <?php

                    //Removes an item from the list of selections and removes the cost from the cost list
                    //@param remove The index of the item to be removed
                    function removeItem($remove) {
                        unset($_SESSION['selections'][$remove]);
                        unset($_SESSION['runningTotal'][$remove]);
                    }

                    //Updates a quantity for a already selected item in the basket
                    //@param update The id of the item to be updated
                    //@param newQuant The new quantity that needs to replaced old value
                    function updateQuantity($update, $newQuant) {
                        $oldQty = substr($_SESSION['selections'][$update], 0, 2);
                        $oldPrice = ($_SESSION['runningTotal'][$update]);
                        $newPrice = ($oldPrice / $oldQty) * $newQuant;
                        $newSelection = $newQuant . " " . substr($_SESSION['selections'][$update], 1);
                        $_SESSION['selections'][$update] = $newSelection;
                        $_SESSION['runningTotal'][$update] = $newPrice;
                    }

                    //Adds a item to the list of selections the user has added to basket
                    //@param quantity The quantity of the item to be added
                    //@param id The id of the item to be added
                    //@param wl The list of wines that are in the currently selected colour 
                    //@param pl The list of prices of the currently selected wines in the currently selected colour
                    function addToSelections($quantity, $id, $wl, $pl) {
                        $_SESSION['selections'][] = $quantity . " " . $wl[$id];
                        $_SESSION['runningTotal'][] = ($quantity * $pl[$id]);
                        $_SESSION['numOfSelections']++;
                    }

                    //Prints out the basket of the user with all of their currently selected items, the remove and update buttons and the text field for updating quantities
                    function printShoppingBasket() {
                        echo "<p><ul><li>To remove an item click the 'x' next to that item</li><li>To change a quantity enter new value in the box <br/> then click the update button</p></li.</ul>";
                        echo '<table border =3';
                        for ($i = 0; $i <= $_SESSION['numOfSelections']; $i++) {
                            if (array_key_exists($i, $_SESSION['runningTotal']) && array_key_exists($i, $_SESSION['selections'])) {
                                echo '<tr><td><form action="" method="POST"><input type="hidden" name="rid" value="' . $i . '"/>
								  <input class="remove" type="submit" name="remove" value="x"/><br/><input class="update" type="submit" name="qUpdate" value="update"/></td>
								  <td><input class="qty" type="text" name="nQty" maxlength="2" value="' . substr($_SESSION['selections'][$i], 0, 2) . '"/> ' . substr($_SESSION['selections'][$i], 2) . '</td>
							      <td> £' . $_SESSION['runningTotal'][$i] . '</td></form></tr>';
                            }
                        }
                        echo "</table><br/>";
                        echo "<p>Total: £" . array_sum($_SESSION['runningTotal']) . "<br/></p>";
                        echo '<form action="page2.php" method="POST"> <input class="checkout" type="submit" name="checkout" value="Checkout"/></form>';
                    }

                    if ((isset($_POST['selected']))) { //If add is pressed
                        addToSelections($_POST['qty'], $_POST['id'], $wineList, $priceList);
                        printShoppingBasket();
                    } else if (isset($_POST['qUpdate'])) { //If update is pressed
                        updateQuantity($_POST['rid'], $_POST['nQty']);
                        printShoppingBasket();
                    } else if (isset($_POST['remove'])) { //If remove is pressed
                        removeItem($_POST['rid']);
                        printShoppingBasket();
                    } else if (isset($_SESSION['colour'])) { //If a colour is selected
                        printShoppingBasket();
                    } else { //Default action
                        echo "<center>Empty</center>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>		