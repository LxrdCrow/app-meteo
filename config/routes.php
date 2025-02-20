<?php

require_once __DIR__ . '/../src/Router.php';

$router = new Router();


$router->addRoute("GET", "/", function() {
    echo "Homepage";
});

$router->addRoute("GET", "/meteo", function() {
    echo "Get forecast";
});


$router->addRoute("POST", "/meteo", function() {
    echo "Forecast saved"; 
});


$router->addRoute("PUT", "/meteo", function() {
    echo "Forecast updated";
});


$router->addRoute("DELETE", "/meteo", function() {
    echo "Forecast deleted";
});

?>


