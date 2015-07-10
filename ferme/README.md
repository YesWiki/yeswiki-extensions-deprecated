# Extension YesWiki bazar ferme
### Ajoute un champs 'yeswiki' pour créer automatiquement un wiki dans une fiche bazar

1) copier l'extension dans votre dossier tools

2) utiliser les lignes suivantes pour le formulaire bazar "ferme":
```
texte***bf_titre***Titre***255***255*** *** *** ***1***
texte***bf_description***Description courte***255***255*** *** *** ***1***
image***bf_bandeau***Bandeau (1920x280 pixels)***400***1920***400***1920***center***1*** ***
yeswiki***bf_dossier-wiki***Nom du dossier wiki***255***255*** *** *** ***1***
```

OPTION: pour affiner le fonctionnement, ajouter les informations suivantes à wakka.config.php
```
  'yeswiki-farm-sql' => 'paepard-espace-de-travail.sql', //fichier sql source des wikis de la ferme présent dans tools/ferme/sql
  'yeswiki-farm-root-url' => 'http://yeswiki.dev/', //adresse url de départ des wikis de la ferme, le nom du dossier sera ajouté
  'yeswiki-farm-root-folder' => '.', //dossier de destination des wikis, par défaut '.' : répertoire du wiki qui dispose de bazar, on peut mettre '..' pour descendre d'un dossier
  'yeswiki-farm-extra-themes' => array('bootstrap3'), // themes supplémentaires (doivent etre présents dans le dossier themes du wiki source)
  'yeswiki-farm-extra-tools' => array(), // tools supplémentaires (doivent etre présents dans le dossier tools du wiki source)
  'yeswiki-farm-fav-theme' => 'bootstrap3', // theme par défaut des wikis créés
  'yeswiki-farm-fav-squelette' => '1col.tpl.html', // squelette par défaut des wikis créés
  'yeswiki-farm-fav-style' => 'paper.bootstrap.min.css', // style par défaut des wikis créés
  'yeswiki-farm-bg-img' => '', // image de fond par défaut des wikis créés
  'yeswiki-farm-write-acls' => '*', // droits en écriture par défaut des wikis créés
  'yeswiki-farm-read-acls' => '*', // droits en lecture par défaut des wikis créés
  'yeswiki-farm-comments-acls' => '+', // droits des commentaires par défaut des wikis créés
  'yeswiki-farm-homepage' => 'DashBoard', // page d'accueil
  'yeswiki-farm-create-user' => false, // cas spécifique ou l'on veut créer un user sur le wiki source
```
