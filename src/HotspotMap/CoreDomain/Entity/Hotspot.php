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
use HotspotMap\CoreDomain\ValueObject\Status;
use HotspotMap\Helper\CloneHelper;

class Hotspot extends Entity
{
    use CloneHelper;

    private $place;
    private $address;
    private $schedule;
    private $price;
    private $equipments;
    private $socialInformations;
    private $status;

    public function __construct(PlaceIdentity $place, Address $address, Price $price = null, Schedule $schedule = null, array $equipments = null, SocialInformation $socialInformation = null, $id = null)
    {
        parent::__construct($id, 'hs_');
        $this->place                = $place;
        $this->schedule             = $schedule;
        $this->address              = $address;
        $this->price                = $price;
        $this->equipments           = $equipments;
        if ($socialInformation === null) {
            $socialInformation = new SocialInformation();
        }
        $this->socialInformations   = $socialInformation;
        $this->status               = Status::Waiting;
    }

    public function __clone()
    {
        parent::__clone();
        $this->place                = $this->cloneAttribute($this->place);
        $this->schedule             = $this->cloneAttribute($this->schedule);
        $this->address              = $this->cloneAttribute($this->address);
        $this->price                = $this->cloneAttribute($this->price);
        //todo clone
        //$this->equipments           = $this->cloneAttribute($this->equipments);
        $this->socialInformations   =$this->cloneAttribute($this->socialInformations);
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

    /**
     * @return Status
    */
    public function getStatus()
    {
        return $this->status;
    }

    public function validate()
    {
        $this->status = Status::Validate;
    }

    public function rejected()
    {
        $this->status = Status::Rejected;
    }
}