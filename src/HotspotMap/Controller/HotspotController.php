<?php
/**
 * File: HotspotController.php
 * Date: 12/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HotspotController {

    protected $hotspotRepository;

    public function __construct($repository)
    {
        $this->hotspotRepository = $repository;
    }

    public function hotspotsAction(Request $request, Application $app)
    {
        return $app['helper.response']->handle($this->hotspotRepository->findAll(), 'Hotspot/hotspots.html');
    }

    public function delete($id)
    {
        $hotspot = $this->hotspotRepository->findSatisfying(new ValueSpecification('getId', $id));
        return new Response($this->hotspotRepository->remove($hotspot));
    }
} 