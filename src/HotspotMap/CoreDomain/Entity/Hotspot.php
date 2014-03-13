<?php
/**
 * File: Hotspot.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\Entity;

use HotspotMap\CoreDomain\ValueObject\Address;
use HotspotMap\CoreDomain\ValueObject\PlaceIdentity;
use HotspotMap\CoreDomain\ValueObject\Price;
use HotspotMap\CoreDomain\ValueObject\Schedule;
use HotspotMap\CoreDomain\ValueObject\Equipment;
use HotspotMap\CoreDomain\ValueObject\SocialInformation;

class Hotspot extends Entity
{
    private $place;
    private $address;
    private $schedule;
    private $price;
    private $equipments;
    private $socialInformations;

    public function __construct(PlaceIdentity $place, Address $address, Price $price = null, Schedule $schedule = null, array $equipments = null, SocialInformation $socialInformation = null, $id = null)
    {
        parent::__construct($id, 'hotspot_');
        $this->place                = $place;
        $this->schedule             = $schedule;
        $this->address              = $address;
        $this->price                = $price;
        $this->equipments           = $equipments;
        if ($socialInformation === null)
            $socialInformation = new SocialInformation();
        $this->socialInformations   = $socialInformation;
    }

    public function __clone()
    {
        parent::__clone();
        $this->place                = clone $this->place;
        $this->schedule             = clone $this->schedule;
        $this->address              = clone $this->address;
        $this->price                = clone $this->price;
        //todo clone
        //$this->equipments           = clone $this->equipments;
        $this->socialInformations   = clone $this->socialInformations;
    }

    /**
     * @return PlaceIdentity
    */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->place->getName();
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

    /**
     * @return SocialInformation
     */
    public function getSocialInformation()
    {
        return $this->socialInformations;
    }
}