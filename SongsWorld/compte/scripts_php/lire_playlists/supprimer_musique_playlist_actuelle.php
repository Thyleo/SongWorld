<?php
if(!isset($_SESSION)){
  session_start();
}

if($_POST["clic"] == "rightclick")
{
  if($_SESSION["musique_actuelle_id"] == count($_SESSION["playlist_actuelle"]) - 1){ // si la musique actuelle est la dernière de la playlist alors on recommence à la première musique
    $_SESSION["musique_actuelle_id"] = 0;
  }else{
    $_SESSION["musique_actuelle_id"] = $_SESSION["musique_actuelle_id"] + 1;
  }

  echo  $_SESSION["playlist_actuelle"][ $_SESSION["musique_actuelle_id"] ];
}

elseif ($_POST["clic"] == "leftclick")
{
  if($_SESSION["musique_actuelle_id"] -1 == -1){
    $_SESSION["musique_actuelle_id"] = count($_SESSION["playlist_actuelle"]) - 1; // on affecte la dernière musique
  }else{
    $_SESSION["musique_actuelle_id"] = $_SESSION["musique_actuelle_id"] - 1;
  }

  echo  $_SESSION["playlist_actuelle"][ $_SESSION["musique_actuelle_id"] ];
}



?>
