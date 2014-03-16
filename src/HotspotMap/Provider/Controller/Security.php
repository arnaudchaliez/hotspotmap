<?php
/**
 * File: Security.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Provider\Controller;

use Silex\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

class Security implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        /**
         * Logout
         */
        $controllers->get('logout', function() use ($app) {
            $app['session']->remove('username');

            return $app->redirect($app['url_generator']->generate('homepage'));
        })->bind('logout');

        return $controllers;
    }
}