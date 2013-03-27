<?php

namespace Rezzza\ProcessOneBundle\Api;

use Rezzza\ProcessOneBundle\Transport\TransportInterface;
use Rezzza\ProcessOneBundle\Message\MessageInterface;
use Rezzza\ProcessOneBundle\Recipient\RecipientInterface;

/**
 * Connection
 *
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class Connection
{
    /**
     * @var Metadata
     */
    protected $metadata;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @param Metadata $metadata metadata
     */
    public function __construct(Metadata $metadata, TransportInterface $transport)
    {
        $this->metadata  = $metadata;
        $this->transport = $transport;
    }

    /**
     * @param MessageInterface   $message   message
     * @param RecipientInterface $recipient recipient
     *
     * @return boolean
     */
    public function send(MessageInterface $message, RecipientInterface $recipient)
    {
        $payload = array(
            'id'      => $this->getUniqid(),
            'expires' => $this->getTimestamp()+$this->metadata->getPublishExpire(),
        );

        $payload = array_merge((array) $message->getPayload(), $payload);
        $payload = array_merge((array) $recipient->getPayload(), $payload);

        $payload = json_encode($payload);

        $url     = $this->metadata->getHost().$message->getEndpoint();
        $infoUrl = parse_url($url);

        $signatureCriterias = implode("\n", array(
            'POST', 
            $infoUrl['host'],
            $infoUrl['path'],
            $payload,
        ));

        $parameters = array(
            'publishkey' => $this->metadata->getPublishKey(),
            'signature'  => hash_hmac('sha1', $signatureCriterias, $this->metadata->getPublishSecret()),
        );

        return $this->transport->send($url, $payload, $parameters);
    }

    /**
     * @return string
     */
    public function getUniqid()
    {
        return uniqid();
    }

    /**
     * @return integer
     */
    public function getTimestamp()
    {
        return time();
    }
}
