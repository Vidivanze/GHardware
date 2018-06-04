<?php
    ################################################################################
    #### Auteur : Viquerat Killian
    #### Date : 24 mai 2018
    #### Page controllers/Commentaire/AddCommentaire.php:
    #### 		  Gestions des données pour ajouter des commentaires
    ################################################################################
    
    include 'models/CommentManager.php';
    
    $commentaireManager = new CommentManager();
    
    if(isset($_POST['Delete'])){
        $deletecommentaire = $commentaireManager->deleteValueComment($_GET['id']);
        header("location:index.php?controller=User&action=CommentaireUser");
    }else{
        $userLogin = $_SESSION['user_name'];
        $CTexte=$_POST['writecomment'];
        $Fk_Article=$_GET['id'];
        $CEtat=0;
        $Date=Date("Y-m-d H:i:s");
        $user = $commentaireManager->getUserByLogin($userLogin);
        print_r($user);
        foreach($user as $value){
            $Fk_User = $value['idUser'];
            echo $Fk_User;
            
        }
        
        if(empty($CTexte)){
            header("location:index.php?controller=Article&action=articlecommentaire&error=1&id=$Fk_Article");
            
        }else{
            $addCommentaire = $commentaireManager->setNewComment($CEtat, $CTexte, $Fk_User, $Fk_Article, $Date);
            header("location:index.php?controller=Article&action=articlecommentaire&id=$Fk_Article");
        }
    }