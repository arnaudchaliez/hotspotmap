<?php
/**
 * File: Specification.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomainBundle\Specification;

interface Specification
{
    public function isSatisfiedBy($object);
}