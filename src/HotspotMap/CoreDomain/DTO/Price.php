<?php
/**
 * File: Price.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\DTO;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

class Price
{
    public $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function toValueObject()
    {
        $price = (float)$this->price;
        return new \HotspotMap\CoreDomain\ValueObject\Price($price);
    }

    static public function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('price', new Assert\Regex(array('pattern' => "/^-?(?:\\d+|\\d*\\.\\d+)$/")));
        $metadata->addPropertyConstraint('price', new Assert\NotBlank());
    }
}