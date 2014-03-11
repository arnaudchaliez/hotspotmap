<?php
/**
 * File: TimePeriodTest.php
 * Date: 20/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\ValueObject;

use HotspotMap\CoreDomain\ValueObject\TimePeriod;

class TimePeriodTest extends \PHPUnit_Framework_TestCase
{
    public function testCompareTo()
    {
        $period1 = new TimePeriod( 5, 7 );
        $period2 = new TimePeriod( 5, 7 );
        $period3 = new TimePeriod( 5, 6 );
        $period4 = new TimePeriod( 6, 7 );

        $this->assertEquals($period1->compareTo($period2), 0);
        $this->assertEquals($period1->compareTo($period3), 1);
        $this->assertEquals($period3->compareTo($period1), -1);
        $this->assertEquals($period1->compareTo($period4), -1);
    }
} 