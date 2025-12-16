<?php
/* Smarty version 5.7.0, created on 2025-12-16 19:57:56
  from 'file:includes\pages\gmap/gmap_fullmap.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941b9c47913b0_37669255',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2328fff5c0954733f6592f5b589e78506ac73f03' => 
    array (
      0 => 'includes\\pages\\gmap/gmap_fullmap.tpl',
      1 => 1765915060,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6941b9c47913b0_37669255 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\gmap';
?><style>
#map { min-height: calc(100vh - 150px); }
</style>
<table class="table-main" cellpadding="0" cellspacing="0"><tr><td style="font-size:12px; text-align:center; width: 100%;">
<?php if ($_smarty_tpl->getValue('gmap_key_ok')) {?>
<div id="map" style="width: 100%; height: calc(100vh - 150px);"></div>
<?php } else {
echo nl2br((string) smarty_mb_wordwrap($_smarty_tpl->getValue('lang')['message']['error']['gmap_key_failed']['body'],40,"\n",false), (bool) 1);?>

<?php }?>
</td></tr><tr><td style="font-size:12px;" align="center">
<input type="checkbox" name="p2p" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_orange.png",'alt'=>$_smarty_tpl->getValue('lang')['backbone']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['backbone'];?>

<input type="checkbox" name="aps" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_green.png",'alt'=>$_smarty_tpl->getValue('lang')['aps']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['aps'];?>

<input type="checkbox" name="hs" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_green.png",'alt'=>$_smarty_tpl->getValue('lang')['hs']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['hs'];?>

<input type="checkbox" name="clients" checked="checked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_blue.png",'alt'=>$_smarty_tpl->getValue('lang')['clients']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['clients'];?>

<input type="checkbox" name="unlinked" onclick="gmap_refresh();" /><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('html_image')->handle(array('file'=>((string)$_smarty_tpl->getValue('img_dir'))."/gmap/mm_20_red.png",'alt'=>$_smarty_tpl->getValue('lang')['unlinked']), $_smarty_tpl);
echo $_smarty_tpl->getValue('lang')['unlinked'];?>

</td></tr>
</table><?php }
}
