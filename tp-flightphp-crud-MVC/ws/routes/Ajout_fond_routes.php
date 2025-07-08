<?php
Flight::route('GET /ajout-fond', function() {
    // Set the page to be included in the template
    $page = 'Ajout_fond';
    
    // Render the template with the specified page
    Flight::render('Template', ['page' => $page]);
});

