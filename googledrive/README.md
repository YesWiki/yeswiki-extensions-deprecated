# Extension YesWiki googledrive
## Ajoute un champs pour créer automatiquement un document collaboratif à une fiche bazar

cf. https://developers.google.com/drive/web/delegation

En résumé :

1. créer un compte developpeur google
2. créer une application google (avec le lien vers votre space web wiki) qui utilise l'API google drive et associer un compte service à cette API (voir la doc)
3. Aller sur la console, gestion des API, menu Identifiant, creer un nouvel identifiant > clé de compte de service, selectionner fichier.P12 , creer un compte mail associe au service 
4. Noter l'adresse du compte mail (on va devoir la mettre pour le dossier partage et dans le fichier de conf.), et telecharger le p12
5. copier la clé .p12 du compte service dans tools/googledrive/key.p12
6. renseigner tools/googledrive/wiki.php ou dans wakka.config.php :
$wakkaConfig['service_account_name'] = isset($wakkaConfig['service_account_name']) ? $wakkaConfig['service_account_name'] : "XXXXXXX@developer.gserviceaccount.com";
7. créer un dossier sur son google drive, et le partager en écriture avec le mail du compte service créé auparavant
8. récupérer l'id du dossier partagé en cliquant dessus et en prenant la derniere partie de la barre d'adresse et renseigner tools/googledrive/wiki.php ou dans wakka.config.php :
$wakkaConfig['folder_id'] = isset($wakkaConfig['folder_id']) ? $wakkaConfig['folder_id'] : "XXXXXXX";
9. utiliser la ligne suivante pour le formulaire bazar:  
`collaborative_doc***bf_type_doc***Type de document*** *** *** *** *** ***0***0***`
