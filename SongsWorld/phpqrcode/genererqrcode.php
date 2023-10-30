<?php
include('phpqrcode/qrlib.php'); //On inclut la librairie au projet
$lien='http://localhost/songsworld/phpqrcode/genererqrcode.php'; // Vous pouvez modifier le lien selon vos besoins
 QRcode::png($lien, 'qrcode.png', "H", 7); // On crée notre QR Code
//QRcode::png($lien);

echo '<img src="qrcode.png" alt="">';


?>
