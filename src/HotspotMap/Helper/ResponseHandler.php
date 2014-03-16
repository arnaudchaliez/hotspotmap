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
    private $serializer;

    private $request;

    public function __construct($serializer, Request $request, $template, array $acceptableMimeTypes)
    {
        $this->serializer           = $serializer;
        $this->request              = $request;
        $this->template             = $template;
        $this->acceptableMimeTypes  = $acceptableMimeTypes;
    }

    public function handle($data, $view = '', $statusCode = 200, array $headers = [], Response $response = null, $defaultFormat = 'html')
    {
        $format = $defaultFormat;

        $negotiator = new \Negotiation\Negotiator();
        $priorities   = array('text/html', 'application/json', 'application/xml', '*/*');
        $contentType = $negotiator->getBest($this->request->headers->get('Accept'), $priorities);
        $mimeType = $contentType->getValue();

        switch($mimeType) {
            case 'application/xml':
                $format = 'xml';
                break;
             case 'application/json':
                $format = 'json';
                break;
        }

        if (null !== $this->request->get('format')) {
            $format = $this->request->get('format');
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

            return $response->setContent($this->serializer->serialize($data, $format));
        }
        else
        {
            return $this->template->render($view,  array('data' => $data));
        }
    }
}