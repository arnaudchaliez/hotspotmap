<?php
/**
 * File: GeocoderControllerTest.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */
namespace HotspotMap\Tests\Controllers;

require_once __DIR__ . '/../FunctionnalTestCase.php';

use HotspotMap\Tests\FunctionnalTestCase;

class GeocoderControllerTest extends FunctionnalTestCase
{
    public function testLatLngToAddress()
    {
        $client = $this->createClient();
        $client->request('GET', '/geocoder/location/45.7750838,3.0828419');

        $this->assertTrue($client->getResponse()->isOk());
        $location = json_decode($client->getResponse()->getContent());

        $this->assertEquals('France', $location->country);
        $this->assertEquals('Clermont-Ferrand', $location->city);
    }
    public function testAddressToLatLng()
    {
        $client = $this->createClient();
        $client->request('GET', '/geocoder/address/place de jaude,clermont-ferrand,63400,france');

        $this->assertTrue($client->getResponse()->isOk());
        $location = json_decode($client->getResponse()->getContent());

        $this->assertEquals(45.7750838, $location->latitude);
        $this->assertEquals(3.0828419, $location->longitude);
    }
}