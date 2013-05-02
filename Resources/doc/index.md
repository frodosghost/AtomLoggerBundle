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

Configuration
------------

1. Configure your config.yml

    ``` yaml
    atom_logger:
        user:
            public_key:  %atom_public%
            private_key: %atom_private%
        uri:     http://atomlogger.com/api/new.xml
    ```
1.1. Then you can add the public and private keys provided by the AtomLogger Dashboard into your parameters file.

    ``` yaml
    atom_public:        "817F...CF"
    atom_private:       "Sy03h..7d"
    ```

2. Then setup the Logger into the config_prod.yml

    ``` yaml
    services:
        atom.logger.logerror:
            class:     %atom.logger.handler.logerror.class%
            arguments: [ @atom.logger, "aa...d", 500, false ]
            tags:
                 - { name: monolog.logger, channel: error_log }

    monolog:
        handlers:
            main:
                type:         fingers_crossed
                action_level: error
                handler:      grouped
            grouped:
                type:    group
                members: [streamed, buffered]
            streamed:
                type:  stream
                path:  "%kernel.logs_dir%/%kernel.environment%.log"
                level: debug
            buffered:
                type:    buffer
                handler: manhattan
            manhattan:
                type:  service
                level: error
                id:    atom.logger.logerror
    ```
