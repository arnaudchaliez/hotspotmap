<?php
/**
 * File: PriceTest.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */
namespace HotspotMap\Tests\DTO;

require_once __DIR__ . '/../FunctionnalTestCase.php';

use HotspotMap\CoreDomain\DTO\Price;
use HotspotMap\Tests\FunctionnalTestCase;

class PriceTest extends FunctionnalTestCase
{
    public function testConstruct()
    {
        $price = new Price('1.0');
        $this->assertEquals('1.0', $price->price);
    }

    public function testValidationOk()
    {
        $price = new Price('1.0');
        $this->assertCount(0, $this->app['validator']->validate($price));
    }

    public function testValidationEmptyKo()
    {
        $price = new Price('');
        $this->assertCount(1, $this->app['validator']->validate($price));
    }

    public function testValidationTextKo()
    {
        $price = new Price('test');
        $this->assertCount(1, $this->app['validator']->validate($price));
    }
}