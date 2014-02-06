YamlConfigProvider
==================

Silex Provider to parse YAML configuration file and cache it if cache is registered

[![Latest Stable Version](https://poser.pugx.org/maxwell2022/yamlconfigprovider/v/stable.png)](https://packagist.org/packages/maxwell2022/yamlconfigprovider) [![Total Downloads](https://poser.pugx.org/maxwell2022/yamlconfigprovider/downloads.png)](https://packagist.org/packages/maxwell2022/yamlconfigprovider)


This Provider is inspired by [deralex](https://github.com/deralex/YamlConfigServiceProvider)

The difference is that the configuration is:
- Lazy loaded
- Cached to avoid to parse it at every page load (if cache is registered)

# Installation

Using your composer.json:

```json
{
    "maxwell2022/yamlconfigprovider": "dev-master"
}
```

```shell
$ ./composer.phar update
```

# Provider registration

```php
$app->register(new \Maxwell2022\Silex\Provider\YamlConfigProvider(), array(
    'config.file' => __DIR__.'/config/config.yml'
));
```

# Example using cache

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

$app->register(new \Maxwell2022\Silex\Provider\YamlConfigProvider(), array(
    'config.file' => __DIR__.'/Config/config.yml',
    'config.cache' => $app['cache']
));
```

