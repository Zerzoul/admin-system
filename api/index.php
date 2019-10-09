<?php
/**
 * api/index.php for return data from database.
 */
require '../framework/lib/Autoloader.php';
\framework\Autoloader::register();

try {

    $app = \framework\App::getInstance();
    $router = $app->initRouter( $_GET['url'], '\apiRoutes');
    $call = $router->run();

    $page = $app->api($call);
    $api = $page->fetchData('api');

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');

    echo json_encode($api);

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

