<?php
/**
 * File: LowerThanSpecification.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomainBundle\Specification;

use HotspotMap\Helper\InvokeAttribute;

class LowerThanSpecification implements Specification
{
    use InvokeAttribute;

    private $attribute;

    private $value;

    public function __construct($attribute, $value)
    {
        $this->attribute = $attribute;
        $this->value = $value;
    }

    public function isSatisfiedBy($object)
    {
        return $this->invokeAttribute($object, $this->attribute) < $this->value;
    }
}