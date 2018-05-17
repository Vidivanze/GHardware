<?php
    ################################################################################
    #### Auteur : Butticaz Yvann
    #### Date : 14 Mai 2018
    #### Page views/Admin/category.php:
    #### 	  Page de managment des categories avec formulaire et tableau
    ################################################################################
    
    //titre du formulaire
    $formTitle = "Gestion des marques";
    
    //message lors de création réussite
    if($_SESSION['br_CreationSucces'] != null){
        $br_CreationSucces = $_SESSION['br_CreationSucces']."<br/>";
    }else{
        $br_CreationSucces = null;
    }
    
    //FORMULAIRE//
    echo ' 
		<div class="row">
			<div class="col-xs-offset-1 col-lg-8"> 
			
		<div class="col-lg-12">
			<table id="tabadmin">
			  <tr>
				<th>ID</th>
				<th>Login</th>
				<th>Prénom</th>
				<th>Nom</th>
				<th>E-Mail</th>
				<th>Date de naissance</th>
				<th>Droits</th>
				<th>Actif</th>
			  </tr>
			  <tr>
				<td>1</td>
				<td>Login</td>
				<td>Prénom</td>
				<td>Nom</td>
				<td>E-Mail</td>
				<td>Date de naissance</td>
				<td>Droits</td>
				<td>Actif</td>
			  </tr>
			  <tr>
				<td>2</td>
				<td>Login</td>
				<td>Prénom</td>
				<td>Nom</td>
				<td>E-Mail</td>
				<td>Date de naissance</td>
				<td>Droits</td>
				<td>Actif</td>
			  </tr>
			  <tr>
				<td>3</td>
				<td>Login</td>
				<td>Prénom</td>
				<td>Nom</td>
				<td>E-Mail</td>
				<td>Date de naissance</td>
				<td>Droits</td>
				<td>Actif</td>
			  </tr>
			</table>
		</div>
		
		<h3>'.$formTitle.'</h3><br/>';
    
    //affichage des messages d'erreures contenus dans le tableau errorsArray
    foreach ($errorsArray as $key => $val) {
        echo '<p style="color:red;">'.$val.'</p>';
    }
    
    echo'<form method="post" action="">
                    '.$br_CreationSucces.'
                        
                    <p>
            			<div class="col-lg-2"><label for="Name">Nom</label></div>
            			<div class="col-lg-10"><input type="text" name="Name" value="'.$formBrandNameValue.'"/></div>
            		</p>
            			    
                    <p>
        			    <div class="col-lg-2"><label for="IsActive">Actif</label></br></div>
        		        <div class="col-lg-12"><input type="radio" name="isActive" value="1" checked="checked">Oui</input></br></div>
                        <div class="col-lg-12"> <input type="radio" name="isActive" value="0">Non</input></div>
        		    </p>
            			    
            	    <p>
            		    <div class="col-xs-offset-2 col-lg-2"><input type="submit" name="submit" value="Envoyer"/></div>
            	    </p>
            	</form>
		</div>
			</div>
                ';
