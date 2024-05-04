<?php
    $hostname= "localhost"; //nom du serveur (localhost)
    $username= "root";//nom d'utilisateur pour accéder au serveur (root)
    $password= "root"; //mot de passe pour accéder au serveur (root)
    $dbname= "minasyan"; //nom de la base de données

    //on se connecte à la bdd
    $connexion = mysqli_connect($hostname, $username, $password, $dbname);
    //verification de la connexion
    if (!$connexion) {
        die('Erreur :' .mysqli_connect_errno());
    }
?>