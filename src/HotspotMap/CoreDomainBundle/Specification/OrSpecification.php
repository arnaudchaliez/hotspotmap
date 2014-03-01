<?php
/**
 * File: OrSpecification.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomainBundle\Specification;

class OrSpecification implements Specification
{
    /**
     * @var Specification[]
     */
    private $specifications;

    public function __construct()
    {
        $this->specifications = func_get_args();
    }

    public function isSatisfiedBy($object)
    {
        $satisfies = false;
        foreach ($this->specifications as $specification) {
            $satisfies = $satisfies || $specification->isSatisfiedBy($object);
        }
        return $satisfies;
    }
} 