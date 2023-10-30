function sidebarBtn(){
  document.getElementById('contenu').classList.toggle('contenu-actif');
  document.getElementById('contenu_defaut').classList.toggle('contenu-actif');
  document.getElementById('sidebar').classList.toggle('active');   //ClassList retourne une liste des atributs de class de l'élément.     //.toggle active ou désactive js
}


var bt1=new Image();
var bt2=new Image();
var img1=new Image();
var img2= new Image();
bt1.src="images/Capture.png";
bt2.src="images/imageN2.png";
img1.src="images/rechercher2.png";
img2.src="images/rechercher.png";

function ChgMenu(){
document.images.menu.src=bt1.src;
}

function RtblMenu2(){
document.images.menu.src=bt2.src;
}

function search1(){
  document.images.recherche.src=img1.src;
}
function search2(){
  document.images.recherche.src=img2.src;
}


var cpt=0;

function BarRecherche(){
  if (cpt==0) {
    document.getElementById('champText').style.visibility = "visible";
    document.getElementById('BOK').style.visibility = "visible";
    cpt=1;
  } else {
    document.getElementById('champText').style.visibility = "hidden";
    document.getElementById('BOK').style.visibility = "hidden";
    cpt=0;
  }
}









// PARTIE THOMAS (lecteur + fonctions diverses)

// lecteur

// on initialise le son à 50% & le timer à 0;
document.getElementById("audio").volume = .5;
document.getElementById("volume").value = 50;
document.getElementById("timer").value = 0
document.getElementById("audio").currentTime = 0;



var play = 0;
var y_a_t_il_une_musique = 0;
document.getElementById("button").onclick = function(){


  if(y_a_t_il_une_musique != 0){ // on regarde si le player a une source ou non, si il n'a pas de source alors il est imposssible pour l'utilisateur de cliquer sur play/pause

      if(play == 0){
        document.getElementById("audio").play();
        play = 1;
        this.innerHTML = "Pause";
      }else{
        document.getElementById("audio").pause();
        play = 0;
        this.innerHTML = "Jouer";
      }
  }





}


document.getElementById("bouton_stop").onclick = function(){
  play = 0;
  document.getElementById("audio").pause();
  document.getElementById("audio").currentTime = 0;
  document.getElementById("timer").value = 0;
  document.getElementById("button").innerHTML = "Play";
}


document.getElementById("audio").ontimeupdate = function() {

  if(document.getElementById("audio").currentTime == document.getElementById("audio").duration){
    document.getElementById("audio").currentTime = 0;
    document.getElementById("timer").value = 0;

      if(type_musique !=null  && type_musique == "playlist"){
        console.log("oui");
              // simulation du clic DROIT
              $.post( "./scripts_php/lire_playlists/supprimer_musique_playlist_actuelle.php", {clic: "rightclick"}, function( data ) {
                //alert( data );

                document.getElementById("audio").src = data;
                document.getElementById("audio").play();
              });

      }
  }


    document.getElementById("timer").max = document.getElementById("audio").duration;
    document.getElementById("timer").value = document.getElementById("audio").currentTime;

    console.log(document.getElementById("audio").currentTime / document.getElementById("audio").duration);

// ajouter la couleur d'arrière plan à la barre du timer

 if ((document.getElementById("audio").currentTime / document.getElementById("audio").duration ) >= 0 && (document.getElementById("audio").currentTime / document.getElementById("audio").duration ) < 0.25) {
  document.getElementById("timer").classList.remove("soixante-quinze-pourcent", "cinquante-pourcent", "vingt-cinq-pourcents", "cent-pourcent");
  document.getElementById("timer").classList.add("vingt-cinq-pourcent");

} else if ((document.getElementById("audio").currentTime / document.getElementById("audio").duration ) >= 0.25 && (document.getElementById("audio").currentTime / document.getElementById("audio").duration ) < 0.5) {
   document.getElementById("timer").classList.remove("soixante-quinze-pourcent", "cinquante-pourcent", "vingt-cinq-pourcents", "cent-pourcent");
    document.getElementById("timer").classList.add("cinquante-pourcent");

}else if ((document.getElementById("audio").currentTime / document.getElementById("audio").duration ) >= 0.5 && (document.getElementById("audio").currentTime / document.getElementById("audio").duration ) < 0.75) {
     document.getElementById("timer").classList.remove("soixante-quinze-pourcent", "cinquante-pourcent", "vingt-cinq-pourcents", "cent-pourcent");
      document.getElementById("timer").classList.add("soixante-quinze-pourcent");
}else if ((document.getElementById("audio").currentTime / document.getElementById("audio").duration ) >= 0.75 && (document.getElementById("audio").currentTime / document.getElementById("audio").duration ) < 1) {
       document.getElementById("timer").classList.remove("soixante-quinze-pourcent", "cinquante-pourcent", "vingt-cinq-pourcents", "cent-pourcent");
       document.getElementById("timer").classList.add("cent-pourcent");

}

};

var repeter = 0;
document.getElementById("bouton_repeter").onclick = function(){
  if(repeter == 0){
      document.getElementById("bouton_repeter").innerHTML = "Répéter ON";
      document.getElementById("bouton_repeter").style.background = "red";
      document.getElementById("audio").loop = true;
      repeter = 1;
  }else{
    document.getElementById("bouton_repeter").innerHTML = "Répéter OFF";
    document.getElementById("bouton_repeter").style.background = "blue";
    document.getElementById("audio").loop = false;
    repeter = 0;
  }
}

document.getElementById("timer").oninput = function() {
  document.getElementById("audio").currentTime = document.getElementById("timer").value;
}

document.getElementById("volume").oninput = function(){
  document.getElementById("audio").volume = document.getElementById("volume").value / 100;
}


function ajouter_musique_playlist(id){
  console.log("id musique : " + id); // affichage de l'id de la musique sur laquelle on a cliqué

  document.getElementById("div-test").style.display = "block";
  document.getElementById("div-test").style.zIndex = "1";


      $.post( "./scripts_php/get_playlists_utilisateur.php").done(function( data ) { // on affiche le popup pour choisir la playlist
        //  alert(data);
          $("#div-test").html(""); // on vide le contenu de la div avant d'afficher toutes les playlists
          $("#div-test").append(data);

          $("#div-test").append("<p id='fermer_l'>Fermer la div</p>");

          document.getElementById("fermer_l").onclick = function(){
                this.style.display = "none";
                this.style.zIndex = "auto";
                document.getElementById("div-test").style.display = "none";
                document.getElementById("div-test").style.zIndex = "auto";
          }

          var nb_playlists;
            $.post( "./scripts_php/nb_playlists.php").done(function( compteur_nb_playlists ) {
                nb_playlists = parseInt(compteur_nb_playlists);

                  for (var b = 1; b < nb_playlists + 1; b++) {
                        if(document.getElementById("playlist_id" + b) != null){
                                  document.getElementById("playlist_id" + b).onclick = function(){ // on choisit la playlist et on ajoute la musique à cette playlist
                                    //  alert(this.title);

                                    console.log(b);

                                        $.post( "./scripts_php/ajouter_musique_playlist.php", { id_playlist: this.title, id_musique: id }).done(function( data ) {
                                            document.getElementById("div-test").style.display = "none";
                                            document.getElementById("div-test").style.zIndex = "0";
                                            alert(data);
                                        });

                                }
                          }
                  }
            });


  });




}



// Partie clic boutons musique / mes playlists
var choix1 = 1;
var choix2 = 0;
$("#choix1").click(function(){
  if(choix2 = 1){
    choix2 = 0;
    choix1 = 1;
    $("#choix1").css("border", "3px solid black");
    $("#choix2").css("border", "none");
  }

  $("#contenu").html("");
  document.getElementById("contenu").style.zIndex = "0";

  $.post("./scripts_php/affichage_musiques.php").done(function(data){
       document.getElementById("contenu_defaut").style.zIndex = "1";
      $("#contenu_defaut").html(data);
  });


});


$("#choix2").click(function(){
  if(choix1 = 1){
    choix1 = 0;
    choix2 = 1;
    $("#choix2").css("border", "3px solid black");
    $("#choix1").css("border", "none");
  }

  $("#contenu_defaut").html("");
    document.getElementById("contenu_defaut").style.zIndex = "0";

  $.post("./scripts_php/get_playlists_utilisateur2.php").done(function(data){
      //console.log(data);
      document.getElementById("contenu").style.zIndex = "1";
      $("#contenu").html(data);

      $.post( "./scripts_php/nb_playlists.php").done(function( compteur_nb_playlists ) {
        var nb_p =  parseInt(compteur_nb_playlists);


/*
           for (var i = 0; i < nb_p + 1; i++) {
             $("#playlistnumero" + 4).click(function(){
               alert(this.id);
             });

                  if(document.getElementById("playlistnumero" + i) != null){
                    document.getElementById("playlistnumero" + i).click = function(){
                          alert("playlistnumero" + this.id);
                    }
                  }
           }

           */

      });

  });


});



















$("#rightclick").click(function(){
  $.post( "./scripts_php/lire_playlists/supprimer_musique_playlist_actuelle.php", {clic: "rightclick"}, function( data ) {
    //alert( data );

    document.getElementById("audio").src = data;
    document.getElementById("audio").play();



  });

  $.post("./scripts_php/lire_playlists/recup_nom_mus_actuelle.php").done(function(nom_musique){

    document.getElementById("titre_musique_actuelle").innerHTML = nom_musique;
  });


});

$("#leftclick").click(function(){
  $.post( "./scripts_php/lire_playlists/supprimer_musique_playlist_actuelle.php", {clic: "leftclick"}, function( data ) {
    //alert( data );

    document.getElementById("audio").src = data;
    document.getElementById("audio").play();



  });

  $.post("./scripts_php/lire_playlists/recup_nom_mus_actuelle.php").done(function(nom_musique){

    document.getElementById("titre_musique_actuelle").innerHTML = nom_musique;
  });


});
