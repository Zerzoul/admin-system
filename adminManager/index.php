<?php
/**
 * adminManager/index.php for return data from database.
 * don't forget to set up dsn.php to dataBase connexion
 */
require '../framework/lib/Autoloader.php';
\framework\Autoloader::register();
session_start();
ob_start();
try {
    $app = \framework\App::getInstance();
    // setUp the routes with the current url.
    $router = $app->initRouter($_GET['action'], 'adminRoutes');
    // catch the return for calling class and method define into the routes array
    $call = $router->run();
    $sanitizer = new \framework\Sanitizer($call);
    // return errors if probleme occur
    $sanitizer->sanitizeParams();
    // passing the $call to getPage class
    $page = $app->getPage($call);
    $page->build('admin');
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
$content = ob_get_clean();
require_once '../app/view/admin/template/layout.php';