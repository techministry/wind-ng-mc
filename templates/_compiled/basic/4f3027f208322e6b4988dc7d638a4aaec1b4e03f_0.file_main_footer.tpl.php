<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:21:03
  from 'file:includes/main_footer.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941bf2f0e8c30_29878850',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4f3027f208322e6b4988dc7d638a4aaec1b4e03f' => 
    array (
      0 => 'includes/main_footer.tpl',
      1 => 1765893819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6941bf2f0e8c30_29878850 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes';
?><table cellpadding="5" cellspacing="0" class="table-main">
      <tr>
        <td class="footer" align="left" width="33%">
        	<a href="http://www.php.net/"><img src="<?php echo $_smarty_tpl->getValue('img_dir');?>
logo-php.gif" alt="PHP Hypertext Preprocessor" /></a>
        	<a href="http://www.mysql.com/"><img src="<?php echo $_smarty_tpl->getValue('img_dir');?>
logo-mysql.gif" alt="MySQL database server" /></a>
        	<a href="http://smarty.php.net/"><img src="<?php echo $_smarty_tpl->getValue('img_dir');?>
logo-smarty.gif" alt="smarty template engine" /></a>
        </td>
        <td class="footer" align="center" width="33%">
        	PHP time: <?php echo round((float) $_smarty_tpl->getValue('php_time'), (int) 3, (int) 1);?>
 s<br />MySQL time: <?php echo round((float) $_smarty_tpl->getValue('mysql_time'), (int) 3, (int) 1);?>
 s<?php if ($_smarty_tpl->getValue('debug_mysql')) {?><br />Debug: <a href="<?php echo $_smarty_tpl->getValue('debug_mysql');?>
" target="debug">MySQL</a><?php }?>
        </td>
        <td class="footer" align="right" width="33%">
        	<b>WiND - Wireless Nodes Database</b><br />
        	Project page: <a href="http://www.wna.gr/trac/wiki/wind-wna">WNA-WiND/</a><br /><br />
        	&copy; 2005-2012 <a href="http://www.wna.gr/trac/wiki/wind-wna/Team">WiND development team</a>
		   <br /><br /><br />
        </td>
      </tr>
</table><?php }
}
