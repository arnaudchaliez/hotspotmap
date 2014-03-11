<?php
/**
 * File: UserController.php
 * Date: 11/03/14
 * Created by Jérémy BOUNY & Arnaud CHALIEZ.
 * Project: hotspotmap
 */

namespace HotspotMap\Helper;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponseHandler
{
    private $serializers;

    private $request;

    public function __construct($serializers, Request $request, $template, array $acceptableMimeTypes)
    {
        $this->serializers          = $serializers;
        $this->request              = $request;
        $this->template             = $template;
        $this->acceptableMimeTypes  = $acceptableMimeTypes;
    }

    public function handle($data, $view = '', $statusCode = 200, array $headers = [], Response $response = null)
    {
        $format = 'html';

        $negotiator = new \Negotiation\Negotiator();
        $priorities   = array('text/html', 'application/json', 'application/xml', '*/*');
        $contentType = $negotiator->getBest($this->request->headers->get('Accept'), $priorities);
        $mymeType = $contentType->getValue();

        switch($mymeType) {
            case 'application/xml':
                $format = 'xml';
                break;
             case 'application/json':
                $format = 'json';
                break;
        }

        if ($format !== 'html')
        {
            if (null === $response) {
                $response = new Response();
            }

            if (in_array($statusCode, [ 404, 500 ])) {
                switch ($contentType) {
                    case 'xml':
                        $mimeType = 'application/error+xml';
                        break;
                    case 'json':
                        $mimeType = 'application/error+json';
                        break;

                    default:
                        $mimeType = 'application/error+html';
                }
            }

            $response->setStatusCode($statusCode);
            $response->headers->add(array_merge(
                [ 'Content-Type' => $mimeType ],
                $headers
            ));

            $response->setContent($this->serializer->serialize($data, $format));
        }
        else
        {
            return $this->template->render($view,  array('data' => $data));
        }
    }
} 