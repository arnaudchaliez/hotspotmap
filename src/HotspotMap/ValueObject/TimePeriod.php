<?php
/**
 * File: TimePeriod.php
 * Date: 20/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\ValueObject;

class TimePeriod
{
    private $begin;

    private $end;

    public function __construct($begin, $end)
    {
        $this->begin = $begin;
        $this->end   = $end;
    }

    public function getBegin()
    {
        return $this->begin;
    }

    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param TimePeriod $period Period to compare to $this
     * @return int 0 if both are equals, 1 if $period > $this, -1 if $period < $this
     */
    public function compareTo(TimePeriod $period)
    {
        if($this->begin < $period->begin) {
            return -1;
        }
        if($this->begin > $period->begin) {
            return 1;
        }
        if($this->end < $period->end) {
            return -1;
        }
        if($this->end > $period->end) {
            return 1;
        }
        return 0;
    }
} 