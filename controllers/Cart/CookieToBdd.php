<?php
################################################################################
#### Auteur : Viquerat Killian
#### Date : 03 février 2018
#### Page controllers/Cart/CookieToBdd.php:
#### 		  Gestions des données des articles
################################################################################

include 'models/PanierManager.php';

session_start();

$userLogin = $_SESSION['user_name'];
$newPanier;
$panierManager = new PanierManager();

$user = $panierManager->getUserName($userLogin);
foreach($iduser as $value){
     $iduser = $value['idUser'];
}
echo $iduser;
$cookie = unserialize($_COOKIE['Panier']);
foreach($cookie as $value){
$idarticle = $value;
$PanierCreationDb = $panierManager->setNewPanier($idarticle, $iduser);
echo 'cc';
}
setcookie('Panier',serialize($newPanier));

?>