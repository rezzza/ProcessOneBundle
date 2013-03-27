<?php

namespace Rezzza\ProcessOneBundle\Recipient;

/**
 * AbstractRecipient
 *
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
abstract class AbstractRecipient
{
    /**
     * @var array
     */
    protected $recipients = array();

    /**
     * @param string|array $recipient recipient
     */
    public function __construct($recipient)
    {
        $this->add($recipient);
    }

    /**
     * @param string|array $recipient recipient
     * 
     * @return AbstractRecipient
     */
    public function add($recipient)
    {
        if (is_array($recipient) || $recipient instanceof \Iterator) {
            foreach ($recipient as $r) {
                $this->add($r);
            }

            return $this;
        }

        $this->recipients[$recipient];

        return $this;
    }
}
