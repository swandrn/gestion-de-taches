<?php include 'header.php'; ?>

<div class="container">
    <h2>Modifier la tâche</h2>
    <form action="index.php?action=edit_task&task_id=<?php echo htmlspecialchars($task['id']); ?>" method="POST">
        <div class="form-group">
            <label for="title">Titre :</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($task['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="priorite">Priorité :</label>
            <input type="number" class="form-control" id="priorite" name="priorite" value="<?php echo htmlspecialchars($task['priorite']); ?>" required>
        </div>
        <div class="form-group">
            <label for="date_echeance">Date d'échéance :</label>
            <input type="date" class="form-control" id="date_echeance" name="date_echeance" value="<?php echo htmlspecialchars($task['date_echeance']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>

<?php include 'footer.php'; ?>