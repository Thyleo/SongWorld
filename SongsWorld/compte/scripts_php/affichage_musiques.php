<?php
if(!isset($_SESSION)){
  session_start();
}

$bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

$musiques = $bdd->prepare("SELECT * FROM musiques");
$musiques->execute([]);

$nombre_de_lignes = $musiques->rowCount();

$nb = 1;
$liste_musiques = $musiques->fetchAll();




for ($i=0; $i < $nombre_de_lignes; $i++) {

    if($nb == 1 && $i != $nombre_de_lignes - 1){
      echo '<div class="categories">';
          echo '<div class="colonne">';
              echo '<img src="images/pikaVmax.jpg" alt="'.$liste_musiques[$i]["source"].'" title="'.$liste_musiques[$i]["nom"].'"  id="'.$liste_musiques[$i]["id"].'">';

              // on regarde si l'utilisateur a déjà ajouté cette musique à ses favoris.
              $bdd2 = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

              $musiques_favorites = $bdd2->prepare("SELECT * FROM musiques_playlists INNER JOIN playlists ON musiques_playlists.id_playlist = playlists.id WHERE id_utilisateur = ? AND nom = ? AND id_musique = ?");
              $musiques_favorites->execute([$_SESSION["utilisateur"]["id"], "favorisde" . $_SESSION["utilisateur"]["pseudo"], $liste_musiques[$i]["id"]]);

              if($musiques_favorites->rowCount() == 1){
                echo '<p > cette musique fait déjà partie de vos favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/coeur_plein.png" width="10%"; class="icone-favoris"> ';
                echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
              }else{
                echo '<p >ajouter à mes favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/image-coeur-pas-rempli.png" width="25%"; class="icone-favoris"> ';
                echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
              }
              // fin du test si la musique est déjà dans la playlist des favoris de l'utilisateur connecté

              echo '<button onclick="ajouter_musique_playlist('.$liste_musiques[$i]["id"].')">Ajouter à une playlist</button>';




          echo "</div>";
      $nb++;
    }elseif ($nb == 4) {
      echo '<div class="colonne">';
          echo '<img src="images/pikaVmax.jpg" alt="'.$liste_musiques[$i]["source"].'" title="'.$liste_musiques[$i]["nom"].'" id="'.$liste_musiques[$i]["id"].'">';

          // on regarde si l'utilisateur a déjà ajouté cette musique à ses favoris.
          $bdd2 = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

          $musiques_favorites = $bdd2->prepare("SELECT * FROM musiques_playlists INNER JOIN playlists ON musiques_playlists.id_playlist = playlists.id WHERE id_utilisateur = ? AND nom = ? AND id_musique = ?");
          $musiques_favorites->execute([$_SESSION["utilisateur"]["id"], "favorisde" . $_SESSION["utilisateur"]["pseudo"], $liste_musiques[$i]["id"]]);


          if($musiques_favorites->rowCount() == 1){
            echo '<p > cette musique fait déjà partie de vos favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/coeur_plein.png" width="10%"; class="icone-favoris">';
            echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
          }else{
            echo '<p >ajouter à mes favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/image-coeur-pas-rempli.png" width="25%"; class="icone-favoris"> ';
            echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
          }
          // fin du test si la musique est déjà dans la playlist des favoris de l'utilisateur connecté

          echo '<button onclick="ajouter_musique_playlist('.$liste_musiques[$i]["id"].')">Ajouter à une playlist</button>';



      echo "</div>";
        echo "</div>"; //je ferme la div categories
      $nb = 1;
    }elseif ($i == $nombre_de_lignes - 1 && $nb != 1) { // si on est sur la dernière ligne
      echo '<div class="colonne">';
          echo '<img src="images/pikaVmax.jpg" alt="'.$liste_musiques[$i]["source"].'" title="'.$liste_musiques[$i]["nom"].'" id="'.$liste_musiques[$i]["id"].'">';

          // on regarde si l'utilisateur a déjà ajouté cette musique à ses favoris.
          $bdd2 = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

          $musiques_favorites = $bdd2->prepare("SELECT * FROM musiques_playlists INNER JOIN playlists ON musiques_playlists.id_playlist = playlists.id WHERE id_utilisateur = ? AND nom = ? AND id_musique = ?");
          $musiques_favorites->execute([$_SESSION["utilisateur"]["id"], "favorisde" . $_SESSION["utilisateur"]["pseudo"], $liste_musiques[$i]["id"]]);


          if($musiques_favorites->rowCount() == 1){
            echo '<p > cette musique fait déjà partie de vos favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/coeur_plein.png" width="10%"; class="icone-favoris"> ';
            echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
          }else{
            echo '<p >ajouter à mes favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/image-coeur-pas-rempli.png" width="25%"; class="icone-favoris"> ';
            echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
          }
          // fin du test si la musique est déjà dans la playlist des favoris de l'utilisateur connecté

          echo '<button onclick="ajouter_musique_playlist('.$liste_musiques[$i]["id"].')">Ajouter à une playlist</button>';



      echo "</div>";
      echo "</div>"; // je ferme la div categories même si elle ne comporte pas 4 éléments


    }elseif ($i == $nombre_de_lignes - 1 && $nb == 1) { // si on est sur la dernière ligne

      echo '<div class="categories">';
      echo '<div class="colonne">';
          echo '<img src="images/pikaVmax.jpg" alt="'.$liste_musiques[$i]["source"].'" title="'.$liste_musiques[$i]["nom"].'" id="'.$liste_musiques[$i]["id"].'">';

          // on regarde si l'utilisateur a déjà ajouté cette musique à ses favoris.
          $bdd2 = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

          $musiques_favorites = $bdd2->prepare("SELECT * FROM musiques_playlists INNER JOIN playlists ON musiques_playlists.id_playlist = playlists.id WHERE id_utilisateur = ? AND nom = ? AND id_musique = ?");
          $musiques_favorites->execute([$_SESSION["utilisateur"]["id"], "favorisde" . $_SESSION["utilisateur"]["pseudo"], $liste_musiques[$i]["id"]]);


          if($musiques_favorites->rowCount() == 1){
            echo '<p > cette musique fait déjà partie de vos favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/coeur_plein.png" width="10%"; class="icone-favoris"> ';
            echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
          }else{
            echo '<p >ajouter à mes favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/image-coeur-pas-rempli.png" width="25%"; class="icone-favoris"> ';
            echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
          }
          // fin du test si la musique est déjà dans la playlist des favoris de l'utilisateur connecté

          echo '<button onclick="ajouter_musique_playlist('.$liste_musiques[$i]["id"].')">Ajouter à une playlist</button>';


      echo "</div>";
      echo "</div>"; // je ferme la div categories même si elle ne comporte pas 4 éléments
    }

    else{
      echo '<div class="colonne">';
      echo '<img src="images/pikaVmax.jpg" alt="'.$liste_musiques[$i]["source"].'" title="'.$liste_musiques[$i]["nom"].'" id="'.$liste_musiques[$i]["id"].'">';

      // on regarde si l'utilisateur a déjà ajouté cette musique à ses favoris.
      $bdd2 = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

      $musiques_favorites = $bdd2->prepare("SELECT * FROM musiques_playlists INNER JOIN playlists ON musiques_playlists.id_playlist = playlists.id WHERE id_utilisateur = ? AND nom = ? AND id_musique = ?");
      $musiques_favorites->execute([$_SESSION["utilisateur"]["id"], "favorisde" . $_SESSION["utilisateur"]["pseudo"], $liste_musiques[$i]["id"]]);


      if($musiques_favorites->rowCount() == 1){
        echo '<p > cette musique fait déjà partie de vos favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/coeur_plein.png" width="10%"; class="icone-favoris"> ';
        echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
      }else{
        echo '<p >ajouter à mes favoris </p> <img id="ajouter_favoris'.$liste_musiques[$i]["id"].'" title="'.$liste_musiques[$i]["id"].'" src="images/image-coeur-pas-rempli.png" width="25%"; class="icone-favoris"> ';
        echo '<p> <a href="../messagerie/tchat.php?id_playlist='.$liste_musiques[$i]["id"].'">partager cette musique </a> </p>';
      }
      // fin du test si la musique est déjà dans la playlist des favoris de l'utilisateur connecté

      echo '<button onclick="ajouter_musique_playlist('.$liste_musiques[$i]["id"].')">Ajouter à une playlist</button>';


      echo "</div>";
      $nb++;
    }

}

?>



<script type="text/javascript">
  var nombre_de_musiques;
  nombre_de_musiques = <?php echo $nombre_de_lignes; ?>;

  for (var i = 1; i < nombre_de_musiques + 1; i++) {
        document.getElementById(i).onclick = function(){
            type_musique = "musique";
        //console.log(this.alt);
        document.getElementById("audio").src = this.alt;
        document.getElementById("titre_musique_actuelle").innerHTML = this.title;
        document.getElementById("audio").play();
        play = 1;
        document.getElementById("button").innerHTML = "Pause";
        document.getElementById("audio").currentTime = 0;
        document.getElementById("timer").value = 0;
        y_a_t_il_une_musique = 1;
      }

  }


  // ajouter une musique à sa playlist par défaut
  for (var k = 1; k < nombre_de_musiques + 1; k++) {
        document.getElementById("ajouter_favoris" + k).onclick = function(){
          //  console.log(this.title);
          var id_musique = this.title;
            $.post( "scripts_php/add_musique_playlist.php", { id_musique: this.title }).done(function( data ) {
              //  console.log(data);
                //$("body").append(data);
                console.log(data);
                document.getElementById("ajouter_favoris" + id_musique).src = "images/coeur_plein.png";

            });
      }

  }

</script>
