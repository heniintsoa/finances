<?php
require_once __DIR__ . '/../db.php';

class Insertion_prets {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM t_pret");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM t_pret WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function montant_total($montant_prets, $idtypepret, $nb_mois) {
        $prets = Prets::getById($idtypepret);
        $taux = $prets->taux_mois;

        $calcule = $montant_prets + ((($motant * $taux)/100) * $nb_mois);
        return $calcule;
    }

    public static function motant_par_mois($montant_prets, $idtypepret, $nb_mois){
        $prets = Prets::getById($idtypepret);
        $taux = ($motant *($prets->taux_mois))/100;

        $calcule = ($montant_prets/$nb_mois)+ $taux;
        return $calcule;
    }

    public static function create($data, $motant_par_mois) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO t_pret (idclient, idtypepret, mois_debut, mois_fin, motant_par_mois) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data->idclient, $data->idtypepret, $data->mois_debut, $data->mois_fin, $motant_par_mois]);
        return $db->lastInsertId();
    }

    public static function update($id, $data, $motant_par_mois) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE t_pret SET idclient = ?, idtypepret =?, mois_debut=?, mois_fin=?, motant_par_mois=? WHERE id = ?");
        $stmt->execute([$data->idclient, $data->idtypepret, $data->mois_debut, $data->mois_fin, $motant_par_mois, $id]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM t_pret WHERE id = ?");
        $stmt->execute([$id]);
    }

}