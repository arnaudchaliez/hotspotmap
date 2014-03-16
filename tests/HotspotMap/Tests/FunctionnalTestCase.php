<?php
/**
 * File: FunctionnalTestCase.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */
namespace HotspotMap\Tests;

use Silex\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

abstract class FunctionnalTestCase extends WebTestCase
{
    public function createApplication()
    {
        $app = require __DIR__ . '/../../../app/app.php';
        $app['session.storage'] = new MockArraySessionStorage();
        $app['debug'] = true;
        $app['exception_handler']->disable();
        return $app;
    }
}