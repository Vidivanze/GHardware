<?php
    ################################################################################
    #### Auteur : Butticaz Yvann
    #### Date : 27 F�vrier 2018
    #### Page Header:
    ####       Ceci est le header qui est include dans le index.php
    ################################################################################
    
    session_start();

    if($_SESSION['user_name'] != null){
        $loginText = $_SESSION['user_name'];
        $deconectButton = '<a href="index.php?controller=Login&action=logout"> Deconnexion</a>';
    }else{
        $loginText = "login";
        $deconectButton = null;
    }
    
    echo '
		<link <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- FORMATION BOOTSTRAP -->
<!-- Les 4 types de Colonnes -->

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<title>Ghardware</title>
	
  	<link href="views/assets/css/addstyle.css" rel="stylesheet">
    <link href="views/Assets/css/bootstrap.css" rel="stylesheet">

  </head>
  
  
  <body>
  
  <div class="container"
  
  <!-- Header Menu -->
  <!-- Login / Logout Button -->
	  <header>
		<div class="row">          
			<div class="col-xs-offset-9 col-lg-3"><a href="index.php?controller=Login&action=login">'.$loginText.'</a>'.$deconectButton.'</div>
		</div>
	  </header>
  
  <!-- Navigation (Logo + Search + Panier) -->
  
	<div class="row">
  <div class="col-sm-3"><img width="100px" src="images/logotemplate.png"></div>
  <div class="col-sm-6">
	<form method="post" action="#">
		<br>
		<input class="searchbar" type="search" name="search" placeholder="Recherche"><button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Chercher</button>
	</form>
  
  </div>
  <div class="col-sm-3">';
    if($_SESSION['UserSession']==TRUE){
  
        echo'<a class="btn btn-default navbar-btn" href="index.php?controller=Cart&action=affichebdd" role="button">Panier <span class="badge text-success"></span></a>';
        
    }else{
        $Panier = unserialize($_COOKIE['Panier']);
        
        if($Panier[0]!=NULL){
            $Nombre = count($Panier);
        }else{
            $Nombre = NULL;
        }
        echo'<a class="btn btn-default navbar-btn" href="index.php?controller=Cart&action=affichecookie" role="button">Panier <span class="badge text-success">'.$Nombre.'</span></a>';
    }
  echo'</div>
	</div>
	
	
	<!-- ROW for Central Part | DO NOT TOUCH-->
	<div class="row">
	';
?>

<!--
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	</head>
</html>

-->