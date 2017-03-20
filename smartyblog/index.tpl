<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <link rel="shortcut icon" href="images/favicon.ico" />

        <title>Declan Wright</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <!-- custom CSS -->
        <link href="../css/myStyles.css" rel="stylesheet">
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../index.php">Declan Wright</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../examples.html">Work</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container">
            <table>
              <tr><th>Name</th><th>IP Address</th></tr>
              {foreach $hosts as $hostentry}
                {foreach from=$hostentry key=name item=ip}
                <tr><td>{$name}</td><td>{$ip}</td></tr>
                {/foreach}
              {/foreach}
            </table>
        </div><!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../jquery-1.9.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../myFunctions.js"></script>
    </body>
</html>
