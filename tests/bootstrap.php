<?php

declare(strict_types=1);

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Facade;
use Psr\Log\NullLogger;

spl_autoload_register(static function (string $class): void {
    $prefixes = [
        'OpenCompany\\IntegrationCore\\' => __DIR__.'/../core/src/',
        'OpenCompany\\Integrations\\ClickUp\\' => __DIR__.'/../packages/clickup/src/',
        'OpenCompany\\Integrations\\GoogleAds\\' => __DIR__.'/../packages/google-ads/src/',
        'OpenCompany\\Integrations\\GoogleDataManager\\' => __DIR__.'/../packages/google-data-manager/src/',
        'OpenCompany\\Integrations\\Instantly\\' => __DIR__.'/../packages/instantly/src/',
        'OpenCompany\\Integrations\\Mailgun\\' => __DIR__.'/../packages/mailgun/src/',
        'OpenCompany\\Integrations\\Plane\\' => __DIR__.'/../packages/plane/src/',
        'OpenCompany\\Integrations\\Todoist\\' => __DIR__.'/../packages/todoist/src/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        if (! str_starts_with($class, $prefix)) {
            continue;
        }

        $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
        $path = $baseDir.$relative.'.php';

        if (is_file($path)) {
            require_once $path;
        }
    }
});

$app = new Container;
Container::setInstance($app);
$app->instance('app', $app);
$app->instance('http', new HttpFactory);
$app->instance('log', new NullLogger);
Facade::setFacadeApplication($app);
