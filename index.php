<?php
// index.php

// Démarrer la session pour suivre l'utilisateur connecté
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
            // Afficher le formulaire pour ajouter une tâche si l'utilisateur est connecté
            if (isset($_SESSION['user_id'])) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $taskController->addTask();
                } else {
                    $taskController->showAddTaskForm();
                }
            } else {
                // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
                header('Location: index.php?action=login');
                exit();
            }
            break;
        case 'edit_task':
            // Afficher le formulaire pour modifier une tâche si l'utilisateur est connecté et si l'ID de la tâche est fourni
            if (isset($_SESSION['user_id']) && isset($_GET['task_id'])) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $taskController->updateTask($_GET['task_id']);
                } else {
                    $taskController->showEditTaskForm($_GET['task_id']);
                }
            } else {
                // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
                header('Location: index.php?action=login');
                exit();
            }
            break;
        case 'delete_task':
            // Supprimer une tâche si l'utilisateur est connecté et si l'ID de la tâche est fourni
            if (isset($_SESSION['user_id']) && isset($_GET['task_id'])) {
                if ($taskController->deleteTask($_GET['task_id'])) {
                    // Rediriger vers le tableau de bord après suppression
                    header('Location: index.php');
                    exit();
                } else {
                    echo "Erreur lors de la suppression de la tâche.";
                }
            } else {
                // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
                header('Location: index.php?action=login');
                exit();
            }
            break;
        case 'fetch_tasks':
            // Récupérer les tâches triées
            if (isset($_SESSION['user_id'])) {
                $taskController->fetchTasks();
            } else {
                // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
                header('Location: index.php?action=login');
                exit();
            }
            break;
        case 'logout':
            // Déconnecter l'utilisateur
            $userController->logout();
            break;
        case 'login':
            // Gérer le formulaire de connexion
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userController->login();
            } else {
                $userController->showLoginForm();
            }
            break;
        case 'register':
            // Gérer le formulaire d'inscription
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userController->register();
            } else {
                $userController->showRegisterForm();
            }
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
