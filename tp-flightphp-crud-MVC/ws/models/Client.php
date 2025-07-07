<?php
require_once __DIR__ . '/../db.php';

class Client{
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM t_client");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM t_client WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}