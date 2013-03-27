<?php

namespace Rezzza\ProcessOneBundle\Message;

/**
 * AbstractMessage
 *
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
abstract class AbstractMessage
{
    /**
     * @var array
     */
    protected $datas = array();

    /**
     * @param string $key   key
     * @param mixed  $value value
     * 
     * @return AbstractMessage
     */
    public function set($key, $value)
    {
        $this->datas[$key] = $value;

        return $this;
    }

    /**
     * @param string $key key
     * 
     * @return mixed
     */
    public function get($key)
    {
        return $this->has($key) ? $this->datas[$key] : null;
    }

    /**
     * @param string $key key
     * 
     * @return boolean
     */
    public function has($key)
    {
        return isset($this->datas[$key]);
    }
}
