<?php
/**
 * File: UserRepository.php
 * Date: 21/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\Repository;

use HotspotMap\CoreDomain\Entity\Hotspot;
use HotspotMap\CoreDomainBundle\Specification\Specification;

interface HotspotRepository
{
    /**
     * @param Hotspot $hotspot
     */
    public function add(Hotspot $hotspot);

    /**
     * @param Hotspot $hotspot
     */
    public function remove(Hotspot $hotspot);

    /**
     * @param Hotspot $hotspot
     */
    public function update(Hotspot $hotspot);

    /**
     * @param Hotspot[]
     */
    public function findAll();

    /**
     * @param int
     */
    public function countAll();

    public function removeAll();

    public function findSatisfying(Specification $specification);
} 