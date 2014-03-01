<?php
/**
 * File: InMemoryUserRepositoryTest.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\Repository;

use HotspotMap\CoreDomainBundle\Repository\InMemoryUserRepository;

class InMemoryUserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $repository = new InMemoryUserRepository();

        $this->assertCount(7, $repository->findAll());
        $this->assertEquals(7, $repository->countAll());
    }

    public function testRemoveAll()
    {
        $repository = new InMemoryUserRepository();
        $repository->removeAll();

        $this->assertCount(0, $repository->findAll());
    }
} 