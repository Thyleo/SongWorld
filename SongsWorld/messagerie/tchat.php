<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V13</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main2.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
    .mess{
	padding:40px;
	background-color: white;
    width:fit-content;
    border-radius:20px;
    z-index:99;
    display:inline-block;
    }
    .contain-mess{
        width:100%-520px;
        text-align:right;
        padding:30px;
    }
</style>
</head>
<body style="background-color: #999999;" >

	<div  id="myDiv" class="animate-bottom" >

		<div class="container-login100">
			<div class="login100-more">
                <?php
                     $bdd = new PDO('mysql:host=127.0.0.1;dbname=songs_world', 'root', '');
                    // récupérer tous les utilisateurs

                    $sql = "SELECT * FROM messages";
                    try{
                    $stmt = $bdd->query($sql);

                    if($stmt === false){
                        die("Erreur");
                    }

                    }catch (PDOException $e){
                        echo $e->getMessage();
                    }
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="contain-mess">
                <div class='mess'><?php echo htmlspecialchars($row['message']); ?></div>
                    </div>
                <?php
                    }
                ?>

            </div>
			<a href="accueil.php" class="icone">
				<i class="fa fa-home"></i>
			</a>
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title">
						Partage de playList
					</span>

					<div class="wrap-input100 validate-input" data-validate="Nom d'utilisateur requis">
						<span class="label-input100">Entrer le pseudo</span>
						<input class="input100" type="text" name="pseudo" placeholder="Pseudo...." >
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="formconnexion" type="submit">
								Envoyer
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php
		session_start();
        date_default_timezone_set('Europe/Paris');

        $bdd = new PDO('mysql:host=127.0.0.1;dbname=songs_world', 'root', '');
        if(isset($_POST['formconnexion'])) {
            $_SESSION['id_play']="1";
            $_SESSION['url']="www.cedricestlemeilleur.com";
            $pseudo = htmlspecialchars($_POST["pseudo"]);
            $url = $_SESSION["utilisateur"]["pseudo"] . " vous a partagé sa playlist voici l'id : " . $_GET["id_playlist"];
            $expediteur_id = $_SESSION["utilisateur"]['id'];
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=songs_world', 'root', '');
            $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
			$requser->execute(array($pseudo));
			$userexist = $requser->rowCount();
            if(!empty($_POST['pseudo'])) {
                if($userexist == 1) {
                    $insertmbr = $bdd->prepare("INSERT INTO  messages(expediteur_id, recepteur_id, id_Playlist, message, Date_mess) VALUES(?, ?, ?, ?,?)");

                    $insertmbr->execute(array($expediteur_id, $requser->fetch()["id"], $_GET["id_playlist"] , $url, date('d-m-y H:i:s')));
                    $erreur = "Votre compte a bien été créé !";
                }else{
                    $erreur="On ne vous connait pas!!!!";
                }
            } else {
                $erreur = "Votre compte n'a pas bien été créé !";
            }
        }
			?>

<?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font><br>";
         }
    ?>
  </div>

</body>
</html>
