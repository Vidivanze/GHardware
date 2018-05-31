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
    
    //Lien AdminArticle "refresh"
    $refresh ="location:index.php?controller=Admin&action=article";
    
    
    
    // ---- PARAMETRES URL ---- //
    
    //paramêtre utile pour l'affichage des inactifs
    $inactiveParam = $_GET['inactive'];
    
    //paramêtre utile pour la modification d'un article
    $modifParam = $_GET['modif'];
    
    //paramêtre utile pour la modification d'un article
    $archiveParam = $_GET['archive'];
    
    
    
    
    
    //Si l'utilisateur n'est pas un admin il se fait rediriger sur la page home
    if($sessionAdminUser != TRUE){
        header($redirectToHome);
                
    }else{
        
        //tableau contenant les erreurs
        $errors = array();
        
        //Liste pour le tableau elle contient soit les actfis soit les inactifs
        $tableList;
        
        
        //instantiation de la classe CategoryManager
        $articleManager = new ArticleManager();              
        
        //catégories pour le Select
        $categoryNameSelect = $articleManager->getCategoriesAll();
        
        //marques pour le Select
        $brandNameSelect = $articleManager->getBrandAll();
        
        //image pour le Select
        $picArticleSelect = $articleManager->getPicArticleAll();
          
      
        
     
        
              
        
        
        
        //--- pagination ---//
        
        define("ROW_PER_PAGE",5);
        
        $search_keyword = '';
        if(isset($_POST['search']['keyword'])){
            $search_keyword = $_POST['search']['keyword'];
            $_SESSION["ar_CreationSucces"] = NULL;
        }
        
        $per_page_html = '';
        $page = 1;
        $start =0;
        
        
        if(isset($_POST["page"])) {
            $page = $_POST["page"];
            $start = ($page-1) * ROW_PER_PAGE;
            $_SESSION["ar_CreationSucces"] = NULL;
        }
        
        $limit =" limit " . $start . "," . ROW_PER_PAGE;
        
        //Défini la liste à afficher dans le tableau selon le paramêtre dans l'url (actif ou inactif)
        if($inactiveParam == TRUE){
            $pagination_statement = $articleManager->searchInactiveArticle($search_keyword);
            $pdo_statement = $articleManager->searchInactiveArticle($search_keyword, $limit);
        }else{
            $pagination_statement = $articleManager->searchActiveArticle($search_keyword);
            $pdo_statement = $articleManager->searchActiveArticle($search_keyword, $limit);
        } 
        
        $row_count = $pagination_statement->rowCount();
        $result = $pdo_statement->fetchAll();
        
        
        
        
        
        
        
      //--- Envois Formulaire ---//
        
        //si le formulaire est envoyé
        if(isset($_POST['submit'])){
            
            $articleId = $_POST['hiddenId'];
            $articleName = $_POST['Name'];
            $articleStock = $_POST['Stock'];
            $articlePrice = $_POST['Price'];
            $articleDescription = $_POST['Description'];
            $articleCategory = $_POST['Category'];
            $articleBrand = $_POST['Brand'];
            $articlePicArticle = $_POST['PicArticle'];
            $articleIsActive = $_POST['isActive'];
            
            
            //si un champ est vide
            if(empty($articleName) || empty($articleStock) || empty($articlePrice) || empty($articleDescription) || 
               $articleCategory == "0" || $articleBrand == "0" || $articlePicArticle == "0"){
                
                $errors[] = "Veuillez remplir tous les champs";
                
            }else{
                                
                if(empty($articleId) || $articleId == NULL){
                    //recherche d'un article name correspondant à l'article name entré
                    $checkByArticleName = $articleManager->articleExists($articleName);
                    
                    //si le nom est égal au nom retourné par la requête
                    if($checkByArticleName == TRUE){
                        $errors[] = "Le nom d'article est déjà utilisé";
                    }
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
                $formArticleIdValue = $articleId;
                $formArticleNameValue = $articleName;
                $formArticleStockValue = $articleStock;
                $formArticlePriceValue = $articlePrice;
                $formArticleDescriptionValue = $articleDescription;
                $formArticleCategoryValue = $articleCategory;
                $formArticleBrandValue = $articleBrand;
                $formArticlePicArticleValue = $articlePicArticle;
                
                //message de confirmation de la création -> vide
                $_SESSION["ar_CreationSucces"] = NULL;
                
            }else{
                //si l'on est en modif
                if(!empty($articleId) || $articleId != NULL){
                    //requête pour la création de l'article
                    $articleManager->modifyArticle($articleId, $articleName, $articleStock, $articlePrice, $articleDescription,
                                                   $articleCategory, $articleBrand, $articlePicArticle, $articleIsActive);
                    
                    $_SESSION["ar_CreationSucces"] = "<p style='color:green;'>Article modifié !</p>";
                    header($refresh);
                }else{
                    //requête pour la création de l'article
                    $articleCreationDb = $articleManager->setNewArticle($articleName, $articleStock, $articlePrice, $articleDescription,
                                                                        $articleCategory, $articleBrand, $articlePicArticle, $articleIsActive);
                    $_SESSION["ar_CreationSucces"] = "<p style='color:green;'>Article ajouté !</p>";
                    header($refresh);
                }
            }
        }
        
        
        
        //ÉDITION
        if($modifParam != NULL && !empty($modifParam) && !isset($_POST['submit'])){
            $articleToModify = $articleManager->getArticles($modifParam);
            
            foreach($articleToModify as $val){
                $formArticleIdValue = $val['idArticle'];
                $formArticleNameValue = $val['AName'];
                $formArticleStockValue = $val['AStock'];
                $formArticlePriceValue = $val['APrix'];
                $formArticleDescriptionValue = $val['ADescription'];
                $formArticleCategoryValue = $val['Fk_Categories'];
                $formArticleBrandValue = $val['Fk_Marque'];
                $formArticlePicArticleValue = $val['Fk_PicArticles'];
            }
        }
        
        
        //ARCHIVAGE
        if($archiveParam != NULL && !empty($archiveParam) && $inactiveParam == NULL){
            $articleManager->setArticleInactive($archiveParam);
            header($refresh);
        }
        
        
        
               
        include 'views/Admin/article.php';
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
