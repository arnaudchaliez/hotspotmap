<?php
/**
 * File: InMemoryPersistence.php
 * Date: 01/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Persistence;

use HotspotMap\CoreDomain\Entity\Entity;

class InMemoryMapper
{
    /**
     * @var Entity[]
     */
    private $memory;

    public function __construct()
    {
        $this->memory = array();
    }
    public function persist(Entity $element)
    {
        $this->memory[] = $element;
    }

    public function remove(Entity $element)
    {
        $position = 0;
        foreach ($this->memory as $current) {
            if ($current->getId() === $element->getId()) {
                array_splice($this->memory, $position, 1);
                return true;
            }
            $position++;
        }
        return false;
    }

    public function removeAll()
    {
        $this->memory = array();
    }

    public function retrieve($id)
    {
        foreach ($this->memory as $current) {
            if ($id === $current->getId()) {
                return $current;
            }
        }
        return null;
    }

    public function retrieveAll()
    {
        return $this->memory;
    }
} 