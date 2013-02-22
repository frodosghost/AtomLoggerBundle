Atom Logger Bundle
============

Installation
------------

1. Add this bundle to your project in composer.json:

    Symfony 2.1 uses composer (http://www.getcomposer.org) to organize dependencies:
    
    ```json
    {
        "require": {
            "atom/logger-bundle": "dev-master",
        }
    }
    ```

2. Add this bundle to your app/AppKernel.php:

    ``` php
    // application/ApplicationKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Atom\LoggerBundle\AtomLoggerBundle(),
            // ...
        );
    }
    ```

3. Configure your config.yml

    ``` yaml
    atom_logger:
        api_key: abc
        uri: http://atomlogger.com/api
    ```