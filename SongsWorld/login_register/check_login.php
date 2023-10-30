<?php
if(!isset($_SESSION)){
  session_start();
}


if(!isset($_SESSION["utilisateur"])){ // on regarde si l'utilisateur n'est pas connecté
  $_SESSION["erreur"] = "Vous n'avez pas le droit d'accéder à cette page car vous n'êtes pas connecté !";
}
?>
