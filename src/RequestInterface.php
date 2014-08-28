<?php

namespace Air\HTTP;

interface RequestInterface
{
    /**
     * @return string The request method.
     */
    public function getMethod();


    /**
     * @return string The URI.
     */
    public function getUri();


    /**
     * @return string The URI path.
     */
    public function getUriPath();


    /**
     * @return array The query parameters.
     */
    public function getQueryParameters();
}
