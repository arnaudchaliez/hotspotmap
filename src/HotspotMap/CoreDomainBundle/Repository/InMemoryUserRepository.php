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

class InMemoryUserRepository implements UserRepository
{
    private $users;

    public function __construct()
    {
        $this->users[] = new User(new Name('Chuck', 'Norris'));
        $this->users[] = new User(new Name('Silvia', 'Godoy'));
        $this->users[] = new User(new Name('Wade', 'Bruton'));
        $this->users[] = new User(new Name('Pearl', 'Bolt'));
        $this->users[] = new User(new Name('Margaret', 'May'));
        $this->users[] = new User(new Name('Susie', 'Pearson'));
        $this->users[] = new User(new Name('Melvin', 'Cole'));
    }

    public function add(User $user)
    {
        $this->users[] = $user;
    }

    public function remove(User $user)
    {
    }

    public function update(User $user)
    {}

    /**
     * @return User[]
     */
    public function findAll()
    {
        return $this->users;
    }

    /**
     * @return int
     */
    public function countAll()
    {
        return count($this->users);
    }

    public function removeAll()
    {
        $this->users = array();
    }

    /**
     * @return User
     */
    public function find($userId)
    {
    }
} 