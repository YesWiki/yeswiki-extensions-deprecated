<?php

function copyRecursive($path, $dest)
{
    if (is_dir($path)) {
        @mkdir($dest);
        $objects = scandir($path);
        if (sizeof($objects) > 0) {
            foreach ($objects as $file) {
                if ($file == "." || $file == ".." || $file == ".git") {
                    continue;
                }
                // go on
                if (is_dir($path.DIRECTORY_SEPARATOR.$file)) {
                    copyRecursive($path.DIRECTORY_SEPARATOR.$file, $dest.DIRECTORY_SEPARATOR.$file);
                } else {
                    copy($path.DIRECTORY_SEPARATOR.$file, $dest.DIRECTORY_SEPARATOR.$file);
                }
            }
        }
        return true;
    } elseif (is_file($path)) {
        return copy($path, $dest);
    } else {
        return false;
    }
}

/** yeswiki() - Ajoute un champ permettant de créer des yeswikis supplémentaires (ferme à wiki)
 *
 * @param    mixed   L'objet QuickForm du formulaire
 * @param    mixed   Le tableau des valeurs des différentes option pour l'élément liste
 * @param    string  Type d'action pour le formulaire : saisie, modification, vue,... saisie par défaut
 * @param    mixed  Valeurs de la fiche sélectionné (pour la modif et vue)
 * @return   void
 */
function yeswiki(&$formtemplate, $tableau_template, $mode, $valeurs_fiche)
{
    if ($mode == 'saisie') {
        $bulledaide = '';
        if (isset($tableau_template[10]) && $tableau_template[10] != '') {
            $bulledaide = ' &nbsp;&nbsp;<img class="tooltip_aide" title="' .
            htmlentities($tableau_template[10], ENT_QUOTES, TEMPLATES_DEFAULT_CHARSET) .
            '" src="tools/bazar/presentation/images/aide.png" width="16" height="16" alt="image aide" />';
        } else {
            $bulledaide = ' &nbsp;&nbsp;<img class="tooltip_aide" title="'
                ._t('uniquement des caractères alphanumériques et tirets (-)')
                .'" src="tools/bazar/presentation/images/aide.png" width="16" height="16" alt="image aide" />';
        }
        
        $html = '<div class="control-group form-group">' . "\n" . '<div class="control-label col-xs-3">' . "\n";
        if (isset($tableau_template[8]) && $tableau_template[8] == 1) {
            $html.= '<span class="symbole_obligatoire">*&nbsp;</span>' . "\n";
        }
        
        if (isset($valeurs_fiche[$tableau_template[1]]) && $valeurs_fiche[$tableau_template[1]] != '') {
            $def = $valeurs_fiche[$tableau_template[1]];
            $disable = ' disabled';
            $html .= '<input type="hidden" name="'.$tableau_template[1].'_exists" value="1">';
        } else {
            $def = '';
            $disable = '';
            $extrafields = '<br>
            <input type="text" class="form-control" id="'. $tableau_template[1].'_wikiname' . '" name="'
            . $tableau_template[1].'_wikiname'.'" required placeholder="NomWiki de l\'admin"><br>
            <input type="password" class="form-control" id="'. $tableau_template[1].'_password' . '" name="'
            . $tableau_template[1].'_password'.'" required placeholder="Mot de passe de l\'admin"><br>
            <input type="email" class="form-control" id="'. $tableau_template[1].'_email' . '" name="'
            . $tableau_template[1].'_email'.'" required placeholder="Email de l\'admin">';
        }
        
        $html .= $tableau_template[2] . $bulledaide . ' : </div>'."\n"
            .'<div class="controls col-xs-8">'."\n"
            .'<div class="input-prepend input-group">'."\n"
            .'<span class="add-on input-group-addon">'.$GLOBALS['wiki']->config['yeswiki-farm-root-url'].'</span>'."\n"
            .'<input type="text" class="form-control" id="'. $tableau_template[1] . '" name="' . $tableau_template[1]
            .'" required'.$disable.' value="'.$def.'" pattern="^[0-9a-zA-Z-]*$" placeholder="dossier">'."\n"
            .$extrafields.'</div>'."\n".'</div>'."\n".'</div>'."\n";
        $formtemplate->addElement('html', $html);
    } elseif ($mode == 'requete') {
        //si le doc n'existe pas, on le crée
        if (!empty($valeurs_fiche[$tableau_template[1]])
            && preg_match('/^[0-9a-zA-Z-]*$/', $valeurs_fiche[$tableau_template[1]])) {
            if (isset($valeurs_fiche[$tableau_template[1].'_exists'])
                && $valeurs_fiche[$tableau_template[1].'_exists'] == 1) {
                // si le wiki a déja été créé on zappe
            } else {
                $url = $GLOBALS['wiki']->config['yeswiki-farm-root-url'].$valeurs_fiche[$tableau_template[1]];
                $srcfolder = getcwd().DIRECTORY_SEPARATOR;
                $destfolder = getcwd().DIRECTORY_SEPARATOR.$GLOBALS['wiki']->config['yeswiki-farm-root-folder']
                            .DIRECTORY_SEPARATOR.$valeurs_fiche[$tableau_template[1]].DIRECTORY_SEPARATOR;

                // test l'existence du dossier choisi
                if (is_dir($destfolder)) {
                    die('L\'adresse '.$url.' est déja utilisée, veuillez en prendre une autre.');
                } else {
                    // on copie les fichier du wiki si l'on a accès en écriture
                    if (is_writable($GLOBALS['wiki']->config['yeswiki-farm-root-folder'])) {
                        // le repertoire racine et les fichiers de la racine
                        mkdir($destfolder);
                        copyRecursive($srcfolder.'index.php', $destfolder.'index.php');
                        copyRecursive($srcfolder.'interwiki.conf', $destfolder.'interwiki.conf');
                        copyRecursive($srcfolder.'robots.txt', $destfolder.'robots.txt');
                        copyRecursive($srcfolder.'tools.php', $destfolder.'tools.php');
                        copyRecursive($srcfolder.'wakka.basic.css', $destfolder.'wakka.basic.css');
                        copyRecursive($srcfolder.'wakka.css', $destfolder.'wakka.css');
                        copyRecursive($srcfolder.'wakka.php', $destfolder.'wakka.php');

                        // les dossiers de base des yeswiki
                        copyRecursive($srcfolder.'actions', $destfolder.'actions');
                        mkdir($destfolder.'cache');
                        mkdir($destfolder.'files');
                        copyRecursive($srcfolder.'formatters', $destfolder.'formatters');
                        copyRecursive($srcfolder.'handlers', $destfolder.'handlers');
                        copyRecursive($srcfolder.'includes', $destfolder.'includes');
                        copyRecursive($srcfolder.'lang', $destfolder.'lang');
                        copyRecursive($srcfolder.'setup', $destfolder.'setup');

                        // themes
                        mkdir($destfolder.'themes');
                        // theme bootstrap par defaut
                        copyRecursive(
                            $srcfolder.'themes'.DIRECTORY_SEPARATOR.'bootstrap',
                            $destfolder.'themes'.DIRECTORY_SEPARATOR.'bootstrap'
                        );
                        // templates
                        copyRecursive(
                            $srcfolder.'themes'.DIRECTORY_SEPARATOR.'tools',
                            $destfolder.'themes'.DIRECTORY_SEPARATOR.'tools'
                        );
                        // themes specifiques
                        foreach ($GLOBALS['wiki']->config['yeswiki-farm-extra-themes'] as $themes) {
                            copyRecursive(
                                $srcfolder.'themes'.DIRECTORY_SEPARATOR.$themes,
                                $destfolder.'themes'.DIRECTORY_SEPARATOR.$themes
                            );
                        }

                        // extensions
                        mkdir($destfolder.'tools');

                        // extensions de base
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'aceditor',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'aceditor'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'attach',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'attach'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'contact',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'contact'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'despam',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'despam'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'ipblock',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'ipblock'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'lang',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'lang'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'login',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'login'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'progressBar',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'progressBar'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'tableau',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'tableau'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'toc',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'toc'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'nospam',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'nospam'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'rss',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'rss'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'tags',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'tags'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'toolsmng',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'toolsmng'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'bazar',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'bazar'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'hashcash',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'hashcash'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'libs',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'libs'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'prepend.php',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'prepend.php'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'syndication',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'syndication'
                        );
                        copyRecursive(
                            $srcfolder.'tools'.DIRECTORY_SEPARATOR.'templates',
                            $destfolder.'tools'.DIRECTORY_SEPARATOR.'templates'
                        );

                        // extensions supplémentaires
                        foreach ($GLOBALS['wiki']->config['yeswiki-farm-extra-tools'] as $tools) {
                            copyRecursive(
                                $srcfolder.'tools'.DIRECTORY_SEPARATOR.$tools,
                                $destfolder.'tools'.DIRECTORY_SEPARATOR.$tools
                            );
                        }

                        // creation d'un user?
                        if ($GLOBALS['wiki']->config['yeswiki-farm-create-user']) {
                            $GLOBALS['wiki']->Query(
                                "insert into ".$GLOBALS['wiki']->config["table_prefix"]."users set ".
                                "signuptime = now(), ".
                                "name = '".mysql_escape_string($valeurs_fiche[$tableau_template[1].'_wikiname'])."', ".
                                "email = '".mysql_escape_string($valeurs_fiche[$tableau_template[1].'_email'])."', ".
                                "password = md5('".mysql_escape_string($valeurs_fiche[$tableau_template[1].'_password'])."')"
                            );
                        }

                        // droits d'accès par aux pages
                        if ($GLOBALS['wiki']->config['yeswiki-farm-write-acls'] == 'user') {
                            $GLOBALS['wiki']->config['yeswiki-farm-write-acls'] = $valeurs_fiche[$tableau_template[1]
                                                                                    .'_wikiname'];
                        }
                        if ($GLOBALS['wiki']->config['yeswiki-farm-read-acls'] == 'user') {
                            $GLOBALS['wiki']->config['yeswiki-farm-read-acls'] = $valeurs_fiche[$tableau_template[1]
                                                                                    .'_wikiname'];
                        }
                        if ($GLOBALS['wiki']->config['yeswiki-farm-comments-acls'] == 'user') {
                            $GLOBALS['wiki']->config['yeswiki-farm-comments-acls'] = $valeurs_fiche[$tableau_template[1]
                                                                                    .'_wikiname'];
                        }
                                           
                        // ecriture du fichier de configuration
                        $config = array (
                              'wakka_version' => $GLOBALS['wiki']->config['wakka_version'],
                              'wikini_version' => $GLOBALS['wiki']->config['wikini_version'],
                              'yeswiki_version' => $GLOBALS['wiki']->config['yeswiki_version'],
                              'yeswiki_release' => $GLOBALS['wiki']->config['yeswiki_release'],
                              'debug' => $GLOBALS['wiki']->config['debug'],
                              'mysql_host' => $GLOBALS['wiki']->config['mysql_host'],
                              'mysql_database' => $GLOBALS['wiki']->config['mysql_database'],
                              'mysql_user' => $GLOBALS['wiki']->config['mysql_user'],
                              'mysql_password' => $GLOBALS['wiki']->config['mysql_password'],
                              'table_prefix' => 'yeswiki_'
                                                .str_replace('-', '_', $valeurs_fiche[$tableau_template[1]]).'__',
                              'root_page' => $GLOBALS['wiki']->config['yeswiki-farm-homepage'],
                              'wakka_name' => addslashes($valeurs_fiche['bf_titre']),
                              'base_url' => $GLOBALS['wiki']->config['yeswiki-farm-root-url']
                                            .$valeurs_fiche[$tableau_template[1]].'/wakka.php?wiki=',
                              'rewrite_mode' => $GLOBALS['wiki']->config['rewrite_mode'],
                              'meta_keywords' => $GLOBALS['wiki']->config['meta_keywords'],
                              'meta_description' => $GLOBALS['wiki']->config['meta_description'],
                              'action_path' => 'actions',
                              'handler_path' => 'handlers',
                              'header_action' => 'header',
                              'footer_action' => 'footer',
                              'navigation_links' => $GLOBALS['wiki']->config['navigation_links'],
                              'referrers_purge_time' => $GLOBALS['wiki']->config['referrers_purge_time'],
                              'pages_purge_time' => $GLOBALS['wiki']->config['pages_purge_time'],
                              'default_write_acl' => $GLOBALS['wiki']->config['yeswiki-farm-write-acls'],
                              'default_read_acl' => $GLOBALS['wiki']->config['yeswiki-farm-read-acls'],
                              'default_comment_acl' => $GLOBALS['wiki']->config['yeswiki-farm-comments-acls'],
                              'preview_before_save' => $GLOBALS['wiki']->config['preview_before_save'],
                              'allow_raw_html' => $GLOBALS['wiki']->config['allow_raw_html'],
                              'default_language' => $GLOBALS['wiki']->config['default_language'],
                              'favorite_theme' => $GLOBALS['wiki']->config['yeswiki-farm-fav-theme'],
                              'favorite_style' => $GLOBALS['wiki']->config['yeswiki-farm-fav-style'],
                              'favorite_squelette' => $GLOBALS['wiki']->config['yeswiki-farm-fav-squelette'],
                              'favorite_background_image' => $GLOBALS['wiki']->config['yeswiki-farm-bg-img'],
                              'source_url' =>  $GLOBALS['wiki']->href('', $valeurs_fiche['id_fiche']),
                        );
                        
                        if (isset($valeurs_fiche['bf_description'])) {
                            $config['meta_description'] = addslashes(
                                substr(
                                    str_replace('<br>', ' ', strip_tags($valeurs_fiche['bf_description'], '<br>')),
                                    0,
                                    150
                                )
                            );
                        }

                        // convert config array into PHP code
                        $configCode = "<?php\n// wakka.config.php "._t('CREATED')." ".strftime("%c")."\n// ".
                                        _t('DONT_CHANGE_YESWIKI_VERSION_MANUALLY')." !\n\n\$wakkaConfig = ";
                        $configCode .= var_export($config, true) . ";\n?>";

                        if ($fp = @fopen($destfolder.'wakka.config.php', "w")) {
                            fwrite($fp, $configCode);
                            // write
                            fclose($fp);
                        } else {
                            die('Ecriture du fichier de configuration impossible');
                        }

                        // base de données
                        if ($sql = file_get_contents('tools/ferme/sql/'.$GLOBALS['wiki']->config['yeswiki-farm-sql'])) {
                            $sql = str_replace(
                                '{{prefix}}',
                                str_replace('-', '_', $valeurs_fiche[$tableau_template[1]]),
                                $sql
                            );
                            $sql = str_replace('{{WikiName}}', $valeurs_fiche[$tableau_template[1].'_wikiname'], $sql);
                            $sql = str_replace('{{password}}', $valeurs_fiche[$tableau_template[1].'_password'], $sql);
                            $sql = str_replace('{{email}}', $valeurs_fiche[$tableau_template[1].'_email'], $sql);

                             /* create sql connection*/
                            $link = mysqli_connect(
                                $GLOBALS["wiki"]->config['mysql_host'],
                                $GLOBALS["wiki"]->config['mysql_user'],
                                $GLOBALS["wiki"]->config['mysql_password'],
                                $GLOBALS["wiki"]->config['mysql_database']
                            );
                            /* Execute queries */
                            mysqli_multi_query($link, utf8_decode($sql));
                        } else {
                            die('Lecture du fichier sql impossible');
                        }
                        
                        //die('finish!!');
                    } else {
                        die('Le dossier '.$GLOBALS['wiki']->config['yeswiki-farm-root-folder']
                            .' n\'est pas accessible en écriture');
                    }
                    
                }
            }
            return array(
                $tableau_template[1] => $valeurs_fiche[$tableau_template[1]]
            );
        } else {
            die('La valeur '.$valeurs_fiche[$tableau_template[1]]
                .' n\'est pas valide, il faut des caractères alphanumérique et des tirets uniquement.');
        }
    } elseif ($mode == 'html') {
        $html = '';
        if (isset($valeurs_fiche[$tableau_template[1]]) && $valeurs_fiche[$tableau_template[1]] != '') {
            $url = $GLOBALS['wiki']->config['yeswiki-farm-root-url'].$valeurs_fiche[$tableau_template[1]];
            $html .= '<div class="BAZ_rubrique" data-id="' . $tableau_template[1] . '">' . "\n"
                .'<span class="BAZ_label">Accèder à l\'espace projet :</span>' . "\n"
                .'<span class="BAZ_texte">'.$valeurs_fiche[$tableau_template[1]].'</span>' . "\n"
                .'</div> <!-- /.BAZ_rubrique -->' . "\n";
            $html .= '<a class="btn btn-primary" href="'.$url.'" target="_blank">'."\n".$url."\n"
                .'</a>'. "\n";
        }
        
        return $html;
    }
}
