<?php
/**
 * File: SpecificationsFilter.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Helper;

use HotspotMap\CoreDomainBundle\Specification\Specification;

trait SpecificationFilter
{
    public function filter(Array $objects, Specification $specification)
    {
        $result = array();

        foreach ($objects as $object) {
            if ($specification->isSatisfiedBy($object))
                $result[] = $object;
        }

        return $result;
    }
} 