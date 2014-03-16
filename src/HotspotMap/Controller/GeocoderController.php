<?php
/**
 * File: GeocoderController.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Controller;

use HotspotMap\Helper\GeocoderHelper;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use HotspotMap\CoreDomain\ValueObject\Address;
use HotspotMap\CoreDomain\ValueObject\Geolocation;

class GeocoderController
{
    protected $geocoderHelper;

    public function __construct(GeocoderHelper $geocoderHelper)
    {
        $this->geocoderHelper = $geocoderHelper;
    }

    public function addressFromGeolocation(Request $request, Application $app, Application $app, $latitude, $longitude)
    {
        $geolocationDTO = new \HotspotMap\CoreDomain\DTO\Geolocation($latitude, $longitude);

        if($app['validator']->validate($geolocationDTO)) {
            $geolocation = $geolocationDTO->toValueObject();
            return $app['helper.response']->handle($this->geocoderHelper->addressFromGeolocation($geolocation), '', 200, [], null, 'json');
        }
    }


    public function geolocationFromAddress(Request $request, Application $app, $street, $city, $postalCode, $country)
    {
        $addressDTO = new \HotspotMap\CoreDomain\DTO\Address($street, $city, $postalCode, $country);

        if($app['validator']->validate($addressDTO)) {
            $address = $addressDTO->toValueObject();
            return $app['helper.response']->handle($this->geocoderHelper->geolocationFromAddress($address), '', 200, [], null, 'json');
        }
    }
}