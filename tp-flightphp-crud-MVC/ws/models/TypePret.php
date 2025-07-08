<?php

require_once __DIR__ . '/../db.php';
class TypePret {

    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM t_typepret");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM t_typepret WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO t_typepret (nom, taux_mois) VALUES (?, ?)");
        $stmt->execute([$data['nom'], $data['taux_mois']]);
        return $this->db->lastInsertId();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE t_typepret SET nom = ?, taux_mois = ? WHERE id = ?");
        return $stmt->execute([$data['nom'], $data['taux_mois'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM t_typepret WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
