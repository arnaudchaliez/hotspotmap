<?php
/**
 * File: UserTest.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\Entity;

use HotspotMap\CoreDomain\Entity\User;
use HotspotMap\CoreDomain\ValueObject\Name;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $user = new User(new Name('Chuck', 'Norris') );

        $this->assertTrue(null !== $user->getId());
        $this->assertEquals($user->getName()->getFirstName(), 'Chuck');
    }

    public function testClone()
    {
        $users[] = new User(new Name('Chuck', 'Norris') );
        $users[] = $users[0];
        $users[] = clone $users[0];

        $this->assertEquals($users[0]->getId(), $users[1]->getId());
        $this->assertNotEquals($users[0]->getId(), $users[2]->getId());

    }
}