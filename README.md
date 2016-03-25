# diagnostics-middleware [![Build Status](https://travis-ci.org/rstgroup/diagnostics-middleware.svg?branch=master)](https://travis-ci.org/rstgroup/diagnostics-middleware)

ZendDiagnostics PSR-7 middleware

## Usage

Create your middleware and add it to middleware stack:

```php
$runner = new ZendDiagnostics\Runner\Runner();
// add checks to your diagnostics runner

// Create response output factory
$factory = new RstGroup\DiagnosticsMiddleware\ResultResponseFactory\JsonResultResponseFactory();

// Create middleware
$middleware = new RstGroup\DiagnosticsMiddleware\DiagnosticsMiddleware();

// add to your middeware runner
$app = new MiddlewareRunner();
$app->add($middleware);
$app->run();
```

We provide factories (using [`container-interop`](https://github.com/container-interop/container-interop)) and config
provider, so implementation should be easy with[`zend-expressive`](https://github.com/zendframework/zend-expressive)
or other PSR-7 middleware framework.

## Installation

Add project name (`rstgroup/diagnostics-middleware`) to composer.json.