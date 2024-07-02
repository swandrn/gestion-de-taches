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

    public function updateTask($task_id) {
        // Mettre à jour une tâche
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priorite = $_POST['priorite'];
        $date_echeance = $_POST['date_echeance'];

        $query = "UPDATE taches SET title = :title, description = :description, priorite = :priorite, date_echeance = :date_echeance WHERE id = :task_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priorite', $priorite);
        $stmt->bindParam(':date_echeance', $date_echeance);
        $stmt->bindParam(':task_id', $task_id);

        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Erreur lors de la mise à jour de la tâche.";
        }
    }

    public function deleteTask($task_id) {
        // Supprimer une tâche
        $query = "DELETE FROM taches WHERE id = :task_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':task_id', $task_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
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
