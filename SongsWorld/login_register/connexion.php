<?php
if(!isset($_SESSION)){
  session_start();
}

if(isset($_SESSION["utilisateur"])){ // on regarde si l'utilisateur n'est pas connecté
  // $_SESSION["erreur"] = "Vous n'avez pas le droit d'accéder à cette page  !";
  header("Location: ../compte/index.php");
}

include "check__not_login.php";
include "erreur.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login V13</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main2.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body style="background-color: #999999;"  onload="myFunction()">
	<div id="loader">
		<div class="gradient-background">

			<div class="disc spin">
				<div class="disc-reflection-left">
				</div>
				<div class="disc-reflection-right">
				</div>
				<div class="disc-groove">
				</div>
				<div class="label ">
					<div class="disc-font disc-title">
						Song's World
					</div>
					<div class="disc-font disc-group">
						Laoding...
					</div>
				</div>
			</div>
			<div class="tone-arm oscillating">
			</div>
		</div>
	</div>
	<div  id="myDiv" class="animate-bottom" style="display:none">
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('images/bg-01.png');"></div>
			<a href="accueil.php" class="icone">
				<i class="fa fa-home"></i>
			</a>
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title">
						Connexion
					</span>

					<div class="wrap-input100 validate-input" data-validate="Nom d'utilisateur requis">
						<span class="label-input100">Adresse mail</span>
						<input class="input100" type="email" name="mailconnect" placeholder="Adresse mail" >
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Mot de passe requis">
						<span class="label-input100">Mot de passe</span>
						<input class="input100" type="password" name="mdpconnect" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="formconnexion" type="submit">
								Connexion
							</button>
						</div>

						<a href="inscription.php" class="dis-block txt3 hov1">
							Inscription
							<i class="fa fa-long-arrow-right"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
	if(!isset($_SESSION)){
		session_start();
	}

		$bdd = new PDO('mysql:host=127.0.0.1;dbname=songs_world', 'root', '');

		if(isset($_POST['formconnexion'])) {
		$mailconnect = htmlspecialchars($_POST['mailconnect']);
		$mdpconnect = sha1($_POST['mdpconnect']);
		if(!empty($mailconnect) AND !empty($mdpconnect)) {
			$requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
			$requser->execute(array($mailconnect, $mdpconnect));
			$userexist = $requser->rowCount();
			if($userexist == 1) {
				$userinfo = $requser->fetch();
				$_SESSION["utilisateur"] = $userinfo;
			//	$_SESSION['id'] = $userinfo['id'];
			//	$_SESSION['pseudo'] = $userinfo['pseudo'];
			//	$_SESSION['mail'] = $userinfo['mail'];
				header("Location: ../compte/index.php");
			} else {
				$erreur = "Mauvais mail ou mot de passe !";
			}
		} else {
			$erreur = "Tous les champs doivent être complétés !";
		}
		}
	?>
	<?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font><br>";
         }
    ?>
  </div>
  <script>
  var myVar;

  function myFunction() {
    myVar = setTimeout(showPage, 2000);
  }

  function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }
  </script>
</body>
</html>
