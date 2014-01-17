<?php
// index.php
// Administration de l'extension : initialisations (tables, fichier de configuration) , information etc. : toutes
// opérations réservées à l'administrateur technique de YesWiki.

// Vérification de sécurité
if (!defined("WIKINI_VERSION")) {
    die ("acc&egrave;s direct interdit");
}

$wakkaConfig['wkhtmltopdf_path'] = (isset($wakkaConfig['wkhtmltopdf_path'])) ? $wakkaConfig['wkhtmltopdf_path'] : getcwd().'/tools/wkhtmltopdf/libs/wkhtmltopdf-i386';

?>
