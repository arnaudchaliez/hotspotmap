<?php
/**
 * File: Address.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Model\ValueObject;


class Address
{
    public $street;

    public $postalCode;

    public $city;

    public $country;

    public function __construct($street, $postalCode, $city, $country)
    {
        $this->street = $street;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->country = $country;
    }
} 