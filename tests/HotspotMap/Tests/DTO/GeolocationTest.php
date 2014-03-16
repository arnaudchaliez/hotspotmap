<?php
/**
 * File: GeolocationTest.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */
namespace HotspotMap\Tests\DTO;

require_once __DIR__ . '/../FunctionnalTestCase.php';

use HotspotMap\CoreDomain\DTO\Geolocation;
use HotspotMap\Tests\FunctionnalTestCase;

class GeolocationTest extends FunctionnalTestCase
{
    public function testConstruct()
    {
        $geolocation = new Geolocation('55.333221', '3.5694841');
        $this->assertEquals('55.333221', $geolocation->latitude);
        $this->assertEquals('3.5694841', $geolocation->longitude);
    }

    public function testValidationOk()
    {
        $geolocation = new Geolocation('55.333221', '3.5694841');
        $this->assertCount(0, $this->app['validator']->validate($geolocation));
    }

    public function testValidationEmptyKo()
    {
        $geolocation = new Geolocation('', null);
        $this->assertCount(2, $this->app['validator']->validate($geolocation));
    }

    public function testValidationLongOk()
    {
        $geolocation = new Geolocation('', '3.5694841');
        $this->assertCount(1, $this->app['validator']->validate($geolocation));
    }

    public function testValidationLatOk()
    {
        $geolocation = new Geolocation('55.333221', '');
        $this->assertCount(1, $this->app['validator']->validate($geolocation));
    }

    public function testValidationTextKo()
    {
        $geolocation = new Geolocation('a', '454df.5');
        $this->assertCount(2, $this->app['validator']->validate($geolocation));
    }
}