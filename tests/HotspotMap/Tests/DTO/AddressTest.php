<?php
/**
 * File: AddressTest.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */
namespace HotspotMap\Tests\DTO;

require_once __DIR__ . '/../FunctionnalTestCase.php';

use HotspotMap\CoreDomain\DTO\Address;
use HotspotMap\Tests\FunctionnalTestCase;

class AddressTest extends FunctionnalTestCase
{
    public function testConstruct()
    {
        $address = new Address('place de la Rotonde', '75001', 'Paris', 'France');
        $this->assertEquals('place de la Rotonde', $address->street);
        $this->assertEquals('75001', $address->postalCode);
        $this->assertEquals('Paris', $address->city);
        $this->assertEquals('France', $address->country);
    }

    public function testValidationOk()
    {
        $address = new Address('place de la Rotonde', '75001', 'Paris', 'France');
        $this->assertCount(0, $this->app['validator']->validate($address));
    }

    public function testValidationEmptyKo()
    {
        $address = new Address('', '', '', '');
        $this->assertCount(1, $this->app['validator']->validate($address));
    }

    public function testValidationSmallStrKo()
    {
        $address = new Address('a', 'b', 'c', 'd');
        $this->assertCount(4, $this->app['validator']->validate($address));
    }
}