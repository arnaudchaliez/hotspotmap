<?php
/**
 * File: InMemoryUserRepository.php
 * Date: 21/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomainBundle\Repository;

use HotspotMap\CoreDomain\Entity\User;
use HotspotMap\CoreDomain\Repository\UserRepository;
use HotspotMap\CoreDomain\ValueObject\Name;
use HotspotMap\CoreDomain\ValueObject\Role;
use HotspotMap\CoreDomainBundle\Specification\Specification;
use HotspotMap\Helper\SpecificationFilter;
use HotspotMap\Persistence\InMemoryMapper;

class InMemoryUserRepository implements UserRepository
{
    use SpecificationFilter;

    private $memory;

    public function __construct()
    {
        $this->memory = new InMemoryMapper();
        $this->memory->persist(new User(new Name('Chuck', 'Norris'), new Role('user', ''), 'hs1@local.fr'));
        $this->memory->persist(new User(new Name('Silvia', 'Godoy'), new Role('user', ''), 'hs2@local.fr'));
        $this->memory->persist(new User(new Name('Wade', 'Bruton'), new Role('user', ''), 'hs3@local.fr'));
        $this->memory->persist(new User(new Name('Pearl', 'Bolt'), new Role('user', ''), 'hs4@local.fr'));
        $this->memory->persist(new User(new Name('Margaret', 'May'), new Role('user', ''), 'hs5@local.fr'));
        $this->memory->persist(new User(new Name('Susie', 'Pearson'), new Role('user', ''), 'hs6@local.fr'));
        $this->memory->persist(new User(new Name('Melvin', 'Cole'), new Role('user', ''), 'hs7@local.fr'));
    }

    public function add(User $user)
    {
        $this->memory->persist($user);
    }

    public function remove(User $user)
    {
        return $this->memory->remove($user);
    }

    public function update(User $user)
    {
    }

    /**
     * @return User[]
     */
    public function findAll()
    {
        return $this->memory->retrieveAll();
    }

    /**
     * @return int
     */
    public function countAll()
    {
        return count($this->memory->retrieveAll());
    }

    public function removeAll()
    {
        $this->memory->removeAll();
    }

    public function find($userId)
    {
        return $this->memory->retrieve($userId);
    }

    public function findSatisfying(Specification $specification)
    {
        return $this->filter($this->memory->retrieveAll(), $specification);
    }
} 