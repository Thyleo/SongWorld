<?php
if(!isset($_SESSION)){
  session_start();
}

$bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

$get_playlist_defaut = $bdd->prepare("SELECT * FROM playlists WHERE nom = ? AND nom_utilisateur = ?");
$nom_playlist_defaut = "favorisde" . $_SESSION["utilisateur"]["pseudo"];
$get_playlist_defaut->execute([$nom_playlist_defaut, $_SESSION["utilisateur"]["pseudo"]]);

$id_playlist = $get_playlist_defaut->fetch()["id"];



$playlists = $bdd->prepare("INSERT INTO musiques_playlists SET id_musique = ?, id_playlist = ?, id_utilisateur = ?");
$playlists->execute([ $_POST["id_musique"], $id_playlist, $_SESSION["utilisateur"]["id"] ]);


echo "Musique bien ajoutée à la playlist " . $nom_playlist_defaut;


?>
