<?php

namespace OpenCompany\Integrations\Exa;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Exa\Tools\ExaAnswer;
use OpenCompany\Integrations\Exa\Tools\ExaFindSimilar;
use OpenCompany\Integrations\Exa\Tools\ExaGetContents;
use OpenCompany\Integrations\Exa\Tools\ExaGetCurrentUser;
use OpenCompany\Integrations\Exa\Tools\ExaSearch;
use OpenCompany\Integrations\Exa\Tools\ExaSearchAndContents;

/**
 * Tool provider for the Exa AI integration.
 *
 * Defines catalog metadata, credential setup, multi-account service resolution, and Exa tool classes.
 */
class ExaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'exa';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Exa AI',
            'description' => 'AI-powered web search, contents, and grounded answers.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:exa',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Exa AI',
            'description' => 'AI-powered web search, content extraction, similar links, and grounded answers.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:exa',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.exa.ai/reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'required' => false,
                'default' => 'https://api.exa.ai',
            ],
        ];
    }

    /**
     * Verify Exa credentials with a lightweight user request.
     *
     * @param  array<string, mixed>  $config  Credential form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.exa.ai', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'API Key is required.'];
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Exa API returned HTTP {$response->status()}. Check your API key.",
                ];
            }

            $json = $response->json();
            $email = is_array($json) ? ($json['email'] ?? 'unknown') : 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Exa as {$email}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'url' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'exa_search' => [
                'class' => ExaSearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search the web with Exa using fast, deep, or classic search types.',
                'icon' => 'ph:magnifying-glass',
            ],
            'exa_search_and_contents' => [
                'class' => ExaSearchAndContents::class,
                'type' => 'read',
                'name' => 'Search And Contents',
                'description' => 'Search the web and return page contents in one call using the current nested contents payload.',
                'icon' => 'ph:article',
            ],
            'exa_answer' => [
                'class' => ExaAnswer::class,
                'type' => 'read',
                'name' => 'Answer',
                'description' => 'Generate a grounded answer with citations from Exa search results.',
                'icon' => 'ph:chat-circle-text',
            ],
            'exa_find_similar' => [
                'class' => ExaFindSimilar::class,
                'type' => 'read',
                'name' => 'Find Similar',
                'description' => 'Find pages similar to a URL.',
                'icon' => 'ph:link-simple',
            ],
            'exa_get_contents' => [
                'class' => ExaGetContents::class,
                'type' => 'read',
                'name' => 'Get Contents',
                'description' => 'Retrieve clean page contents, highlights, summaries, and metadata for URLs or IDs.',
                'icon' => 'ph:file-text',
            ],
            'exa_get_current_user' => [
                'class' => ExaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Exa user profile and usage details.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/exa.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ExaService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Runtime context.
     */
    private function resolveService(array $context = []): ExaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ExaService(
                apiKey: $creds->get('exa', 'api_key', '', $account),
                baseUrl: $creds->get('exa', 'url', 'https://api.exa.ai', $account),
            );
        }

        return app(ExaService::class);
    }
}
