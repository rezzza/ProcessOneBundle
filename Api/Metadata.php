<?php

namespace Rezzza\ProcessOneBundle\Api;

/**
 * Metadata
 *
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class Metadata
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $publishKey;

    /**
     * @var string
     */
    private $publishSecret;

    /**
     * @var integer
     */
    private $publishExpire = 10;

    /**
     * @param string  $host          host
     * @param string  $publishKey    publishKey
     * @param string  $publishSecret publishSecret
     * @param integer $publishExpire publishExpire
     */
    public function __construct($host, $publishKey, $publishSecret, $publishExpire)
    {
        $this->host          = $host;
        $this->publishKey    = $publishKey;
        $this->publishSecret = $publishSecret;
        $this->publishExpire = $publishExpire;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getPublishKey()
    {
        return $this->publishKey;
    }

    /**
     * @return string
     */
    public function getPublishSecret()
    {
        return $this->publishSecret;
    }

    /**
     * @return integer
     */
    public function getPublishExpire()
    {
        return $this->publishExpire;
    }
}
