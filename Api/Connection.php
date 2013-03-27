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
     * @var MessageInterface
     */
    protected $message;

    /**
     * @var RecipientInterface
     */
    protected $recipient;

    /**
     * @param Metadata $metadata metadata
     */
    public function __construct(Metadata $metadata, TransportInterface $transport)
    {
        $this->metadata  = $metadata;
        $this->transport = $transport;
    }

    /**
     * @return boolean
     */
    public function send()
    {
        if (!$this->message) {
            throw new \LogicException('Please, provide a message.');
        }

        if (!$this->recipient) {
            throw new \LogicException('Please, provide a recipient.');
        }

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
     * @param MessageInterface $message message
     *
     * @return Connection
     */
    public function setMessage(MessageInterface $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param RecipientInterface $recipient recipient
     *
     * @return Connection
     */
    public function setRecipient(RecipientInterface $recipient)
    {
        $this->recipient = $recipient;

        return $this;
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
