# CHANGELOG

## 3.0.2: Dockerised dev environment

* setup Github Actions
* changed tooling from scripts to Makefile
* installed phpstan as a dev depdendency
* installed swiss-knife as a dev depdendency
* installed rector as a dev depdendency
* upgraded PHP CS fixer to v2.19.3
* dockerized for local development

## 3.0.1: PHP 8 and phpspec 7 support

* added support for PHP 8
* added support for phpspec 7

## 3.0.0: PHP 7.2 requirement

Dropped support for PHP <7.2

Other upgrades:

* upgraded PHP CS Fixer (from 2.10 to 2.16)
* upgraded phpspec (from 4.3 to 6.1)

## 2.0.0-alpha1, 2.0.0-alpha2: PHP 7

* dropped support for PHP < 7

## 1.0.2: Updated dependencies

* added support for PHP 7

## 1.0.1: Stabilised versions

* updated phpspec to version 2.2.0 stable

## 1.0.0: Constraint extraction

* extracted Constraints to their own package

> **BC breaks**:
>
> * removed `Memio\Validator\Constraint` namespace, use `Memio\Linter` instead.

## 1.0.0-rc-1: Import

* imported validator from [memio/memio](http://github.com/memio/memio) v1.0.0-rc8
