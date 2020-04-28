<?php

function actionUtilisateur($twig, $db){
    $form = array(); 
    $utilisateur = new Utilisateur($db);
    
     if(isset($_GET['id'])){
        /* Nous vérifions que l'utilisateur n'est pas responsable d'une équipe
           Car nous n'avons pas souhaité faire un DELETE ON CASCADE  
         */ 
        
        
        
            $exec=$utilisateur->delete($_GET['id']);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème de suppression dans la table utilisateur';
            }
            else{
                $form['valide'] = true;
                $form['message'] = 'Utilisateur supprimé avec succès';
            }
        
       
       
     }
     $liste = $utilisateur->select();
     echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionUtilisateurModif($twig, $db){
 $form = array();   
 if(isset($_GET['id'])){
    $utilisateur = new Utilisateur($db);
    $unUtilisateur = $utilisateur->selectByEmail($_GET['id']);  
    if ($unUtilisateur!=null){
      $form['utilisateur'] = $unUtilisateur;
      $role = new Role($db);
      $liste = $role->select();
      $form['roles']=$liste;
    }
    else{
      $form['message'] = 'Utilisateur incorrect';  
    }
 }
 else{
     if(isset($_POST['btModifier'])){
       $utilisateur = new Utilisateur($db);
       $nom = $_POST['nom'];
       $prenom = $_POST['prenom'];
       $role = $_POST['role'];
       $email = $_POST['email'];
       $exec=$utilisateur->update($email, $role, $nom, $prenom);
       if(!$exec){
         $form['valide'] = false;  
         $form['message'] = 'Echec de la modification des données. '; 
       }
       else{
         $form['valide'] = true;  
         $form['message'] = 'Modification des données réussie. ';  
       }
       if(!empty($_POST['inputPassword'])){
          $p1 = $_POST['inputPassword'];
          $p2 = $_POST['inputPassword2'];
          if ($p1==$p2){
             $p1 = password_hash($p1, PASSWORD_DEFAULT);
             $exec=$utilisateur->updateMdp($email, $p1);
             if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification du mot de passe'; 
             }
             else{
                $form['valide'] = true;  
                $form['message'] .= 'Modification réussie du mot de passe';  
             } 
          }
          else{
            $form['valide'] = false;  
            $form['message'] .= 'Echec de la modification du mot de passe';   
          }
          
       }
     }
     else{
       $form['message'] = 'Utilisateur non précisé';
     }  
 }
 echo $twig->render('utilisateur-modif.html.twig', array('form'=>$form));
}

function actionUtilisateurWS($twig, $db){
   $utilisateur = new Utilisateur($db);
   $liste = $utilisateur->select();
   for($i=0;$i<count($liste);$i++){
      $img_src = $liste[$i]['photo'];
      $imgbinary = fread(fopen('../src/private/'.$img_src, "r"), filesize('../src/private/'.$img_src)); 
      $liste[$i]['photo'] = base64_encode($imgbinary); 
   }
   $json = json_encode($liste); 
   echo $json; 
}


?>

