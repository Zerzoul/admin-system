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
    $sanitizer = new \framework\Sanitizer($call);
    $sanitizer->sanitizeParams();
    $api = $app->api($call);
    $data = $api->getData();

    echo $data;

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

