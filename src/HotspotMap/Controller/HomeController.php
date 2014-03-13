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
}