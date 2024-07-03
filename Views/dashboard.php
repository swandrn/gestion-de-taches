<?php include 'header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center">Tableau de Bord</h2>
    <p>Vous avez <span id="completedCount">0</span> tâche(s) réalisée(s) sur <span id="totalCount"><?php echo count($tasks); ?></span> tâche(s).</p>
    <a href="index.php?action=add_task" class="btn btn-success">Ajouter une tâche</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Réalisée</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Priorité</th>
                <th scope="col">Date d'échéance</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td>
                        <input type="checkbox" class="task-completed" data-task-id="<?php echo htmlspecialchars($task['id']); ?>" <?php echo $task['is_completed'] ? 'checked' : ''; ?>>
                    </td>
                    <td><?php echo htmlspecialchars($task['title']); ?></td>
                    <td><?php echo htmlspecialchars($task['description']); ?></td>
                    <td>
                        <?php
                        switch ($task['priorite']) {
                            case 0:
                                echo "Urgente";
                                break;
                            case 1:
                                echo "Normale";
                                break;
                            case 2:
                                echo "Basse";
                                break;
                            default:
                                echo "Non spécifiée";
                                break;
                        }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($task['date_echeance']); ?></td>
                    <td>
                        <a href="index.php?action=edit_task&task_id=<?php echo htmlspecialchars($task['id']); ?>" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="index.php?action=delete_task&task_id=<?php echo htmlspecialchars($task['id']); ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="script.js"></script>
<?php include 'footer.php'; ?>
