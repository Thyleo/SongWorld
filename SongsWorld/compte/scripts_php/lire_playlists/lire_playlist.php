<?php
if(!isset($_SESSION)){
  session_start();
}
var_dump($_SESSION);

if(!isset( $_SESSION["musique_actuelle_id"])){
   $_SESSION["musique_actuelle_id"]  = 0;
}


if(!isset($_SESSION["playlist_actuelle"])){ // on initiliase le tableau pour la playlist actuelle
    $_SESSION["playlist_actuelle"] = [];
}



 // $_SESSION["playlist_actuelle"] = [];
$bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");
$recup_musiques_playlist = $bdd->prepare("SELECT * FROM musiques_playlists");
$recup_musiques_playlist->execute([]);

?>

<?php
/*

while ($musique_playlist = $recup_musiques_playlist->fetch()) {
  // on va chercher les infos de la musique
  $infos_musiques = $bdd->prepare("SELECT * from musiques WHERE id = ?");
  $infos_musiques->execute([$musique_playlist["id_musique"]]);

  $musique = $infos_musiques->fetch();
  array_push($_SESSION["playlist_actuelle"], $musique["source"]);



}

*/



?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="jquery.js" charset="utf-8"></script>


  </head>
  <body>
    <i class="fa fa-wifi" style="font-size:48px;color:red"></i>
    <i class="fa fa-arrow-left"  id="leftclick" style="font-size:48px;color:#0088cc"></i>

    <i class="fa fa-arrow-right" id="rightclick" style="font-size:48px;color:red"></i>

      <audio id="player" src="" controls>

      </audio>


<script type="text/javascript">


document.getElementById("player").src = "<?php echo $_SESSION["playlist_actuelle"][ $_SESSION["musique_actuelle_id"] ]; ?>";

$("#rightclick").click(function(){
  $.post( "supprimer_musique_playlist_actuelle.php", {clic: "rightclick"}, function( data ) {
    //alert( data );

    document.getElementById("player").src = data;
    document.getElementById("player").play();



  });


});

$("#leftclick").click(function(){
  $.post( "supprimer_musique_playlist_actuelle.php", {clic: "leftclick"}, function( data ) {
    //alert( data );

    document.getElementById("player").src = data;
    document.getElementById("player").play();



  });


});




</script>


  </body>
</html>
