<?php
if (!defined("WIKINI_VERSION")) {
        die ("acc&egrave;s direct interdit");
}
// acces à l'appli google php
set_include_path('tools/googledrive/libs/vendor/'.PATH_SEPARATOR.get_include_path());
require_once 'tools/googledrive/libs/vendor/Google/Client.php';
require_once 'tools/googledrive/libs/vendor/Google/Service.php';
require_once 'tools/googledrive/libs/vendor/Google/Service/Drive.php';

//fonctions pour bazar
require_once 'tools/googledrive/libs/googledrive.inc.php';

// prend les valeurs dans wakka.config.php si renseignées, ou les valeurs ci dessous le cas échéant
$wakkaConfig['service_account_name'] = isset($wakkaConfig['service_account_name']) ?
  $wakkaConfig['service_account_name'] : "XXXXXXX@developer.gserviceaccount.com";
$wakkaConfig['key_file_location'] = isset($wakkaConfig['key_file_location']) ?
  $wakkaConfig['key_file_location'] : "tools/googledrive/key.p12";
$wakkaConfig['folder_id'] = isset($wakkaConfig['folder_id']) ?
  $wakkaConfig['folder_id'] : "XXXXXXX";
