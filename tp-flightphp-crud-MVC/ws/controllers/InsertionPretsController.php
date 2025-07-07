<?php
require_once __DIR__ . '/../models/Etudiant.php';
require_once __DIR__ . '/../helpers/Utils.php';

class InsertionPretsController {

    public static function insertion() {
        $data = [
            'client' => Client::getAll(),
            'prets' => Prets::getAll()
        ];

        Flight::render('insertion_prets', $data);
    }

    public static function create() {
        $data = Flight::request()->data;
        $interval = ($data->mois_fin)->diff($data->mois_debut);
        $nb_mois = $interval->y*12 + $interval->m;
        $montant_par_mois = Insertion_prets::motant_par_mois($data->montant_prets, $data->idtypepret, $nb_mois);
        $id = Insertion_prets::create($data);
    }
}