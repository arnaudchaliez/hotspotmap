<?php
/**
 * File: Address.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\DTO;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

class Address
{
    private $street;

    private $postalCode;

    private $city;

    private $country;

    public function __construct($street, $postalCode, $city, $country)
    {
        $this->street       = $street;
        $this->postalCode   = $postalCode;
        $this->city         = $city;
        $this->country      = $country;
    }

    public function toValueObject()
    {
        return new \HotspotMap\CoreDomain\ValueObject\Address($this->street, $this->postalCode, $this->city, $this->country);
    }

    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('street', new Assert\Length(array('min' => 4)));

        $metadata->addPropertyConstraint('postalCode', new Assert\Length(array('min' => 2)));

        $metadata->addPropertyConstraint('city', new Assert\Length(array('min' => 2)));

        $metadata->addPropertyConstraint('country', new Assert\NotBlank());
        $metadata->addPropertyConstraint('country', new Assert\Length(array('min' => 2)));
    }
} 