<?php
session_start();

// Inclure la configuration de la base de données
require_once 'config/bdd.php';

// Inclure les contrôleurs nécessaires pour gérer les utilisateurs et les tâches
require_once 'controllers/UserController.php';
require_once 'controllers/TaskController.php';

// Créer une connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Créer des instances des contrôleurs
$userController = new UserController($db);
$taskController = new TaskController($db);

// Vérifier si une action est demandée dans l'URL
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add_task':
            // Vérifier si l'utilisateur est connecté
            if (isset($_SESSION['user_id'])) {
                // Vérifier si le formulaire d'ajout de tâche a été soumis
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['description'], $_POST['priority'], $_POST['due_date'])) {
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $priority = $_POST['priority'];
                    $due_date = $_POST['due_date'];

                    // Appeler la méthode pour ajouter une tâche dans TaskController
                    $taskController->addTask($title, $description, $priority, $due_date);

                    // Redirection après l'ajout
                    header('Location: index.php');
                    exit();
                } else {
                    // Afficher le formulaire pour ajouter une tâche
                    $taskController->showAddTaskForm();
                }
            } else {
                // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
                header('Location: index.php?action=login');
                exit();
            }
            break;
        case 'edit_task':
            // Vérifier si l'utilisateur est connecté et si l'ID de la tâche est fourni
            if (isset($_SESSION['user_id']) && isset($_GET['task_id'])) {
                // Vérifier si le formulaire de modification de tâche a été soumis
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['description'], $_POST['priority'], $_POST['due_date'])) {
                    $task_id = $_GET['task_id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $priority = $_POST['priority'];
                    $due_date = $_POST['due_date'];

                    // Appeler la méthode pour modifier une tâche dans TaskController
                    $taskController->editTask($task_id, $title, $description, $priority, $due_date);

                    // Redirection après la modification
                    header('Location: index.php');
                    exit();
                } else {
                    // Afficher le formulaire pour modifier une tâche
                    $taskController->showEditTaskForm($_GET['task_id']);
                }
            } else {
                // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté ou si l'ID de la tâche n'est pas fourni
                header('Location: index.php?action=login');
                exit();
            }
            break;
        case 'delete_task':
            // Supprimer une tâche si l'utilisateur est connecté et si l'ID de la tâche est fourni
            if (isset($_SESSION['user_id']) && isset($_GET['task_id'])) {
                $taskController->deleteTask($_GET['task_id']);
                // Rediriger vers le tableau de bord après suppression
                header('Location: index.php');
                exit();
            } else {
                // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté ou si l'ID de la tâche n'est pas fourni
                header('Location: index.php?action=login');
                exit();
            }
            break;
        case 'logout':
            // Déconnexion de l'utilisateur
            $userController->logout();
            break;
        case 'login':
            // Afficher le formulaire de connexion
            $userController->showLoginForm();
            break;
        case 'register':
            // Afficher le formulaire d'inscription
            $userController->showRegisterForm();
            break;
        default:
            // Rediriger vers la page d'accueil par défaut si l'action demandée n'est pas reconnue
            header('Location: index.php');
            exit();
            break;
    }
} else {
    // Afficher le tableau de bord par défaut si aucune action n'est demandée
    if (isset($_SESSION['user_id'])) {
        $taskController->showDashboard($_SESSION['user_id']);
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        header('Location: index.php?action=login');
        exit();
    }
}
?>
