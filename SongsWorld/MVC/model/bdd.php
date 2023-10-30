<?php

class BaseDonnees
{

    private $connexion;

    function __construct()
    {
      $this->connexion = new PDO('mysql:host=localhost;dbname=songs_world', 'root', '');
    }

    function req($requete, $parametres)
    {
        $requete = $this->connexion->prepare($requete);
        $requete->execute($parametres);

        return $requete->fetchAll();

    }

}

?>
