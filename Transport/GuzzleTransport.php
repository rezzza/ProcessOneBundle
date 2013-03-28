<?php

namespace Rezzza\ProcessOneBundle\Transport;

use Guzzle\Http\Client;

/**
 * GuzzleTransport 
 *
 * @uses TransportInterface
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class GuzzleTransport implements TransportInterface
{
    /**
     * {@inheritdoc}
     */
    public function send($url, $payload, array $parameters)
    {
        $client = new Client();
        $client->setSslVerification(false);

        $url   .= '?'.http_build_query($parameters);

        $request = $client->post($url, array(
            'Content-Type' => 'application/json'
        ), $payload);

        $response = $request->send();

        return new Response($response->getStatusCode(), $response->getBody(true));
    }
}
