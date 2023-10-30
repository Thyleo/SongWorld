<?php
if(!isset($_SESSION)){
  session_start();
}

$bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

$requete = 'SELECT * FROM playlists WHERE nom_utilisateur = "'.$_SESSION["utilisateur"]["pseudo"].'"';

$resultat = $bdd->prepare($requete);
$resultat->execute([]);

while ($res = $resultat->fetch()) {
  echo '<p id="playlist_id'.$res["id"].'" title="'.$res["id"].'"> '.$res["nom"].' </p>';
}


?>
