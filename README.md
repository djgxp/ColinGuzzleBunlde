# DjgxpGuzzleBundle

Log Guzzle in Symfony profiler

## Installation
1. Add this repository to your composer.json:
```
 "repositories": [
        ...
        { "type": "git", "url": "https://github.com/djgxp/DjgxpGuzzleBundle.git" },
 ]
```
2. Add the bundle to your composer.json:

```composer require djgxp/guzzle-bundle dev-master@dev```

2. Enable the bundle for all Symfony environments:
```
// bundles.php
return [
    //...
    Djgxp\Bundle\GuzzleBundle\DjgxpGuzzleBundle::class => ['all' => true],
];
```
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
