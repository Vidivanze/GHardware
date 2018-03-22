<?php
################################################################################
#### Auteur : Viquerat Killian
#### Date : 13 Mars 2018
#### Page controllers/Cart/affichecookie.php:
#### Gestions des donn�es des articles dans le cookie pour le Panier
################################################################################
//inclusion du fichier pour les requête a la base de donnée
include 'models/PanierCookieManager.php';
session_start();
//initialisation de la class PanierCookieManager
$panierCookieManager = new PanierCookieManager();
//recuperation du tableau stocker dans le cookie
$Panier = unserialize($_COOKIE['Panier']);
//recuperation du nombre de valeur présente dans le tableau
$Nombre = array_count_values($Panier);
//déduplication du tableaux pour avoir le nombre d'article
$PanierNoDouble = array_unique($Panier);
//pour chaque articles présent dans le tableau
foreach($PanierNoDouble as $value){
    //stockage de l'id d'article pour l'indexation et la requète db
    $index = $value;
    //stockage du nombre du même articles voulu avec l'id de l'articles pour le retrouver facilement
    $PanierNb[$index] = $Nombre[$index];
    //stockage des donnée de la db sur l'article avec l'id de l'articles pour le retrouver facilement
    $articles[$index] = $panierCookieManager->getArticlesCookie($index);
}

$aside = $panierCookieManager->getCategories();
//inclusion du fichier des catégorie
include 'views/aside.php';
//inclusion du fichier du panier
include 'views/Cart/cart.php';
