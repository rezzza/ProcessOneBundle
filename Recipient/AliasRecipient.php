<?php

namespace Rezzza\ProcessOneBundle\Recipient;

/**
 * AliasRecipient 
 *
 * @uses AbstractRecipient
 * @uses RecipientInterface
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class AliasRecipient extends AbstractRecipient implements RecipientInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPayload()
    {
        return array('aliases' => $this->recipients);
    }
}
