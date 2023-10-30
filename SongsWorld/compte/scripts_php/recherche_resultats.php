<?php
if(!isset($_SESSION)){
  session_start();
}
  $bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");


  $requete1 = "SELECT * FROM musiques WHERE nom LIKE '%".$_POST['saisie']."%'";
  $requete2 = "SELECT * FROM playlists WHERE nom LIKE '%".$_POST['saisie']."%'";


  $resultat1 = $bdd->prepare($requete1);
  $resultat1->execute([]);


  $resultat2 = $bdd->prepare($requete2);
  $resultat2->execute([]);

$resultat_final = [];

  foreach ($resultat1 as $musique) {
    $musique["type"] = "Musique";
    array_push($resultat_final, $musique);
  }

  foreach($resultat2->fetchAll() as $playlist){
    $playlist["type"] = "Playlist";
    array_push($resultat_final, $playlist);
  }




  if(count($resultat_final) == 0){
    echo "Aucune playlist ou musique trouvée";
 }else{
   $index = 0;
       foreach ($resultat_final as $musique_ou_playlist) {
          if($musique_ou_playlist["type"] == "Musique"){
            echo '<a id="musique_ou_playlist'.$index.'" title="'.$musique_ou_playlist["source"].'"> '. $musique_ou_playlist["nom"] . '</a>' ;
            echo "<br>";
            $index++;
          }elseif ($musique_ou_playlist["type"] == "Playlist" && $musique_ou_playlist["nom_utilisateur"] == $_SESSION["utilisateur"]["pseudo"]) { // remplacer le créateur par la personne connectée
            echo '<a  id="musique_ou_playlist'.$index.'"> '. $musique_ou_playlist["nom"] . '</a>' ;
             echo "<br>";
             $index++;
          }

       }

 }








/*
  if($resultat->rowCount() == 0){
    echo "Aucune playlist ou musique trouvée";
  }else{
      foreach ($resultat as $musique) {
        echo '<a href="'.$musique["source"].'"> '. $musique["nom"] . '</a>' ;
        echo "<br>";
      }
  }
*/
?>
