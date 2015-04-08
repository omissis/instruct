Instruct
========

A PHP Event-Condition-Action system implementation.

[![Build Status](https://travis-ci.org/omissis/instruct.svg?branch=master)](https://travis-ci.org/omissis/instruct)
[![Code Coverage](https://scrutinizer-ci.com/g/omissis/instruct/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/omissis/instruct/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/omissis/instruct/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/omissis/instruct/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/552461d5971f784339000624/badge.svg?style=flat)](https://www.versioneye.com/user/projects/552461d5971f784339000624)

Introduction
------------

This library implements an ECA, a.k.a. Event Condition Action system.

The idea of this library spawns from an abstraction of the [Drupal's Rule module](https://www.drupal.org/project/rules),
from which it borrows several concepts and classes.

The author hopes the two libraries will eventually merge in a common codebase.

Running the tests
-----------------

Simply run `composer install --prefer-dist` for installing all the needed dependencies and then `bin/phpunit`.
