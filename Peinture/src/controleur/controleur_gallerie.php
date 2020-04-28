<?php

function actionGallerie($twig, $db){
    $form = array(); 
    $tableau = new Tableau($db);
    
   	
      
      
        
        
        
       $liste = $tableau->selectAll();
     echo $twig->render('gallerie.html.twig', array('form'=>$form,'liste'=>$liste));
}


function actionAjoutTableau($twig, $db){
    $form = array(); 
     $tableau = new Tableau($db); 
    if (isset($_POST['btAjoutabl'])){
      $inputTitre = $_POST['inputTitre'];
      $inputDescription = $_POST['inputDescription'];
      $date= date('Ymd');     
     
     
    
    
                        if(!empty($_FILES['fichier']['name'])){

					  //Cette ligne teste si la variable fichier qui se nomme «fichier» existe en mémoire
    $extensions_ok = array('png', 'gif', 'jpg', 'jpeg','PNG','JPG','JPEG');
    		 //Cette ligne indique les extensions des fichiers que nous autoriserons. Nous les mettons dans un tableau.
    $taille_max = 500000;
    $dest_dossier = '../web/images/';
//Il faudra donner des droits au répertoire qui accueillera vos fichier.
     if( !in_array( substr(strrchr($_FILES['fichier']['name'],'.'), 1), $extensions_ok ) ){
		 //La ligne regarde si dans le nom de la photo nous avons bien une extension autorisée.
         echo 'Veuillez sélectionner un fichier de type png, gif ou jpg !';
              }
     else{
           if( file_exists($_FILES['fichier']['tmp_name'])&& (filesize($_FILES['fichier']['tmp_name'])) >$taille_max){
               echo 'Votre fichier doit faire moins de 500Ko !';
          }
          else{
              // copie du fichier
             $dest_fichier = basename($_FILES['fichier']['name']);
              // formatage nom fichier
              // enlever les accents
            $dest_fichier=strtr($dest_fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
              // remplacer les caractères autres que lettres, chiffres et point par _
              $dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $dest_fichier);
              // copie du fichier
                
                move_uploaded_file($_FILES['fichier']['tmp_name'], $dest_dossier . $dest_fichier);
                  $nb = $tableau->insert($inputTitre ,$inputDescription,$date,$dest_fichier);
                  if ($nb!=1){
                     $form['invalide'] = false; 
                     $form['message'] ='Erreur lors de l\'insertion';
                  }else{
                    $form['valide'] = true; 
                    $form['message'] = 'insertion réussi  ';
                  }

          }
      }
}
    else{
        $tableau = new Tableau($db); 
        $exec = $tableau->insert($inputTitre ,$inputDescription, $date,'benches.jpg');
        if (!$exec){
          $form['invalide'] = false;  
          $form['message'] = 'Problème d\'insertion dans la table utilisateur '; 
       
        }
      }
     //   var_dump($nb,$dest_fichier,$date);
      

    }
    echo $twig->render('ajoutableau.html.twig', array('form'=>$form));
}



function actionListeTableau($twig, $db){
    $form = array(); 
    $tableau = new Tableau($db);
    
     if(isset($_GET['id'])){
        $exec=$tableau->delete($_GET['id']);
        if (!$exec){
            $form['invalide'] = false;
            $form['message'] = 'Problème de suppression dans la table message';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Message supprimée avec succès';
     }
     
     $liste = $tableau->selectAll();
     echo $twig->render('listetableau.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionModifTableau($twig, $db){
    $form = array(); 
    $tableau = new Tableau($db);
    
    if(isset($_GET['id'])){
		$id = $_GET['id'];
                $unTableau= $tableau->selectById($_GET['id']);  
                 if ($unTableau!=null){
            $form['tableau'] = $unTableau;
           
          
            
        }
	}
    else{
        if(isset($_POST['btModif'])){
            $id = $_POST['id'];
          $inputTitre = $_POST['inputTitre'];
           $inputDescription = $_POST['inputDescription'];
          $tableau = new Tableau($db);
          $exec = $tableau->updateAllNoImg($id,$inputTitre,$inputDescription);
         
            if(!empty($_FILES['fichier']['name'])){

					  //Cette ligne teste si la variable fichier qui se nomme «fichier» existe en mémoire
    $extensions_ok = array('png', 'gif', 'jpg', 'jpeg','PNG','JPG','JPEG');
    		 //Cette ligne indique les extensions des fichiers que nous autoriserons. Nous les mettons dans un tableau.
    $taille_max = 500000;
    $dest_dossier = '../web/images/';
//Il faudra donner des droits au répertoire qui accueillera vos fichier.
     if( !in_array( substr(strrchr($_FILES['fichier']['name'],'.'), 1), $extensions_ok ) ){
		 //La ligne regarde si dans le nom de la photo nous avons bien une extension autorisée.
         echo 'Veuillez sélectionner un fichier de type png, gif ou jpg !';
              }
     else{
           if( file_exists($_FILES['fichier']['tmp_name'])&& (filesize($_FILES['fichier']['tmp_name'])) >$taille_max){
               echo 'Votre fichier doit faire moins de 500Ko !';
          }
          else{
              // copie du fichier
             $dest_fichier = basename($_FILES['fichier']['name']);
              // formatage nom fichier
              // enlever les accents
            $dest_fichier=strtr($dest_fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
              // remplacer les caractères autres que lettres, chiffres et point par _
              $dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $dest_fichier);
              // copie du fichier
                
                move_uploaded_file($_FILES['fichier']['tmp_name'], $dest_dossier . $dest_fichier);
                  $nb = $tableau->update($id,$inputTitre ,$inputDescription,$dest_fichier);
                  if ($nb!=1){
                     $form['invalide'] = false; 
                     $form['message'] ='Erreur lors de l\'insertion';
                  }else{
                    $form['valide'] = true; 
                    $form['message'] = 'insertion réussi  ';
                  }

          }
      }
}
    else{
        $tableau = new Tableau($db); 
        $exec = $tableau->updateAllNoImg($id,$inputTitre ,$inputDescription);
        if (!$exec){
          $form['invalide'] = false;  
          $form['message'] = 'Problème d\'insertion dans la table tableau '; 
       
        }
      }
          if(!$exec){
                $form['invalide'] = false;  
                $form['message'] = 'Echec de la modification tableau'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
             $form['invalide'] = false;
            $form['message'] = 'tableau non précisé';
        }    
     
    } 
    
     
     echo $twig->render('tableaumodif.html.twig', array('form'=>$form));
}
?>

