<?php
require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;

$app = new Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/HotspotMap/View'
));
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app['home.controller'] = $app->share(function() use ($app) {
    return new \HotspotMap\Controller\HomeController();
});
$app->get('/', 'home.controller:indexAction');

// definitions
$app['debug'] = true;
$app->run();