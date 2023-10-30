var nom_musique_ou_playlist_actuelle;

$("#champText").keyup(function(){
    //console.log($(this).val());
    var texte = $(this).val();

  if($(this).val().length >= 3){ // si la recherche comporte plus de 3 caractères
      $.post( "./scripts_php/recherche_resultats.php", { saisie: texte }).done(function( data ) {
          $("#listeChampText").html("");
          document.getElementById('listeChampText').style.visibility="visible";
          $("#listeChampText").append(data);

          var nombre_musiques_ou_playlists = document.getElementById('listeChampText').children.length / 2;

          for (var i = 0; i < nombre_musiques_ou_playlists; i++) {
              $("#musique_ou_playlist" + i).click(function(){
                  console.log(this.id);
                  nom_musique_ou_playlist_actuelle = $(this).html();
                  $("#champText").val( $(this).html() );
                  $("#champText").attr("title", this.title );
              });
          }

      });
  }else{
    $("#listeChampText").html("");
    document.getElementById('listeChampText').style.visibility="hidden";
  }


});

$("#BOK").click(function(){
    //console.log(document.getElementById("champText").title);
    $("#listeChampText").html("");
    document.getElementById('listeChampText').style.visibility="hidden";

    document.getElementById("audio").src = document.getElementById("champText").title;
    document.getElementById("audio").play();
    play = 1;
    y_a_t_il_une_musique = 1;
    document.getElementById("button").innerHTML = "Pause";
    document.getElementById("titre_musique_actuelle").innerHTML = nom_musique_ou_playlist_actuelle;

});
