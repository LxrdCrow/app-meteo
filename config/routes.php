<?php

require_once __DIR__ . '/../src/Router.php';

$router = new Router();


$router->addRoute("GET", "/", function() {
    echo "Homepage";
});

$router->addRoute("GET", "/meteo", function() {
    echo "Pagina meteo";
});


$router->addRoute("POST", "/meteo", function() {
    echo "Aggiunta nuova previsione meteo";
});


$router->addRoute("PUT", "/meteo", function() {
    echo "Previsione meteo aggiornata";
});


$router->addRoute("DELETE", "/meteo", function() {
    echo "Previsione meteo eliminata";
});

?>


