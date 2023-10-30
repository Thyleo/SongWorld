<?php
if(!isset($_SESSION)){
  session_start();
}



echo $_SESSION["noms_musiques_playlist"][ $_SESSION["musique_actuelle_id"] ];

?>
