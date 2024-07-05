document.addEventListener('DOMContentLoaded', function() {
    const triSelect = document.getElementById('triSelect');
    const triDateContainer = document.getElementById('triDateContainer');
    const triDateSelect = document.getElementById('triDateSelect');
    const triPriorityContainer = document.getElementById('triPriorityContainer');
    const triPrioritySelect = document.getElementById('triPrioritySelect');
    const tasksTableBody = document.getElementById('tasksTableBody');

    triSelect.addEventListener('change', function() {
        const selectedValue = this.value;

        // Masquer tous les conteneurs de tri
        triDateContainer.classList.add('d-none');
        triPriorityContainer.classList.add('d-none');

        // Afficher le conteneur correspondant au choix
        if (selectedValue === 'date') {
            triDateContainer.classList.remove('d-none');
        } else if (selectedValue === 'priority') {
            triPriorityContainer.classList.remove('d-none');
        }

        // Rechercher les tâches triées
        fetchTasks();
    });

    triDateSelect.addEventListener('change', fetchTasks);
    triPrioritySelect.addEventListener('change', fetchTasks);

    function fetchTasks() {
        const triType = triSelect.value;
        let triOrder = '';

        if (triType === 'date') {
            triOrder = triDateSelect.value;
        } else if (triType === 'priority') {
            triOrder = triPrioritySelect.value;
        }

        fetch(`index.php?action=fetch_tasks&triType=${triType}&triOrder=${triOrder}`)
            .then(response => response.json())
            .then(data => {
                tasksTableBody.innerHTML = '';
                data.forEach(task => {
                    const tr = document.createElement('tr');

                    const tdCompleted = document.createElement('td');
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.classList.add('task-completed');
                    checkbox.dataset.taskId = task.id;
                    if (task.is_completed) {
                        checkbox.checked = true;
                    }
                    tdCompleted.appendChild(checkbox);
                    tr.appendChild(tdCompleted);

                    const tdTitle = document.createElement('td');
                    tdTitle.textContent = task.title;
                    tr.appendChild(tdTitle);

                    const tdDescription = document.createElement('td');
                    tdDescription.textContent = task.description;
                    tr.appendChild(tdDescription);

                    const tdPriority = document.createElement('td');
                    tdPriority.textContent = ['Urgente', 'Normale', 'Basse'][task.priorite] || 'Non spécifiée';
                    tr.appendChild(tdPriority);

                    const tdDate = document.createElement('td');
                    tdDate.textContent = task.date_echeance;
                    tr.appendChild(tdDate);

                    const tdActions = document.createElement('td');
                    const editButton = document.createElement('a');
                    editButton.href = `index.php?action=edit_task&task_id=${task.id}`;
                    editButton.classList.add('btn', 'btn-primary', 'btn-sm');
                    editButton.textContent = 'Modifier';
                    tdActions.appendChild(editButton);

                    const deleteButton = document.createElement('a');
                    deleteButton.href = `index.php?action=delete_task&task_id=${task.id}`;
                    deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');
                    deleteButton.textContent = 'Supprimer';
                    tdActions.appendChild(deleteButton);

                    tr.appendChild(tdActions);

                    tasksTableBody.appendChild(tr);
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des tâches triées:', error));
    }
});
