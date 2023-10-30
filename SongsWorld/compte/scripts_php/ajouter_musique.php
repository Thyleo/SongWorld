

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>


    <form enctype="multipart/form-data"  method="post">
      <input type="hidden" name="MAX_FILE_SIZE" value="30000000000" />
      Nom de la musique : <input type="text" name="nom_musique" value="">
      Envoyez ce fichier : <input name="userfile" type="file"  multiple="multiple"/>
      <input type="submit" value="Envoyer le fichier" />
    </form>



    <?php



        function genererChaineAleatoire($longueur)
    {
     $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $longueurMax = strlen($caracteres);
     $chaineAleatoire = '';
     for ($i = 0; $i < $longueur; $i++)
     {
     $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
     }
     return $chaineAleatoire;
    }
    //Utilisation de la fonction
    //echo genererChaineAleatoire(5);


    $uploaddir = '../uploads/';

    $bdd = new PDO("mysql:host=localhost;dbname=songs_world", "root", "");

$nom_aleatoire = genererChaineAleatoire(5);

    $uploadfile = $uploaddir . $nom_aleatoire . ".mp3";

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "Le fichier est valide, et a été téléchargé
               avec succès. Voici plus d'informations :\n";

               echo "<a href='../uploads/".$nom_aleatoire.".mp3'> voir le fichier </a> ";

               $upload_bdd_fichier = $bdd->prepare("INSERT INTO musiques SET nom = ?, source = ?");
               $source = "uploads/" .  $nom_aleatoire . ".mp3";
          //     $upload_bdd_fichier->execute([$_FILES['userfile']['name'], $source]);
               $upload_bdd_fichier->execute([$_POST["nom_musique"], $source]);


    }else{
      echo "erreur";
    }








    ?>

  </body>
</html>
