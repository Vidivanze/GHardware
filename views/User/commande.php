<?php 

echo'<link href="views/Assets/css/printstyle.css" rel="stylesheet">';

$number=0;
$Prix=0;
$PrixTotal=0;

echo'

	<div class="col-sm-12">
		<div class="printonly">
			<div class="col-lg-offset-4 col-sm-4">
				<img style="display:none;" id="imgprint" src="images/GHardwareLogoB.png">
			</div>
		</div>
	</div>
	
	<div class="col-lg-offset-2 col-sm-10">

';    



foreach($order as $value){
    if($number<=0){
        echo'Adresse:'.$FirstName.' '.$LastName.'</br>'.$Road.'</br>'.$NPA.' '.$Town.'</br>';
        echo 'Date de commande:'.$value['Date'].'</br>';
        echo 'Numero commande:'.$value['NumberOrder'].'</br>';
        if($value['State']==0){
        
            echo'Etat commande:'.'En attente du payement'.'<br>';
        
        }else if($value['State']==1){
        
            echo'Etat commande:'.'Envoyer'.'<br>';
        
        }else{
        
            echo'Etat commande:'.'Arriver à destination'.'<br>';
        
        }
        if($value['PayementMethod']==0){
        
            echo'Payement methode:'.'Nature'.'<br>';
        
        }else if($value['PayementMethod']==1){
        
            echo'Payement methode:'.'Facture'.'<br>';
        
        }
        if($value['PayementState']==0){
        
            echo'Etat payement:'.'En cour de traitement'.'<br>';
        
        }else if($value['PayementState']==1){
        
            echo'Etat payement:'.'Payer'.'<br>';
        
        }else{
        
            echo'Etat payement:'.'Payement refuser'.'<br>';
        }
        $number++;   
    }
    foreach($articles as $values){
        if(($value['Fk_Article'])==($values['idArticle'])){
            $Prix += $value['Number']*$values['Price'];
            $PrixTotal += $value['Number']*$values['Price'];
            echo 'Article:'.$values['Name'].'</br>';
            echo 'Nombre commandé:'.$value['Number'].'</br>';
            echo 'Prix:'.$Prix.'</br>';
        }
    }
    $Prix=0;
}
echo'Total prix:'.$PrixTotal;

echo'</div>';