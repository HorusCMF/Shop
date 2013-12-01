Horus CMF Shop
======
[![Build Status](https://travis-ci.org/HorusCMF/Shop.png?branch=master)](https://travis-ci.org/HorusCMF/Shop)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/HorusCMF/Shop/badges/quality-score.png?s=69e973febd5f8f132b22fcd129f70e0ae790fd7d)](https://scrutinizer-ci.com/g/HorusCMF/Shop/)


Horus CMF is an open source e-commerce solution for **Developers**, based on the [**Symfony2**](http://symfony.com) framework.

Ultimate goal of the project is to create a Minimalist & Collaborative Webshop engine, which is user-friendly, *loved* by developers and has a helpful community.

Horus with Symfony2 offers all the flexibility of custom development for E-Commerce and can be used to design an application that perfectly meets the expressed needs. It, however, requires development, integration and maintenance related technical expertise.

Using full-stack Symfony Framework 2.3.7, with MongoDB, Node IO/Stream, Elastic Search and Codeception.

Technologies: Symfony2, Assetic, Doctrine 2, Node, SASS & COMPASS, MVC, Bootsrap Twitter, PHPUnit, Behat, Twig, YAML, Codeception, PAyline/PAyzen, Coffescript,  Mongo,

Philosophy: **Minimalist** features, **Collaborative** in real time, **Maintainable**, **Pragmatic** and **Responsive** Solution.


Screenshots
------------------

![ScreenShot](https://raw.github.com/HorusCMF/Shop/master/screenshots/MainScreen.png)
![ScreenShot](https://raw.github.com/HorusCMF/Shop/master/screenshots/Screen2.png)
![ScreenShot](https://raw.github.com/HorusCMF/Shop/master/screenshots/Screen3.png)
![ScreenShot](https://raw.github.com/HorusCMF/Shop/master/screenshots/Screen4.png)
![ScreenShot](https://raw.github.com/HorusCMF/Shop/master/screenshots/Screen5.png)
![ScreenShot](https://raw.github.com/HorusCMF/Shop/master/screenshots/Screen6.png)

Documentation
-------------

Documentation is available at [docs.Horus CMF.org](http://docs.Horus CMF.org).


Quick Installation
------------------

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar create-project HorusCMF/Shop -s dev
$ cd HorusCMF
$ php app/console HorusCMF:install
```

Requirements
---------------

* Mongo DB
* Elastic Search
* Node JS
* Composer
* Symfony 2


Installation
------------

### Add the deps for the needed bundles

``` php
[HorusSiteBundle]
    git=https://github.com/HorusCMF/Shop.git
    target=/bundles/horussite/

```
Or add HorusSiteBundle in your composer.json

```js
{
    "require": {
        "HorusCMF/Shop": "*"
    }
}
```
If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

```bash
    curl -s https://getcomposer.org/installer | php
```

Next, run the vendors script to download the bundles:

``` bash
$ php bin/vendors install
```

### Add to autoload.php

``` php
$loader->registerNamespaces(array(
    'Horus'             => __DIR__.'/../vendor/bundles',
    // ...
```
### Register HorusSiteBundle to Kernel

``` php
<?php

    # app/AppKernel.php
    //...
    $bundles = array(
        //...
        new Horus\SiteBundle\HorusSiteBundle(),
    );
    //...
```

### Create database and schema

``` bash
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:create
```

### Enable routing configuration

``` yaml
# app/config/routing.yml
horus:
    resource: "@HorusSiteBundle/Resources/config/routing.yml"
```
### Refresh asset folder

``` bash
$ php app/console assets:install web/
```

### Data fixtures (optional)

First, make sure that your db parameters are correctly set in `app/config/parameters.ini`.
You'll need to install ``Doctrine Data Fixtures`` (don't forget to add the
path to `AppKernel.php`) and then run:

``` bash
$ php app/console doctrine:fixtures:load

You can read about install instructions in the Symfony2 Cookbook(http://symfony.com/doc/2.0/cookbook/doctrine/doctrine_fixtures.html#setup-and-configuration)
```


## Why Horus CMF

- 100% Responsive Backend
- Based on Powerfully Symfony 2
- MVC Structure
- ORM Database with Doctrine 2
- ODM NoSQL with Mongo
- Elastic search to the Cloud Big Datas
- Real-Time App with Node
- Flexible views with Twig Template Engine
- Acceptance, Unit & Fct Tests with Codeception
- Form Classes in services
- Routing & Configuration & Translation in YAML
- Sass & Compass & Coffee with Assetic
- Security with Roles & Permissions & Switch to Roles access
- E-R Model System with Entities-Repository
- Datas fixtures for tests
- Documentation API with Responsive PHPDocumentor 2
- Crud action for all Modules


Troubleshooting
---------------

If something goes wrong, errors & exceptions are logged at the application level.

````
tail -f app/logs/prod.log
tail -f app/logs/dev.log
````

Contributing
------------

All informations about contributing to Horus CMF can be found on [this page](https://github.com/HorusCMF/Shop/graphs/contributors).


Horus CMF on twitter
-----------------

If you want to keep up with the updates, [follow the official Horus CMF account on twitter](https://twitter.com/HorusCMF).

Bug tracking
------------

Horus CMF uses [GitHub issues](https://github.com/HorusCMF/Shop/issues).
If you have found bug, please create an issue.

Travis CI
------------
Follow all changes & testing [here](https://travis-ci.org/HorusCMF/Shop).
For coverage: phpunit -c app  --coverage-text


MIT License
-----------

License can be found [here](https://github.com/HorusCMF/Shop/blob/master/LICENSE).

Authors
-------

Horus CMF was originally created by [Symfomany]
See the list of [contributors](https://github.com/HorusCMF/Shop/graphs/contributors).