<?php

use Components\Constants;
use Components\UrlManager;
use NewsProvider\NewsProviderFactory;

$config = include '../config.php';

spl_autoload_register(function ($class) {
    list($namespace, $className) = explode('\\', $class);
    $str = '../src/' . $namespace . DIRECTORY_SEPARATOR . $className . '.php';
//    var_dump($str);
    include $str;
});

if (!in_array($config['news_provider'], NewsProviderFactory::getAvailableProviders())) {
    die('ololo');
}

try {
    $urlManager = new UrlManager();
    $provider = NewsProviderFactory::getNewsProvider($config);
    $crud = new \Components\Crud($provider);

    $action = $urlManager->getAction();

    if (strtoupper($_SERVER['REQUEST_METHOD']) == Constants::REQUEST_METHOD_POST) {
        echo json_encode($crud->$action());
    } else {
        include 'header.php';
        echo $crud->index();
        include 'footer.php';
    }

} catch (\Exception $e) {
    //todo something pretty
    die($e->getMessage());
}