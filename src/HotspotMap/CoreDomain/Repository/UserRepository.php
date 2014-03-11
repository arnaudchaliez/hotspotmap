<?php
/**
 * File: UserRepository.php
 * Date: 21/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\Repository;

use HotspotMap\CoreDomain\Entity\User;
use HotspotMap\CoreDomainBundle\Specification\Specification;

interface UserRepository
{
    /**
     * @param User $user
     */
    public function add(User $user);

    /**
     * @param User $user
     */
    public function remove(User $user);

    /**
     * @param User $user
     */
    public function update(User $user);

    /**
     * @param User[]
     */
    public function findAll();

    /**
     * @param int
     */
    public function countAll();

    public function removeAll();

    public function findSatisfying(Specification $specification);
} 