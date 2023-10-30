<?php
include "./model/bdd.php";


function nouveauMessage()
{
  $bdd = new BaseDonnees();
  $messages = $bdd->req("SELECT * FROM messages", array());
}


function afficheTchat()
{

}

?>
