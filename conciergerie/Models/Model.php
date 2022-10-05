<?php 
namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    // table de la base de données
    protected $table;
    // instance de Db
    private $db;

    /**
     * trouver toute les occurences Select*from this table
     */
    public function findAll(){
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    public function findBy(array $criteres){
      $champs = [];
      $valeurs = [];
        //   on boucle pour éclater le tableau
        foreach($criteres as $champ => $valeur){
        // select * from annonces where actif = ? AND signale = 0
        // bindvalue(1, valeur)
        // créons actif = ?

        $champs[] = "$champ = ?";
        $valeurs[] = $valeur;
        }
        // on transforme le tableau champ en une chaine de caractères
        $liste_champs = implode(' AND ', $champs);

        // on peut maintenant exécuter la requête
        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs)->fetchAll();
    }

    public function find(int $id){
    return $this->requete('SELECT * FROM ' . $this->table . ' WHERE id = ?', [$id])->fetch();
    }

    public function findByDate($date){
        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE date = ?', [$date])->fetchAll();
    }

   public function orderBy(array $criteres){
    $champs = [];
    $valeurs = [];
      //   on boucle pour éclater le tableau
      foreach($criteres as $champ => $valeur){
      // select * from annonces where actif = ? AND signale = 0
      // bindvalue(1, valeur)
      // créons actif = ?

      $champs[] = "$champ = ?";
      $valeurs[] = $valeur;
      }
      // on transforme le tableau champ en une chaine de caractères
      $liste_champs = implode(' AND ', $champs);
    return $this->requete('SELECT * FROM ' . $this->table . ' ORDER BY ' . $champ . ' ' . $valeur)->fetchAll();
    }


    
    public function create(){
        $champs = [];
        $inter = [];
        $valeurs = [];
        //   on boucle pour éclater le tableau


        foreach($this as $champ => $valeur){
              if($valeur !== null && $champ != 'db' && $champ != 'table'){
          // INSERT INTO annonces (titre, description, actif) VALUES (?, ?, ?);
          $champs[] = $champ;
          $inter[] = '?';
          $valeurs[] = $valeur;
          } }
          // on transforme le tableau champ en une chaine de caractères
          $liste_champs = implode(' , ', $champs);
          $liste_inter = implode(' , ', $inter);
          // on peut maintenant exécuter la requête
          return $this->requete('INSERT INTO ' .$this->table.' ('.$liste_champs.') VALUES('.$liste_inter.')', $valeurs);
    }


    public function update(){
        $champs = [];
        $valeurs = [];
        //   on boucle pour éclater le tableau
        foreach($this as $champ => $valeur){
              if($valeur !== null && $champ != 'db' && $champ != 'table'){
          // UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id = ?;
          $champs[] = "$champ = ?";
          $valeurs[] = $valeur;
          } }
          $valeurs[] = $this->id;
          // on transforme le tableau champ en une chaine de caractères
          $liste_champs = implode(' , ', $champs);
          // on peut maintenant exécuter la requête
          return $this->requete('UPDATE ' .$this->table.' SET '.$liste_champs.' WHERE id = ?', $valeurs);
    }

    public function delete(int $id){
        return $this->requete('DELETE FROM ' . $this->table . ' WHERE id = ?', [$id]);
    }

   
    public function dateSearch() {
        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE date = ?', [$this->date]);
    }



    function requete(string $sql, array $attributs = null)
    {
        // on récupère l'instance de Db
        $this->db = Db::getInstance();

        // on vérifie si l'on a des attributs
        if($attributs !== null) {
            // on prépare la requête avec les attributs
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }
        else {
           // on prépare la requête sans attributs
           return $this->db->query($sql);
       }
    }

    public function hydrate($donnees){
        foreach($donnees as $key => $value){
            // on récupère le nom du setter correspondant à la clé
            $setter = "set".ucfirst($key);
            // on vérifie si le setter existe
            if(method_exists($this, $setter)){
                // si oui, on appelle le setter
                $this->$setter($value);
            }
        }
        return $this;
    }

}