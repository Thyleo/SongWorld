<?php
if(!isset($_SESSION)){
  session_start();
}
$bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");



// Avant d'insérer la musique dans la playlist choisie par l'utilisateur, il faut regarder que la musique ne soit pas déjà dans sa playlist.
$requete_verif = 'SELECT COUNT(*) AS verif FROM musiques_playlists WHERE id_musique = ? AND id_playlist = ? AND id_utilisateur = ?';
$verif = $bdd->prepare($requete_verif);
$verif->execute([$_POST["id_musique"], $_POST["id_playlist"], $_SESSION["utilisateur"]["id"]]);

if($verif->fetch()["verif"] == 1){
  echo "Erreur, cette musique est déjà dans votre playlist.";
}else{ // sinon j'ajoute la musique dans la playlist de l'utilisateur
  $requete = 'INSERT INTO musiques_playlists SET id_musique = ?, id_playlist = ?, id_utilisateur = ?';

  $resultat = $bdd->prepare($requete);
  $resultat->execute([$_POST["id_musique"], $_POST["id_playlist"], $_SESSION["utilisateur"]["id"]]);

  echo "Cette musique a bien été ajoutée à votre playlist.";

}






?>
