<?php

namespace Rezzza\ProcessOneBundle\Recipient;

/**
 * TagRecipient 
 *
 * @uses AbstractRecipient
 * @uses RecipientInterface
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class TagRecipient extends AbstractRecipient implements RecipientInterface
{
    protected static $allowedTags = array(
        '@all', '@registered', '@anonymous',
    );

    /**
     * {@inheritdoc}
     */
    public function add($recipient)
    {
        if (is_array($recipient) || $recipient instanceof \Iterator) {
            return parent::add($recipient);
        }

        if (!in_array($recipient, self::$allowedTags)) {
            throw new \InvalidArgumentException(sprintf('Recipient "%s" not supported, use "%s"', $recipient, implode(', ', self::$allowedTags)));
        }

        return parent::add($recipient);
    }

    /**
     * {@inheritdoc}
     */
    public function getPayload()
    {
        return array('tags' => array_values($this->recipients));
    }
}
