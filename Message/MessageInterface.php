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
     * validate current message and throw an exception if there is any trouble.
     */
    public function validate();

    /**
     * @return string prefixed by a /
     */
    public function getEndpoint();
}
