<?php

namespace Rezzza\ProcessOneBundle\Message;

use Rezzza\ProcessOneBundle\Exception;

/**
 * APSMessage 
 *
 * Apple documentation of Apple Push Notification Service.
 * http://developer.apple.com/library/ios/#documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/ApplePushService/ApplePushService.html#//apple_ref/doc/uid/TP40008194-CH100-SW1
 *
 * @uses MessageInterface
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class APSMessage implements MessageInterface
{
    /**
     * @var array
     */
    protected $apsData = array();

    /**
     * @var array
     */
    protected $data = array();

    /**
     * {@inheritdoc}
     */
    public function getPayload()
    {
        return array_filter(
            array_merge(
                $this->data, array(
                    'aps' => array_filter($this->apsData)
                )
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        if (empty($this->apsData)) {
            throw new Exception\EmptyMessageException('Aps data are mandatory.');
        }

        if ($length = mb_strlen(serialize($this->getPayload())) > 256) {
            throw new Exception\InvalidMessageException(sprintf('Length of message exceed 256 chars (current = %s)', $length));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getEndPoint()
    {
        return '/api/push';
    }

    /**
     * @param string $key   key
     * @param mixed  $value value
     * 
     * @return APSMessage
     */
    public function setApsData($key, $value)
    {
        $this->apsData[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getApsData()
    {
        return $this->apsData;
    }

    /**
     * @param string $key   key
     * @param mixed  $value value
     * 
     * @return APSMessage
     */
    public function setData($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
