<?php
// Classe qui gère les opérations liées aux tâches
class GestionnaireDeTaches {
    // Tableau pour stocker les tâches
    private $taches = [];

    // Méthode pour ajouter une tâche
    public function ajouterTache($tache) {
        // Ajoute la tâche à la liste des tâches
        $this->taches[] = $tache;
    }

    // Méthode pour modifier une tâche existante
    public function modifierTache($id, $nouvelleTache) {
        // Parcourt la liste des tâches
        foreach ($this->taches as &$tache) {
            // Si l'ID de la tâche correspond à celui recherché
            if ($tache->getId() == $id) {
                // Remplace l'ancienne tâche par la nouvelle
                $tache = $nouvelleTache;
                return true;
            }
        }
        return false; // Renvoie false si l'ID n'est pas trouvé
    }

    // Méthode pour supprimer une tâche
    public function supprimerTache($id) {
        // Parcourt la liste des tâches
        foreach ($this->taches as $key => $tache) {
            // Si l'ID de la tâche correspond à celui recherché
            if ($tache->getId() == $id) {
                // Supprime la tâche du tableau
                unset($this->taches[$key]);
                return true;
            }
        }
        return false; // Renvoie false si l'ID n'est pas trouvé
    }

    // Méthode pour lister toutes les tâches
    public function listerTaches() {
        // Retourne le tableau des tâches
        return $this->taches;
    }
}
?>
