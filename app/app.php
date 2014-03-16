<?php
/**
 * File: app.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */
use Symfony\Component\HttpFoundation\Request;

$app = require __DIR__.'/bootstrap.php';

/** routes */
//home - website
$app->get('/', 'home.controller:indexAction')->bind('homepage');
$app->get('/about', 'home.controller:aboutAction');
//$app->get('/{hotspotId}', 'home.controller:selectAction');

$app->get('/login', function (Request $request) use ($app) {
    return $app['twig']->render('User/login.html');
});
$app->post('/login', 'user.controller:loginAction');

//users
$app->get('/users', 'user.controller:usersAction');
$app->delete('/users/{userId}', 'user.controller:deleteAction');

//hotspots
$app->get('/hotspots', 'hotspot.controller:hotspotsAction');
$app->get('/hotspots/{hotspotId}', 'hotspot.controller:showAction');
$app->get('/hotspots/findByName/{hotspotName}', 'hotspot.controller:findByNameAction');
$app->put('/hotspots/{hotspotId}', 'hotspot.controller:updateAction');
$app->post('/hotspots', 'hotspot.controller:addAction');

//geocoder
$app->get('/geocoder/location/{latitude},{longitude}', 'geocoder.controller:addressFromGeolocation');
$app->get('/geocoder/address/{street},{city},{postalCode},{country}', 'geocoder.controller:geolocationFromAddress');

$app->mount('/', new \HotspotMap\Provider\Controller\Security());

return $app;