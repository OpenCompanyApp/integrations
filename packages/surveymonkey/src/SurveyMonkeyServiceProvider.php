<?php

namespace OpenCompany\Integrations\SurveyMonkey;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SurveyMonkeyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SurveyMonkeyService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SurveyMonkeyService(
                accessToken: $creds->get('surveymonkey', 'access_token', ''),
                baseUrl: $creds->get('surveymonkey', 'url', 'https://api.surveymonkey.com/v3'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SurveyMonkeyToolProvider());
        }
    }
}
