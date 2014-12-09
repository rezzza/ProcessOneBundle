<?php

namespace Rezzza\ProcessOneBundle\Recipient;

use Rezzza\ProcessOneBundle\Recipient\TagRecipient;
use Rezzza\ProcessOneBundle\Recipient\AliasRecipient;
use Rezzza\ProcessOneBundle\Recipient\DeviceTokenRecipient;

/**
 * Description of RecipientFactory
 *
 * @author mika
 */
class RecipientFactory
{

    /**
     * Return recipient.
     *
     * @param string $to
     * @throws \InvalidArgumentException
     * @return AbstractRecipient
     */
    public function getRecipient($to)
    {
        if (is_scalar($to) === false) {
            throw new \InvalidArgumentException('Expected scalar');
        }

        if ($this->isAlias($to) === true) {
            return new AliasRecipient($to);
        }

        if ($this->isTag($to) === true) {
            return new TagRecipient($to);
        }

        if ($this->isToken($to) === true) {
            return new DeviceTokenRecipient($to);
        }

        throw new \InvalidArgumentException('No device recipient found for ' . $to);
    }

    /**
     * Return if $to is alias.
     * @param type $to
     */
    private function isAlias($to)
    {
        return (preg_match('/^~[^@]+@[^.]+\..+/', $to) === 1);
    }

    /**
     * Return if $to is token.
     * @param type $to
     */
    private function isTag($to)
    {
        return (preg_match('/^@.+/', $to) === 1);
    }

    /**
     * Return if $to is token.
     * @param type $to
     */
    private function isToken($to)
    {
        return (preg_match('/^[a-z0-9-:]+$/i', $to) === 1);
    }
}
