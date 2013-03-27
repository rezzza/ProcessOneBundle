ProcessOneBundle
================

[![Build Status](https://secure.travis-ci.org/rezzza/ProcessOneBundle.png)](http://travis-ci.org/rezzza/ProcessOneBundle)

## Installation


```
"require": {
    'rezzza/processone-bundle': '*',
}
```

## Enable Bundle

In `AppKernel`:

```php
$bundles = array(
    //....
    new Rezzza\ProcessOneBundle\RezzzaProcessOneBundle(),
    //....
);
```
## Configuration

```yml
rezzza_process_one:
    connections:
        default:
            transport:  guzzle
            host:       https://subdomain.process-one.net
            publish:
                key:    MY_KEY
                secret: MY_SECRET
                expire: 10
```

## Usage

```php

use Rezzza\ProcessOneBundle\Recipient;
use Rezzza\ProcessOneBundle\Message;

$conn = $this->get('rezzza.process_one.default.connection');

// recipients
$recipients = new Recipient\TagRecipient(array('@registered'));
$recipients = new Recipient\AliasRecipient(array('user@domain.tld'));
$recipients = new Recipient\DeviceTokenRecipient(array('device-token'));


// message

$message = new Message\ApsMessage();
$message->setApsData('alert', '..');
$message->setApsData('badge', 1337);
$message->setData('custom_element', 'value');

$conn->setRecipient($recipients)
     ->setMessage($message)
     ->send();
```

## Customisation

You can easily add new `messages`, `recipients`, `transport`
