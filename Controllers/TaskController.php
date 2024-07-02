<?php

class TaskController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function showAddTaskForm() {
        // Affiche le formulaire pour ajouter une tâche
        include 'views/add_task.php';
    }

    public function showEditTaskForm($task_id) {
        // Récupérer les informations de la tâche à modifier
        $query = "SELECT * FROM taches WHERE id = :task_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':task_id', $task_id);
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

    public function addTask($title, $description, $priority, $due_date, $user_id) {
        // Insérer une nouvelle tâche dans la base de données
        $query = "INSERT INTO taches (utilisateur_id, title, description, priorite, date_echeance) VALUES (:user_id, :title, :description, :priority, :due_date)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':due_date', $due_date);

        return $stmt->execute();
    }

    public function editTask($task_id, $title, $description, $priority, $due_date) {
        // Mettre à jour une tâche existante
        $query = "UPDATE taches SET title = :title, description = :description, priorite = :priority, date_echeance = :due_date WHERE id = :task_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':due_date', $due_date);
        $stmt->bindParam(':task_id', $task_id);

        return $stmt->execute();
    }

    public function deleteTask($task_id) {
        // Supprimer une tâche
        $query = "DELETE FROM taches WHERE id = :task_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':task_id', $task_id);

        return $stmt->execute();
    }

    public function showDashboard($user_id) {
        // Récupérer les tâches de l'utilisateur depuis la base de données
        $query = "SELECT * FROM taches WHERE utilisateur_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Affiche le tableau de bord avec les tâches de l'utilisateur
        include 'views/dashboard.php';
    }
}
?>

