<?php

namespace Colin\Bundle\GuzzleBundle\Guzzle6\Middleware;

use Colin\Bundle\GuzzleBundle\DataCollector\Request;
use Colin\Bundle\GuzzleBundle\DataCollector\RequestCollector;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CollectorMiddleware
{
    /**
     * @var RequestCollector
     */
    private $collector;

    /**
     * CollectorMiddleware constructor.
     *
     * @param RequestCollector $collector
     */
    public function __construct(RequestCollector $collector)
    {
        $this->collector = $collector;
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
                    $this->collect($request, $response, true);

                    return $response;
                }, function (ResponseInterface $response) use ($request) {
                    $this->collect($request, $response, false);

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
    private function collect(RequestInterface $request, ResponseInterface $response, $success)
    {
        $data = new Request(
            $request->getUri(),
            $request->getMethod(),
            $request->getHeaders(),
            (string) $request->getBody(),
            $response->getHeaders(),
            (string) $response->getBody(),
            $response->getStatusCode(),
            $response->getReasonPhrase(),
            $success
        );

        $this->collector->collect($data);
    }
}
