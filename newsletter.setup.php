<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/newsletter/newsletter.setup.php
Version=100
Updated=2006-jul-09
Type=Plugin
Author=riptide
Description=A classic newsletter plugin (unbound to the LDU user system)
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=newsletter
Name=Newsletter
Description=A classic newsletter plugin (unbound to the LDU user system)
Version=100
Date=2006/07/09
Author=riptide
Copyright=
Notes=
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
cleandelay=01:string::7:Days after a inactive registration will be deleted (cleaning)
[END_SED_EXTPLUGIN_CONFIG]

==================== */

if ( !defined('SED_CODE') ) { die("Wrong URL."); }

?>
