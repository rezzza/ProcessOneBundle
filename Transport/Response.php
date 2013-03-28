<?php

namespace Rezzza\ProcessOneBundle\Transport;

/**
 * Response
 *
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class Response
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $body;

    /**
     * @param string $status status
     * @param string $body   body
     */
    public function __construct($status, $body)
    {
        $this->status = $status;
        $this->body   = $body;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
}
