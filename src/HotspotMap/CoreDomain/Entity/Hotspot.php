<?php
/**
 * File: Hotspot.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\Entity;

use HotspotMap\CoreDomain\ValueObject\Address;
use HotspotMap\CoreDomain\ValueObject\Price;
use HotspotMap\CoreDomain\ValueObject\Schedule;
use HotspotMap\CoreDomain\ValueObject\Equipment;

class Hotspot extends Entity
{
    private $name;
    private $address;
    private $schedule;
    private $price;
    private $equipments;

    public function __construct($name, Address $address, Price $price = null, Schedule $schedule = null, ArrayObject $equipments = null, $id = null)
    {
        parent::__construct($id, 'hotspot_');
        $this->name         = $name;
        $this->schedule     = $schedule;
        $this->address      = $address;
        $this->price        = $price;
        $this->equipments   = $equipments;
    }

    public function __clone()
    {
        parent::__clone();
        $this->name         = clone $this->name;
        $this->schedule     = clone $this->schedule;
        $this->address      = clone $this->address;
        $this->price        = clone $this->price;
        $this->equipments   = clone $this->equipments;
    }

    /**
     * @return String
    */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return ArrayObject
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * @return Schedule
     */
    public function getSchedule()
    {
        return $this->schedule;
    }
}