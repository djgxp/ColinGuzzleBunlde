<?php

namespace Colin\Bundle\GuzzleBundle\Guzzle6\Middleware;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class LoggerMiddleware
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LoggerMiddleware constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param callable $handler
     *
     * @return \Closure
     */
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            return $handler($request, $options)->then(
                function (ResponseInterface $response) use ($request) {
                    $this->log($request, $response, true);

                    return $response;
                }, function (ResponseInterface $response) use ($request) {
                    $this->log($request, $response, false);

                    return $response;
                }
            );
        };
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param bool              $success
     */
    private function log(RequestInterface $request, ResponseInterface $response, $success)
    {
        if ($success) {
            $this->logger->debug('Guzzle : ' . (string) $request->getUri(), [
                'StatusCode' => $response->getStatusCode()
            ]);
        } else {
            $this->logger->error('Guzzle : ' . (string) $request->getUri(), [
                'StatusCode' => $response->getStatusCode()
            ]);
        }
    }
}
