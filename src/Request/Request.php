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
     * @var array $queryData An array of query data (i.e. a GET request).
     */
    protected $queryData;


    /**
     * @var array $serverData An array of server data (i.e. HTTP_REFERER, DOC_ROOT etc).
     */
    protected $serverData;


    /**
     * @var array $cookies An array of cookies the current request holds
     */
    protected $cookies;


    /**
     * Class constructor.
     *
     * @param string $uri The request URI.
     * @param string $method The request method.
     * @param array $requestData The request data.
     * @param array $queryData The query data.
     * @param array $serverData The server data.
     * @param array $cookies The cookies for the current request
     * @throws \InvalidArgumentException
     */
    public function __construct(
        $uri,
        $method = self::METHOD_GET,
        array $requestData = [],
        array $queryData = [],
        array $serverData = [],
        array $cookies = []
    ) {
        $this->uri = $uri;
        $this->method = $method;
        $this->requestData = $requestData;
        $this->queryData = $queryData;
        $this->serverData = $serverData;
        $this->cookies = $cookies;

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
     * Get the request method.
     *
     * @return string The request method.
     */
    public function getMethod()
    {
        return $this->method;
    }


    /**
     * Get the URI.
     *
     * @return string The URI.
     */
    public function getUri()
    {
        return $this->uri;
    }


    /**
     * Get the URI path.
     *
     * @return string The URI path.
     */
    public function getUriPath()
    {
        return $this->uriComponents['path'];
    }


    /**
     * Get the request data.
     *
     * @return array The request data.
     */
    public function getRequestData()
    {
        return $this->requestData;
    }


    /**
     * Get the query data.
     *
     * @return array The query data.
     */
    public function getQueryData()
    {
        return $this->queryData;
    }


    /**
     * Get the server data.
     *
     * @return array The server data.
     */
    public function getServerData()
    {
        return $this->serverData;
    }


    /**
     * Get the HTTP REFERER from the server data.
     *
     * @return string|null The referer or null if not found.
     */
    public function getReferer()
    {
        $referer = null;

        if (array_key_exists(self::REFERER_KEY, $this->serverData)) {
            $referer = $this->serverData[self::REFERER_KEY];
        }

        return $referer;
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


    /**
     * Get cookie value by name
     *
     * @param string $name
     *
     * @return string|null returns the cookie value for the index name provided
     */
    public function getCookie($name)
    {
        return (isset($this->cookies[$name])) ? $this->cookies[$name] : null;
    }


    /**
     * Returns true if the cookie is set for the name provided else false
     *
     * @param string @name
     *
     * @return boolean
     */
    public function issetCookie($name)
    {
        return ($this->getCookie($name) !== null);
    }
}
