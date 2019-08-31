<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Welding Courses</title>
        <link rel="stylesheet" type="text/css" href="../myStyle.css"/>
    </head>
    <body>
        <div id="header">
            <center><h1>Module Selection</h1></center>
        </div>
        <div id="pageBody" style="background-color: #FFFFFF; padding-left: 5px; padding-right: 5px;">
            <?php
                echo '<h3>Your selections are as follows:</h3>';
                foreach($_POST['modOpt'] as $sel){
                    echo '<p>'.$sel.'</p>';
                }
            ?>
            <p><a href="../examples.html">Back to Portfolio</a></p>
        </div>
    </body>
</html>