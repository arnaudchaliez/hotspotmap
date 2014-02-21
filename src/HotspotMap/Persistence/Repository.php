<?php
/**
 * File: Repository.php
 * Date: 21/02/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Persistence;

interface Repository {
    public function add($object);

    public function remove($object);

    public function update($object);

    public function findAll();

    public function countAll();

    public function removeAll();

    public function find($objectId);

    //public function createQuery();
} 