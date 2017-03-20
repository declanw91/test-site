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
                    <a class="navbar-brand" href="index.php">Declan Wright</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../index.php">Home</a></li>
                        <li><a href="../examples.html">Work</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container">

            <div class="content-wrapper">
              <?php
              require '../config.php';
              $movieQuery = MLINK . "?api_key=" . MOVIE_KEY . "&query=";
              if (isset($_POST['submit'])) {
                  $query = $_POST['query'];
                  $query = urlencode($query);
                  $movieQuery.=$query;
                  $opts = array(
                      'http' => array(
                          'method' => "GET",
                          'header' => "Accept-language: application/json"
                      )
                  );
                  $context = stream_context_create($opts);
                  $resp = file_get_contents($movieQuery, false, $context);
                  if ($resp != false) {
                      $decodedresp = json_decode($resp);
                      //var_dump($decodedresp);
                      for($i = 0; $i < count($decodedresp->{'results'}); $i++) {
                        echo '<div class="movieItem">';
                        echo '<div class="moviePoster"><img src="https://image.tmdb.org/t/p/w150'.$decodedresp->{'results'}[$i]->poster_path.'" alt="'.$decodedresp->{'results'}[$i]->title.'"/></div>';
                        echo '<div class="movieInfo">';
                        echo "<h3>".$decodedresp->{'results'}[$i]->title."</h3>";
                        echo "<h4>Summary:</h4>";
                        echo '<p class="movieSummary">'.$decodedresp->{'results'}[$i]->overview.'</p>';
                        echo '<p class="releaseDate">Release date: '.$decodedresp->{'results'}[$i]->release_date.'</p>';
                        echo '</div>';
                        echo "</div>";
                      }
                  } else {
                      echo '<h3> Search failed please press new search to try
                              again </h3>';
                  }
                  echo '<br/><div id="back"> <form action="" method="POST">
                              <input type="submit" name="back" value="New Search"/>
                              </form></div>';
              } else if ((!isset($_POST['submit'])) || (isset($_POST['back']))) {
                  unset($_POST['submit']);
                  echo '<div id="movieForm"><form action="" method="POST">
                          Movie Title: <input type="text" name="query"/> <br/>
                          <input type="submit" name="submit" value="submit"/>
                          </form></div>';
              }
              echo '<div><center><a href="../examples.html">Back to Portfolio</a></center></div>';
              ?>
            </div>

        </div><!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="jquery-1.9.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="myFunctions.js"></script>
    </body>
</html>
