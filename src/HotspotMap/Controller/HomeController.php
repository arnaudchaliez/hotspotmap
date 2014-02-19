<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 19/02/14
 * Time: 16:03
 */

namespace HotspotMap\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController {
    public function indexAction(Request $request, Application $app)
    {
        return $app['twig']->render('index.html', array('name' => 'World') );
    }
} 