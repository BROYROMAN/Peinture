<?php
function getPage($db){

// Inscrire vos contrôleurs ici    
$lesPages['accueil'] = "actionAccueil;0";
$lesPages['admin'] = "actionAdmin;1";
$lesPages['gallerie'] = "actionGallerie;0";
$lesPages['connexion'] = "actionConnexion;0";
$lesPages['deconnexion'] = "actionDeconnexion;0";
$lesPages['inscrire'] = "actionInscrire;0";
$lesPages['maintenance'] = "actionMaintenance;0";
$lesPages['contact'] = "actionContact;0";
$lesPages['utilisateur'] = "actionUtilisateur;0";
$lesPages['ajoutableau'] = "actionAjoutTableau;1";
$lesPages['ajoutmessagelo'] = "actionAjoutMessage;0";
$lesPages['listetableau'] = "actionListeTableau;1";
$lesPages['listemessage'] = "actionListeMessage;1";
$lesPages['tableaumodif'] = "actionModifTableau;1";
$lesPages['messagemodif'] = "actionModifMessage;1";
$lesPages['listeMav'] = "actionMAV;1";
$lesPages['livreor'] = "actionLivreOr;0";


if ($db!=null){
  if(isset($_GET['page'])){
    // Nous mettons dans la variable $page, la valeur qui a été passée dans le lien
    $page = $_GET['page']; }
  else{
    // S'il n'y a rien en mémoire, nous lui donnons la valeur « accueil » afin de lui afficher une page
    //par défaut
    $page = 'accueil';
  }

  if (!isset($lesPages[$page])){
    // Nous rentrons ici si cela n'existe pas, ainsi nous redirigeons l'utilisateur sur la page d'accueil
    $page = 'accueil'; 
  }
  
  $explose = explode(";",$lesPages[$page]);
  $role = $explose[1];
  
  // Si le rôle nécessite de contrôler les droits
  if ($role != 0){
      // Nous vérifions que la personne est connectée
      if(isset($_SESSION['login'])){
        //Nous vérifions qu'elle a un rôle
        if(isset($_SESSION['role'])){
            
            if($role!=$_SESSION['role']){
               //Nous redigeons la personne vers la page d'acccueil car elle n'a pas le bon rôle 
               $contenu = 'actionAccueil';  
            }
            else{
               // La personne est autorisée à récupérer  
               $contenu = $explose[0]; 
            }
        }
        else{
           // Dans la session le rôle n'existe pas donc on va sur la page d'accueil 
           $contenu = 'actionAccueil'; 
        }
      }
      else{
        // La personne n'est pas connectée, donc on va sur la page d'accueil  
        $contenu = 'actionAccueil';  
      }
    }else{
      // Nous donnons du contenu non protégé  
      $contenu = $explose[0];   
    }
}
else{
   // La base de données n'est pas accessible
   $contenu = 'actionMaintenance';
}
// La fonction envoie le contenu
return $contenu; 

}
?>