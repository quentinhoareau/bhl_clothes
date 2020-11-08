<?php

class ContactManager extends DataBase{
    
    // insertion
    public function insertBDDContact($idCli, $nom, $email, $tel, $sujet, $message){
        $this->getBdd();
        $newID = $this->getNewIdTable('contact','idContact');
        $req= "INSERT INTO contact VALUES(?, ?,?, ?, ?, ?, ?, NOW())";
        $this->getBdd();
        $this->execBDD($req,[$newID, $idCli, $nom, $email,$tel, $sujet, $message]);
    }

    // obtenir la liste des contacts
    public function getListeContact(){
        $req= "SELECT * FROM contact";
        $this->getBdd();
        return $this->getModele( "Contact",  $req) ;    
    }

    // obtenir un contact
    public function getContact($idContact){
        $req="SELECT * FROM contact WHERE idContact=?";
        $this->getBdd();
        return $this->getModele( "Contact",  $req,[$idContact])[0] ; 
    }

    // suppression 
    public function supprimer($idContact){
        
        $req = "DELETE FROM contact WHERE idContact = ?" ;
        $this->getBdd();

        $this->execBdd($req, [$idContact]);
    }


}

?>