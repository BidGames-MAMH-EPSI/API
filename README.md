# BIDGAMES - API

## Installation
#### Serveur
Cette API fonctionne sous n'importe quel serveur executant **PHP en version 7.4**.

#### Base de données
Elle a besoin d'avoir accès à une base de données sous **MySQL**.
Pour configurer les identifiants de connexion à la base de données sur l'API, il faut modifier les varialbes suivantes dans le fichier ```database.php``` dans le dossier ```config/``` :
```php
private $host = "<HOST>";
private $db_name = "<DB_NAME>";
private $username = "<USERNAME>";
private $password = "<PASSWORD>";
``` 

#### .htaccess
Le fichier ```.htaccess``` est configuré pour pouvoir accéder à l'API sans devoir saisir l'extension ```.php``` des fichiers.

## Utilisation
#### Appel et réponse
L'API répond aux appels sur le protocole **HTTP/HTTPS**, et renvoie une réponse au format **JSON**.
Si tout s'est bien déroulé, le résultat sera toujours retourné de cette manière :
```json
{
    "results": {
        [...]
    }
}
```

Le code **200** est utilisé si tout s'est bien déroulé. Sinon le code **404** est retourné, et il renvoie la description de l'erreur sous le format suivant :
```json
{
    "message": "xxx"
}
```