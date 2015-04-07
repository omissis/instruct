Instruct
========

A PHP Event-Condition-Action system implementation.

Introduction
------------

This library implements an ECA, a.k.a. Event Condition Action system.

The idea of this library spawns from an abstraction of the [Drupal's Rule module](https://www.drupal.org/project/rules),
from which it borrows several concepts and classes.

The author hopes the two libraries will eventually merge in a common codebase.

Running the tests
-----------------

Simply run `composer install --prefer-dist` for installing all the needed dependencies and then `bin/phpunit`.
