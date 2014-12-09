<?php

namespace Rezzza\ProcessOneBundle\tests\units\Recipient;

require __DIR__ . "/../../../vendor/autoload.php";

use mageekguy\atoum;
use Rezzza\ProcessOneBundle\Recipient\RecipientFactory as TestedClass;

/**
 * Description of RecipientFactory
 *
 * @author mika
 */
class RecipientFactory extends atoum\test
{
    /**
     * @dataProvider getRecipientDataProvider
     */
    public function test_get_recipient($input, $className)
    {
        $this
            ->given($factory = new TestedClass())
            ->and($recipient = $factory->getRecipient($input))
            ->object($recipient)->isInstanceOf($className)
        ;
    }

    /**
     * @dataProvider failRecipientDataProvider
     */
    public function test_fail_recipient($input)
    {
        $this
            ->given($factory = new TestedClass())
            ->exception(function() use ($factory, $input) {
                $factory->getRecipient($input);
            })
        ;
    }

    public function getRecipientDataProvider()
    {
        return array(
            array('~6@vlr.com', '\Rezzza\ProcessOneBundle\Recipient\AliasRecipient'),
            array('H3ze7:Q3em-2', '\Rezzza\ProcessOneBundle\Recipient\DeviceTokenRecipient'),
            array('@all', '\Rezzza\ProcessOneBundle\Recipient\TagRecipient'),
        );
    }

    public function failRecipientDataProvider()
    {
        return array(
            array('Jean Marc'),
            array('mika@vlr.com'),
            array(new \stdClass()),
        );
    }
}
