<?php

namespace Rezzza\ProcessOneBundle\Message;

/**
 * MessageInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
interface MessageInterface
{
    /**
     * @return array
     */
    public function getPayload();

    /**
     * @return string prefixed by a /
     */
    public function getEndpoint();
}
