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
        $this->memory->persist(new User(new Name('Chuck', 'Norris')));
        $this->memory->persist(new User(new Name('Silvia', 'Godoy')));
        $this->memory->persist(new User(new Name('Wade', 'Bruton')));
        $this->memory->persist(new User(new Name('Pearl', 'Bolt')));
        $this->memory->persist(new User(new Name('Margaret', 'May')));
        $this->memory->persist(new User(new Name('Susie', 'Pearson')));
        $this->memory->persist(new User(new Name('Melvin', 'Cole')));
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