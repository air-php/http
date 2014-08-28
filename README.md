# HTTP
[![Build Status](https://scrutinizer-ci.com/g/air-php/http/badges/build.png?b=master)](https://scrutinizer-ci.com/g/air-php/http/build-status/master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/air-php/http/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/air-php/http/?branch=master)

The HTTP library includes classes for abstracting the [Hypertext Transfer Protocol](http://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol).

## Installation
Installation via [Composer](https://getcomposer.org/) is recommended.

    "require": {
        "air-php/http": "~1.0"
    }


## Request
The `Request` class encapsulates a HTTP request. You can create a `Request` like so:

    <?php

    use Air\HTTP\Request\Request;

    new Request('http://www.test.com/test/', 'GET');

Once you have a `Request` object, it offers convenient methods for accessing request data, such as `getUriPath()` and `getQueryParameters()`.