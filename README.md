# Chimera - foundation

[![Total Downloads](https://img.shields.io/packagist/dt/chimera/foundation.svg?style=flat-square)](https://packagist.org/packages/chimera/foundation)
[![Latest Stable Version](https://img.shields.io/packagist/v/chimera/foundation.svg?style=flat-square)](https://packagist.org/packages/chimera/foundation)
[![Unstable Version](https://img.shields.io/packagist/vpre/chimera/foundation.svg?style=flat-square)](https://packagist.org/packages/chimera/foundation)

![Branch master](https://img.shields.io/badge/branch-master-brightgreen.svg?style=flat-square)
[![Build Status](https://img.shields.io/travis/chimeraphp/foundation/master.svg?style=flat-square)](http://travis-ci.org/#!/chimeraphp/foundation)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/chimeraphp/foundation/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/chimeraphp/foundation/?branch=master)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/chimeraphp/foundation/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/chimeraphp/foundation/?branch=master)

> The term Chimera (_/kɪˈmɪərə/_ or _/kaɪˈmɪərə/_) has come to describe any
mythical or fictional animal with parts taken from various animals, or to 
describe anything composed of very disparate parts, or perceived as wildly
imaginative, implausible, or dazzling.

There are many many amazing libraries in the PHP community and with the creation
and adoption of the PSRs we don't necessarily need to rely on full stack
frameworks to create a complex and well designed software. Choosing which
components to use and plugging them together can sometimes be a little
challenging.

The goal of this set of packages is to make it easier to do that (without
compromising the quality), allowing you to focus on the behaviour of your
software.

This particular package provides **abstractions** and **default components**
to standardise some basic concepts, creating a foundation to connect different
libraries together without creating a huge monster.

## Installation

You probably won't depend directly on this package, but it is available on [Packagist](http://packagist.org/packages/chimera/foundation),
and can be installed using [Composer](http://getcomposer.org):

```shell
$ composer require chimera/foundation
```

### PHP Configuration

In order to make sure that we're dealing with the correct data, we're using `assert()`,
which is a very interesting feature in PHP but not often used. The nice thing
about `assert()` is that we can (and should) disable it in production mode so
that we don't have useless statements.

So, for production mode, we recommend you to set `zend.assertions` to `-1` in your `php.ini`.
For development you should leave `zend.assertions` as `1` and set `assert.exception` to `1`, which
will make PHP throw an [`AssertionError`](https://secure.php.net/manual/en/class.assertionerror.php)
when things go wrong.

Check the documentation for more information: https://secure.php.net/manual/en/function.assert.php

## Related packages

* [`chimera/bus-tactician`](https://github.com/chimeraphp/bus-tactician): Adapter
for the amazing [`league/tactician`](https://github.com/thephpleague/tactician)
* [`chimera/routing`](https://github.com/chimeraphp/routing): Abstractions and
reusable request handlers (controllers) to handle HTTP requests
* [`chimera/routing-expressive`](https://github.com/chimeraphp/routing-expressive): Adapter
for the great [`zendframework/zend-expressive`](https://github.com/zendframework/zend-expressive)
* [`chimera/serialization-jms`](https://github.com/chimeraphp/serialization-jms): Adapter
for the really flexible [`jms/serializer`](https://github.com/schmittjoh/serializer)
* [`chimera/di-symfony`](https://github.com/chimeraphp/di-symfony): A set of
compiler passes that plugs everything together while compiling the container, so that
no unnecessary process is executed when the software is handling user requests
* [`chimera/sample`](https://github.com/chimeraphp/sample): A very basic
application showing how to use this set of libraries

## License

MIT, see [LICENSE file](https://github.com/chimeraphp/foundation/blob/master/LICENSE).
