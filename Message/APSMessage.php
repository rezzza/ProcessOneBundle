<?php

namespace Rezzza\ProcessOneBundle\Message;

/**
 * APSMessage 
 *
 * @uses AbstractMessage
 * @uses MessageInterface
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class APSMessage extends AbstractMessage implements MessageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPayload()
    {
        return array(
            'aps' => $this->data,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getEndPoint()
    {
        return '/api/push';
    }
}
