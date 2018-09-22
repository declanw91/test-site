<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Online Wine Store</title>
        <link rel="stylesheet" type="text/css" href="wineStoreStyle.css" />
    </head>
    <body>
        <div id="header">
            <h1> Shalom Wines</h1>
        </div>
        <div id="summary">
            <?php

            //Prints the final order to the screen so the user can see their final selections, this does not print options to edit the order
            function printOrder() {
                echo "<h2>Order Summary</h2><br/>";
                echo '<table class="summary" border =3>';
                for ($i = 0; $i <= $_SESSION['numOfSelections']; $i++) {
                    if (array_key_exists($i, $_SESSION['runningTotal']) && array_key_exists($i, $_SESSION['selections'])) {
                        echo '<tr><td>' . $_SESSION['selections'][$i] . '</td><td> £' . $_SESSION['runningTotal'][$i] . '</td></tr>';
                    }
                }
                echo "<tr><td>Total:</td><td>£" . array_sum($_SESSION['runningTotal']) . "</td></tr>";
                echo "</table>";
            }

            session_start(); //Join current session
            if (array_sum($_SESSION['runningTotal']) == 0) {//If no items have been selected
                //Notify the user that no items have been selected and give them a back button
                echo "No items have been added to the order please go back and add some items<br/>";
                echo '<form action="index.php" method="POST" /><input type="submit"name="back"value="Back"/></form>';
            } else if (!(isset($_POST['pSubmit']))) {//If items have been selected but a postage option hasn't
                printOrder();
                //Print out the form needed to select a postage option
                echo "<p><br/>Please select the postage you want for your order or press back to edit your order<br/></p>";
                echo '<form action="" method="POST"> <select name="postage"><option>First Class (£5)</option>
                            <option>Second Class (£3)</option><option>Special Delivery (£6)</option></select>
                            <input type="submit" name="pSubmit" value="submit"/> </form> <br/>';
                echo '<form action="index.php" method="POST" /><input type="submit"name="back"value="Back"</form>';
            } else if (isset($_POST['pSubmit'])) {//If a postage option has been selected
                printOrder();
                //Print out all of the calculations so user can see final total and how its calculated
                echo "<p>";
                echo "<br/>Total before VAT: £" . array_sum($_SESSION['runningTotal']) . "<br/>";
                echo "VAT: 20%<br/>";
                $totalAfterVAT = (array_sum($_SESSION['runningTotal']) * 1.2);
                echo "Total after VAT: £" . number_format((round($totalAfterVAT, 2)), 2) . "<br/>";
                echo "Postage Selected: " . $_POST['postage'] . "<br/>";
                echo "Final Total: £" . number_format(round(($totalAfterVAT + substr($_POST['postage'], -2, 1)), 2), 2);
                echo "</p>";
            }
            ?>
            <p><a href="../examples.html">Back to Portfolio</a></p>
        </div>
    </body>
</html>