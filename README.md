[![Latest Stable Version](https://img.shields.io/packagist/v/sebastian/partition-phpunit-suite.svg?style=flat-square)](https://packagist.org/packages/sebastian/partition-phpunit-suite)
[![Build Status](https://img.shields.io/travis/sebastianbergmann/partition-phpunit-suite/master.svg?style=flat-square)](https://travis-ci.org/sebastianbergmann/partition-phpunit-suite)

# partition-phpunit-suite

`partition-phpunit-suite` is a tool for creating build scripts for executing PHPUnit test suites in parallel.

## Installation

### PHP Archive (PHAR)

The easiest way to obtain `partition-phpunit-suite` is to download a [PHP Archive (PHAR)](http://php.net/phar) that has all required dependencies of `partition-phpunit-suite` bundled in a single file:

    $ wget https://phar.phpunit.de/partition-phpunit-suite.phar
    $ chmod +x partition-phpunit-suite.phar
    $ mv partition-phpunit-suite.phar /usr/local/bin/partition-phpunit-suite

You can also immediately use the PHAR after you have downloaded it, of course:

    $ wget https://phar.phpunit.de/partition-phpunit-suite.phar
    $ php partition-phpunit-suite.phar

### Composer

You can add this tool as a local, per-project, development-time dependency to your project using [Composer](https://getcomposer.org/):

    $ composer require --dev sebastian/partition-phpunit-suite

You can then invoke it using the `vendor/bin/partition-phpunit-suite` executable.

## Usage

### Write list of tests and test groups to temporary files

    $ phpunit --list-tests-raw > /tmp/tests.txt
    $ phpunit --list-groups-raw > /tmp/groups.txt

### Generate build script

#### `build.xml` (for use with Apache Ant)

    $ partition-phpunit-suite --build-xml=build.xml /tmp/tests.txt /tmp/groups.txt

#### `Makefile` (for use with GNU make)

    $ partition-phpunit-suite --makefile=Makefile /tmp/tests.txt /tmp/groups.txt
