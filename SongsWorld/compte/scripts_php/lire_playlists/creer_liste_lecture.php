<?php
if(!isset($_SESSION)){
  session_start();
}

unset($_SESSION["playlist_actuelle"]);
unset($_SESSION["musique_actuelle_id"]);

if(!isset( $_SESSION["musique_actuelle_id"])){
   $_SESSION["musique_actuelle_id"]  = 0;
}


if(!isset($_SESSION["playlist_actuelle"])){ // on initiliase le tableau pour la playlist actuelle
    $_SESSION["playlist_actuelle"] = [];
}

if(!isset($_SESSION["noms_musiques_playlist"])){ // on initiliase le tableau pour la playlist actuelle
    $_SESSION["noms_musiques_playlist"] = [];
}





 // $_SESSION["playlist_actuelle"] = [];
$bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");
$recup_musiques_playlist = $bdd->prepare("SELECT * FROM musiques_playlists WHERE id_playlist = ? ORDER BY id ASC");
$recup_musiques_playlist->execute([$_POST["id_playlist"]]);




while ($musique_playlist = $recup_musiques_playlist->fetch()) {
  // on va chercher les infos de la musique
  $infos_musiques = $bdd->prepare("SELECT * from musiques WHERE id = ?");
  $infos_musiques->execute([$musique_playlist["id_musique"]]);

  $musique = $infos_musiques->fetch();
  array_push($_SESSION["playlist_actuelle"], $musique["source"]);
  array_push($_SESSION["noms_musiques_playlist"], $musique["nom"]);
}

echo $_SESSION["playlist_actuelle"][ $_SESSION["musique_actuelle_id"] ];

?>
