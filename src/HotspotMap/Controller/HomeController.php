<?php
/**
 * File: HomeCotnroller.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController {
    public function indexAction(Request $request, Application $app)
    {
        $hotspots = $app['repository.hotspot']->findAll();
        return $app['twig']->render(
            'index.html',
            array('hotspots' => $hotspots)
        );
    }

    public function aboutAction(Request $request, Application $app)
    {

        $data = array(
            'name'      => 'HotspotMap',
            'licence'   => 'no-licence',
            'description' => 'a tool to share nice hotspots places',
            'authors'   => array(
                'Bouny Jérémy',
                'Chaliez Arnaud'
            ),
            'version'   => '0.1',
            'date_creation' => '2014-17-03'

        );

        return $app['helper.response']->handle($data, 'about.html', 200);
    }

    public function selectAction(Request $request, Application $app, $hotspotId)
    {
        $repository = $app['repository.hotspot'];
        $hotspots   = $repository->findAll();
        $hotspot    = $app['repository.hotspot']->find($hotspotId);
        $geolocate  = null; // $app['helper.geocoder']->geolocationFromAddress($hotspot->getAddress());
        if (null !== $hotspot)
            return $app['twig']->render(
                'details.html',
                array(
                    'hotspots'  => $hotspots,
                    'hotspot'   => $hotspot,
                    'geolocate' => $geolocate
                )
            );
        else
            return $app['helper.response']->handle('hotspot not found', 'error.html', 404);
    }
}