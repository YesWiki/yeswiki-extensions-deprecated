# Extension YesWiki googledrive
### Champs pour formulaire bazar pour créer automatiquement un document collaboratif associé a une fiche


En résumé :

1. Créer un compte developpeur google a partir de votre compte google (voir https://developers.google.com en haut a droite) 
2. Sur https://console.developers.google.com , créer un nouveau projet qui utilise l'API google drive (penser a activer l'api google drive quand ce sera proposé)
3. Créer un identifiant "Créer une clé de compte de service" avec les infos suivantes : 
  - Compte de service : App engine default service account
  - Type de clé : P12 (Pour la rétrocompatibilité avec le code au format P12)
  telecharger la clé et garder le mot de passe
4. Aller sur la gestion des comptes de service
5. Noter l'adresse du compte mail ('ID du compte de service'	'ID de clé') (on va devoir la mettre dans le fichier de conf.)
6. copier la clé .p12 du compte service dans tools/googledrive/key.p12
7. renseigner tools/googledrive/wiki.php ou dans wakka.config.php :
$wakkaConfig['service_account_name'] = isset($wakkaConfig['service_account_name']) ? $wakkaConfig['service_account_name'] : "XXXXXXX@developer.gserviceaccount.com";
8. créer un dossier sur son google drive, et le partager en écriture avec le mail du compte service créé auparavant
9. récupérer l'id du dossier partagé en cliquant dessus et en prenant la derniere partie de la barre d'adresse et renseigner tools/googledrive/wiki.php ou dans wakka.config.php :
$wakkaConfig['folder_id'] = isset($wakkaConfig['folder_id']) ? $wakkaConfig['folder_id'] : "XXXXXXX";
10. utiliser la ligne suivante pour le formulaire bazar:  
`collaborative_doc***bf_type_doc***Type de document*** *** *** *** *** ***0***0***`
