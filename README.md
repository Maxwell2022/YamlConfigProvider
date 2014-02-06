YamlConfigProvider
==================

Silex Provider to parse YAML configuration file and cache it if possible

[![Latest Stable Version](https://poser.pugx.org/maxwell2022/yamlconfigprovider/v/stable.png)](https://packagist.org/packages/maxwell2022/yamlconfigprovider)

[![Total Downloads](https://poser.pugx.org/maxwell2022/yamlconfigprovider/downloads.png)](https://packagist.org/packages/maxwell2022/yamlconfigprovider)


This Provider is inspired by https://github.com/deralex/YamlConfigServiceProvider
The difference is that the config is lazy loaded and that I'm caching the configuration to avoid to parse it at every page load.

# Installation

Using your composer.json:

```json
{
    "maxwell2022/yamlconfigprovider": "dev-master"
}
```

# Provider registration

```php
$app->register(new Zumny\Core\Silex\Provider\YamlConfigServiceProvider(), array(
    'config.file' => __DIR__.'/Config/config.yml'
));
```

# Exemple using cache

```php
$app['cache.path'] = __DIR__.'/../cache';

$app->register(new \CHH\Silex\CacheServiceProvider, array(
    'cache.options' => array(
        'default' => array('driver' => 'apc'),
        'file' => array(
            'driver' => 'filesystem',
            'directory' => $app['cache.path']
        )
    )
));

$app->register(new Zumny\Core\Silex\Provider\YamlConfigServiceProvider(), array(
    'config.file' => __DIR__.'/Config/config.yml',
    'config.cache' => $app['cache']
));
```

