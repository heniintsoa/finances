<?php
require_once __DIR__ . '/../db.php';

class Fonds{

    private $db;
    public function __construct() {
        $this->db = getDB();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM t_fonds");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM t_fonds WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
            $db = getDB();
            $stmt = $db->prepare("INSERT INTO t_fonds (id, montant, type_operation, date_operation, descri) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$data->id, $data->montant, $data->type_operation, $data->date_operation, $data->descri]);
            return $db->lastInsertId();
        }
    
     public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE t_fonds SET montant = ?, type_operation = ?, descri = ? WHERE id = ?");
        return $stmt->execute([$data['montant'], $data['type_operation'], $data['descri'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM t_fonds WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
