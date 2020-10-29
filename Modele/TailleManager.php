<?php

class TailleManager extends DataBase{
    
    public function getTaille($libelle){
        $req = "SELECT * FROM taille WHERE libelle = ?";
        $this->getBdd();
        return @$this->getModele($req, [$libelle], "Taille")[0]; // Si une valeur
    }

    public function getListeTaille(){
        $req = "SELECT t.* FROM taille t";
        $this->getBdd();
        return $this->getModele($req,["*"],"Taille");
    }

    public function getListeTailleForVet($idVet){
        $req = "SELECT t.* 
        FROM vet_taille vt 
        INNER JOIN taille t ON t.libelle = vt.taille 
        WHERE vt.idVet =?";
        $this->getBdd();
        return $this->getModele($req,[$idVet],"Taille");
    }

    public function getListeTailleLettre(){
        $req = "SELECT t.* FROM taille t WHERE t.libelle NOT REGEXP '^[0-9]+$'; ";
        $this->getBdd();
        return $this->getModele($req,["*"],"Taille");
    }

    public function getListeTailleChiffre(){
        $req = "SELECT t.* FROM taille t WHERE t.libelle REGEXP '^[0-9]+$'; ";
        $this->getBdd();
        return $this->getModele($req,["*"],"Taille");
    }


}

?>