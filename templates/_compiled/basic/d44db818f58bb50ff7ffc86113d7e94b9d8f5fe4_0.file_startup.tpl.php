<?php
/* Smarty version 5.7.0, created on 2025-12-16 20:04:38
  from 'file:includes\pages\startup/startup.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6941bb569d7c72_84209051',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd44db818f58bb50ff7ffc86113d7e94b9d8f5fe4' => 
    array (
      0 => 'includes\\pages\\startup/startup.tpl',
      1 => 1765900691,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:generic/page-title.tpl' => 1,
  ),
))) {
function content_6941bb569d7c72_84209051 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'D:\\users\\admin\\GitHub\\wind-ng-mc\\templates\\basic\\includes\\pages\\startup';
$_smarty_tpl->renderSubTemplate("file:generic/page-title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>$_smarty_tpl->getValue('lang')['welcome']), (int) 0, $_smarty_current_dir);
if ($_smarty_tpl->getValue('startup_html') != '') {
echo $_smarty_tpl->getValue('startup_html');?>

<?php } else { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">

<p align="left">
<font size="5"><strong>WNA-WiND - Developers copy </strong></font>
<br />
<br />
<font size="2" face="Verdana, Arial, Helvetica, sans-serif">Η έκδοση αυτή είναι εδώ για δοκιμαστικούς λόγους απευθείας από το SVN</font></p>
<p align="left">Σελίδα project:   <a href="http://www.wna.gr/trac/wiki/wind-wna">http://www.wna.gr/trac/wiki/wind-wna</a> </p>
<p align="left">Δεν μπορείτε να κάνετε εγγραφή εδώ</p>
<p align="left">Δοκιμαστικός λογαριασμός χρήστη: user/demo</p>
<p align="left">Δοκιμαστικός λογαριασμός χρήστη: user2/demo</p>
<p align="left">Δοκιμαστικός λογαριασμός χρήστη: user3/demo</p>
<p align="left">Δοκιμαστικός λογαριασμός χρήστη hostmaster: hostmaster/demo   </p>
<p align="left">Δοκιμαστικός λογαριασμός διαχειριστή ασύρματης κοινότητας: coadmin/demo   </p>
<p align="left">Δοκιμαστικός λογαριασμός διαχειριστή ασύρματης κοινότητας: coadmin2/demo   </p>
<p>&nbsp;</p>
  </th>
    <th scope="col">
<?php echo '<script'; ?>
 type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://adserver.vivanet.gr/www/delivery/ajs.php':'http://adserver.vivanet.gr/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=149");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--><?php echo '</script'; ?>
><noscript><a href='http://adserver.vivanet.gr/www/delivery/ck.php?n=afb829d2&amp;cb=00000000000' target='_blank'><img src='http://adserver.vivanet.gr/www/delivery/avw.php?zoneid=149&amp;cb=0000000000&amp;n=afb829d2' border='0' alt='' /></a></noscript>
</th>
  </tr>
</table>









<?php }
}
}
