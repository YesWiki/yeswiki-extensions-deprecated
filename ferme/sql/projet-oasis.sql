DROP TABLE IF EXISTS `yeswiki_{{prefix}}__acls`;
CREATE TABLE `yeswiki_{{prefix}}__acls` (
  `page_tag` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `privilege` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `list` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`page_tag`,`privilege`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `yeswiki_{{prefix}}__links`;
CREATE TABLE `yeswiki_{{prefix}}__links` (
  `from_tag` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `to_tag` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  UNIQUE KEY `from_tag` (`from_tag`,`to_tag`),
  KEY `idx_from` (`from_tag`),
  KEY `idx_to` (`to_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `yeswiki_{{prefix}}__links` (`from_tag`, `to_tag`) VALUES
('AidE',  'CoursUtilisationYesWiki'),
('AidE',  '{{WikiName}}'),
('BacASable', 'BacASable'),
('BacASable', 'DerniersChangements'),
('BacASable', 'DerniersCommentaires'),
('BacASable', 'PagePrincipale'),
('BacASable', 'ParametresUtilisateur'),
('BacASable', '{{WikiName}}'),
('BazaR', '{{WikiName}}'),
('CoursUtilisationYesWiki', 'AccueiL'),
('CoursUtilisationYesWiki', 'CoursUtilisationYesWiki'),
('CoursUtilisationYesWiki', 'DerniersChangements'),
('CoursUtilisationYesWiki', 'DerniersChangementsRSS'),
('CoursUtilisationYesWiki', 'DerniersCommentaires'),
('CoursUtilisationYesWiki', 'JamesBond'),
('CoursUtilisationYesWiki', 'ListeDesActionsWikini'),
('CoursUtilisationYesWiki', 'PageFooter'),
('CoursUtilisationYesWiki', 'PageHeader'),
('CoursUtilisationYesWiki', 'PageMenu'),
('CoursUtilisationYesWiki', 'PageMenuHaut'),
('CoursUtilisationYesWiki', 'PagePrincipale'),
('CoursUtilisationYesWiki', 'PageRapideHaut'),
('CoursUtilisationYesWiki', 'PagesOrphelines'),
('CoursUtilisationYesWiki', 'ParametresUtilisateur'),
('CoursUtilisationYesWiki', 'ReglesDeFormatage'),
('CoursUtilisationYesWiki', 'TableauDeBordDeCeWiki'),
('CoursUtilisationYesWiki', '{{WikiName}}'),
('CoursUtilisationYesWiki', 'YesWiki'),
('DerniersChangements', 'DerniersChangements'),
('DerniersChangements', 'DerniersCommentaires'),
('DerniersChangements', 'PagePrincipale'),
('DerniersChangements', 'ParametresUtilisateur'),
('DerniersChangements', '{{WikiName}}'),
('DerniersChangementsRSS',  'DerniersChangements'),
('DerniersChangementsRSS',  'DerniersChangementsRSS'),
('DerniersChangementsRSS',  'DerniersCommentaires'),
('DerniersChangementsRSS',  'PagePrincipale'),
('DerniersChangementsRSS',  'ParametresUtilisateur'),
('DerniersChangementsRSS',  '{{WikiName}}'),
('DerniersCommentaires',  'DerniersChangements'),
('DerniersCommentaires',  'DerniersCommentaires'),
('DerniersCommentaires',  'PagePrincipale'),
('DerniersCommentaires',  'ParametresUtilisateur'),
('DerniersCommentaires',  '{{WikiName}}'),
('PageFooter',  'DerniersChangements'),
('PageFooter',  'DerniersCommentaires'),
('PageFooter',  'PageFooter'),
('PageFooter',  'PagePrincipale'),
('PageFooter',  'ParametresUtilisateur'),
('PageFooter',  '{{WikiName}}'),
('PageHeader',  '{{WikiName}}'),
('PageMenu',  'DerniersChangements'),
('PageMenu',  'DerniersCommentaires'),
('PageMenu',  'PageMenu'),
('PageMenu',  'PagePrincipale'),
('PageMenu',  'ParametresUtilisateur'),
('PageMenu',  '{{WikiName}}'),
('PageMenuHaut',  'DerniersChangements'),
('PageMenuHaut',  'DerniersCommentaires'),
('PageMenuHaut',  'PageMenuHaut'),
('PageMenuHaut',  'PagePrincipale'),
('PageMenuHaut',  'ParametresUtilisateur'),
('PageMenuHaut',  '{{WikiName}}'),
('PagePrincipale',  '{{WikiName}}'),
('PageRapideHaut',  '{{WikiName}}'),
('PagesOrphelines', 'DerniersChangements'),
('PagesOrphelines', 'DerniersCommentaires'),
('PagesOrphelines', 'PagePrincipale'),
('PagesOrphelines', 'PagesOrphelines'),
('PagesOrphelines', 'ParametresUtilisateur'),
('PagesOrphelines', '{{WikiName}}'),
('PageTitre', 'DerniersChangements'),
('PageTitre', 'DerniersCommentaires'),
('PageTitre', 'PagePrincipale'),
('PageTitre', 'PageTitre'),
('PageTitre', 'ParametresUtilisateur'),
('PageTitre', '{{WikiName}}'),
('ParametresUtilisateur', 'DerniersChangements'),
('ParametresUtilisateur', 'DerniersCommentaires'),
('ParametresUtilisateur', 'PagePrincipale'),
('ParametresUtilisateur', 'ParametresUtilisateur'),
('ParametresUtilisateur', '{{WikiName}}'),
('RechercheTexte',  'DerniersChangements'),
('RechercheTexte',  'DerniersCommentaires'),
('RechercheTexte',  'PagePrincipale'),
('RechercheTexte',  'ParametresUtilisateur'),
('RechercheTexte',  'RechercheTexte'),
('RechercheTexte',  '{{WikiName}}'),
('TableauDeBord', 'DerniersChangements'),
('TableauDeBord', 'DerniersCommentaires'),
('TableauDeBord', 'PagePrincipale'),
('TableauDeBord', 'ParametresUtilisateur'),
('TableauDeBord', 'TableauDeBord'),
('TableauDeBord', '{{WikiName}}'),
('{{WikiName}}', 'DerniersChangements'),
('{{WikiName}}', 'DerniersCommentaires'),
('{{WikiName}}', 'PageFooter'),
('{{WikiName}}', 'PageHeader'),
('{{WikiName}}', 'PageMenuHaut'),
('{{WikiName}}', 'PagePrincipale'),
('{{WikiName}}', 'PageRapideHaut'),
('{{WikiName}}', 'PageTitre'),
('{{WikiName}}', 'ParametresUtilisateur'),
('{{WikiName}}', '{{WikiName}}');

DROP TABLE IF EXISTS `yeswiki_{{prefix}}__nature`;
CREATE TABLE `yeswiki_{{prefix}}__nature` (
  `bn_id_nature` int(10) unsigned NOT NULL DEFAULT '0',
  `bn_label_nature` varchar(255) DEFAULT NULL,
  `bn_description` text,
  `bn_condition` text,
  `bn_ce_id_menu` int(3) unsigned NOT NULL DEFAULT '0',
  `bn_commentaire` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bn_appropriation` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bn_image_titre` varchar(255) NOT NULL DEFAULT '',
  `bn_image_logo` varchar(255) NOT NULL DEFAULT '',
  `bn_couleur_calendrier` varchar(255) NOT NULL DEFAULT '',
  `bn_picto_calendrier` varchar(255) NOT NULL DEFAULT '',
  `bn_template` text NOT NULL,
  `bn_ce_i18n` varchar(5) NOT NULL DEFAULT '',
  `bn_type_fiche` varchar(255) NOT NULL,
  `bn_label_class` varchar(255) NOT NULL,
  PRIMARY KEY (`bn_id_nature`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `yeswiki_{{prefix}}__nature` (`bn_id_nature`, `bn_label_nature`, `bn_description`, `bn_condition`, `bn_ce_id_menu`, `bn_commentaire`, `bn_appropriation`, `bn_image_titre`, `bn_image_logo`, `bn_couleur_calendrier`, `bn_picto_calendrier`, `bn_template`, `bn_ce_i18n`, `bn_type_fiche`, `bn_label_class`) VALUES
(17,  'Images', 'pour faire des galeries d\'images',  '', 0,  0,  0,  '', '', '', '', 'texte***bf_titre***Titre***60***255*** *** *** ***1***0***Si possible proposer un titre parlant (qui dÃ©crive bien le contenu de la photo)\r\nimage***bf_image***Photo***500***500***1000***1000***center***1***0***\r\ntexte***bf_auteur***Auteur***60***255*** *** *** ***0***0***\r\ntexte***bf_description***Description***100***100*** *** *** *** *** ***\r\ntags***tags***Mots clÃ©s***60***255*** *** *** ***0***0***On peut sÃ©parer les mots clÃ©s en appuyant sur les touches entrÃ©e, virgule ou point-virgule.',  'fr-FR',  'Images', 'images'),
(11,  'Annonces et actualitÃ©s',  'ActualitÃ©, articles de blog', '', 0,  0,  0,  '', '', '', '', 'texte***bf_titre***Titre***255***255*** *** *** ***1***0***\r\ntextelong***bf_chapeau***Chapeau***40***3*** *** *** ***1***0***Donnez envie au lecteur de lire l\'article grÃ¢ce Ã  cette introduction d\'une ou 2 lignes\r\nimage***bf_image***Image de d\'illustration (770x385) ***385***770***385***770***right***0***0***Votre image doit Ãªtre au format .jpg ou .gif ou .png\r\ntextelong***bf_description***Billet***40***30*** *** *** ***1***0***\r\ntags***tags***Mots clÃ©s***60***255*** *** *** ***0***1***On peut sÃ©parer les mots clÃ©s en appuyant sur les touches entrÃ©e, virgule ou point-virgule.\r\n',  'fr-FR',  'Blog', 'blog');

DROP TABLE IF EXISTS `yeswiki_{{prefix}}__pages`;
CREATE TABLE `yeswiki_{{prefix}}__pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `body_r` text COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `latest` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `handler` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'page',
  `comment_on` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_tag` (`tag`),
  KEY `idx_time` (`time`),
  KEY `idx_latest` (`latest`),
  KEY `idx_comment_on` (`comment_on`),
  FULLTEXT KEY `tag` (`tag`,`body`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `yeswiki_{{prefix}}__pages` (`id`, `tag`, `time`, `body`, `body_r`, `owner`, `user`, `latest`, `handler`, `comment_on`) VALUES
(1, 'BacASable',  '2015-07-08 10:08:31',  ' - si vous cliquez sur \"Ã©diter cette page\"\n - vous pourrez Ã©crire dans cette page comme bon vous semble\n - puis en cliquant sur \"sauver\" vous pourrez enregistrer vos modifications',  '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(2, 'RechercheTexte', '2015-07-08 10:08:31',  '{{TextSearch}}', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(3, 'PageMenuHaut', '2015-07-08 10:08:31',  ' - [[PagePrincipale Accueil]]\n',  '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(4, 'DerniersChangementsRSS', '2015-07-08 10:08:31',  '{{recentchangesrss}}', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(6, 'PageTitre',  '2015-07-08 10:08:31',  '{{configuration param=\"wakka_name\"}}', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(7, 'PageFooter', '2015-07-08 10:08:31',  '\"\"<div style=\"text-align:center\">\"\"\n(>^_^)> Galope sous [[http://www.yeswiki.net YesWiki]] <(^_^<)\n\"\"</div>\"\" \n', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(9, 'CoursUtilisationYesWiki',  '2015-07-08 10:08:31',  '======Cours sur l\'utilisation de YesWiki======\n====Le principe \"Wiki\"====\nWiki Wiki signifie rapide, en Hawaïen. \n==N\'importe qui peut modifier la page==\n[[http://the.honoluluadvertiser.com/dailypix/2002/Aug/19/ln07a_b.jpg le bus wiki wiki]]\n\n**Les Wiki sont des dispositifs permettant la modification de pages Web de façon simple, rapide et interactive.**\nYesWiki fait partie de la famille des wiki. Il a la particularité d\'être très facile à installer.\n\n=====Mettre du contenu=====\n====Écrire ou coller du texte====\n - Dans chaque page du site, un double clic sur la page ou un clic sur le lien \"Éditer cette page\" en bas de page permet de passer en mode \"Édition\".\n - On peut alors écrire ou coller du texte\n - On peut voir un aperçu des modifications ou sauver directement la page modifiée en cliquant sur les boutons en bas de page.\n\n====Écrire un commentaire (optionnel)====\nSi la configuration de la page permet d\'ajouter des commentaires, on peut cliquer sur : Afficher commentaires/formulaire en bas de chaque page.\nUn formulaire apparaitra et vous permettra de rajouter votre commentaire.\n\n\n=====Mise en forme : Titres et traits=====\n--> Voir la page ReglesDeFormatage\n\n====Faire un titre====\n======Très gros titre====== \ns\'écrit en syntaxe wiki : \"\"======Très gros titre======\"\"\n\n\n==Petit titre== \ns\'écrit en syntaxe wiki : \"\"==Petit titre==\"\" \n\n\n//On peut mettre entre 2 et 6 = de chaque coté du titre pour qu\'il soit plus petit ou plus grand//\n\n====Faire un trait de séparation====\nPour faire apparaitre un trait de séparation\n----\ns\'écrit en syntaxe wiki : \"\"----\"\"\n\n=====Mise en forme : formatage texte=====\n====Mettre le texte en gras====\n**texte en gras**\ns\'écrit en syntaxe wiki : \"\"**texte en gras**\"\" \n\n====Mettre le texte en italique====\n//texte en italique//\ns\'écrit en syntaxe wiki : \"\"//texte en italique//\"\"\n\n====Mettre le texte en souligné====\n__texte en souligné__\ns\'écrit en syntaxe wiki : \"\"__texte en souligné__\"\"\n\n=====Mise en forme : listes=====\n====Faire une liste à puce====\n - point 1\n - point 2\n\ns\'écrit en syntaxe wiki : \n\"\" - point 1\"\"\n\"\" - point 2\"\"\n\nAttention : de bien mettre un espace devant le tiret pour que l\'élément soit reconnu comme liste\n\n\n====Faire une liste numérotée====\n 1) point 1\n 2) point 2\n\ns\'écrit en syntaxe wiki : \n\"\" 1) point 1\"\"\n\"\" 2) point 2\"\"\n\n=====Les liens : le concept des \"\"ChatMots\"\"=====\n====Créer une page YesWiki : ====\nLa caractéristique qui permet de reconnaitre un lien dans un wiki : son nom avec un mot contenant au moins deux majuscules non consécutives (un \"\"ChatMot\"\", un mot avec deux bosses). \n\n==== Lien interne====\n - On écrit le \"\"ChatMot\"\" de la page YesWiki vers laquelle on veut pointer.\n  - Si la page existe, un lien est automatiquement créé\n  - Si la page n\'existe pas, apparait un lien avec crayon. En cliquant dessus on arrive vers la nouvelle page en mode \"Édition\".\n\n=====Les liens : personnaliser le texte=====\n====Personnaliser le texte du lien internet====\nentre double crochets : \"\"[[AccueiL aller à la page d\'accueil]]\"\", apparaitra ainsi : [[AccueiL aller à la page d\'accueil]].\n\n====Liens vers d\'autres sites Internet====\nentre double crochets : \"\"[[http://outils-reseaux.org aller sur le site d\'Outils-Réseaux]]\"\", apparaitra ainsi : [[http://outils-reseaux.org aller sur le site d\'Outils-Réseaux]].\n\n\n=====Télécharger une image, un document=====\n====On dispose d\'un lien vers l\'image ou le fichier====\nentre double crochets :\n - \"\"[[http://mondomaine.ext/image.jpg texte de remplacement de l\'image]]\"\" pour les images.\n - \"\"[[http://mondomaine.ext/document.pdf texte du lien vers le téléchargement]]\"\" pour les documents.\n\n====L\'action \"attach\"====\nEn cliquant sur le pictogramme représentant une image dans la barre d\'édition, on voit apparaître la ligne de code suivante :\n\"\"{{attach file=\" \" desc=\" \" class=\"left\" }} \"\"\n\nEntre les premières guillemets, on indique le nom du document (ne pas oublier son extension (.jpg, .pdf, .zip).\nEntre les secondes, on donne quelques éléments de description qui deviendront le texte du lien vers le document\nLes troisièmes guillemets, permettent, pour les images, de positionner l\'image à gauche (left), ou à droite (right) ou au centre (center)\n\"\"{{attach file=\"nom-document.doc\" desc=\"mon document\" class=\"left\" }} \"\"\n\nQuand on sauve la page, un lien en point d\'interrogation apparait. En cliquant dessus, on arrive sur une page avec un système pour aller chercher le document sur sa machine (bouton \"parcourir\"), le sélectionner et le télécharger.\n\n=====Intégrer du html=====\nSi on veut faire une mise en page plus compliquée, ou intégrer un widget, il faut écrire en html. Pour cela, il faut mettre notre code html entre double guillemets.\nPar exemple : \"\"<textarea style=\"width:100%;\">&quot;&quot;<span style=\"color:#0000EE;\">texte coloré</span>&quot;&quot;</textarea>\"\"\ndonnera :\n\"\"<span style=\"color:#0000EE;\">texte coloré</span>\"\"\n\n\n=====Les pages spéciales=====\n - PageHeader\n - PageFooter\n - PageMenuHaut\n - PageMenu\n - PageRapideHaut\n\n - PagesOrphelines\n - TableauDeBordDeCeWiki\n \n\n=====Les actions disponibles=====\nVoir la page spéciale : ListeDesActionsWikini\n\n**les actions à ajouter dans la barre d\'adresse:**\nrajouter dans la barre d\'adresse :\n/edit : pour passer en mode Edition\n/slide_show : pour transformer la texte en diaporama\n\n===La barre du bas de page permet d\'effectuer diverses action sur la page===\n - voir l\'historique\n - partager sur les réseaux sociaux\n...\n\n=====Suivre la vie du site=====\n - Dans chaque page, en cliquant sur la date en bas de page on accède à **l\'historique** et on peut comparer les différentes versions de la page.\n\n - **Le TableauDeBordDeCeWiki : ** pointe vers toutes les pages utiles à l\'analyse et à l\'animation du site.\n\n - **La page DerniersChangements** permet de visualiser les modifications qui ont été apportées sur l\'ensemble du site, et voir les versions antérieures. Pour l\'avoir en flux RSS DerniersChangementsRSS\n\n - **Les lecteurs de flux RSS** :  offrent une façon simple, de produire et lire, de façon standardisée (via des fichiers XML), des fils d\'actualité sur internet. On récupère les dernières informations publiées. On peut ainsi s\'abonner à différents fils pour mener une veille technologique par exemple.\n[[http://www.wikini.net/wakka.php?wiki=LecteursDeFilsRSS Différents lecteurs de flux RSS]]\n\n\n\n=====L\'identification=====\n====Première identification = création d\'un compte YesWiki====\n    - aller sur la page spéciale ParametresUtilisateur, \n    - choisir un nom YesWiki qui comprend 2 majuscules. //Exemple// : JamesBond\n    - choisir un mot de passe et donner un mail\n    - cliquer sur s\'inscrire\n\n====Identifications suivantes====\n    - aller sur ParametresUtilisateur, \n    - remplir le formulaire avec son nom YesWiki et son mot de passe\n    - cliquer sur \"connexion\"\n\n\n\n=====Gérer les droits d\'accès aux pages=====\n - **Chaque page possède trois niveaux de contrôle d\'accès :**\n     - lecture de la page\n     - écriture/modification de la page\n     - commentaire de la page\n\n - **Les contrôles d\'accès ne peuvent être modifiés que par le propriétaire de la page**\nOn est propriétaire des pages que l\'ont créent en étant identifié. Pour devenir \"propriétaire\" d\'une page, il faut cliquer sur Appropriation. \n\n - Le propriétaire d\'une page voit apparaître, dans la page dont il est propriétaire, l\'option \"**Éditer permissions**\" : cette option lui permet de **modifier les contrôles d\'accès**.\nCes contrôles sont matérialisés par des colonnes où le propriétaire va ajouter ou supprimer des informations.\nLe propriétaire peut compléter ces colonnes par les informations suivantes, séparées par des espaces :\n     - le nom d\'un ou plusieurs utilisateurs : par exemple \"\"JamesBond\"\" \n     - le caractère ***** désignant tous les utilisateurs\n     - le caractère **+** désignant les utilisateurs enregistrés\n     - le caractère **!** signifiant la négation : par exemple !\"\"JamesBond\"\" signifie que \"\"JamesBond\"\" **ne doit pas** avoir accès à cette page\n\n - **Droits d\'accès par défaut** : pour toute nouvelle page créée, YesWiki applique des droits d\'accès par défaut : sur ce YesWiki, les droits en lecture et écriture sont ouverts à tout internaute.\n\n=====Supprimer une page=====\n\n - **2 conditions :**\n    - **on doit être propriétaire** de la page et **identifié** (voir plus haut),\n    - **la page doit être \"orpheline\"**, c\'est-à-dire qu\'aucune page ne pointe vers elle (pas de lien vers cette page sur le YesWiki), on peut voir toutes les pages orphelines en visitant la page : PagesOrphelines\n\n - **On peut alors cliquer sur l\'\'option \"Supprimer\"** en bas de page.\n\n\n\n=====Changer le look et la disposition=====\nEn mode édition, si on est propriétaire de la page, ou que les droits sont ouverts, on peut changer la structure et la présentation du site, en jouant avec les listes déroulantes en bas de page : Thème, Squelette, Style.\n\n', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(10,  'TableauDeBord',  '2015-07-08 10:08:31',  '======Tableau de bord======\n{{grid}}\n{{col size=\"6\"}} \n==== 8 derniers comptes utilisateurs ====\n{{Listusers last=\"8\"}}\n------\n==== 8 derniÃ¨res pages modifiÃ©es ====\n{{recentchanges max=\"8\"}}\n------\n==== 5 derniÃ¨res pages commentÃ©es ====\n{{RecentlyCommented max=\"5\"}}\n------\n{{end elem=\"col\"}} \n{{col size=\"6\"}} \n==== Index des pages ====\n{{pageindex}}\n------\n==== Pages orphelines ====\n{{OrphanedPages}}\n------\n{{end elem=\"col\"}}\n{{end elem=\"grid\"}}\n', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(12,  'ParametresUtilisateur',  '2015-07-08 10:08:31',  '{{UserSettings}}', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(13,  'DerniersChangements',  '2015-07-08 10:08:31',  '{{RecentChanges}}',  '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(14,  'PageMenu', '2015-07-08 10:08:31',  ' - \"\"<a href=\"wakka.php?wiki=\"\"{{configuration param=\"root_page\"}}\"\"\" title=\"Aller sur la page d\'accueil\">Accueil</a>\"\"', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(15,  'PagesOrphelines',  '2015-07-08 10:08:31',  '{{OrphanedPages}}',  '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(17,  'DerniersCommentaires', '2015-07-08 10:08:31',  '{{RecentlyCommented}}',  '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(18,  '{{WikiName}}',  '2015-07-08 10:08:31',  '{{grid}}\n{{col size=\"6\"}} \n===GÃ©rer les menus de ce wiki===\n - [[PageMenuHaut Editer menu horizontal d\'en haut]]\n - [[PageTitre Editer le titre]]\n - [[PageRapideHaut Editer le menu roue crantÃ©e]]\n - [[PageHeader Editer le bandeau]]\n - [[PageFooter Editer le footer]]\n\n===GÃ©rer les groupes d\'utilisateurs===\nnÃ©cessite une connexion admin\n{{editgroups}}\n{{end elem=\"col\"}} \n{{col size=\"6\"}} \n=== Gestion des tags ===\n{{admintag}}\n------\n=== Gestion des commentaires ===\n{{erasespamedcomments}}\n------\n{{end elem=\"col\"}}\n{{end elem=\"grid\"}}\n', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(19,  'PageRapideHaut', '2015-07-08 10:22:23',  '\"\"<div class=\"btn-group pull-right\">\n<button type=\"button\" class=\"yeswiki-menu-btn navbar-btn btn btn-default  dropdown-toggle\" data-toggle=\"dropdown\">\n<span class=\"glyphicon  glyphicon-cog icon-cog\"></span>\n</button>\n\n<ul class=\"dropdown-menu\" role=\"menu\">\n<li><a href=\"wakka.php?wiki=ParametresUtilisateur\"><i  class=\"glyphicon glyphicon-user icon-user\"></i> Se Connecter</a></li>\n<li class=\"divider\"></li>\n<li><a href=\"wakka.php?wiki=AidE\"><i  class=\"glyphicon glyphicon-question-sign icon-question-sign\"></i> Aide</a></li>\n<li class=\"divider\"></li>\n<li><a href=\"wakka.php?wiki={{WikiName}}\"><i  class=\"glyphicon glyphicon-wrench icon-wrench\"></i> Gestion du site</a></li>\n<li><a href=\"wakka.php?wiki=TableauDeBord\"><i  class=\"glyphicon glyphicon-dashboard icon-list-alt\"></i> Tableau de bord</a></li>\n<li><a href=\"wakka.php?wiki=BazaR\"><i  class=\"glyphicon glyphicon-briefcase icon-briefcase\"></i> Base de donnÃ©es</a></li>\n</ul>\n</div>\"\"{{moteurrecherche template=\"moteurrecherche_navbar.tpl.html\" class=\"pull-right\"}}  \"\"<div class=\"clearfix\"></div>\"\"', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(20,  'AidE', '2015-07-08 10:22:54',  '=====Les pages d\'aide=====\n\n  - [[CoursUtilisationYesWiki Cours sur l\'utilisation de YesWiki]]\n\n\"\"<iframe class=\"yeswiki_frame\" width=\"100%\" height=\"3000\" frameborder=\"0\" src=\"http://yeswiki.net/wakka.php?wiki=CodeExemple/iframe\"></iframe>\"\"',  '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(22,  'PagePrincipale', '2015-07-08 10:24:13',  '======Bienvenue !======\n\nCliquez sur le lien \"Editer cette page\" au bas de la page pour dÃ©marrer et Ã©crire le contenu de la page.',  '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(23,  'BazaR',  '2015-07-08 10:35:40',  '{{bazar}}',  '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', ''),
(44,  'PageHeader', '2015-07-10 13:45:55',  '\"\"<div class=\"background-image cover\" style=\"background-image:url(\"\"{{valeur champ=\"bf_bandeau\" image=\"lien\"}}\"\");\">\n<div class=\"container\">\n<h1><span style=\"color:#FFF;text-shadow:0 0 2px black;\">\"\"{{valeur champ=\"bf_titre\"}}\"\"</span></h1>\n<h2><span style=\"color:#A2B420;font-weight:bold;text-shadow:0 0 2px black;\">\"\"{{valeur champ=\"bf_description\"}}\"\"</span></h2>\n</div> <!-- /.container -->\n</div>\"\"', '', '{{WikiName}}',  '{{WikiName}}',  'Y',  'page', '');

DROP TABLE IF EXISTS `yeswiki_{{prefix}}__referrers`;
CREATE TABLE `yeswiki_{{prefix}}__referrers` (
  `page_tag` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `referrer` char(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `idx_page_tag` (`page_tag`),
  KEY `idx_time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `yeswiki_{{prefix}}__triples`;
CREATE TABLE `yeswiki_{{prefix}}__triples` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `property` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resource` (`resource`),
  KEY `property` (`property`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `yeswiki_{{prefix}}__triples` (`id`, `resource`, `property`, `value`) VALUES
(1, 'ThisWikiGroup:admins', 'http://www.wikini.net/_vocabulary/acls', '{{WikiName}}');

DROP TABLE IF EXISTS `yeswiki_{{prefix}}__users`;
CREATE TABLE `yeswiki_{{prefix}}__users` (
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `motto` text COLLATE utf8_unicode_ci NOT NULL,
  `revisioncount` int(10) unsigned NOT NULL DEFAULT '20',
  `changescount` int(10) unsigned NOT NULL DEFAULT '50',
  `doubleclickedit` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `signuptime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `show_comments` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`name`),
  KEY `idx_name` (`name`),
  KEY `idx_signuptime` (`signuptime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `yeswiki_{{prefix}}__users` (`name`, `password`, `email`, `motto`, `revisioncount`, `changescount`, `doubleclickedit`, `signuptime`, `show_comments`) VALUES
('{{WikiName}}', md5('{{password}}'), '{{email}}', '', 20, 50, 'Y',  '2015-07-08 10:08:31',  'N');

-- 2015-07-10 13:52:05
