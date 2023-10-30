<?php
if(!isset($_SESSION)){
  session_start();
}

if(isset($_GET["page"])){
  $route = $_GET["page"];
}elseif(!isset($_GET["page"]) && isset($_SESSION["utilisateur"])){
  header("Location: ../compte/index.php");
}else{
  header("Location: ../accueil/index.html");
}

switch (variable) {
  case 'nouveauMessage':
    include "controller/messagerieController.php";
    nouveauMessage($_GET["id_playlist"]);
    break;

  case 'afficheTchat':
    include "controller/messagerieController.php";
    afficheTchat();
    break;

  default:

    break;
}


?>
