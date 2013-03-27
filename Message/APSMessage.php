<?php

namespace Rezzza\ProcessOneBundle\Message;

/**
 * APSMessage 
 *
 * Apple documentation of Apple Push Notification Service.
 * http://developer.apple.com/library/ios/#documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/ApplePushService/ApplePushService.html#//apple_ref/doc/uid/TP40008194-CH100-SW1
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
