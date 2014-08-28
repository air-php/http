<?php

namespace Air\HTTP\Request\Tests;

use Air\HTTP\Request\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request $request A Request object.
     */
    private $request;


    /**
     * Setup a new request object for each test.
     */
    public function setUp()
    {
        $this->request = new Request('http://www.test.com/segment1/segment2?test=true', 'POST');
    }


    /**
     * Test that a constructed object returns an instance of the expected class.
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(Request::class, $this->request);
    }


    /**
     * Ensure the getUri() method returns the expected value.
     */
    public function testGetUri()
    {
        $this->assertEquals('http://www.test.com/segment1/segment2?test=true', $this->request->getUri());
    }


    /**
     * Ensure that getUriPath() returns the expected value.
     */
    public function testGetUriPath()
    {
        $this->assertEquals('/segment1/segment2', $this->request->getUriPath());
    }


    /**
     * Ensure that getQueryParameters() returns an array with the correct keys/values set.
     */
    public function testGetQueryParameters()
    {
        $this->assertTrue(is_array($this->request->getQueryParameters()));
        $this->assertEquals(1, count($this->request->getQueryParameters()));
        $this->assertArrayHasKey('test', $this->request->getQueryParameters());
        $this->assertEquals('true', $this->request->getQueryParameters()['test']);
    }


    /**
     * Ensure the getMethod() method returns the expected value.
     */
    public function testGetMethod()
    {
        $this->assertEquals('POST', $this->request->getMethod());
    }
}
