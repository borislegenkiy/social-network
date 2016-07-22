<?php /* Smarty version Smarty-3.1.11, created on 2012-09-03 16:45:46
         compiled from "templates/info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172187173150097cd0c406f5-58849618%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8525489f4b7a73a318d0a47b208623e89a2d9b8' => 
    array (
      0 => 'templates/info.tpl',
      1 => 1346679945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172187173150097cd0c406f5-58849618',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50097cd0c66c12_80919262',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50097cd0c66c12_80919262')) {function content_50097cd0c66c12_80919262($_smarty_tpl) {?><div id="info_container">
		<h2>Введите Ваше публичное сообщение:</h2>
		<textarea id="info_editor" class="ui-widget-content ui-corner-all"></textarea>
		<button id="info_button" class="ui-widget-content ui-corner-all">Поместить новость</button>
</div>
<?php }} ?>