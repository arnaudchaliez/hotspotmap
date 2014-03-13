<?php
/**
 * File: HotspotController.php
 * Date: 12/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Controller;

use HotspotMap\CoreDomainBundle\Specification\ValueSpecification;
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

    public function showAction(Request $request, Application $app, $hotspotId)
    {
        $hotspot = $this->hotspotRepository->find($hotspotId);
        if (null !== $hotspot)
            return $app['helper.response']->handle($hotspot, 'Hotspot/hotspot.html');
        else
            return $app['helper.response']->handle('hotspot not found', 'error.html', 404);
    }

    public function findByNameAction(Request $request, Application $app, $hotspotName)
    {
        $hotspots = $this->hotspotRepository->findSatisfying(new ValueSpecification('getName', $hotspotName));

        if (null !== $hotspots)
            return $app['helper.response']->handle($hotspots, 'Hotspot/hotspots.html');
        else
            return $app['helper.response']->handle('hotspot not found', 'error.html', 404);
    }

    public function updateAction(Request $request, Application $app)
    {
        //return $app['helper.response']->handle($this->hotspotRepository->findAll(), 'Hotspot/hotspots.html');
    }
    public function deleteAction($id)
    {
        $hotspot = $this->hotspotRepository->findSatisfying(new ValueSpecification('getId', $id));
        return new Response($this->hotspotRepository->remove($hotspot));
    }
} 