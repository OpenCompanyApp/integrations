<?php

namespace OpenCompany\Integrations\NewsApi;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\NewsApi\Tools\NewsApiEverything;
use OpenCompany\Integrations\NewsApi\Tools\NewsApiSources;
use OpenCompany\Integrations\NewsApi\Tools\NewsApiTopHeadlines;

/**
 * Tool catalog and configuration metadata for NewsAPI.
 *
 * Exposes the documented v2 article search, top-headlines, and source
 * discovery endpoints.
 */
class NewsApiToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['NewsAPI requires an API key sent via the X-Api-Key header.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'newsapi';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'NewsAPI',
            'description' => 'Search news articles, retrieve top headlines, and discover sources',
            'icon' => 'ph:newspaper',
            'logo' => 'ph:newspaper',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'NewsAPI',
            'description' => 'NewsAPI v2 for searching articles, retrieving live top headlines, and discovering publishers available for top headlines.',
            'icon' => 'ph:newspaper',
            'logo' => 'ph:newspaper',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://newsapi.org/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'NewsAPI key', 'hint' => 'Required for all NewsAPI v2 endpoints.', 'required' => true],
        ];
    }

    /**
     * Verify NewsAPI credentials with a lightweight sources request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'NewsAPI API key is required.'];
            }

            $response = Http::acceptJson()
                ->withHeaders(['X-Api-Key' => $apiKey])
                ->timeout(20)
                ->get('https://newsapi.org/v2/top-headlines/sources', ['language' => 'en']);

            return $response->successful()
                ? ['success' => true, 'message' => 'NewsAPI API key accepted.']
                : ['success' => false, 'error' => 'NewsAPI returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'NewsAPI key', 'hint' => 'Required for all NewsAPI v2 endpoints.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'newsapi_everything' => ['class' => NewsApiEverything::class, 'type' => 'read', 'name' => 'Everything', 'description' => 'Search across indexed news articles.', 'icon' => 'ph:magnifying-glass'],
            'newsapi_top_headlines' => ['class' => NewsApiTopHeadlines::class, 'type' => 'read', 'name' => 'Top Headlines', 'description' => 'Retrieve live top and breaking headlines.', 'icon' => 'ph:newspaper-clipping'],
            'newsapi_sources' => ['class' => NewsApiSources::class, 'type' => 'read', 'name' => 'Sources', 'description' => 'List news sources available for top headlines.', 'icon' => 'ph:broadcast'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a NewsAPI tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): NewsApiService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new NewsApiService(apiKey: $creds->get('newsapi', 'api_key', '', $account));
        }

        return app(NewsApiService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/newsapi.md';
    }
}
