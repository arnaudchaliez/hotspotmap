<?php
/**
 * File: User.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\User;

use HotspotMap\ValueObject\Name;

class User {
    private $id;

    private $name;

    public function __construct($id, Name $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->firstName;
    }
}