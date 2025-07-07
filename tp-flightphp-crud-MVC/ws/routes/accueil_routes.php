<?php

Flight::route('GET /accueil', function(){
    // Set the page to be included in the template
    $page = 'accueil';
    
    // Render the template with the specified page
    Flight::render('Template', ['page' => $page]);
});

