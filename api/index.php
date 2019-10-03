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
    $page = $app->getApi($call);
    $api = $page->returnApi('api');

    echo json_encode($api);

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

