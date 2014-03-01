<?php
/**
 * File: PriceTest.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\ValueObject;

use HotspotMap\CoreDomain\ValueObject\Price;

class PriceTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $price = new Price();
        $this->assertEquals($price->getValue(), 0);
    }

    public function testPrecision()
    {
        $this->assertEquals((new Price(100, '€'))->getValue('€'), 100, '', 0.00001);
        $this->assertEquals((new Price(-100.5))->getValue(), -100.5, '', 0.00001);

        $this->assertEquals((new Price(100.5999))->getValue(), 100.5999, '', 0.00001);
        $this->assertEquals((new Price(100.5999, '€'))->getValue('€'), 100.5999, '', 0.00001);
    }

    public function testRate()
    {
        $euroValue = 42.42;

        // Save value in euro
        $price = new Price($euroValue, '€');
        $this->assertEquals($price->getValue('€'), $euroValue, '', 0.00001);

        // Convert it to dollar
        $dollarValue = $price->getValue('$');
        $this->assertNotEquals($dollarValue, $euroValue, '', 0.00001);

        // Retrieve value in euro
        $price->setValue($dollarValue, '$');
        $this->assertEquals($price->getValue('€'), $euroValue, '', 0.00001);
    }
} 