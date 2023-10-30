<?php
if(!isset($_SESSION)){
  session_start();
}


if(isset($_SESSION["erreur"])){ // si il y a une erreur en session on l'affiche puis on la supprime
  echo $_SESSION["erreur"];
  unset($_SESSION["erreur"]);
}

?>
