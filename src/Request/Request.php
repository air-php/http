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
     * @var array $postData An array of post data.
     */
    protected $postData;


    /**
     * @param string $uri The request URI.
     * @param string $method The request method.
     * @param array $postData The request post data.
     * @throws \InvalidArgumentException
     */
    public function __construct($uri, $method = 'GET', array $postData = [])
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->postData = $postData;

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
     * @return array The query parameters.
     */
    public function getQueryParameters()
    {
        $params = [];

        if (isset($this->uriComponents['query'])) {
            parse_str($this->uriComponents['query'], $params);
        }

        return $params;
    }


    /**
     * @return array Request POST data.
     */
    public function getPostData()
    {
        return $this->postData;
    }


    /**
     * Add post data to the request.
     *
     * @param array $data An array of data.
     */
    public function addPostData(array $data)
    {
        $this->postData = array_merge($this->postData, $data);
    }
}
