<?php
/**
 * File: Geolocation.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\DTO;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

class Geolocation
{
    public $latitude;

    public $longitude;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function toValueObject()
    {
        $latitude = (float)$this->latitude;
        $longitude = (float)$this->longitude;
        return new \HotspotMap\CoreDomain\ValueObject\Geolocation($latitude, $longitude);
    }

    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('latitude', new Assert\Regex(array('pattern' => "/^[-]?(([0-8]?[0-9])\\.(\\d+))|(90(\\.0+)?)$/")));
        $metadata->addPropertyConstraint('latitude', new Assert\NotBlank());

        $metadata->addPropertyConstraint('longitude', new Assert\Regex(array('pattern' => "/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\\.(\\d+))|180(\\.0+)?)$/")));
        $metadata->addPropertyConstraint('longitude', new Assert\NotBlank());
    }
} 