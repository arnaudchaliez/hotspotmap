<?php
/**
 * File: GeocoderController.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use HotspotMap\CoreDomain\ValueObject\Address;
use HotspotMap\CoreDomain\ValueObject\Geolocation;

class HotspotController
{
    protected $geocoderHelper;

    public function __construct($geocoderHelper)
    {
        $this->geocoderHelper = $geocoderHelper;
    }

    public function hotspotsAction(Request $request, Application $app)
    {
        $geolocation = new \HotspotMap\CoreDomain\DTO\Geolocation($request->query->get('lat'), $request->query->get('lng'));
        if($app['validator']->validate($geolocation)) {
            return $app['helper.response']->handle($this->hotspotRepository->findAll(), 'Hotspot/hotspots.html', [], null, 'json');
        }
    }
}