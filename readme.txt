Features :

This is a "classic" newsletter system for your website.

Why do i call it "classic"? Because it's completely unbound to the SED user system. This means, that everyone (registered user or not) could join the newsletter simple by entering his emailadress. Easy as 1..2..3..

If someone joins or cancel the newsletter via website, he'll receive an email to confirm (security). Every newsletter has a direct link to cancel the newsletter without confirmation at the bottom.

The newsletter is text only (no HTML). In my humble opinion, HTML-Newsletters are crab, that's why it is not supported.

Instead of sending HTML-Newsletters i suggest to create a newsletter-page and send the link to the page with this newsletter system. This way you make sure that it looks as it should and you have a newsletter archive, where people can read the old newsletters on your website.

See also the official forum thread:
http://www.neocrome.net/forums.php?m=posts&q=20067

Installation :

1 : Unpack and upload the files into the folder : /plugins/newsletter/

2 : Go into the administration panel, then tab "Extended plugins", click the name of the new plugin, and at bottom of the plugin properties, select "Install all".

3 : Then in the same page, check if this plugin require new tags in the skin files (.TPL).
If yes, then open the skin file(s) with a text editor, and add the tag(s).

4 : Some extended plugins have their own configuration entries, available by clicking the number near "Configuration" in the plugin properties, or go directly to the main configuration tab, section "Plugins".

5 : Some extended plugins require their own SQL-Tables. After making a backup of your DB, insert the new tables of the .sql file into your DB (IE with phpMyAdmin)

Instructions (from the author) :

Don't forget to insert the new table into your DB (mysql.txt).

It's shipped with an english and a german language file, if you're using another language you have to translate it yourself.

Adjust the settings in the configuration panel :

- Days after a inactive registration will be deleted (Default: 7)

After the installation the link for the plugin will be: http://www.yoursite.com/plug.php?e=newsletter

To write a new newsletter, go to your administration panel and watch the tools section. If you want to allow other user to write a newsletter, make sure they have newsletter write rights.

There is an index part to promote your newsletter on the frontpage with a simple tag in your index.tpl -> {PLUGIN_NEWSLETTER}. If you don't use it, you can deactivate the index part.

Known issues:
- there is a timeoutproblem, if you have a large number of newsletter receivers

History :

v100
- ported from LDU to Seditio
- added the possability to hide the receivers/inactives 