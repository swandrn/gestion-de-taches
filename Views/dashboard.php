<?php include 'header.php'; ?>
<h2>Vos Tâches</h2>
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
        <?php if (isset($tasks) && is_array($tasks) && count($tasks) > 0): ?>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo htmlspecialchars($task['title']); ?></td>
                    <td><?php echo htmlspecialchars($task['description']); ?></td>
                    <td><?php echo htmlspecialchars($task['priorite']); ?></td>
                    <td><?php echo htmlspecialchars($task['date_echeance']); ?></td>
                    <td>
                        <a href="index.php?action=edit_task&task_id=<?php echo $task['id']; ?>" class="btn btn-warning">Modifier</a>
                        <a href="index.php?action=delete_task&task_id=<?php echo $task['id']; ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Aucune tâche trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>
