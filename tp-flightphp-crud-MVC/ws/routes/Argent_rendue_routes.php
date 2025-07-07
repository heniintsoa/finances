<?php

Flight::route('GET /Argent-Rendue', function(){
    // Set the page to be included in the template
    $page = 'Argent-Rendue';
    
    // Render the template with the specified page
    Flight::render('Template', ['page' => $page]);
});