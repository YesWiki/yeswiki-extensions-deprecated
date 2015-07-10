<?php
/*vim: set expandtab tabstop=4 shiftwidth=4: */
// +------------------------------------------------------------------------------------------------------+
// | PHP version 5.1                                                                                      |
// +------------------------------------------------------------------------------------------------------+
// | Copyright (C) 1999-2006 outils-reseaux.org                                                           |
// +------------------------------------------------------------------------------------------------------+
// | This file is part of wkfarm.                                                                         |
// |                                                                                                      |
// | Foobar is free software; you can redistribute it and/or modify                                       |
// | it under the terms of the GNU General Public License as published by                                 |
// | the Free Software Foundation; either version 2 of the License, or                                    |
// | (at your option) any later version.                                                                  |
// |                                                                                                      |
// | Foobar is distributed in the hope that it will be useful,                                            |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of                                       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                                        |
// | GNU General Public License for more details.                                                         |
// |                                                                                                      |
// | You should have received a copy of the GNU General Public License                                    |
// | along with Foobar; if not, write to the Free Software                                                |
// | Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA                            |
// +------------------------------------------------------------------------------------------------------+

/**
* wiki.php
*
* Description : fichier de configuration de la ferme
*
*@package 			wkfarm
*@author        Florian Schmitt <mrflos@gmail.com>
*@copyright     yeswiki.net 2015
*
*/

if (!defined("WIKINI_VERSION")) {
        die ("acc&egrave;s direct interdit");
}

include_once 'tools/ferme/libs/ferme.functions.php';

// test de l'existence des variables de configuration de la ferme, mise en place de valeurs par défaut sinon
if (!isset($wakkaConfig['yeswiki-farm-root-url'])) {
    $wakkaConfig['yeswiki-farm-root-url'] = str_replace(
        'wakka.php?wiki=',
        '',
        $wakkaConfig['base_url']
    );
    $wakkaConfig['yeswiki-farm-root-folder'] = '.';
} elseif (!isset($wakkaConfig['yeswiki-farm-root-folder'])) {
    die('Il faut indiquer le chemin relatif des wikis avec la valeur "yeswiki-farm-root-folder"
     dans le fichier de configuration.');
}
// themes supplémentaires
if (!isset($wakkaConfig['yeswiki-farm-extra-themes'])
    || !is_array($wakkaConfig['yeswiki-farm-extra-themes'])) {
    $wakkaConfig['yeswiki-farm-extra-themes'] = array();
}

// extensions supplémentaires
if (!isset($wakkaConfig['yeswiki-farm-extra-tools'])
    || !is_array($wakkaConfig['yeswiki-farm-extra-tools'])) {
    $wakkaConfig['yeswiki-farm-extra-tools'] = array();
}

// theme par defaut
if (!isset($wakkaConfig['yeswiki-farm-fav-theme'])) {
    $wakkaConfig['yeswiki-farm-fav-theme'] = 'bootstrap';
}
if (!isset($wakkaConfig['yeswiki-farm-fav-squelette'])) {
    $wakkaConfig['yeswiki-farm-fav-squelette'] = '1col.tpl.html';
}
if (!isset($wakkaConfig['yeswiki-farm-fav-style'])) {
    $wakkaConfig['yeswiki-farm-fav-style'] = 'bootstrap.css';
}
if (!isset($wakkaConfig['yeswiki-farm-bg-img'])) {
    $wakkaConfig['yeswiki-farm-bg-img'] = '';
}

// acls
if (!isset($wakkaConfig['yeswiki-farm-write-acls'])) {
    $wakkaConfig['yeswiki-farm-write-acls'] = '*';
}
if (!isset($wakkaConfig['yeswiki-farm-read-acls'])) {
    $wakkaConfig['yeswiki-farm-read-acls'] = '*';
}
if (!isset($wakkaConfig['yeswiki-farm-comments-acls'])) {
    $wakkaConfig['yeswiki-farm-comments-acls'] = '+';
}

// sql d'installation par défaut
if (isset($wakkaConfig['yeswiki-farm-sql']) && !file_exists('tools/ferme/sql/'.$wakkaConfig['yeswiki-farm-sql']))) {
    die('Dans wakka.config.php, il faut indiquer la valeur "yeswiki-farm-sql" pour le fichier sql '
         .'d\'installation du wiki et le mettre dans le dossier tools/ferme/sql .');
}
if (!isset($wakkaConfig['yeswiki-farm-sql']) {
    $wakkaConfig['yeswiki-farm-sql'] = 'default';
}

// création d'un utilisateur dans le wiki initial (sert pour des cas spécifiques avec une bd centralisée)
if (!isset($wakkaConfig['yeswiki-farm-create-user'])) {
    $wakkaConfig['yeswiki-farm-create-user'] = false;
}

// page d'accueil des wikis de la ferme
if (!isset($wakkaConfig['yeswiki-farm-homepage'])) {
    $wakkaConfig['yeswiki-farm-homepage'] = $wakkaConfig['root_page'];
}
