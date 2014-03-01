<?php
/**
 * File: Schedule.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\ValueObject;

class Schedule
{
    private $timePeriods;

    public function __construct()
    {
        $this->timePeriods = array();
    }

    public function __clone()
    {
        $timePeriods = $this->timePeriods;
        $this->timePeriods = [];

        foreach($timePeriods as $period)
            $this->timePeriods[] = clone $period;
    }

    public function getPeriods()
    {
        return $this->timePeriods;
    }

    /**
     * Add the period in an ordered of TimePeriod
     * @param TimePeriod $period
     */
    public function addPeriod(TimePeriod $period)
    {
        $size = count($this->timePeriods);
        for ($i = 0; $i < $size; $i++) {
            if (-1 === $period->compareTo($this->timePeriods[$i])) {
                array_splice($this->timePeriods, $i, 0, array($period));
                return;
            }
        }
        $this->timePeriods[] = $period;
    }
} 