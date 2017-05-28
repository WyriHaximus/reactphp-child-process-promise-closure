# ReactPHP Child Process Promise Closure child class

[![Linux Build Status](https://travis-ci.org/WyriHaximus/reactphp-child-process-promise-closure.png)](https://travis-ci.org/WyriHaximus/reactphp-child-process-promise-closure)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/react-child-process-promise-closure/v/stable.png)](https://packagist.org/packages/WyriHaximus/react-child-process-promise-closure)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/react-child-process-promise-closure/downloads.png)](https://packagist.org/packages/WyriHaximus/react-child-process-promise-closure)
[![Code Coverage](https://scrutinizer-ci.com/g/WyriHaximus/reactphp-child-process-promise-closure/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/WyriHaximus/reactphp-child-process-promise-closure/?branch=master)
[![License](https://poser.pugx.org/WyriHaximus/react-child-process-promise-closure/license.png)](https://packagist.org/packages/wyrihaximus/react-child-process-promise-closure)
[![PHP 7 ready](http://php7ready.timesplinter.ch/WyriHaximus/reactphp-child-process-promise-closure/badge.svg)](https://travis-ci.org/WyriHaximus/reactphp-child-process-promise-closure)

Runs  a closure in a child process and return the result over a promise

### Installation ###

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `~`.

```
composer require wyrihaximus/react-child-process-promise-closure 
```

## Usage ##

Usage is simple, just pass the function the event loop and a closure that returns an array as result or throws a `Throwable` on errors and it will run in a freshly spawned child process.

```php
use function WyriHaximus\React\childProcessPromiseClosure;

childProcessPromiseClosure($loop, function () {
    return ['message' => 'The closure MUST always return an array'];
})->done(function ($time) {
    echo $time['message'], PHP_EOL;
});

```

## Examples ##

For examples see the [examples](https://github.com/WyriHaximus/reactphp-child-process-promise-closure/tree/master/examples) directory

## Contributing ##

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License ##

Copyright 2017 [Cees-Jan Kiewiet](http://wyrihaximus.net/)

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
