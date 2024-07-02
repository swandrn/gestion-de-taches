<?php 

// Inclure la configuration de la base de données et la classe Tache
require_once '../config/database.php';
require_once '../classes/Tache.php';

class TaskModel {
    private $conn;
    private $table_name = "taches"; // Nom de la table des tâches

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour créer une nouvelle tâche
    public function creerTache($tache, $utilisateur_id) {
        // Requête SQL pour insérer une nouvelle tâche
        $query = "INSERT INTO " . $this->table_name . " SET description=:description, date_echeance=:date_echeance, priorite=:priorite, statut=:statut, utilisateur_id=:utilisateur_id";
        $stmt = $this->conn->prepare($query);

        // Lier les paramètres de la requête aux propriétés de la tâche
        $stmt->bindParam(":description", $tache->getDescription());
        $stmt->bindParam(":date_echeance", $tache->getDateEcheance());
        $stmt->bindParam(":priorite", $tache->getPriorite());
        $stmt->bindParam(":statut", $tache->getStatut());
        $stmt->bindParam(":utilisateur_id", $utilisateur_id);

        // Exécuter la requête et retourner true si elle réussit, sinon false
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Méthode pour lire les tâches d'un utilisateur
    public function lireTaches($utilisateur_id) {
        // Requête SQL pour sélectionner les tâches d'un utilisateur spécifique
        $query = "SELECT * FROM " . $this->table_name . " WHERE utilisateur_id = :utilisateur_id";
        $stmt = $this->conn->prepare($query);

        // Lier le paramètre utilisateur_id
        $stmt->bindParam(":utilisateur_id", $utilisateur_id);
        $stmt->execute();

        // Créer un tableau pour stocker les tâches
        $taches = [];
        
        // Parcourir les résultats de la requête et créer des objets Tache pour chaque ligne
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tache = new Tache($row['description'], $row['date_echeance'], $row['priorite']);
            $tache->setId($row['id']);
            $tache->setStatut($row['statut']);
            $taches[] = $tache;
        }
        // Retourner le tableau des tâches
        return $taches;
    }
}
?>
