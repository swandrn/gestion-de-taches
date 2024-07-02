<?php include 'header.php'; ?>

<div class="container">
    <h2>Ajouter une tâche</h2>
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
            <div class="select-container">
    <select class="form-control" id="priority" name="priority" onchange="stylePriority(this)">
        <option value="0" class="low-priority">Basse</option>
        <option value="1" class="normal-priority">Normale</option>
        <option value="2" class="high-priority">Urgente</option>
    </select>
</div>


        </div>
        <div class="form-group">
            <label for="date_echeance">Date d'échéance :</label>
            <input type="date" class="form-control" id="date_echeance" name="date_echeance" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter la tâche</button>
    </form>
</div>

<?php include 'footer.php'; ?>
