var deplié = 0;
  $("#nouvelle_playlist").click(function(){
    if(deplié == 0){
      $("#sidebar2").append('<input type="text" name="" value="" placeholder="Entrez le nom de la playlist" id="nom_playlist">');
      $("#sidebar2").append('  <button type="button" id="creer_playlist"> Créer playlist </button>');
      $("#nouvelle_playlist").html("-");
      deplié = 1;

      $("#creer_playlist").click(function(){

            $.post( "./scripts_php/creer_playlist.php", { nom_playlist: $("#nom_playlist").val() }).done(function( data ) {
                //  alert( "Data Loaded: " + data );
                $("#sidebar2").append('<p id="retourphp"></p>');
                $("#retourphp").html(data);
                $("#nom_playlist").val("");

                    setTimeout(afficher_retour, 2000);

                    function afficher_retour(){

                      $("#retourphp").remove();
                    }

            });
      });

    }else{
      $("#nom_playlist").remove();
      $("#creer_playlist").remove();
      $("#nouvelle_playlist").html("Créer playlist");
      deplié = 0;
    }
  });
