<?php

    /*
    * Fetches and then prints the blog posts in the database
    * @param dbo The database object
    */
    function getPosts($dbo) {
        $stmt = $dbo->prepare("SELECT * FROM blog ORDER BY Time DESC");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            if (($row['Type'] == "normal") || (($row['Type'] == "purchase") && (isset($_SESSION['User'])))) {
                echo '<div class="blogTitle">';
                echo '<h2>' . $row['Title'] . '</h2>';
                echo '</div>';
                echo '<div class="blogPost">';
                echo '<p>' . $row['Post'] . '</p>';
                echo '<p class="author"> Posted by: ' . $row['Author'] . ' at: ' . $row['Time'] . '</p>';
                if ((isset($_SESSION['User'])) && ($_SESSION['UserType'] == "admin")) {
                    printUserButtons($row['id']);
                }
            }
            echo '</div>';
        }
    }

    /*
    * Checks and logs in a user
    * @param dbo The database object
    */
    function login($dbo) {
        $stmt = $dbo->prepare("SELECT * FROM users WHERE Username= :u AND Password= :p");
        $stmt->bindValue(":u", (strip_tags($_POST['user'])));
        $pass = md5(strip_tags($_POST['password']));
        $stmt->bindValue(":p", $pass);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            $_SESSION['User'] = $user['Username'];
            $_SESSION['UserType'] = $user['Type'];
            printCreateLogoutForm();
        } else {
            echo '<div id="Warning"><h3>Login failed. Please try again.</h3></div>';
        }
    }

    /*
    * Logs a user out of the page and destroys the session
    */
    function logOut() {
        unset($_SESSION['User']);
        echo '<script type="text/javascript">document.getElementById("loginForm").setAttribute("class", "")</script>';
        session_destroy();
    }

    /*
    * Prints out the create post and logout buttons
    */
    function printCreateLogoutForm() {
        echo '<div id="createLogout"><form action="index.php" method="post">';
        if ($_SESSION['UserType'] == "admin") {
            echo '<input type="submit" name="create" value="New Post"/>';
        }
        echo '<input type="submit" name="pHistory" value="My Purchases"/>';
        echo '<input type="submit" name="logout" value="Log Out"/>';
        echo '</form></div>';
        echo '<script type="text/javascript">document.getElementById("loginForm").setAttribute("class", "hidden")</script>';
    }

    /*
    * Prints a users options of edit and delete
    * @param id The id of the post
    */
    function printUserButtons($id) {
        echo '<div class="userButton">
                <form action="index.php" method="post">
                    <input type="submit" name="edit" value="Edit"/>
                    <input type="submit" name="delete" value="Delete"/>
                    <input type="hidden" name="id" value=' . $id . '/>
                </form>
              </div>';
    }

    /*
    * Prints the form needed for creating posts
    * @param dbo The database object to be used
    */
    function printNewPostForm($dbo) {
        echo '<form action="index.php" method="post">
                <p>Post Title:</p>
                <textarea class="bTitle" name="pTitle"></textarea><br/>
                <p>Post Body:</p>
                <textarea class="bPost" name=pBody></textarea><br/>
                <p>Attachments:</p>' . getFiles($dbo) . '<br/>
                <input type="submit" name="sendPost" value="Post"/>
                <input type="submit" name="cancel" value="Back"/>
              </form>';
    }

    /*
    * Gets the list of files from the database and put them together into a
    * select form string to be printed
    * @param dbo The database object to be used
    */
    function getFiles($dbo) {
        $list = '<select name="fileList"> <option selected="selected" value="none">None</option>';
        $stmt = $dbo->prepare("SELECT Name, Source FROM downloads");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $list = $list . '<option value= "' . $row['Source'] . '">' . $row['Name'] . '</option>';
        }
        $list = $list . '</select>';
        return $list;
    }

    /*
    * Checks and submits a post to the database
    * @param dbo The database object
    */
    function storePost($dbo) {
        if ((strlen($_POST['pTitle']) == 0) || (strlen($_POST['pBody']) == 0)) {
            echo '<div id="Warning"><h3>Please check your post. No fields can be empty</h3></div>';
        } else if ((strlen($_POST['pTitle'])) != (strlen(strip_tags($_POST['pTitle'])))) {
            echo '<div id="Warning"><h3>HTML/Javascript/PHP is not allowed in a post title.</h3></div>';
        } else if ((strlen($_POST['pBody'])) != (strlen(strip_tags($_POST['pBody'])))) {
            echo '<div id="Warning"><h3>HTML/Javascript/PHP is not allowed in a posts.</h3></div>';
        } else {
            $post = str_replace("\n", "<br/>", $_POST['pBody']);
            $type = "normal";
            $stmt = $dbo->prepare("INSERT INTO blog VALUES('', :u, :t, :p, now(), :n)");
            $stmt->bindValue(":t", $_POST['pTitle']);
            if ($_POST['fileList'] != "none") {
                $post = $post . "<h3>Attachments: </h3>";
                $post = $post . getSoftwareInfo($dbo, strip_tags($_POST['fileList']));
                $file = makeBuyButton(strip_tags($_POST['fileList']));
                $post = $post . $file;
                $type = "purchase";
            }
            $stmt->bindValue(":p", $post);
            $stmt->bindValue(":u", $_SESSION['User']);
            $stmt->bindValue(":n", $type);
            if ($stmt->execute()) {
                echo '<p>Post was successful</p>';
            } else {
                echo '<div id="Warning"><h3>Post attempt failed. Please try again.
                       </h3></div>';
            }
        }
    }

    /*
    * Makes and returns a string containing the information about the requested
    * file
    * @param dbo The database object to be used
    * @param file The file whose information is needed
    */
    function getSoftwareInfo($dbo, $file) {
        $info = '';
        $stmt = $dbo->prepare("SELECT * FROM downloads WHERE Source= :f");
        $stmt->bindValue(":f", $file);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $info = $info . '<p>Name: ' . $row['Name'] . '</p>';
            $info = $info . '<p>Description: ' . $row['Description'] . '</p>';
            $info = $info . '<p>Price: £' . $row['Price'] . '</p>';
        }
        return $info;
    }

    /*
    * Makes and return a string containing a form with a link to the purchase
    * system for the selected file
    * @param file The file to be bought if this button is pressed
    */
    function makeBuyButton($file) {
        return '<form action="" method="POST">
                    <input type="hidden" name="file" value="' . $file . '"/>
                    <input type="submit" name="download" value="Download"/>
                </form>';
    }

    /*
    * Either gets a post and returns it to be edited or submits the newly edited post
    * Newly edited post is checked before submission
    * @param dbo The database object to be used
    */
    function editPost($dbo) {
        if (isset($_POST['edit'])) {
            $stmt = $dbo->prepare("SELECT * FROM blog WHERE id= :i");
            $stmt->bindValue(":i", $_POST['id']);
            $stmt->execute();
            echo '<form action="index.php" method="post">';
            while ($row = $stmt->fetch()) {
                $post = str_replace("<br/>", "\n", $row['Post']);
                echo '<textarea class="bTitle" name="title">' . $row['Title'] . '</textarea><br/>';
                echo '<textarea class="bPost" name="post">' . $post . '</textarea><br/>';
                echo '<input type="hidden" name="id" value=' . $_POST['id'] . '/><br/>';
                echo '<input type="submit" name="edited" value="Post"/>';
                echo '<input type="submit" name="cancel" value="Back"/>';
            }
            echo '</form>';
            unset($_POST['edit']);
        } else if ($_POST['edited']) {
            $post = str_replace("\n", "<br/>", $_POST['post']);
            $stmt = $dbo->prepare("UPDATE blog SET Title= :t, Post= :p WHERE id= :i");
            $stmt->bindValue(":t", $_POST['title']);
            $stmt->bindValue(":p", $post);
            $stmt->bindValue(":i", $_POST['id']);
            if ((strlen($_POST['title'])) != (strlen(strip_tags($_POST['title'])))) {
                echo '<div id="Warning"><h3>HTML/Javascript/PHP is not allowed in a post title.</h3></div>';
            } else if ((strlen($_POST['post'])) != (strlen(strip_tags($_POST['post'])))) {
                echo '<div id="Warning"><h3>HTML/Javascript/PHP is not allowed in a posts.</h3></div>';
            } else if ($stmt->execute()) {
                echo '<p>Post was successfully edited.</p>';
            } else {
                echo '<div id="Warning"><h3>Post edit attempt failed please try again.</h3></div>';
            }
        }
    }

    /*
    * Removes a post form the database based on its id
    * @param dbo The database object to be used
    */
    function deletePost($dbo) {
        $stmt = $dbo->prepare("DELETE FROM blog WHERE id= :i");
        $stmt->bindValue(":i", $_POST['id']);
        if ($stmt->execute()) {
            echo '<p>Post was sucessfully deleted</p>';
        } else {
            echo '<div id="Warning"><h3>Post delete attempt failed please try again.</h3></div>';
        }
    }

    /*
    * Prints out the registration form for users to sign up
    */
    function printSignUpForm() {
        echo '<h3>Welcome to the Registration Page</h3>';
        echo '<form action="index.php" method="post">
                <p>Desired Username:</p> <input type="text" name="newUser"/>
                <p>Email:</p> <input type="text" name="newEmail"/>
                <p>Desired Password:</p> <input type="password" name="newPassword"/>
                <p>Confirm Password:</p> <input type="password" name="conPassword"/><br/>
                <input type="submit" name="signUp" value="Register"/>
                <input type="submit" name="cancel" value="Back"/>
              </form>';
    }

    /*
    * Checks the new users credentials and then registers them and adds their user
    * and pass to the database of users
    * @param dbo The database object to be used
    */
    function registerUser($dbo) {
        $user = $_POST['newUser'];
        $pass = $_POST['newPassword'];
        $conPass = $_POST['conPassword'];
        $email = $_POST['newEmail'];
        if ((strlen($user) == 0) || (strlen($pass) == 0) || (strlen($email) == 0) || (strlen($conPass) == 0)) {
            echo '<div id="Warning"><h3>Empty field detected. Please ensure all fields are filled in.</h3></div>';
            printSignUpForm();
            return;
        }
        if ($pass != $conPass) {
            echo '<div id="Warning"><h3>The two password fields do not match please retry.</h3></div>';
            printSignUpForm();
            return;
        }
        $pass = md5($pass);
        $stmt = $dbo->prepare("INSERT into users VALUES('', :u, :p, :e, now(), 'user')");
        $stmt->bindValue(":u", $user);
        $stmt->bindValue(":p", $pass);
        $stmt->bindValue(":e", $email);
        if ($stmt->execute()) {
            echo '<p>Registration was successful. Please log in.</p>';
        } else {
            echo '<div id="Warning"><h3>Registration attempt failed. Please try again.</h3></div>';
        }
    }

    /*
    * Gets the list of purchases for the current user
    * @param dbo The database object to be used
    */
    function getUsersPurchases($dbo) {
        echo "<h2> My Purchase History </h2>";
        echo "<p> Below is a list of purchases you have made from this site. This page allows you to view and redownload your purchases.</p>";
        $stmt = $dbo->prepare("SELECT UserId, log.Date as 'Purchased On', downloads.Source as Source, downloads.Name as Name, downloads.Description as Description, downloads.Price as Price FROM log, downloads WHERE downloads.id = log.PurchaseId AND log.UserId = :u");
        $stmt->bindValue(":u", $_SESSION['User']);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            echo '<div id="Purchase"> <p> Name: ' . $row['Name'] . '</p>';
            echo '<p>Description: ' . $row['Description'] . '</p>';
            echo '<p>Purchased On: ' . $row['Purchased On'] . '</p>';
            if (isset($_SESSION['User'])) {
                echo '<a href=download.php?file=' . $row['Source'] . '>Redownload</a>';
            }
            echo '</div>';
        }
        echo '<form action="index.php" method="POST"> <input type="submit" name="cancel" value="Back"/></form>';
    }

    /*
    * Downloads the file passed as a parameter
    * @param file The file to be downloaded
    */
    function downloadFile($file) {
        chdir('resources');
        header('Content-Type: application/download');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header("Content-Length: " . filesize($file));
        $fp = fopen($file, "r");
        fpassthru($fp);
        fclose($fp);
    }

?>
