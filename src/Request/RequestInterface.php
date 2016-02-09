<?php

namespace Air\HTTP\Request;

interface RequestInterface
{
    /**
     * Request methods.
     */
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
     * Server data parameters.
     */
    const REFERER_KEY = 'HTTP_REFERER';


    /**
     * @param string $uri The request URI.
     * @param string $method The request method.
     * @param array $requestData The request data.
     * @param array $queryData The query data.
     * @param array $serverData The server data.
     * @throws \InvalidArgumentException
     */
    public function __construct(
        $uri,
        $method = self::METHOD_GET,
        array $requestData = [],
        array $queryData = [],
        array $serverData = [],
        array $fileData = []
    );


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
     * @param mixed $key The data key.
     * @param mixed $default The value to return if the key is not found.
     *
     * @return mixed The request data.
     */
    public function getRequestData($key = null, $default = null);


    /**
     * @return array The query data.
     */
    public function getQueryData();


    /**
     * Get the server data.
     *
     * @return array The server data.
     */
    public function getServerData();


    /**
     * Get the HTTP REFERER from the server data.
     *
     * @return string|null The referer or null if not found.
     */
    public function getReferer();


    /**
     * Get file data.
     *
     * @return array File data.
     */
    public function getFileData();


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


    /**
     * Get cookie value by name
     *
     * @param string $name
     *
     * @return string returns the cookie value for the index name provided
     */
    public function getCookie($name);


    /**
     * Returns true if the cookie is set for the name provided else false
     *
     * @param string @name
     *
     * @return boolean
     */
    public function issetCookie($name);


    /**
     * Returns the content of the request.
     *
     * @return string
     */
    public function getContent();
}
