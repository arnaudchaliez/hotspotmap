<?php
/**
 * File: UserRepository.php
 * Date: 21/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\User;

interface UserRepository
{
    public function add(User $user);

    public function remove(User $user);

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

    /**
     * @param User
     */
    public function find($userId);
} 