<?php
// bdd.php
class Database {
    private $host = "localhost";
    private $db_name = "gestion_taches";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->conn;
    }
}

// Test de la connexion
$database = new Database();
$conn = $database->getConnection();
if ($conn) {
    echo "Connexion réussie.";
} else {
    echo "Erreur de connexion.";
}

?>

