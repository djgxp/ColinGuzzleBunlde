<?php

namespace Djgxp\Bundle\GuzzleBundle\DataCollector;

class RequestCollector
{
    /**
     * @var Request[]
     */
    private $requests = [];

    /**
     * @param Request $request
     */
    public function collect(Request $request)
    {
        $this->requests[] = $request;
    }

    /**
     * @return Request[]
     */
    public function getRequests()
    {
        return $this->requests;
    }
}
