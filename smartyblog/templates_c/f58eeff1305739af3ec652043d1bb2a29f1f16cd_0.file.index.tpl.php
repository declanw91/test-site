<?php
/* Smarty version 3.1.30, created on 2017-02-27 19:30:51
  from "C:\xampp\htdocs\portfolio\smartyblog\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58b4705b34ee40_02631225',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f58eeff1305739af3ec652043d1bb2a29f1f16cd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\portfolio\\smartyblog\\index.tpl',
      1 => 1488220247,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58b4705b34ee40_02631225 (Smarty_Internal_Template $_smarty_tpl) {
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
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hosts']->value, 'hostentry');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['hostentry']->value) {
?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hostentry']->value, 'ip', false, 'name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['name']->value => $_smarty_tpl->tpl_vars['ip']->value) {
?>
                <tr><td><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</td><td><?php echo $_smarty_tpl->tpl_vars['ip']->value;?>
</td></tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </table>
        </div><!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?php echo '<script'; ?>
 src="../jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="../js/bootstrap.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="../myFunctions.js"><?php echo '</script'; ?>
>
    </body>
</html>
<?php }
}
