<?php
/**
 * File: ScheduleTest.php
 * Date: 20/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Tests\ValueObject;

use HotspotMap\CoreDomain\ValueObject\Schedule;
use HotspotMap\CoreDomain\ValueObject\TimePeriod;

class ScheduleTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $schedule = new Schedule();

        $this->assertTrue(null !== $schedule);
        $this->assertEquals( count($schedule->getPeriods()), 0 );
    }

    public function testAdd()
    {
        $schedule = new Schedule();

        $periods = [];
        $periods[] = new TimePeriod( 5, 7 );
        $periods[] = new TimePeriod( 5, 7 );
        $periods[] = new TimePeriod( 5, 6 );

        for ($i = 0; $i < 3; $i++) {
            $schedule->addPeriod($periods[$i]);
        }

        $this->assertEquals( count($schedule->getPeriods()), 3 );
    }

    public function testAddOrder()
    {
        $schedule = new Schedule();

        $periods = [];
        $periods[] = new TimePeriod( 5, 7 );
        $periods[] = new TimePeriod( 5, 7 );
        $periods[] = new TimePeriod( 5, 6 );
        $periods[] = new TimePeriod( 6, 7 );

        for ($i = 0; $i < 4; $i++) {
            $schedule->addPeriod($periods[$i]);
        }

        // p2 < p0 == p1 < p3
        $this->assertEquals(count($schedule->getPeriods()), 4);
        $this->assertEquals($schedule->getPeriods()[0], $periods[2]);
        $this->assertEquals($schedule->getPeriods()[3], $periods[3]);
    }

    public function testClone()
    {
        $schedule = new Schedule();
        $schedule->addPeriod( new TimePeriod( 5, 7 ) );

        $clone = $schedule;
        $this->assertTrue($schedule === $clone);
        $this->assertTrue($schedule->getPeriods() === $clone->getPeriods());
        $this->assertTrue($schedule->getPeriods()[0] === $clone->getPeriods()[0]);

        $clone = clone $schedule;
        $this->assertFalse($schedule === $clone);
        $this->assertFalse($schedule->getPeriods() === $clone->getPeriods());
        $this->assertFalse($schedule->getPeriods()[0] === $clone->getPeriods()[0]);
    }
} 