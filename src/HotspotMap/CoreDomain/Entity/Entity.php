<?php
/**
 * File: Entity.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomain\Entity;

class Entity
{
    protected $prefix;

    protected $id;

    public function __construct($id = null, $prefix)
    {
        $this->prefix = $prefix;
        $this->setId($id);
    }

    public function __clone()
    {
        $this->setId(null);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    private function setId($id)
    {
        if (null === $id) {
            $this->id = uniqid($this->prefix);
        } else {
            $this->id = $id;
        }
    }
} 