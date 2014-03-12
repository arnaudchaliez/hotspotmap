<?php
require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

$app = new Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/HotspotMap/View'
));
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

//serializers

$app['rest.serializer'] = $app->share(function () {
    $encoders = array (
        'json' => new JsonEncoder(),
        'xml'  => new XmlEncoder()
    );
    $normalizers = array(new GetSetMethodNormalizer());
    $serializer = new Serializer($normalizers, $encoders);
    return $serializer;
});

$app['rest.decoder.json'] =  $app->share(function () use ($app) {
    return  new JsonDecoder();
});

$app['rest.decoder.xml'] =  $app->share(function () use ($app) {
    return  new XmlDecoder();
});
$app['rest.decoders'] = isset($app['rest.decoders']) ? $app['rest.decoders'] : array(
    'json'  => 'rest.decoder.json',
    'xml'   => 'rest.decoder.xml',
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

/** helpers */

$app['helper.response'] = $app->share(function () use ($app) {
    return new \HotspotMap\Helper\ResponseHandler('rest.serializer', $app['request'], $app['twig'], array('','application/json','application/xml','text/html'));
});

// definitions
$app['debug'] = true; //'dev' === getenv('APPLICATION_ENV');

/** routes */

//home
$app->get('/', 'home.controller:indexAction');

//users
$app->get('/users', 'user.controller:usersAction');

//hotspots
$app->get('/hotspots', 'hotspot.controller:hotspotsAction');


/** events management */

/*
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = $app['rest.decoder.json']($request->request);
        $request->request->replace(is_array($data) ? $data : array());
    }
});
*/

// rest response
$app->after(function (Request $request, Response $response) use ($app) {
    $format = $request->attributes->get('format');

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

/** run  */
$app->run();