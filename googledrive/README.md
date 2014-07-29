# Extension YesWiki googledrive
## Ajoute un champs pour créer automatiquement un document collaboratif à une fiche bazar

cf. https://developers.google.com/drive/web/delegation

En résumé :

1. créer un compte developpeur google

2. créer une application google (avec le lien vers votre space web wiki) qui utilise l'API google drive et associer un compte service à cette API (voir la doc)

3. copier la clé .p12 du compte service dans tools/googledrive/key.p12

4. renseigner tools/googledrive/wiki.php ou dans wakka.config.php :
$wakkaConfig['service_account_name'] = isset($wakkaConfig['service_account_name']) ? $wakkaConfig['service_account_name'] : "XXXXXXX@developer.gserviceaccount.com";

5. créer un dossier sur son google drive, et le partager en écriture avec le mail du compte service créé auparavant

6. récupérer l'id du compte service (clic droit, propriétés du dossier) et renseigner tools/googledrive/wiki.php ou dans wakka.config.php :
$wakkaConfig['folder_id'] = isset($wakkaConfig['folder_id']) ? $wakkaConfig['folder_id'] : "XXXXXXX";

7. utiliser la ligne suivante pour le formulaire bazar:
collaborative_doc***bf_type_doc***Type de document*** *** *** *** *** ***0***0***
