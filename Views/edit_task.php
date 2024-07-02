<?php include 'header.php'; ?>

<div class="container">
    <h2>Modifier une tâche</h2>
    <form action="index.php?action=edit_task&task_id=<?php echo htmlspecialchars($task['id']); ?>" method="POST">
        <div class="form-group">
            <label for="title">Titre :</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($task['title']) ? htmlspecialchars($task['title']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" id="description" name="description" required><?php echo isset($task['description']) ? htmlspecialchars($task['description']) : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="priority">Priorité :</label>
            <select class="form-control" id="priority" name="priority">
                <option value="1" <?php if (isset($task['priorite']) && $task['priorite'] == 1) echo 'selected'; ?>>Basse</option>
                <option value="2" <?php if (isset($task['priorite']) && $task['priorite'] == 2) echo 'selected'; ?>>Normale</option>
                <option value="3" <?php if (isset($task['priorite']) && $task['priorite'] == 3) echo 'selected'; ?>>Urgente</option>
            </select>
        </div>
        <div class="form-group">
            <label for="due_date">Date d'échéance :</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo isset($task['date_echeance']) ? htmlspecialchars($task['date_echeance']) : ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Retour au tableau de bord</a>
</div>

<?php include 'footer.php'; ?>

