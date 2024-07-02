<?php include 'header.php'; ?>

<div class="container">
    <h2>Tableau de bord</h2>
    <?php
    // Tableau associatif pour les priorités
    $priorities = [
        0 => 'Basse',
        1 => 'Normale',
        2 => 'Urgente'
    ];
    ?>
    <a href="index.php?action=add_task" class="btn btn-success mb-3">Ajouter tâche</a>
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
                    <td><?php echo htmlspecialchars($priorities[$task['priorite']]); ?></td>
                    <td><?php echo htmlspecialchars($task['date_echeance']); ?></td>
                    <td>
                        <a href="index.php?action=edit_task&task_id=<?php echo $task['id']; ?>" class="btn btn-primary">Modifier</a>
                        <a href="index.php?action=delete_task&task_id=<?php echo $task['id']; ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
