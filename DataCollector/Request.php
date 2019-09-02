<?php

namespace Djgxp\Bundle\GuzzleBundle\DataCollector;

class Request
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $requestHeaders;

    /**
     * @var array
     */
    private $responseHeaders;

    /**
     * @var string
     */
    private $requestBody;

    /**
     * @var string
     */
    private $responseBody;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $reasonPhrase;

    /**
     * @var bool
     */
    private $success;

    /**
     * @param string $url
     * @param string $method
     * @param array  $requestHeaders
     * @param string $requestBody
     * @param array  $responseHeaders
     * @param string $responseBody
     * @param int    $statusCode
     * @param string $reasonPhrase
     * @param bool   $success
     */
    public function __construct(
        $url,
        $method,
        array $requestHeaders,
        $requestBody,
        array $responseHeaders,
        $responseBody,
        $statusCode,
        $reasonPhrase,
        $success
    ) {
        $this->url             = $url;
        $this->method          = $method;
        $this->requestHeaders  = $requestHeaders;
        $this->requestBody     = $requestBody;
        $this->responseHeaders = $responseHeaders;
        $this->responseBody    = $responseBody;
        $this->statusCode      = $statusCode;
        $this->reasonPhrase    = $reasonPhrase;
        $this->success         = $success;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get requestHeaders
     *
     * @return array
     */
    public function getRequestHeaders()
    {
        return $this->requestHeaders;
    }

    /**
     * Get responseHeaders
     *
     * @return array
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }

    /**
     * Get statusCode
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Get success
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * Get requestBody
     *
     * @return string
     */
    public function getRequestBody()
    {
        return $this->requestBody;
    }

    /**
     * Get responseBody
     *
     * @return string
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }

    /**
     * Get reasonPhrase
     *
     * @return string
     */
    public function getReasonPhrase()
    {
        return $this->reasonPhrase;
    }
}
