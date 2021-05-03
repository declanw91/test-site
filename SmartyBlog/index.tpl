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
		<link href="../css/myStyles.css" rel="stylesheet">
    </head>

    <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
		  <a class="navbar-brand" href="../">Declan Wright</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../examples.html">Examples</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../blog.html">Blog</a>
          </li>
        </ul>
      </div>
		</nav>
		<main role="main" class="container">

		  <div id="BlogPostsWrapper" class="container-fluid">
		  {foreach $blogs as $blog}
			<div class="blogPost row">
			  <div class="blogTitle container">
				<h2>{$blog.title}</h2>
			  </div>
			  <div class="blogContent">
				{$blog.content}
			  </div>
			  {$blog.publishdate}
			</div>
		  {/foreach}
		  </div>

		</main>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../js/jquery-3.3.1.min.js" type="text/javascript"></script>
		<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
    </body>
</html>
