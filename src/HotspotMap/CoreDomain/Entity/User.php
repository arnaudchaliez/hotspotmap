<?php
/**
 * File: User.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\Entity;

use HotspotMap\CoreDomain\ValueObject\Name;

class User
{
    private $id;

    private $name;

    public function __construct(Name $name, $id = null)
    {
        $this->setId($id);
        $this->name = $name;
    }

    public function __clone()
    {
        $this->name = clone $this->name;
        $this->setId(null);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    private function setId($id)
    {
        if (null === $id) {
            $this->id = uniqid('user');
        }
        else {
            $this->id = $id;
        }
    }
}