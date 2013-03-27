<?php

namespace Rezzza\ProcessOneBundle\Recipient;

/**
 * RecipientInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
interface RecipientInterface
{
    /**
     * @return array
     */
    public function getPayload();
}
