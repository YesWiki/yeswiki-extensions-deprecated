<?php
if (!defined("WIKINI_VERSION")) {
    die("acc&egrave;s direct interdit");
}

include_once "tools/markdown/libs/vendor/Parsedown.php";
$Parsedown = new Parsedown();
$Parsedown->setBreaksEnabled(true);

// bidouilles pour que la syntaxe wakka cohabite avec celle du markdown
// TODO: plusieurs retours a la ligne ne produisent qu'un seul <br>
// TODO: __sousligne__ de wakka en interference avec la syntaxe markdown
$text = str_replace(
    array('&quot;', '<p>""{{', '}}""</p>', '}}"" </p>'),
    array('"', '""{{', '}}""', '}}""'),
    '""'.$Parsedown->text(str_replace(
        array('{{', "}}\n", '}} -', '}}', '[[', ']]'),
        array('""{{', '}}', "}}\n -", '}}""', '""[[', ']]""'),
        str_replace('""', '', $text)
    )).'""'
);
