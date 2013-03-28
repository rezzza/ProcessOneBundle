<?php

namespace Rezzza\ProcessOneBundle\Transport;

/**
 * TransportInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
interface TransportInterface
{
    /**
     * @param string $url        url
     * @param string $payload    payload
     * @param array  $parameters parameters
     * 
     * @return Response
     */
    public function send($url, $payload, array $parameters);
}
