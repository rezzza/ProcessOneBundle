ProcessOneBundle
================

[![Build Status](https://secure.travis-ci.org/rezzza/ProcessOneBundle.png)](http://travis-ci.org/rezzza/ProcessOneBundle)

## Installation


```json
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

