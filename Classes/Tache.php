<?php
// Classe qui représente une tâche
class Tache {
    // Propriétés de la tâche
    private $id;
    private $description;
    private $date_echeance;
    private $priorite;
    private $statut; // 0 = en cours, 1 = complet

    // Constructeur pour initialiser une nouvelle tâche
    public function __construct($description, $date_echeance, $priorite) {
        $this->description = $description;
        $this->date_echeance = $date_echeance;
        $this->priorite = $priorite;
        $this->statut = 0; // Par défaut, le statut est "en cours"
    }

    // Getters pour accéder aux propriétés
    public function getId() { return $this->id; }
    public function getDescription() { return $this->description; }
    public function getDateEcheance() { return $this->date_echeance; }
    public function getPriorite() { return $this->priorite; }
    public function getStatut() { return $this->statut; }

    // Setters pour modifier les propriétés
    public function setId($id) { $this->id = $id; }
    public function setDescription($description) { $this->description = $description; }
    public function setDateEcheance($date_echeance) { $this->date_echeance = $date_echeance; }
    public function setPriorite($priorite) { $this->priorite = $priorite; }
    public function setStatut($statut) { $this->statut = $statut; }
}
?>
