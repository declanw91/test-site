<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>
        <title>Declan's Blog</title>
        <link rel="stylesheet" type="text/css" href="blogStyle.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div id="loginForm">
            <form action="index.php" method="post">
                <input class="login" type="text" name="user" value="Username"/><br/>
                <input class="login" type="password" name="password" value="Password"/><br/>
                <input type="submit" name="login" value="Login"/>
                <input type="submit" name="register" value="Sign Up"/>
            </form>
        </div>
        <div id="pageTitle">
            <h1>Declan's Blog</h1>
        </div>
        <div id="blogPosts">
            <?php
                // Requires the cofig file and imports the settings
                require '../config.php';
                // Import the functions from the external file
                include 'functions.php';
                // Start the session
                session_start();
                // Create DB object
                $dbh = new PDO('mysql:host='."localhost".'; dbname=' . "dw273", "decw273", "ladif1991!");
                // Check to see if login button has been pressed
                if (isset($_POST['login'])) {
                    login($dbh);
                    getPosts($dbh);
                }
                // Check to see if log out button is pressed
                else if (isset($_POST['logout'])) {
                    logOut();
                    getPosts($dbh);
                }
                // Check to see if create button is pressed
                else if (isset($_POST['create'])) {
                    printCreateLogoutForm();
                    printNewPostForm($dbh);
                }
                // Check to see if send post button is pressed
                else if (isset($_POST['sendPost'])) {
                    storePost($dbh);
                    printCreateLogoutForm();
                    getPosts($dbh);
                }
                // Check to see if edit button is pressed
                else if (isset($_POST['edit'])) {
                    printCreateLogoutForm();
                    editPost($dbh);
                }
                // Check to see if the edited post button is pressed
                else if (isset($_POST['edited'])) {
                    editPost($dbh);
                    printCreateLogoutForm();
                    getPosts($dbh);
                }
                // Check to see if delete button is pressed
                else if (isset($_POST['delete'])) {
                    deletePost($dbh);
                    printCreateLogoutForm();
                    getPosts($dbh);
                // Check to see if sign up button is pressed
                } else if (isset($_POST['register'])) {
                    printSignUpForm();
                // Check to see if sign up button is pressed
                } else if (isset($_POST['signUp'])) {
                    registerUser($dbh);
                // Check to see if My Purchases button is pressed
                } else if (isset($_POST['pHistory'])) {
                    printCreateLogoutForm();
                    getUsersPurchases($dbh);
		// Check to see if a cancel button is pressed
                } else if (isset($_POST['cancel'])) {
                    printCreateLogoutForm();
                    getPosts($dbh);
		// If user is redirected reload standard page
                } else if(isset($_SESSION['User'])) {
                    printCreateLogoutForm();
                    getPosts($dbh);
		}
                // Default behaviour
                else {
                    getPosts($dbh);
                }
            ?>
        </div>
        <p><a href="../examples.html">Back to portfolio</a></p>
        <div id="footer">
            <p>Created By: Declan Wright</p>
        </div>
    </body>
</html>
