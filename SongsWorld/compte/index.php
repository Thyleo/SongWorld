<?php
if(!isset($_SESSION)){
  session_start();
}


unset($_SESSION["playlist_actuelle"]);
unset($_SESSION["musique_actuelle_id"]);


// on regarde si l'utilisateur est connecté sinon on le renvoie à la page de connexion
if(!isset($_SESSION["utilisateur"])){
  $_SESSION["erreur"] = "Vous n'avez pas le droit d'accéder la page du compte sans être connecté  !";
  header("Location: ../login_register/connexion.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sidebar2.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/player.css">
    <link rel="stylesheet" href="css/css_thomas.css">
    <link rel="stylesheet" href="css/creer_playlist.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="js/jquery.js" charset="utf-8"></script>

    <title>Song's World</title>
  </head>


  <body>


<!-- partie barre de navigation -->
              <div class="navBar">
                <img onmouseover="ChgMenu()" onmouseout="RtblMenu2()" src="images/imageN2.png"  id="menu" onclick="sidebarBtn()" >
                  <p class="Titre">
                      Song's World
                  </p>
                    <input type="text" id="champText" placeholder="Tapez ici votre recherche">
                    <button type="button" id="BOK">Ok</button>

                    <div id="listeChampText"></div>

                  <img onmouseover="search1()" onmouseout="search2()" src="images/rechercher.png" alt="Oops...erreur" id="recherche" onclick="BarRecherche()">

                  <p id="nom_utilisateur">  <?php  if(isset($_SESSION["utilisateur"])){ echo "Bonjour " . $_SESSION["utilisateur"]["pseudo"]; } ?></p>

                  <button type="button" id="deconnexion" name=""> <a href="../login_register/deconnexion.php"> <?php  if(isset($_SESSION["utilisateur"])){ echo "Se déconnecter"; } ?> </a> </button>
              </div>
<!-- fin de la partie barre de navigation -->



              <div id="sidebar">
                    <div class="listeDeroulante" >
                      <ul>
                        <br>
                        <li> <a href="#" id="accueil" >Accueil</a></li><br>
                        <li><a href="index.html" id="nouveaute" >Nouveauté</a></li><br>
                        <li><a href="../Page_de_podium/podium.html" >Podium</a></li><br>
                        <li><a href="index.html" id="parametre" >Parametre</a></li><br>
                        <li><a href="index.html" id="contact" >Contactez-nous</a></li><br>
                      </ul>
                    </div>
              </div>

              <div id="boutons_choix">
                  <button type="button"  id="choix1" name="button">Musiques</button>
                  <button type="button"  id="choix2" name="button">Mes playlists</button>
              </div>


              <div id="contenu">
              </div>

              <div id="contenu_defaut">
              <?php include "scripts_php/affichage_musiques.php"; ?>
              </div>




              <div id="sidebar2">
                  <p> <a href="#"> Voir toutes mes playlists </a></p>
                  <p> <a href="scripts_php/ajouter_musique.php"> Ajouter une musique </a></p>
                  <p> <a href="../login_register/connexion2.php?id=<?php echo $_SESSION["utilisateur"]['id']; ?>"> Gérer mon compte </a></p>
                  <button type="button" id="nouvelle_playlist"> Créer playlist </button>

              </div>

              <div id="div-test">

              </div>


              <script type="text/javascript">


var type_musique;
              function lireplaylist(id){
                //alert(id);

                $("#leftclick").show();
                $("#rightclick").show();

                play = 1;
                document.getElementById("button").innerHTML = "Pause";
                document.getElementById("audio").currentTime = 0;
                document.getElementById("timer").value = 0;
                y_a_t_il_une_musique = 1;



                type_musique = "playlist";

                $.post("./scripts_php/lire_playlists/creer_liste_lecture.php", {id_playlist : id}).done(function(donnees){
                  console.log("playlist chargée");
                //  console.log(donnees);
                  document.getElementById("audio").src = donnees;
                  document.getElementById("audio").play();
                });


                $.post("./scripts_php/lire_playlists/recup_nom_mus_actuelle.php").done(function(nom_musique){

                  document.getElementById("titre_musique_actuelle").innerHTML = nom_musique;
                });


              }
              </script>



              <?php include "scripts_php/player.php"; ?>

    <script src="js/main.js" charset="utf-8"></script>
    <script src="js/recherche.js" charset="utf-8"></script>
    <script src="js/creer_playlist.js" charset="utf-8"></script>


  </body>
</html>
