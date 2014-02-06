YamlConfigProvider
==================

Silex Provider to parse YAML configuration file and cache it if possible


This Provider is inspired by https://github.com/deralex/YamlConfigServiceProvider
The difference is that the config is lazy loaded and that I'm caching the configuration to avoid to parse it at every page load.

# Installation

Using your composer.json:

``

# Provider registration

# Exemple using cache
