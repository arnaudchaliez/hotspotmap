<?php
/**
 * File: SqlUserRepository.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomainBundle\Repository;

use HotspotMap\CoreDomain\Entity\User;
use HotspotMap\CoreDomain\Repository\UserRepository;
use HotspotMap\CoreDomainBundle\Specification\Specification;

class DbUserRepository implements UserRepository
{
    use SpecificationFilter;


    public function __construct()
    {
    }

    public function add(User $user)
    {
    }

    public function remove(User $user)
    {
    }

    public function update(User $user)
    {
    }

    /**
     * @return User[]
     */
    public function findAll()
    {
    }

    /**
     * @return int
     */
    public function countAll()
    {
    }

    public function removeAll()
    {
    }

    public function find($userId)
    {
    }

    public function findSatisfying(Specification $specification)
    {
        return $this->filter($this->findAll(), $specification);
    }
} 