<?php
/**
 * File: Name.php
 * Date: 19/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Model\ValueObject;


class Name
{
    public $surname;

    public $name;

    public function __construct($surname, $name)
    {
        $this->surname = $surname;
        $this->name = $name;
    }
} 