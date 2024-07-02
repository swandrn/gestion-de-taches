<?php
// /models/UserModel.php

// Inclure la configuration de la base de données et la classe Utilisateur
require_once '../config/database.php';
require_once '../classes/Utilisateur.php';

class UserModel {
    private $conn;
    private $table_name = "utilisateurs"; // Nom de la table des utilisateurs

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour créer un nouvel utilisateur
    public function creerUtilisateur($utilisateur) {
        // Requête SQL pour insérer un nouvel utilisateur
        $query = "INSERT INTO " . $this->table_name . " SET nom=:nom, email=:email, mot_de_passe=:mot_de_passe";
        $stmt = $this->conn->prepare($query);

        // Lier les paramètres de la requête aux propriétés de l'utilisateur
        $stmt->bindParam(":nom", $utilisateur->getNom());
        $stmt->bindParam(":email", $utilisateur->getEmail());
        $stmt->bindParam(":mot_de_passe", $utilisateur->getMotDePasse());

        // Exécuter la requête et retourner true si elle réussit, sinon false
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Méthode pour vérifier les informations de connexion d'un utilisateur
    public function verifierUtilisateur($email, $mot_de_passe) {
        // Requête SQL pour sélectionner un utilisateur par email
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);

        // Lier le paramètre email
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si une ligne a été trouvée
        if($row) {
            // Créer un objet Utilisateur avec les données récupérées
            $utilisateur = new Utilisateur($row['nom'], $row['email'], $row['mot_de_passe']);
            $utilisateur->setId($row['id']);
            // Vérifier le mot de passe
            if($utilisateur->verifierMotDePasse($mot_de_passe)) {
                return $utilisateur; // Retourner l'utilisateur si le mot de passe est correct
            }
        }
        return null; // Retourner null si aucune correspondance ou si le mot de passe est incorrect
    }
}
?>
