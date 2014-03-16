<?php
/**
 * File: InMemoryUserRepositoryTest.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\Repository;

use HotspotMap\CoreDomain\Entity\Hotspot;
use HotspotMap\CoreDomain\ValueObject\Address;
use HotspotMap\CoreDomain\ValueObject\PlaceIdentity;
use HotspotMap\CoreDomainBundle\Repository\InMemoryHotspotRepository;
use HotspotMap\CoreDomainBundle\Specification\ValueSpecification;

class InMemoryHotspotRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $repository = new InMemoryHotspotRepository();

        $this->assertCount(4, $repository->findAll());
        $this->assertEquals(4, $repository->countAll());
    }

    public function testRemoveAll()
    {
        $repository = new InMemoryHotspotRepository();
        $repository->removeAll();

        $this->assertCount(0, $repository->findAll());
    }

    public function testSatisfying()
    {
        $repository = new InMemoryHotspotRepository();

        $hotspot = new Hotspot(new PlaceIdentity('test'), new Address('','','',''), null, null, null, null, 'test_id');
        $repository->add($hotspot);

        $hotspots = $repository->findSatisfying(new ValueSpecification('getId', 'test_id'));

        $this->assertCount(1, $hotspots);
        $this->assertEquals($hotspot, $hotspots[0]);
    }

    public function testFindAndRemove()
    {
        $repository = new InMemoryHotspotRepository();

        $hotspot = new Hotspot(new PlaceIdentity('test'), new Address('','','',''), null, null, null, null, 'test_id');
        $repository->add($hotspot);

        $find = $repository->find('test_id');
        $this->assertEquals($hotspot, $find);

        $this->assertTrue($repository->remove($hotspot));
        $find = $repository->find('test_id');
        $this->assertEquals(null, $find);
    }
} 