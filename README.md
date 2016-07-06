# ColinGuzzleBunlde

Log Guzzle in Symfony profiler

## Installation

```composer required maximecolin/guzzle-bundle```

## Usage

```
services:
    your_guzzle_services_id:
        class: GuzzleHttp\Client
        tags:
            - { name: guzzle.client }
```
