<?php

namespace OpenCompany\Integrations\Segment;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SegmentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SegmentService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SegmentService(
                writeKey: $creds->get('segment', 'write_key', ''),
                apiToken: $creds->get('segment', 'api_token', ''),
                baseUrl: $creds->get('segment', 'url', 'https://api.segment.io/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SegmentToolProvider());
        }
    }
}
