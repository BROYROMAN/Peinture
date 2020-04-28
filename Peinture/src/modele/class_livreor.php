<?php

class Livreor{
    
    private $db;
    private $insert;
    private $selectAll;
    private $select;
    private $delete;
    private $selectById;
    private $selectEtat;
    private $selectMaV;        
    private $updateEtat;
    private $selectAvis; 

    
    
    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into livredor_message(Pseudo,email,message,note,date,idEtat_message ) values (:Pseudo,:email,:message,:note,:date,:idEtat_message )");
        $this->selectAll = $db->prepare("SELECT livredor_message.id as idLO,Pseudo,email,note,message,date,idEtat_message,etat_message.id as idEtat,etat FROM livredor_message,etat_message where livredor_message.idEtat_message=etat_message.id ORDER by date desc"); 
        $this->select = $db->prepare("SELECT * FROM livredor_message where idEtat_message=1 ORDER by date desc limit 6");  
        $this->delete = $db->prepare("delete from livredor_message where id=:id");
        $this->selectById = $db->prepare("select * from livredor_message  where id=:id ");
        $this->update = $db->prepare("update livredor_message set Pseudo=:Pseudo, email=:email,message=:message,idEtat_message=:idEtat_message where id=:id");
        $this->selectEtat = $db->prepare("select * from etat_message");
        $this->selectMaV = $db->prepare("SELECT  livredor_message.id as idLO,Pseudo,email,note,message,date,idEtat_message,etat_message.id as idEtat,etat FROM livredor_message,etat_message where etat_message.id=2 and  idEtat_message=2 ORDER by date desc");
        $this->updateEtat = $db->prepare("update livredor_message set idEtat_message=:idEtat_message where id=:id");
        $this->selectAvis = $db->prepare("SELECT  livredor_message.id as idLO,Pseudo,email,note,message,date,idEtat_message FROM livredor_message where idEtat_message=1  ORDER by date desc");

        }
    public function insert($inputPseudo,$inputEmail,$inputMessage,$inputNote,$date,$etat){
        $r = true;
        $this->insert->execute(array(':Pseudo'=>$inputPseudo,':email'=>$inputEmail, ':message'=>$inputMessage, ':note'=>$inputNote, ':date'=>$date,':idEtat_message'=>$etat));
        if ($this->insert->errorCode()!=0){
             print_r($this->insert->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    
     public function selectAll(){
        $this->selectAll->execute();
        if ($this->selectAll->errorCode()!=0){
             print_r($this->selectAll->errorInfo());  
        }
        return $this->selectAll->fetchAll();
    }
    
  
    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
             print_r($this->select->errorInfo());  
        }
        return $this->select->fetchAll();
    }
    
     public function selectMaV(){
        $this->selectMaV->execute();
        if ($this->selectMaV->errorCode()!=0){
             print_r($this->selectMaV->errorInfo());  
        }
        return $this->selectMaV->fetchAll();
    }
    
   
    public function delete($id){
        $r = true;
        $this->delete->execute(array(':id'=>$id));
        if ($this->delete->errorCode()!=0){
             print_r($this->delete->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function selectById($id){ 
        $this->selectById->execute(array(':id'=>$id)); 
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo()); 
            
        }
        return $this->selectById->fetch(); 
    } 
    
    public function update($id,$inputPseudo,$inputEmail,$inputMessage,$etat){
        $r = true;
        
        $this->update->execute(array(':id'=>$id,':Pseudo'=>$inputPseudo,':email'=>$inputEmail,':message'=>$inputMessage,':idEtat_message'=>$etat));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
     public function selectEtat(){
        $this->selectEtat->execute();
        if ($this->selectEtat->errorCode()!=0){
             print_r($this->selectEtat->errorInfo());  
        }
        return $this->selectEtat->fetchAll();
    }
    
    
     public function updateEtat($id,$etat){
        $r = true;
        
        $this->updateEtat->execute(array(':id'=>$id,':idEtat_message'=>$etat));
        if ($this->updateEtat->errorCode()!=0){
             print_r($this->updateEtat->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    
      public function selectAvis(){
        $this->selectAvis->execute();
        if ($this->selectAvis->errorCode()!=0){
             print_r($this->selectAvis->errorInfo());  
        }
        return $this->selectAvis->fetchAll();
    }
}

?>

