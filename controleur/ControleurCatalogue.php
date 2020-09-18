<?php 
require_once('vue/Vue.php');

class ControleurCatalogue{
   private $vue;
   private $vetementManager;

   // CONSTRUCTEUR 
   public function __construct($url){
      
      if( isset($url) && count($url) > 3 ){
         throw new Exception('Page introuvable');
      }
      else{
         
         //DEBUG
      
            $this->recherche();
       


         if( isset($url[1]) && isset($url[2]) ){
            $donnee =  $this->listeVetement($url[1], $url[2]);
         }
         else if( isset($url[1]) && !isset($url[2]) ){
            $donnee =  $this->listeVetement($url[1], null);
         }
         else{
            
            $donnee =  $this->listeVetement(null, null);
         }


         $this->vue = new Vue('Catalogue') ;
         $this->vue->genererVue(array( 
            "listeVetement"=> $donnee,
            "vuePagination" => $this->vetementManager->Pagination->getVuePagination("catalogue&page="),
            "listeTaille"=>$this->TaillesCatalogue()
         )) ;
         
      }
   }

   //Retourne la liste des vêtement par catégorie ou non =)
   private function listeVetement($libelleGenre, $idCateg){
      $this->vetementManager = new VetementManager;
      $this->vetementManager->setPagination(10);

      if($libelleGenre != null && $idCateg != null){
         $listeVetement =  $this->vetementManager->getListeVetByCategGenre($libelleGenre, $idCateg);
      }
      else if($libelleGenre != null && $idCateg == null){
         $listeVetement =  $this->vetementManager->getListeVetByGenre($libelleGenre);
      }
      else{
         $listeVetement = $this->vetementManager->getListeVetement();
      }
      
      return $listeVetement;
      
   }

   public function TaillesCatalogue(){
      $TaillesCatalogue = new TailleManager();
      return $TaillesCatalogue->getListeTaille();
   }

   public function recherche(){

      if( isset($_POST["recherche"]) ){
         $RechercheManager = new RechercheManager();
            $prixIntervale= [0, 80];
            $listeTaille= [1,2];
            $listeCouleur= ["noir", "bleu"];
            $categorie= null;
            $genre = null;

         $resultat = $RechercheManager->getRecherche(
            $prixIntervale, 
            $listeTaille, 
            $listeCouleur, 
            $categorie, 
            $genre
         );

         echo "\n".$resultat ."\n" ;
      }

      //$prix = $_POST['prix'];
      //echo "<h1>".$prix."</h1>";

      // if (isset($_POST['taille'])) {
      //    foreach ($_POST['taille'] as $recup){
      //       echo "<h1>".$recup."</h1><br>";
      //    }
      // }

      //return $RechercheManager->getRecherche();
   }



   
   



}

?>