<?php

namespace Maxwell2022\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

class YamlConfigProvider implements ServiceProviderInterface
{
    /**
     * Create a config key in the app storing the configuration in an array
     *
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['config'] = $app->share(function($app){

            // Check the cache
            if (isset($app['caches']['file'])) {
                $config = $app['caches']['file']->fetch(md5($app['config.file']));
                if (false !== $config) {
                    return $config;
                }
            }

            $config = array();
            $this->parseRecursively($app['config.file'], $config);

            if (isset($app['caches']['file'])) {
                $app['caches']['file']->save(md5($app['config.file']), $config);
            }

            return $config;
        });
    }

    /**
     * Parse a YAML file recursively importing all resources
     *
     * @param $file
     * @param $data
     */
    protected function parseRecursively($file, &$data)
    {
        $tmp = Yaml::parse(file_get_contents($file));
        foreach ($tmp as $key => $value) {
            if ($key == 'imports') {
                foreach ($value as $resource) {
                    $base_dir = str_replace(basename($file), '', $file);
                    $this->parseRecursively($base_dir . $resource['resource'], $data);
                }

                unset($tmp['imports']);
                continue;
            }

            if (isset($data) && is_array($data)) {
                $data = array_replace_recursive($data, $tmp);
            } else {
                $data = $tmp;
            }
        }
    }

    public function boot(Application $app)
    {
    }
}
