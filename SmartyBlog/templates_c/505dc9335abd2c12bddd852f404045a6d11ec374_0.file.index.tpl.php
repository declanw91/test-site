<?php
/* Smarty version 3.1.30, created on 2020-07-13 22:23:10
  from "C:\MySite\test-site\SmartyBlog\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f0cb49eeb9547_98323706',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '505dc9335abd2c12bddd852f404045a6d11ec374' => 
    array (
      0 => 'C:\\MySite\\test-site\\SmartyBlog\\index.tpl',
      1 => 1594663029,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f0cb49eeb9547_98323706 (Smarty_Internal_Template $_smarty_tpl) {
?>
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
            <a class="nav-link" href="../about.html">About</a>
          </li>
			</ul>
		  </div>
		</nav>
		<main role="main" class="container">

		  <div id="BlogPostsWrapper" class="container-fluid">
		  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blogs']->value, 'blog');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['blog']->value) {
?>
			<div class="blogPost row">
			  <div class="blogTitle container">
				<h2><?php echo $_smarty_tpl->tpl_vars['blog']->value['title'];?>
</h2>
			  </div>
			  <div class="blogContent">
				<?php echo $_smarty_tpl->tpl_vars['blog']->value['content'];?>

			  </div>
			  <?php echo $_smarty_tpl->tpl_vars['blog']->value['publishdate'];?>

			</div>
		  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

		  </div>

		</main>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?php echo '<script'; ?>
 src="../js/jquery-3.3.1.min.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="../js/bootstrap.bundle.min.js" type="text/javascript"><?php echo '</script'; ?>
>
    </body>
</html>
<?php }
}
