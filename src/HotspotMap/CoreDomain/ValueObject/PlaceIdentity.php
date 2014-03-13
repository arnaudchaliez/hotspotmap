<?php
/**
 * File: PlaceIdentity.php
 * Date: 13/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\ValueObject;

class PlaceIdentity
{
    private $name;

    private $description;

    private $thumbnail;

    public function __construct($name = '', $description = '', $thumbnail = '')
    {
        $this->name         = $name;
        $this->description  = $description;
        $this->thumbnail    = $thumbnail;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }
} 