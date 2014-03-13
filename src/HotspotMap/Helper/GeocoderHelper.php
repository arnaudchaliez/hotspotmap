<?php
/**
 * File: GeocoderHelper.php
 * Date: 13/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Helper;

use Buzz\Browser;
use Buzz\Client\Curl;
use HotspotMap\CoreDomain\ValueObject\Address;
use HotspotMap\CoreDomain\ValueObject\Geolocation;
use Geocoder\HttpAdapter\BuzzHttpAdapter;
use Geocoder\Provider\GoogleMapsBusinessProvider;
use Geocoder\Provider\GoogleMapsProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GeocoderHelper
{
    /* Adapters */
    const GoogleMaps = 0;
    const GoogleMapsBusiness = 1;

    private $adapter;
    private $buzz;
    private $geocoder;

    public function __construct()
    {
        $this->buzz = new Browser(new Curl());
        $this->adapter = new BuzzHttpAdapter($this->buzz);
        $this->geocoder = new Geocoder();

        $this->registerGoogleMapsProviders('fr_FR', 'France');
    }

    public function registerGoogleMapsProviders($locale, $region, $useSsl = true, $key = null, $privateId = null)
    {
        $providers = array();
        $providers[] = new GoogleMapsProvider($this->adapter, $locale, $region, $useSsl);
        if ($key && $privateId)
            $providers[] =  new GoogleMapsBusinessProvider($this->adapter,$privateId , $key, $locale, $region, $useSsl);

        $this->geocoder->registerProvider($providers);
    }

    private function AddressFromGeolocation(Geolocation $geolocation)
    {
        $geocode = $this->geocoder->reverse(
            $geolocation->getLatitude(),
            $geolocation->getLongitude()
        );

        $street     = $geocode['streetNumber'] . ' ' . $geocode['streetName'];
        $country    = $geocode['country'];
        $city       = $geocode['city'];
        $postalCode = $geocode['zipcode'];
        $address = new Address($street, $postalCode, $city, $country);

        return $address;
    }

    private function GeolocationFromAddress(Address $address)
    {
        $geocode = $this->geocoder->geocode(
            $address->getStreet() . ' ' . $address->getCity() . ' ' . $address->getCountry()
        );

        $geolocation = new Geolocation(
            $geocode['latitude'],
            $geocode['longitude']
        );

        return $geolocation;
    }

} 