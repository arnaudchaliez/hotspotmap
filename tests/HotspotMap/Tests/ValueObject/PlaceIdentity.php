<?php
/**
 * File: NameTest.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\ValueObject;

use HotspotMap\CoreDomain\ValueObject\PlaceIdentity;

class PlaceIdentityTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $name = new PlaceIdentity();
        $this->assertEquals($name->getName(), '');
        $this->assertEquals($name->getDescription(), '');
        $this->assertEquals($name->getThumbnail(), '');

        $name = new PlaceIdentity( 'McDo', 'Fast-food', 'mcdo.png');
        $this->assertEquals($name->getName(), 'McDo');
        $this->assertEquals($name->getDescription(), 'Fast-food');
        $this->assertEquals($name->getThumbnail(), 'mcdo.png');
    }
} 