<?php
/**
 * File: HotspotTest.php
 * Date: 12/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\Entity;

use HotspotMap\CoreDomain\Entity\Hotspot;
use HotspotMap\CoreDomain\ValueObject\Address;
use HotspotMap\CoreDomain\ValueObject\Name;

class HotspotTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $hotspot = new Hotspot('McDonald\'s', new Address('Avenue des États Unis', '63000', 'Clermont-Ferrand', 'France'));

        $this->assertTrue(null !== $hotspot->getId());
        $this->assertEquals($hotspot->getName(), 'McDonald\'s');
    }

    public function testClone()
    {
        $hotspots[] = new Hotspot('McDonald\'s', new Address('Avenue des États Unis', '63000', 'Clermont-Ferrand', 'France'));

        $hotspots[] = $hotspots[0];
        $hotspots[] = clone $hotspots[0];

        $this->assertEquals($hotspots[0]->getId(), $hotspots[1]->getId());
        $this->assertNotEquals($hotspots[0]->getId(), $hotspots[2]->getId());
    }
}