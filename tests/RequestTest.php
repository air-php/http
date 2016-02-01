<?php

namespace Air\HTTP\Request\Tests;

use Air\HTTP\Request\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request $request A Request object.
     */
    private $request;

    CONST COOKIE_VALUE = 'I have a right to exist';


    /**
     * Setup a new request object for each test.
     */
    public function setUp()
    {
        $this->request = new Request(
            'http://www.test.com/segment1/segment2?test=true',
            'POST',
            [
                'test' => 'true'
            ],
            [
                'test' => 'true'
            ],
            [
                'HTTP_REFERER' => 'http://test.com/'
            ],
            // Cookies
            [
                'PHPSESSID' => self::COOKIE_VALUE,
            ],
            [
                'userfile' => [
                    'name' => 'testfile.jpg'
                ]
            ]
        );
    }


    /**
     * Test that a constructed object returns an instance of the expected class.
     */
    public function testConstruct()
    {
        $this->assertInstanceOf(Request::class, $this->request);
    }


    /**
     * Test that an invalid URI throws an \InvalidArgumentException Exception.
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The URI provided was malformed.
     */
    public function testConstructThrowsAnException()
    {
        new Request('//');
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
     * Ensure that getQueryData() returns an array with the correct keys/values set.
     */
    public function testGetQueryData()
    {
        $this->assertTrue(is_array($this->request->getQueryData()));
        $this->assertEquals(1, count($this->request->getQueryData()));
        $this->assertArrayHasKey('test', $this->request->getQueryData());
        $this->assertEquals('true', $this->request->getQueryData()['test']);
    }


    /**
     * Ensure that getRequestData() returns an array with the correct keys/values set.
     */
    public function testGetRequestData()
    {
        $this->assertTrue(is_array($this->request->getRequestData()));
        $this->assertEquals(1, count($this->request->getRequestData()));
        $this->assertArrayHasKey('test', $this->request->getRequestData());
        $this->assertEquals('true', $this->request->getRequestData()['test']);
        $this->assertEquals('true', $this->request->getRequestData('test'));
        $this->assertEquals('Pizza', $this->request->getRequestData('Burger', 'Pizza'));
        $this->assertNull($this->request->getRequestData('Burger'));
    }


    /**
     * Ensure that addRequestData() works as expected.
     */
    public function testAddRequestData()
    {
        // Add some request data.
        $this->request->addRequestData([
            'test 1' => 'test'
        ]);

        $this->assertEquals(2, count($this->request->getRequestData()));
        $this->assertArrayHasKey('test 1', $this->request->getRequestData());
        $this->assertEquals('test', $this->request->getRequestData()['test 1']);
    }


    /**
     * Ensure the getMethod() method returns the expected value.
     */
    public function testGetMethod()
    {
        $this->assertEquals('POST', $this->request->getMethod());
    }


    /**
     * Ensure the isPost() works as expected.
     */
    public function testIsPost()
    {
        $this->assertTrue($this->request->isPost());
    }


    /**
     * Ensure the isGet() works as expected.
     */
    public function testIsGet()
    {
        $this->assertFalse($this->request->isGet());
    }


    /**
     * Ensure the getServer() method returns expected data.
     */
    public function testGetServer()
    {
        $this->assertEquals([
            'HTTP_REFERER' => 'http://test.com/'
        ], $this->request->getServerData());
    }


    /**
     * Ensure the getReferer() method returns the HTTP REFERER.
     */
    public function testGetReferer()
    {
        $this->assertEquals('http://test.com/', $this->request->getReferer());
    }


    /**
     * Ensure that the getCookie() method returns the value of the cookie set
     */
    public function testGetCookie()
    {
        // Will return the value as mocked above
        $this->assertEquals(self::COOKIE_VALUE, $this->request->getCookie('PHPSESSID'));

        // Will return null if the value isnt set
        $this->assertNull($this->request->getCookie('nonexistent_cookie'));
    }


    /**
     * Ensure the issetCookie() method returns a boolean in any possible scenario
     */
    public function testIssetCookie()
    {
        // Will return true if the value is set
        $this->assertTrue($this->request->issetCookie('PHPSESSID'));

        // Will return false if the value is not set
        $this->assertFalse($this->request->issetCookie('nonexistent_cookie'));
    }


    /**
     * Test getFileData().
     */
    public function testGetFileData()
    {
        $this->assertEquals('testfile.jpg', $this->request->getFileData()['userfile']['name']);
    }
}
