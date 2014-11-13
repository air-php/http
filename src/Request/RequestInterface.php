<?php

namespace Air\HTTP\Request;

interface RequestInterface
{
    const METHOD_CONNECT = 'CONNECT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_GET = 'GET';
    const METHOD_HEAD = 'HEAD';
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_PATCH = 'PATCH';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_TRACE = 'TRACE';


    /**
     * @param string $uri The request URI.
     * @param string $method The request method.
     * @param array $requestData The request data.
     * @param array $queryData The query data.
     * @throws \InvalidArgumentException
     */
    public function __construct($uri, $method = self::METHOD_GET, array $requestData = [], array $queryData = []);


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
     * @return array The request data.
     */
    public function getRequestData();


    /**
     * @return array The query data.
     */
    public function getQueryData();


    /**
     * Add data to the request.
     *
     * @param array $data An array of data.
     */
    public function addRequestData(array $data);


    /**
     * @return bool Whether the method is post or not.
     */
    public function isPost();


    /**
     * @return bool Whether the method is get or not.
     */
    public function isGet();
}
