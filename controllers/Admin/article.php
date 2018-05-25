<?php
    ################################################################################
    #### Auteur : Butticaz Yvann
    #### Date : 15 Mai 2018
    #### Page controllers/Admin/article.php:
    #### 	  Page de managment des articles avec formulaire et tableau
    ################################################################################
    
    //include de la classe ArticleManager
    include("models/ArticleManager.php");
    
    //Variable contenant le paramêtre de session 'userIsAdmin'
    $sessionAdminUser = $_SESSION['userIsAdmin'];
    
    //Lien Home
    $redirectToHome = "location:index.php?controller=Site&action=home";
    
    $inActiveParam = $_GET['inActive'];
    
    //Si l'utilisateur n'est pas un admin il se fait rediriger sur la page home
    if($sessionAdminUser != TRUE){
        header($redirectToHome);
                
    }else{
        //tableau contenant les erreurs
        $errors = array();
        
        //Liste pour le tableau elle contient soit les actfis soit les inactifs
        $TableList;
        
        
        //instantiation de la classe CategoryManager
        $articleManager = new ArticleManager();
        
        
        //Liste des articles actifs pour le tableau
        $ActiveArticleTable = $articleManager->ListArticleActive();
        
        //Liste des articles inactifs pour le tableau
        $InactiveArticleTable = $articleManager->ListArticleInactive();
                
        
        //catégories pour le Select
        $categoryNameSelect = $articleManager->getCategoriesName();
        
        //marques pour le Select
        $brandNameSelect = $articleManager->getBrandNameAll();
        
        //image pour le Select
        $picArticleSelect = $articleManager->getPicArticleAll();
          
      
     
        //Défini la liste à afficher selon le paramêtre dans l'url
        if($inActiveParam == TRUE){
            $TableList = $InactiveArticleTable;
        }else{
            $TableList = $ActiveArticleTable;
        }
        
        
       
        //--- Envois Formulaire ---//
        
        //si le formulaire est envoyé
        if(isset($_POST['submit'])){
            
            $articleName = $_POST['Name'];
            $articleStock = $_POST['Stock'];
            $articlePrice = $_POST['Price'];
            $articleDescription = $_POST['Description'];
            $articleCategory = $_POST['Category'];
            $articleBrand = $_POST['Brand'];
            $articlePicArticle = $_POST['PicArticle'];
            $articleIsActive = $_POST['isActive'];
            
            
            //si un champ est vides
            if(empty($articleName) || empty($articleStock) || empty($articlePrice) || empty($articleDescription) || 
               $articleCategory == "0" || $articleBrand == "0" || $articlePicArticle == "0"){
                
                $errors[] = "Veuillez remplir tous les champs";
                
            }else{ 
                //recherche d'un article name correspondant au article name entré
                $checkByArticleName = $articleManager->articleExists($articleName);
                
                //si le nom est égal au nom retourné par la requête
                if($checkByArticleName == TRUE){
                    $errors[] = "Le nom d'article est déjà utilisé";
                }
                
                //si le stock ne contient pas que des chiffres 
                if(!preg_match('/^[0-9]+$/', $articleStock)){
                    $errors[] = "Le stock doit contenir uniquement des chiffres";
                }
                
                //si le prix ne contient pas que des chiffres
                if(!preg_match('/^[0-9]+$/', $articlePrice)){
                    $errors[] = "Le prix doit contenir uniquement des chiffres";
                }
            }
            
            //array_filter() permet d'utiliser ensuite empty() sur le tableau d'erreurs
            $errorsArray = array_filter($errors);
            
            //s'il y a une/des d'erreur/s
            if(!empty($errorsArray)){
                //valeurs pour repopuler le formulaire
                $formArticleNameValue = $articleName;
                $formArticleStockValue = $articleStock;
                $formArticlePriceValue = $articlePrice;
                $formArticleDescriptionValue = $articleDescription;
                $formArticleCategoryValue = $articleCategory;
                $formArticleBrandValue = $articleBrand;
                $formArticlePicArticleValue = $articlePicArticle;
                
                //message de confirmation de la création -> vide
                $_SESSION["ar_CreationSucces"] = null;
                
            }else{
                //requête pour la création de l'article
                $articleCreationDb = $articleManager->setNewArticle($articleName, $articleStock, $articlePrice, $articleDescription, 
                                                                    $articleCategory, $articleBrand, $articlePicArticle, $articleIsActive);
                $_SESSION["ar_CreationSucces"] = "<p style='color:green;'>Article ajouté !</p>";
            }
        }
        
        include 'views/Admin/article.php';
    }
    
    
   
    
    
    //------ FONCTIONS ------//
    
    //Fonction pour filtrer les articles actifs
    function filterActives($value){
        return ($value == 1);
    }
    
    //Fonction pour filtrer les articles inactifs
    function filterNotActives($value){
        return ($value == 0);
    }
