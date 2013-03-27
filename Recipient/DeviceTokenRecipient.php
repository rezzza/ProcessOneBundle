<?php

namespace Rezzza\ProcessOneBundle\Recipient;

/**
 * DeviceTokenRecipient 
 *
 * @uses AbstractRecipient
 * @uses RecipientInterface
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class DeviceTokenRecipient extends AbstractRecipient implements RecipientInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPayload()
    {
        return array('device_tokens' => array_values($this->recipients));
    }
}
