<?php
/**
 * File: Specifications.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests;

use HotspotMap\CoreDomain\ValueObject\Name;
use HotspotMap\CoreDomain\ValueObject\Price;
use HotspotMap\CoreDomainBundle\Specification\AndSpecification;
use HotspotMap\CoreDomainBundle\Specification\GreaterThanSpecification;
use HotspotMap\CoreDomainBundle\Specification\LowerThanSpecification;
use HotspotMap\CoreDomainBundle\Specification\OrSpecification;
use HotspotMap\CoreDomainBundle\Specification\ValueSpecification;

class SpecificationsTest extends \PHPUnit_Framework_TestCase
{
    public function testValueSpecification()
    {
        $specification = new ValueSpecification('getFirstName', 'Chuck');

        $this->assertTrue($specification->isSatisfiedBy(new Name('Chuck', 'Norris')));
        $this->assertFalse($specification->isSatisfiedBy(new Name('Melvin', 'Cole')));
    }

    public function testAndSpecification()
    {
        $specification = new AndSpecification(
            new GreaterThanSpecification('getValue', 5),
            new LowerThanSpecification('getValue', 5.5)
        );

        $this->assertFalse($specification->isSatisfiedBy(new Price(1.0)));
        $this->assertTrue($specification->isSatisfiedBy(new Price(5.1)));
        $this->assertTrue($specification->isSatisfiedBy(new Price(5.4)));
        $this->assertFalse($specification->isSatisfiedBy(new Price(6.0)));
    }

    public function testOrSpecification()
    {
        $specification = new OrSpecification(
            new GreaterThanSpecification('getValue', 5.5),
            new LowerThanSpecification('getValue', 5)
        );

        $this->assertTrue($specification->isSatisfiedBy(new Price(1.0)));
        $this->assertFalse($specification->isSatisfiedBy(new Price(5.1)));
        $this->assertFalse($specification->isSatisfiedBy(new Price(5.4)));
        $this->assertTrue($specification->isSatisfiedBy(new Price(6.0)));
    }
} 