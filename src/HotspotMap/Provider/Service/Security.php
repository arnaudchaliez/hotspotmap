<?php
/**
 * File: Security.php
 * Date: 16/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Provider\Service;

use Silex\ServiceProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Response;

class Security implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app->before(function() use ($app) {
            $app['session']->start();

            $route = $app['request']->get('_route');
            if ('logout' === $route) {
                return;
            }

            if ('GET_login' === $route && !$app['session']->has('username')) {
                $openid = new \LightOpenID($_SERVER['SERVER_NAME']);

                if (!$openid->mode) {
                    $openid->identity = 'https://www.google.com/accounts/o8/id';
                    $openid->required = array('email' => 'contact/email');
                    return $app->redirect($openid->authUrl());
                } else {
                    if ($openid->validate()) {
                        $attributes = $openid->getAttributes();
                        $app['session']->set('username', $attributes['contact/email']);
                        return $app->redirect($app['url_generator']->generate('homepage'));
                    }
                }
            }

            $userName = $app['session']->get('username');

            if (isset($app['auth']) && !$app['auth']($userName)) {
                return new Response($app['twig']->render('forbidden.html.twig'), 403);
            }

            $app['twig']->addGlobal('username', $userName);
        });
    }

    public function boot(Application $app)
    {

    }
}