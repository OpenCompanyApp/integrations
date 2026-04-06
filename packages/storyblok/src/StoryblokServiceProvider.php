<?php

namespace OpenCompany\Integrations\Storyblok;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class StoryblokServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(StoryblokService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new StoryblokService(
                accessToken: $creds->get('storyblok', 'access_token', ''),
                spaceId: $creds->get('storyblok', 'space_id', ''),
                baseUrl: $creds->get('storyblok', 'url', 'https://api.storyblok.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new StoryblokToolProvider());
        }
    }
}
