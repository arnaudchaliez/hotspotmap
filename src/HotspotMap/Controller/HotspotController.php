<?php
/**
 * File: HotspotController.php
 * Date: 12/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Controller;

use HotspotMap\CoreDomain\Entity\Hotspot;
use HotspotMap\CoreDomain\ValueObject\Address;
use HotspotMap\CoreDomain\ValueObject\PlaceIdentity;
use HotspotMap\CoreDomain\ValueObject\Price;
use HotspotMap\CoreDomain\ValueObject\Schedule;
use HotspotMap\CoreDomain\ValueObject\SocialInformation;
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

    public function addAction(Request $request, Application $app)
    {

        $hotspot = $this->createHotspotFromRequest($request);

        if ($hotspot)
        {
            if ($this->hotspotRepository->add($hotspot))
            {
                return $app['helper.response']->handle($hotspot, 'Hotspot/hotspot.html', 201);
            }

            return $app['helper.response']->handle('error adding hotspot', 'error.html', 400);
        }

        return $app['helper.response']->handle('error creating hotspot', 'error.html', 400);
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

    protected function createHotspotFromRequest(Request $request)
    {
        Hotspot::$hotspot = null;
        extract($request->attributes);
        //todo verif params
        if (isset($name))
            $hotspot = new Hotspot(
                new PlaceIdentity($name, $description, $thumbnail),
                new Address($street, $postalCode, $city, $country),
                new Price($price),
                new Schedule(),
                new array($equipments),
                new SocialInformation($facebook, $twitter)
            );

        return $hotspot;
    }
} 