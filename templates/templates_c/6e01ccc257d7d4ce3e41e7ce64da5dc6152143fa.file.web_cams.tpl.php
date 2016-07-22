<?php /* Smarty version Smarty-3.1.11, created on 2012-09-10 13:37:38
         compiled from "templates/web_cams.tpl" */ ?>
<?php /*%%SmartyHeaderCode:905112493504db23615e263-81239872%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e01ccc257d7d4ce3e41e7ce64da5dc6152143fa' => 
    array (
      0 => 'templates/web_cams.tpl',
      1 => 1347272547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '905112493504db23615e263-81239872',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_504db236185f48_23471568',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_504db236185f48_23471568')) {function content_504db236185f48_23471568($_smarty_tpl) {?><div id="webcam_items">
	<div id="webcam_item1">
		<h2>Веб камера&nbsp;(серверная)</h2>
		<embed SCALE="ToFit" id="web1" width="640" height="376" type="video/quicktime" qtsrc="rtsp://10.10.10.128/live3.sdp" qtsrcdontusebrowser autoplay="true" controller="true">				
	</div>
	
	<div id="webcam_item2">
		<h2>Веб камера&nbsp;(серверная)</h2>
		<embed SCALE="ToFit" id="web2" width="640" height="376" type="video/quicktime" qtsrc="rtsp://10.10.10.129/live3.sdp" qtsrcdontusebrowser autoplay="true" controller="true">
	</div>
</div><?php }} ?>