<?php
/**
 * File: app.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../vendor/fp/lightopenid/openid.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

$app = new Application();

$getNumberEquipments = new Twig_SimpleFunction('getNumberEquipments', function () {
    return \HotspotMap\CoreDomain\ValueObject\Equipment::NumberEquipments;
});

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/HotspotMap/View'
));
$app['twig']->addFunction($getNumberEquipments);

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new \HotspotMap\Provider\Service\Security());
/*$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'default' => array(
            'pattern' => '^.*$',
            'anonymous' => true,
            'form' => array('/login' => '/', 'check_path' => 'connexion'),
            'logout' => array('/logout' => '/logout'),
            'users' => $app->share(function() use ($app) {
                return new HotspotMap\Provider\UserProvider($app['repository.user']);
            }),
        ),
    ),
    'security.access_rules' => array(
        array('^/.+$', 'ROLE_USER'),
        array('^/foo$', ''), // Cette url est accessible en mode non connecté
    )
));*/

//serializers

$app['rest.serializer'] = $app->share(function () use ($app) {
    $encoders = array (
        'json' => new JsonEncoder(),
        'xml'  => new XmlEncoder()
    );
    $normalizers = array(new GetSetMethodNormalizer());
    $serializer = new Serializer($normalizers, $encoders);
    return $serializer;
});

$app['rest.decoder.json'] =  $app->share(function () use ($app) {
    return new JsonEncoder();
});

$app['rest.decoder.xml'] =  $app->share(function () use ($app) {
    return new XmlEncoder();
});
$app['rest.decoders'] = isset($app['rest.decoders']) ? $app['rest.decoders'] : array(
    'json'  => $app['rest.decoder.json'],
    'xml'   => $app['rest.decoder.xml'],
);

/** data */

//repositories

$app['repository.user'] = $app->share(function() use ($app) {
    return new HotspotMap\CoreDomainBundle\Repository\InMemoryUserRepository();
    //return new \HotspotMap\CoreDomain\Repository\UserRepository();
});

$app['repository.hotspot'] = $app->share(function() use ($app) {
    return new HotspotMap\CoreDomainBundle\Repository\InMemoryHotspotRepository();
    //return new \HotspotMap\CoreDomain\Repository\HotspotRepository();
});


/** controllers */

//home
$app['home.controller'] = $app->share(function() use ($app) {
    return new \HotspotMap\Controller\HomeController();
});

//user
$app['user.controller'] = $app->share(function() use ($app) {
    return new \HotspotMap\Controller\UserController($app['repository.user'], $app);
});

//hotspot
$app['hotspot.controller'] = $app->share(function() use ($app) {
    return new \HotspotMap\Controller\HotspotController($app['repository.hotspot'], $app);
});

//geocoder
$app['geocoder.controller'] = $app->share(function() use ($app) {
    return new \HotspotMap\Controller\GeocoderController($app['helper.geocoder'], $app);
});

/** helpers */

$app['helper.response'] = $app->share(function () use ($app) {
    return new \HotspotMap\Helper\ResponseHandler($app['rest.serializer'], $app['request'], $app['twig'], array('','application/json','application/xml','text/html'));
});

$app['helper.geocoder'] = $app->share(function () use ($app) {
    return new \HotspotMap\Helper\GeocoderHelper();
});

// definitions
$app['debug'] = true; //'dev' === getenv('APPLICATION_ENV');



/** events management */

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = $app['rest.decoder.json']($request->request);
        $request->request->replace(is_array($data) ? $data : array());
    }
});


// rest response
$app->after(function (Request $request, Response $response) use ($app) {
    $format = $request->attributes->get('format');
    if (null === $format) {
        $format = $request->get('format');
    }

    $contentType = 'text/html';
    switch($format) {
        case 'xml':
            $contentType = 'text/xml';
            break;
        case 'json':
            $contentType = 'text/json';
            break;
    }
    $response->headers->set('Content-Type', $contentType);
});

return $app;