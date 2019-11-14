<?php
/**
 * api/index.php for return data from database.
 * don't forget to set up dsn.php to dataBase connexion
 */
require '../framework/lib/Autoloader.php';
\framework\Autoloader::register();

try {

    $app = \framework\App::getInstance();
    // setUp the routes with the current url.
    $router = $app->initRouter( $_GET['url'], 'apiRoutes');
    // catch the return for calling class and method define into the routes array
    $call = $router->run();
    $sanitizer = new \framework\Sanitizer($call);
    // return errors if probleme occur
    $sanitizer->sanitizeParams();
    // Passing the $call to api class;
    $api = $app->api($call);
    // get data and execute them
    $data = $api->getData();

    echo $data;

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

