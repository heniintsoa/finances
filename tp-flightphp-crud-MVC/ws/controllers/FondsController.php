<?php 
    require_once __DIR__ . '/../models/Fonds.php';
    require_once __DIR__ . '/../helpers/Utils.php';
    
    class FondsController{
        public static function create() {
            $data = Flight::request()->data;
        
                if (!isset($data->montant) || empty($data->montant)) {
                    Flight::json(['error' => 'Le montant est requis.'], 400);
                    return;
                }
                if (!isset($data->type_operation)) {
                    $data->type_operation = 'entree';
                }
                if (!isset($data->date_operation)) {
                    $data->date_operation = date('Y-m-d');
                }
        function construireFonds($data) {
            $data = Flight::request()->data;
            
            Fonds::create($data);
            Flight::redirect('/ajout-fond?success=1');
            }
        }
    }
?>
