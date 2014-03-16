<?php
/**
 * File: User.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\Entity;

use HotspotMap\CoreDomain\ValueObject\Name;
use HotspotMap\CoreDomain\ValueObject\Role;

class User extends Entity
{
    private $name;

    public function __construct(Name $name, Role $role, $id = null)
    {
        parent::__construct($id, 'user_');
        $this->name = $name;
        $this->role = $role;
    }

    public function __clone()
    {
        parent::__clone();
        $this->name = clone $this->name;
        $this->role = clone $this->role;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Role
     */
    public function getRoe()
    {
        return $this->role;
    }
}