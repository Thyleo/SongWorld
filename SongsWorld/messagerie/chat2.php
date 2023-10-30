<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V13</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <style>
    body{
        margin:0;
    }
    .mess{
        padding:40px;
        background-color: #ddd;
        width:fit-content;
        border-radius:20px;
        z-index:99;
        display:inline-block;
    }
    .contain-mess{
        width:100%-520px;
        text-align:left;
        padding:30px;
    }

    .icone{
        padding:20px;
        font-size:30px;
        width:80px;
        position:absolute;
        z-index:1;
        background: #333;
        color:#fff;
        border-radius: 100px 0px 0px 100px;
        display:inline-block;
	}
.icone:hover{
	cursor: pointer;
	background: #ddd;
}
.icone-container{
    width:94.15%;
    text-align:right;
    margin:0;
    padding:0;
}
@media (min-width: 480px) and (max-width: 780px){
	.icone{
		padding:10px;
		font-size:25px;
		width:60px;
		position:absolute;
		z-index:1;
		background: #333;
		color:#fff;
		border-radius: 0px 100px 100px 0px;
		position:fixed;
	}
	.icone:hover{
		cursor: pointer;
		background: #ddd;
	}
}
</style>
</head>
<body style="background-color: #fff;" >
<div class="icone-container">
        <a href="accueil.php" class="icone">
                <i class="fa fa-home" ></i>
        </a>
    </div>
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
        <?php
        if ($row['recepteur_id']=="2") {
            ?>
        <div class='mess'><?php
            echo "PlayList: ".htmlspecialchars($row['message'])."<br>De: ".htmlspecialchars($row['expediteur_id']);
        }
        ?>
        </div>
        </div>
    <?php
        }

    ?>


</body>
</html>
