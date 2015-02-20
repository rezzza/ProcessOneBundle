<?php

namespace Rezzza\ProcessOneBundle\Transport;

use Guzzle\Http\ClientInterface;

/**
 * GuzzleTransport
 *
 * @uses TransportInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class GuzzleTransport implements TransportInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function send($url, $payload, array $parameters)
    {
        $this->client->setSslVerification(false, true, 2);

        $url .= '?' . http_build_query($parameters);

        $request = $this->client->post($url, array(
            'Content-Type' => 'application/json'
        ), $payload);

        $response = $request->send();

        return new Response($response->getStatusCode(), $response->getBody(true));
    }
}
