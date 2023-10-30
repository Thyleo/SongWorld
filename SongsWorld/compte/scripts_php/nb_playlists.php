<?php
if(!isset($_SESSION)){
  session_start();
}
$bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");


$nb = $bdd->prepare("SELECT COUNT(*) AS nb_playlists FROM playlists WHERE nom_utilisateur = ?");
$nb->execute([$_SESSION["utilisateur"]["pseudo"]]);

echo $nb->fetch()["nb_playlists"];


?>
