<?php
/**
 * File: NameTest.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\ValueObject;

use HotspotMap\CoreDomain\ValueObject\Name;

class NameTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $name = new Name();
        $this->assertEquals($name->getFirstName(), '');
        $this->assertEquals($name->getLastName(), '');

        $name = new Name( 'Chuck', 'Norris');
        $this->assertEquals($name->getFirstName(), 'Chuck');
        $this->assertEquals($name->getLastName(), 'Norris');
    }
} 