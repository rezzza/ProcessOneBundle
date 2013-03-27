<?php

namespace Rezzza\ProcessOneBundle\Message;

/**
 * CustomMessage 
 *
 * @uses AbstractMessage
 * @uses MessageInterface
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class CustomMessage extends AbstractMessage implements MessageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPayload()
    {
        return $this->data;
    }
}
