<?php
// index.php
// Administration de l'extension : initialisations (tables, fichier de configuration) , information etc. : toutes
// op�rations r�serv�es � l'administrateur technique de YesWiki.

// V�rification de s�curit�
if (!defined("WIKINI_VERSION")) {
    die ("acc&egrave;s direct interdit");
}

$wakkaConfig['wkhtmltopdf_path'] = (isset($wakkaConfig['wkhtmltopdf_path'])) ? $wakkaConfig['wkhtmltopdf_path'] : getcwd().'/tools/wkhtmltopdf/libs/wkhtmltopdf-i386';

?>
