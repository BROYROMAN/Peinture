<?php

function actionAjoutMessage($twig, $db){
    $form = array(); 
    $message = new Livreor($db);
    
   	
      
     
    if (isset($_POST['btAjoutMessLO'])){
      $inputPseudo = $_POST['pseudo'];
      $inputEmail = $_POST['email'];
      $inputMessage = $_POST['message'];
      $inputNote = $_POST['rate'];
      $date= date('Ymd'); 
      $etat=2;
      $form[] = null;
     
    
    
      
	
                  $nb = $message->insert($inputPseudo,$inputEmail,$inputMessage,$inputNote,$date,$etat);
                  if ($nb!=1){
                     
                      $form['invalide'] = false;                      
                      $form['message'] ='Erreur lors de l\'insertion';
                  }else{
                     $form['valide'] = true;
                    $form['message'] = 'insertion réussi  ';
                  }

          
      }

    
     //   var_dump($nb,$dest_fichier,$date);
      

    
   
        
        
        
       $liste = $message->selectAll();
     echo $twig->render('ajoutmessagelo.html.twig', array('form'=>$form,'liste'=>$liste));
}


function actionListeMessage($twig, $db){
    $form = array(); 
    $message = new Livreor($db);
    
     if(isset($_GET['id'])){
        $exec=$message->delete($_GET['id']);
        if (!$exec){
            $form['invalide'] = false;
            $form['message'] = 'Problème de suppression dans la table message';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Message supprimée avec succès';
     }
     $liste = $message->selectAll();
     echo $twig->render('listemessage.html.twig', array('form'=>$form,'liste'=>$liste));
}


function actionModifMessage($twig, $db){
    $form = array(); 
    $message = new Livreor($db);
    
    if(isset($_GET['id'])){
        $message = new Livreor($db);
        $unMessage = $message->selectById($_GET['id']);  
        
        if ($unMessage!=null){
            $form['mess'] = $unMessage;
           
            $message = new Livreor($db);
            $liste = $message->selectEtat();
           
            //var_dump($liste);
        }
        else{
            $form['message'] = 'Equipe incorrecte';  
        }
    }
    else{
        if(isset($_POST['btModif'])){
            $id = $_POST['id'];
          $inputPseudo = $_POST['pseudo'];
          $inputEmail = $_POST['email'];
          $inputMessage = $_POST['message'];
          $etat=$_POST['etat'];
         
          $message = new Livreor($db);
          $exec = $message->update($id,$inputPseudo,$inputEmail,$inputMessage,$etat);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification del\'équipe'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
            $form['message'] = 'Utilisateur non précisé';
        }    
     
    }
    $liste = $message->selectEtat();
     //$liste = $message->selectAll();
     echo $twig->render('messagemodif.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionMav($twig, $db){
    $form = array(); 
    $message = new Livreor($db);
   
     if(isset($_GET['id'])){
        $exec=$message->delete($_GET['id']);
        if (!$exec){
            $form['invalide'] = false;
            $form['message'] = 'Problème de suppression dans la table message';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Message supprimée avec succès';
     }
     
     if(isset($_GET['idLO']) && $_GET['id']){
         $id=$_GET['idLO'];
         $etat=$_GET['id'];

        $exec=$message->updateEtat($id,$etat);
        if (!$exec){
            $form['invalide'] = false;
            $form['message'] = 'Problème de changement de l\'état' ;
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Changement effectué avec succès';
     }
     $liste = $message->selectMav();
     echo $twig->render('listeMav.html.twig', array('form'=>$form,'liste'=>$liste));
}