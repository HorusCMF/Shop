Horus CMF [![Build status...](https://secure.travis-ci.org/Horus CMF/Horus CMF.png?branch=master)](http://travis-ci.org/Horus CMF/Horus CMF) [![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/Horus CMF/Horus CMF/badges/quality-score.png?s=f6d89b8aad6e15cab61134e7c0544ee1313f7f31)](https://scrutinizer-ci.com/g/Horus CMF/Horus CMF/)
======

Horus CMF is an open source e-commerce solution for **Developers**, based on the [**Symfony2**](http://symfony.com) framework.

Ultimate goal of the project is to create a minimalist webshop engine, which is user-friendly, *loved* by developers and has a helpful community.

Horus CMF is constructed from fully decoupled components (bundles in Symfony2 glossary), which means that every feature (products catalog, shipping engine, promotions system...) can be used in any other application. 

We're using full-stack Symfony, with MongoDB, Node IO, Elastic Search and Codeception.

Documentation
-------------

Documentation is available at [docs.Horus CMF.org](http://docs.Horus CMF.org).

Quick Installation
------------------

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar create-project Horus CMF/Horus CMF -s dev
$ cd Horus CMF
$ php app/console Horus CMF:install
```

[Behat](http://behat.org) scenarios
-----------------------------------

You need to copy Behat default configuration file and enter your specific ``base_url``
option there.

```bash
$ cp behat.yml.dist behat.yml
$ vi behat.yml
```

Then download [Selenium Server](http://seleniumhq.org/download/), and run it.

```bash
$ java -jar selenium-server-standalone-2.11.0.jar
```

You can run Behat using the following command.

``` bash
$ bin/behat
```

Troubleshooting
---------------

If something goes wrong, errors & exceptions are logged at the application level.

````
tail -f app/logs/prod.log
tail -f app/logs/dev.log
````

Contributing
------------

All informations about contributing to Horus CMF can be found on [this page](http://docs.Horus CMF.org/en/latest/contributing/index.html).

Horus CMF on twitter
-----------------

If you want to keep up with the updates, [follow the official Horus CMF account on twitter](http://twitter.com/Horus CMF).

Bug tracking
------------

Horus CMF uses [GitHub issues](https://github.com/Horus CMF/Horus CMF/issues).
If you have found bug, please create an issue.

MIT License
-----------

License can be found [here](https://github.com/Horus CMF/Horus CMF/blob/master/LICENSE).

Authors
-------

Horus CMF was originally created by [Symfomany]
See the list of [contributors](https://github.com/Horus CMF/Horus CMF/contributors).