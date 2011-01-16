<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/newsletter/newsletter_idx.php
Version=100
Updated=2006-jul-09
Type=Plugin
Author=riptide
Description=A classic newsletter plugin (unbound to the LDU user system)
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=newsletter
Part=index
File=newsletter_idx
Hooks=index.tags
Order=10
Tags=index.tpl:{PLUGIN_NEWSLETTER}
[END_SED_EXTPLUGIN]

==================== */

if ( !defined('SED_CODE') ) { die("Wrong URL."); }

require("plugins/newsletter/lang/newsletter.".$usr['lang'].".lang.php");

$plu_newsletter   = $L['plu_index_intro']."";
$plu_newsletter  .= "<a href=\"plug.php?e=newsletter\">".$L['plu_index_linktext']."</a>";

	$t-> assign(array(
	"PLUGIN_NEWSLETTER" => $plu_newsletter,
	));

?>
