# Test-Uballers

Enregistrer la base donnée à l'aide du fichier `./sql/users.sql`

Le fichier `db.php` doit éventuellement être modifié, si l'une des données à la connexion du root est fausse :
- Nom d'utilisateur : 'root'   (ligne 3 | $db_username = 'root'; )
- mot de passe : ''  (ligne 4 | $db_password = ''; )

Aller dans le dossier décompressé. 

Création d'un serveur local : `php -S localhost:8080` ou `php -S localhost:8080 -t dossier_décompressé`

Pour accéder au site en local : `http://localhost:8080/`
