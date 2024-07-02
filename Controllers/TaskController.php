<?php

class TaskController {
    private $db; // Instance de la base de données

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->db = $db;
    }

    // Affiche le formulaire pour ajouter une tâche
    public function showAddTaskForm() {
        include 'views/add_task.php'; // Inclure la vue du formulaire d'ajout de tâche
    }

    // Affiche le formulaire pour modifier une tâche
    public function showEditTaskForm($task_id) {
        // Récupérer les informations de la tâche à modifier
        $query = "SELECT * FROM taches WHERE id = :task_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':task_id', $task_id); // Lier l'identifiant de la tâche
        $stmt->execute();
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si la tâche existe
        if ($task) {
            // Inclure la vue avec les données de la tâche
            include 'views/edit_task.php';
        } else {
            // Rediriger vers le tableau de bord si la tâche n'existe pas
            header('Location: index.php');
            exit();
        }
    }

    // Supprime une tâche (logique à implémenter)
    public function deleteTask($task_id) {
        // Logique de suppression de la tâche
    }

    // Affiche le tableau de bord avec les tâches de l'utilisateur
    public function showDashboard($user_id) {
        // Récupérer les tâches de l'utilisateur depuis la base de données
        $query = "SELECT * FROM taches WHERE utilisateur_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id); // Lier l'identifiant de l'utilisateur
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Inclure la vue du tableau de bord avec les tâches de l'utilisateur
        include 'views/dashboard.php';
    }
}

?>

