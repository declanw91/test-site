<?php
/* Smarty version 3.1.30, created on 2017-02-27 19:32:50
  from "C:\xampp\htdocs\portfolio\smartyblog\test.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58b470d2526be3_50911170',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0105bdc40fd32ba51e358190342b6696c34709b7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\portfolio\\smartyblog\\test.tpl',
      1 => 1488220358,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58b470d2526be3_50911170 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head></head>
<body>
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
</body>
</html>
<?php }
}
