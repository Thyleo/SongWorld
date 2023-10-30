<?php
if(!isset($_SESSION)){
  session_start();
}

$bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

// On regarde si l'utilisateur connecté n'a pas déjà une playlist avec ce nom
$check = $bdd->prepare("SELECT * FROM playlists WHERE nom = ? AND nom_utilisateur = ?");
$check->execute([$_POST["nom_playlist"], $_SESSION["utilisateur"]["pseudo"]]);

if($check->rowCount() == 1)
{
  echo "Vous avez déjà une playlist avec ce nom";
}
else
{
  $creer_playlist = $bdd->prepare("INSERT INTO playlists SET nom = ?, nom_utilisateur = ?");
  $creer_playlist->execute([ $_POST["nom_playlist"], $_SESSION["utilisateur"]["pseudo"] ]);

  echo "Playlist " . '"' . $_POST['nom_playlist']  . '"' . " créée avec succés !";
}



?>
