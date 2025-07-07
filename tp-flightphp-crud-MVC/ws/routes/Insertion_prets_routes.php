<?php
require_once __DIR__ . '/../controllers/InsertionPretsController.php';

Flight::route('GET /Insertion_prets', ['InsertionPretsController', 'insertion']);
Flight::route('POST /insertion', ['InsertionPretsController', 'create']);



