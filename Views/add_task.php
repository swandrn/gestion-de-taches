<?php include 'header.php'; ?>
<div class="container">
    <h2 class="mt-5">Ajouter une tâche</h2>
    <form action="index.php?action=add_task" method="POST">
        <div class="form-group">
            <label for="title">Titre :</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="priority">Priorité :</label>
            <select class="form-control" id="priority" name="priority">
                <option value="0">Basse</option>
                <option value="1">Normale</option>
                <option value="2">Urgente</option>
            </select>
        </div>
        <div class="form-group">
            <label for="due_date">Date d'échéance :</label>
            <input type="date" class="form-control" id="due_date" name="due_date">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Retour au tableau de bord</a>
</div>
<?php include 'footer.php'; ?>
