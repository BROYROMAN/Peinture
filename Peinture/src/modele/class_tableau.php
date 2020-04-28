<?php

class Tableau{
    
    private $db;
    private $insert;
    private $selectAll;
    private $select;
     private $selectById;
    private $delete;
     private $update;
     private $updateAllNoImg;

    
    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into tableau(titre,description,date,photo) values (:titre,:description, :date, :photo)");
        $this->selectAll = $db->prepare("select * from tableau ORDER by date desc "); 
        $this->select = $db->prepare("SELECT * FROM tableau ORDER by date desc limit 6");  
        $this->delete = $db->prepare("delete from tableau where id=:id"); 
        $this->selectById = $db->prepare("select * from tableau  where id=:id ");
        $this->update = $db->prepare("update tableau set titre=:titre, description=:description,photo=:photo where id=:id");
        $this->updateAllNoImg = $db->prepare("update tableau set titre=:titre,description=:description where id=:id");
        }
    public function insert($titre,$inputDescription,$date,$photo ){
        $r = true;
        $this->insert->execute(array(':titre'=>$titre,':description'=>$inputDescription, ':date'=>$date, ':photo'=>$photo));
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
    
     public function update($id,$titre,$description,$photo){
        $r = true;
        
        $this->update->execute(array(':id'=>$id,':titre'=>$titre,':description'=>$description,':photo'=>$photo));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
      public function updateAllNoImg($id,$titre,$description){
        $r = true;
        
        $this->updateAllNoImg->execute(array(':id'=>$id,':titre'=>$titre,':description'=>$description));
        if ($this->updateAllNoImg->errorCode()!=0){
             print_r($this->updateAllNoImg->errorInfo());  
             $r=false;
        }
        return $r;
    }
}

?>

