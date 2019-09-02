# DjgxpGuzzleBundle

Log Guzzle in Symfony profiler

## Installation

```composer require djgxp/guzzle-bundle```

## Compatibility

Works with [Guzzle 6](https://github.com/guzzle/guzzle)

## Usage

```yaml
services:
    your_guzzle_services_id:
        class: GuzzleHttp\Client
        tags:
            - { name: guzzle.client }
```
