<?php
/**
 * File: InMemoryUserRepository.php
 * Date: 21/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomainBundle\Repository;

use HotspotMap\CoreDomain\User\User;
use HotspotMap\CoreDomain\User\UserRepository;
use HotspotMap\ValueObject\Name;

class InMemoryUserRepository implements UserRepository
{
    private $users;

    public function __construct()
    {
        $this->users[] = new User(0, new Name("Chuck", "Norris"));
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