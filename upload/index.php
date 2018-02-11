<!DOCTYPE html>
<html>
    <head>
        <title>Declan Wright</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../myStyle.css"/>
        <link rel="shortcut icon" href="../images/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--[if IE]>
            <style>
                body{
                    background-image: url('../images/stripedBackground.png');
                    background-size: 100%;
                }
            </style>
            <![endif]-->
        <script type="text/javascript" src="../myFunctions.js"></script>
    </head>
    <body>
        <div id="header" class="boxShadow">
            <center><h1>Declan Wright</h1></center>
            <center><a href="../">Home</a> <a href="../examples.html">Examples</a></center>
        </div>
        <div id="pageBody"> 
            <div id="home">
                <div id="blog">
                    <p>This is the upload page. It will allow the upload of images.
                    You will receive a message below the form if the upload 
                    was successful or not.</p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <p><input type="file" name="file" id="file" /></p>
                        <input type="submit" name="submit" value="Submit" />
                    </form>
                    <?php
                        function uploadFile() {
                            $allowedExts = array("jpg", "jpeg", "gif", "png", "txt");
                            if (!isset($_FILES["file"])) {
                                return FALSE;
                            } else {
                                $extension = explode(".", $_FILES["file"]["name"]);
                            }
                            if ((!isset($_FILES["file"])) || ($_FILES["file"]["error"] > 0)) {
                                return FALSE;
                            } else if ((!isset($extension)) || (!in_array($extension[sizeof($extension) - 1], $allowedExts))) {
                                return FALSE;
                            } else {
                                if (file_exists("../images/" . $_FILES["file"]["name"])) {
                                    return FALSE;
                                } else {
                                    move_uploaded_file($_FILES["file"]["tmp_name"], "../images/" . $_FILES["file"]["name"]);
                                    return TRUE;
                                }
                            }
                        }

                        if (isset($_POST['submit'])) {
                            if (uploadFile()) {
                                echo '<p>Upload Successful</p>';
                            } else {
                                echo '<p>Upload failed</p>';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="social">
                <div id="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a></div>
                <div class="fb-like" data-href="http://www.declanwright.co.uk" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div>
            </div>
        </div>
    </body>
</html>