document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.task-completed');
    const totalCountElement = document.getElementById('totalCount');
    const completedCountElement = document.getElementById('completedCount');

    let totalTasks = checkboxes.length;
    let completedTasks = 0;

    if (checkboxes.length > 0 && totalCountElement && completedCountElement) {
        checkboxes.forEach(checkbox => {
            const taskId = checkbox.dataset.taskId;

            // Vérifier si l'état de la checkbox est stocké en localStorage
            const isChecked = localStorage.getItem(`task_${taskId}`) === 'true';
            checkbox.checked = isChecked;

            // Incrémenter le compteur de tâches réalisées
            if (isChecked) {
                completedTasks++;
            }

            // Ajouter un écouteur d'événement pour sauvegarder l'état et mettre à jour le compteur
            checkbox.addEventListener('change', function() {
                localStorage.setItem(`task_${taskId}`, checkbox.checked);

                if (checkbox.checked) {
                    completedTasks++;
                } else {
                    completedTasks--;
                }

                // Mettre à jour l'affichage du compteur
                updateCounter(completedTasks, totalTasks);
            });
        });

        // Fonction pour mettre à jour le compteur de tâches réalisées
        function updateCounter(completedCount, totalCount) {
            completedCountElement.textContent = completedCount;
            totalCountElement.textContent = totalCount;
        }

        // Initialiser le compteur au chargement de la page
        updateCounter(completedTasks, totalTasks);
    }
});
