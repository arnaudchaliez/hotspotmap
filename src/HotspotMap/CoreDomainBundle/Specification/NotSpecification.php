<?php
/**
 * File: NotSpecification.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomainBundle\Specification;

class NotSpecification implements Specification
{
    /**
     * @var Specification[]
     */
    private $specification;

    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy($object)
    {
        return ! $this->isSatisfiedBy($object);
    }
} 