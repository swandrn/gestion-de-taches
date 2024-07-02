<?php include 'header.php'; ?>

<div class="container">
    <h2>Tableau de bord</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Priorité</th>
                <th>Date d'échéance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo htmlspecialchars($task['title']); ?></td>
                    <td><?php echo htmlspecialchars($task['description']); ?></td>
                    <td><?php echo htmlspecialchars($task['priorite']); ?></td>
                    <td><?php echo htmlspecialchars($task['date_echeance']); ?></td>
                    <td>
                        <a href="index.php?action=edit_task&task_id=<?php echo $task['id']; ?>" class="btn btn-primary">Modifier</a>
                        <a href="index.php?action=delete_task&task_id=<?php echo $task['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php?action=add_task" class="btn btn-success">Ajouter une tâche</a>
</div>

<?php include 'footer.php'; ?>
