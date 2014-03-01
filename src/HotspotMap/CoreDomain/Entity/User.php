<?php
/**
 * File: User.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\Entity;

use HotspotMap\CoreDomain\ValueObject\Name;

class User extends Entity
{
    private $name;

    public function __construct(Name $name, $id = null)
    {
        parent::__construct($id, 'user_');
        $this->name = $name;
    }

    public function __clone()
    {
        parent::__clone();
        $this->name = clone $this->name;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }
}