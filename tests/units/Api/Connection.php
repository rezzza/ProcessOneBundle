<?php

namespace Rezzza\ProcessOneBundle\tests\units\Api;

require __DIR__."/../../../vendor/autoload.php";

use mageekguy\atoum;
use Rezzza\ProcessOneBundle\Api\Metadata;

/**
 * Connection 
 *
 * @uses atoum
 * @author Stephane PY <py.stephane1@gmail.com> 
 */
class Connection extends atoum\test
{
    public function testSend()
    {
        $this->mockClass('Rezzza\ProcessOneBundle\Api\Connection', '\Mock');
        $this->mockClass('Rezzza\ProcessOneBundle\Transport\TransportInterface', '\Mock');
        $this->mockClass('Rezzza\ProcessOneBundle\Message\MessageInterface', '\Mock');
        $this->mockClass('Rezzza\ProcessOneBundle\Recipient\RecipientInterface', '\Mock');

        $this->if($metadata  = new Metadata('https://host.tld', 'publishkey', 'publishsecret', 1337))
            ->and($transport = new \Mock\TransportInterface())
            ->and($message   = new \Mock\MessageInterface())
            ->and($recipient = new \Mock\RecipientInterface())
            // define endpoint
            ->and($message->getMockController()->getEndpoint  = '/endpoint')
            // define payload additions for message and recipient
            ->and($message->getMockController()->getPayload   = array('message'    => 'myMessage'))
            ->and($recipient->getMockController()->getPayload = array('device_ids' => array(1, 2, 3)))
            // connection (tested object) object creation
            ->and($connection = new \Mock\Connection($metadata, $transport))
            ->and($connection->getMockController()->getTimestamp = 13)
            ->and($connection->getMockController()->getUniqid    = 'jm')
            ->and($connection->setMessage($message))
            ->and($connection->setRecipient($recipient))
            // send the message to recipient
            ->when($connection->send())
                ->mock($message)->call('getEndPoint')->once()
                ->mock($transport)
                    ->call('send')
                    ->withArguments(
                        'https://host.tld/endpoint', 
                        '{"device_ids":[1,2,3],"message":"myMessage","id":"jm","expires":1350}',
                        array(
                            'publishkey' => 'publishkey',
                            'signature' => '16494857750af1b2320b0a080ecc1622a16a4589',
                        )
                    )
                    ->once()
            ;
    }
}
