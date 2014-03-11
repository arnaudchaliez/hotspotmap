<?php
/**
 * File: InMemoryUserRepositoryTest.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\Repository;

use HotspotMap\CoreDomain\Entity\User;
use HotspotMap\CoreDomain\ValueObject\Name;
use HotspotMap\CoreDomainBundle\Repository\InMemoryUserRepository;
use HotspotMap\CoreDomainBundle\Specification\ValueSpecification;

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

    public function testSatisfying()
    {
        $repository = new InMemoryUserRepository();

        $user = new User(new Name(), 'test_id');
        $repository->add($user);

        $users = $repository->findSatisfying(new ValueSpecification('getId', 'test_id'));

        $this->assertCount(1, $users);
        $this->assertEquals($user, $users[0]);
    }

    public function testFindAndRemove()
    {
        $repository = new InMemoryUserRepository();

        $user = new User(new Name(), 'test_id');
        $repository->add($user);

        $find = $repository->find('test_id');
        $this->assertEquals($user, $find);

        $this->assertTrue($repository->remove($user));
        $find = $repository->find('test_id');
        $this->assertEquals(null, $find);
    }
} 