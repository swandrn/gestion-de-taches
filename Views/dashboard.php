<?php include 'header.php'; ?>
<div class="container mt-5">
    <h1 class="text-center">Tableau de Bord</h1>
    <p class="tacheRealise">Vous avez <span id="completedCount">0</span> tâche(s) réalisée(s) sur <span id="totalCount"><?php echo count($tasks); ?></span> tâche(s).</p>

   <div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <label for="triSelect" class="form-label">Trier par :</label>
            <select id="triSelect" class="form-select select-inline">
                <option value="none">Sélectionner</option>
                <option value="date">Date</option>
                <option value="priority">Priorité</option>
            </select>

            <div id="triDateContainer" class="select-inline d-none">
                <label for="triDateSelect" class="form-label">Ordre :</label>
                <select id="triDateSelect" class="form-select">
                    <option value="asc">Descendant</option>
                    <option value="desc">Ascendant</option>
                </select>
            </div>

            <div id="triPriorityContainer" class="select-inline d-none">
                <label for="triPrioritySelect" class="form-label">Ordre :</label>
                <select id="triPrioritySelect" class="form-select">
                    <option value="asc">Descendant</option>
                    <option value="desc">Ascendant</option>
                </select>
            </div>
        </div>
    </div>
</div>

    <a href="index.php?action=add_task" class="btn btn-success" id="btnAjout">Ajouter une tâche</a>
    <table class="table">
        <thead>
            <tr class="table-active">
                <th scope="col">Réalisée</th>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Priorité</th>
                <th scope="col">Date d'échéance</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="tasksTableBody">
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

<script src="Js/trieur.js"></script>
<?php include 'footer.php'; ?>
