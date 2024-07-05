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

    public function addTask() {
        // Vérifier que la méthode est POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $priorite = $_POST['priority'];
            $date_echeance = $_POST['due_date'];
            $utilisateur_id = $_SESSION['user_id']; // Assurez-vous que l'utilisateur est connecté
    
            // Préparer la requête d'insertion
            $query = "INSERT INTO taches (utilisateur_id, title, description, priorite, date_echeance) 
                      VALUES (:utilisateur_id, :title, :description, :priorite, :date_echeance)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':utilisateur_id', $utilisateur_id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':priorite', $priorite);
            $stmt->bindParam(':date_echeance', $date_echeance);
    
            // Exécuter la requête
            if ($stmt->execute()) {
                header('Location: index.php');
                exit();
            } else {
                echo "Erreur lors de l'ajout de la tâche.";
            }
        }
    }

    public function updateTask($task_id) {
        // Mettre à jour une tâche
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $due_date = $_POST['due_date'];

        $query = "UPDATE taches SET title = :title, description = :description, priorite = :priorite, date_echeance = :date_echeance WHERE id = :task_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priorite', $priority);
        $stmt->bindParam(':date_echeance', $due_date);
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

    public function fetchTasks() {
        // Récupérer les paramètres de tri depuis la requête GET
        $triType = $_GET['triType'] ?? 'none'; // Type de tri (date ou priority), 'none' par défaut
        $triOrder = $_GET['triOrder'] ?? ''; // Ordre de tri (asc ou desc), chaîne vide par défaut
    
        // Commencer la requête SQL pour sélectionner toutes les tâches de l'utilisateur connecté
        $query = "SELECT * FROM taches WHERE utilisateur_id = :user_id";
    
        // Ajouter une clause ORDER BY à la requête en fonction du type de tri sélectionné
        if ($triType === 'date') {
            // Trier par date d'échéance en ordre ascendant ou descendant
            $query .= ' ORDER BY date_echeance ' . ($triOrder === 'asc' ? 'ASC' : 'DESC');
        } elseif ($triType === 'priority') {
            // Trier par priorité en ordre ascendant ou descendant
            $query .= ' ORDER BY priorite ' . ($triOrder === 'asc' ? 'ASC' : 'DESC');
        }
    
        // Préparer la requête SQL
        $stmt = $this->db->prepare($query);
    
        // Lier le paramètre utilisateur_id à la valeur de l'ID de l'utilisateur connecté
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
    
        // Exécuter la requête
        $stmt->execute();
    
        // Récupérer toutes les tâches résultantes de la requête
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Encoder les tâches en JSON et les renvoyer comme réponse
        echo json_encode($tasks);
        
        // Terminer le script après avoir envoyé la réponse
        exit;
    }
    
}
?>
