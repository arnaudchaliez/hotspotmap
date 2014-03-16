<?php
/**
 * File: InMemoryUserRepository.php
 * Date: 21/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\CoreDomainBundle\Repository;

use HotspotMap\CoreDomain\Entity\Hotspot;
use HotspotMap\CoreDomain\Repository\HotspotRepository;
use HotspotMap\CoreDomain\ValueObject\Equipment;
use HotspotMap\CoreDomain\ValueObject\PlaceIdentity;
use HotspotMap\CoreDomain\ValueObject\Price;
use HotspotMap\CoreDomain\ValueObject\Address;
use HotspotMap\CoreDomainBundle\Specification\Specification;
use HotspotMap\Helper\SpecificationFilter;
use HotspotMap\Persistence\InMemoryMapper;

class InMemoryHotspotRepository implements HotspotRepository
{
    use SpecificationFilter;

    private $memory;

    public function __construct()
    {
        $this->memory = new InMemoryMapper();
        $equipments = array( Equipment::FastFood, Equipment::Sofa );
        $this->memory->persist(
            new Hotspot(new PlaceIdentity('McDonald\'s', 'Famous Fast-food restaurant', 'mcdonald.png'), new Address('Avenue des États Unis', '63000', 'Clermont-Ferrand', 'France'), new Price(1.0), null, $equipments, null, '1')
        );
        $this->memory->persist(
            new Hotspot(new PlaceIdentity('Starbucks Des Halles'), new Address('place de la Rotonde', '75001', 'Paris ', 'France'), new Price(1.0), null, $equipments, null, '2')
        );
        $this->memory->persist(
            new Hotspot(new PlaceIdentity('Starbucks Echelle'), new Address('2 Rue de I’Echelle', '75001', 'Paris', 'France'), new Price(1.0), null, $equipments, null, '3')
        );
        $this->memory->persist(
            new Hotspot(new PlaceIdentity('Starbucks Louvre'), new Address('Musee du Louvre', '75001', 'Paris', 'France'), new Price(1.0), null, $equipments, null, '4')
        );
    }

    public function add(Hotspot $hotspot)
    {
        $this->memory->persist($hotspot);
    }

    public function remove(Hotspot $hotspot)
    {
        return $this->memory->remove($hotspot);
    }

    public function update(Hotspot $hotspot)
    {
    }

    /**
     * @return Hotspot[]
     */
    public function findAll()
    {
        return $this->memory->retrieveAll();
    }

    /**
     * @return int
     */
    public function countAll()
    {
        return count($this->memory->retrieveAll());
    }

    public function removeAll()
    {
        $this->memory->removeAll();
    }

    public function find($userId)
    {
        return $this->memory->retrieve($userId);
    }

    public function findSatisfying(Specification $specification)
    {
        return $this->filter($this->memory->retrieveAll(), $specification);
    }
} 