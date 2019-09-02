<?php

namespace Colin\Bundle\GuzzleBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class GuzzleDataCollector extends DataCollector
{
    /**
     * @var RequestCollector
     */
    private $requestCollector;

    /**
     * @param RequestCollector $requestCollector
     */
    public function __construct(RequestCollector $requestCollector)
    {
        $this->requestCollector = $requestCollector;
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data['requests']      = [];
        $this->data['informational'] = 0;
        $this->data['success']       = 0;
        $this->data['redirection']   = 0;
        $this->data['client_error']  = 0;
        $this->data['server_error']  = 0;

        foreach ($this->requestCollector->getRequests() as $data) {
            $this->data['requests'][] = $data;

            switch (substr($data->getStatusCode(), 0, 1)) {
                case '1':
                    $this->data['informational']++;
                    break;
                case '2':
                    $this->data['success']++;
                    break;
                case '3':
                    $this->data['redirection']++;
                    break;
                case '4':
                    $this->data['client_error']++;
                    break;
                case '5':
                    $this->data['server_error']++;
                    break;
            }
        }
    }

    /**
     * @return array
     */
    public function getRequests()
    {
        return $this->data['requests'];
    }

    /**
     * @return int
     */
    public function getInformational()
    {
        return $this->data['informational'];
    }

    /**
     * @return int
     */
    public function getSuccess()
    {
        return $this->data['success'];
    }

    /**
     * @return int
     */
    public function getRedirection()
    {
        return $this->data['redirection'];
    }

    /**
     * @return int
     */
    public function getClientError()
    {
        return $this->data['client_error'];
    }

    /**
     * @return int
     */
    public function getServerError()
    {
        return $this->data['server_error'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'guzzle';
    }
    
    public function reset()
    {
        $this->data = [];
    }
}
