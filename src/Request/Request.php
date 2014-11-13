<?php

namespace Air\HTTP\Request;

class Request implements RequestInterface
{
    /**
     * @param string $uri The request URI.
     */
    protected $uri;


    /**
     * @param array $uriComponents An array of components that make up the URI.
     */
    protected $uriComponents;


    /**
     * @param string $method The request method.
     */
    protected $method;


    /**
     * @var array $requestData An array of request data (from POST, PUT, etc).
     */
    protected $requestData;


    /**
     * @var array $getData An array of query data (i.e. a GET request).
     */
    protected $queryData;


    /**
     * @param string $uri The request URI.
     * @param string $method The request method.
     * @param array $requestData The request data.
     * @param array $queryData The query data.
     * @throws \InvalidArgumentException
     */
    public function __construct($uri, $method = self::METHOD_GET, array $requestData = [], array $queryData = [])
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->requestData = $requestData;
        $this->queryData = $queryData;

        // Parse the URI.
        $parsed_uri = parse_url($uri);

        // Ensure the URI is valid, and set it.
        if ($parsed_uri) {
            $this->uriComponents = $parsed_uri;
        } else {
            throw new \InvalidArgumentException('The URI provided was malformed.');
        }
    }


    /**
     * @return string The request method.
     */
    public function getMethod()
    {
        return $this->method;
    }


    /**
     * @return string The URI.
     */
    public function getUri()
    {
        return $this->uri;
    }


    /**
     * @return string The URI path.
     */
    public function getUriPath()
    {
        return $this->uriComponents['path'];
    }


    /**
     * @return array The request data.
     */
    public function getRequestData()
    {
        return $this->requestData;
    }


    /**
     * @return array The query data.
     */
    public function getQueryData()
    {
        return $this->queryData;
    }


    /**
     * Add data to the request.
     *
     * @param array $data An array of data.
     */
    public function addRequestData(array $data)
    {
        $this->requestData = array_merge($this->requestData, $data);
    }


    /**
     * @return bool Whether the method is post or not.
     */
    public function isPost()
    {
        return $this->method === self::METHOD_POST;
    }


    /**
     * @return bool Whether the method is get or not.
     */
    public function isGet()
    {
        return $this->method === self::METHOD_GET;
    }
}
