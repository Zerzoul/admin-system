<?php
/**
 * api/index.php for admin management.
 */
require '../framework/lib/Autoloader.php';
\framework\Autoloader::register();

session_start();
ob_start();
try {

    $app = \framework\App::getInstance();
    $router = $app->initRouter($_GET['action'], '\adminRoutes');
    $call = $router->run();
    $page = $app->getPage($call);
    $page->build('admin');

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

$content = ob_get_clean();
require_once '../app/view/admin/template/layout.php';

