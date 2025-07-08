<?php

require_once __DIR__ . '/../models/TypePret.php'; 

require_once __DIR__ . '/../helpers/Utils.php';

class TypePretController {

    private $model;

    public function __construct() {
        $this->model = new TypePret();
    }

    public function getAll() {
        $data = $this->model->getAll();
        Flight::json($data);
    }

    public function getById($id) {
        $data = $this->model->getById($id);
        if ($data) {
            Flight::json($data);
        } else {
            Flight::halt(404, 'Type de prêt non trouvé');
        }
    }

    public function create() {
        $data = Flight::request()->data;
        if (!isset($data['nom']) || !isset($data['taux_mois'])) {
            Flight::halt(400, 'Champs requis manquants');
        }

        $id = $this->model->create($data);
        Flight::json(['message' => 'Ajouté', 'id' => $id], 201);
    }

    public function update($id) {
        $data = Flight::request()->data;
        $updated = $this->model->update($id, $data);
        if ($updated) {
            Flight::json(['message' => 'Modifié']);
        } else {
            Flight::halt(404, 'Échec de la mise à jour');
        }
    }

    public function delete($id) {
        $deleted = $this->model->delete($id);
        if ($deleted) {
            Flight::json(['message' => 'Supprimé']);
        } else {
            Flight::halt(404, 'Échec de la suppression');
        }
    }
}
