# diagnostics-middleware [![Build Status](https://travis-ci.org/rstgroup/diagnostics-middleware.svg?branch=master)](https://travis-ci.org/rstgroup/diagnostics-middleware)
ZendDiagnostics PSR-7 middleware

# Usage

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