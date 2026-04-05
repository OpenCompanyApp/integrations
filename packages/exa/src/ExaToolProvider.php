<?php

namespace OpenCompany\Integrations\Exa;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Exa\Tools\ExaSearch;
use OpenCompany\Integrations\Exa\Tools\ExaFindSimilar;
use OpenCompany\Integrations\Exa\Tools\ExaGetContents;
use OpenCompany\Integrations\Exa\Tools\ExaSearchAndContents;
use OpenCompany\Integrations\Exa\Tools\ExaGetCurrentUser;

/**
 * Tool provider for the Exa AI search integration.
 *
 * Declares 5 tools (search, findSimilar, getContents, searchAndContents,
 * getCurrentUser) and supports multi-account credential resolution through
 * the shared resolveService() method.
 */
class ExaToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'exa';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'search, find similar, get contents',
            'description' => 'AI-powered web search',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:exa',
        ];
    }

    // ── ConfigurableIntegration ───────────────────────────

    public function integrationMeta(): array
    {
        return [
            'name' => 'Exa AI',
            'description' => 'AI-powered neural web search and content retrieval',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:exa',
            'category' => 'search',
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
                'placeholder' => 'Enter your Exa API key',
                'hint' => 'Generate an API key at <a href="https://dashboard.exa.ai/api-keys" target="_blank">dashboard.exa.ai</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.exa.ai',
                'hint' => 'Override only if using a proxy or custom endpoint',
                'default' => 'https://api.exa.ai',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.exa.ai', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            if ($response->successful()) {
                $data = $response->json();
                $email = $data['email'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Exa API as {$email}.",
                ];
            }

            $error = $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Exa API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    // ── Tools ─────────────────────────────────────────────

    public function tools(): array
    {
        return [
            'exa_search' => [
                'class' => ExaSearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Perform a neural search query across the web.',
                'icon' => 'ph:magnifying-glass',
            ],
            'exa_find_similar' => [
                'class' => ExaFindSimilar::class,
                'type' => 'read',
                'name' => 'Find Similar',
                'description' => 'Find pages similar to a given URL.',
                'icon' => 'ph:link',
            ],
            'exa_get_contents' => [
                'class' => ExaGetContents::class,
                'type' => 'read',
                'name' => 'Get Contents',
                'description' => 'Retrieve contents for a list of Exa document IDs.',
                'icon' => 'ph:file-text',
            ],
            'exa_search_and_contents' => [
                'class' => ExaSearchAndContents::class,
                'type' => 'read',
                'name' => 'Search and Contents',
                'description' => 'Search the web and retrieve full page contents in one call.',
                'icon' => 'ph:magnifying-glass-plus',
            ],
            'exa_get_current_user' => [
                'class' => ExaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile and usage info.',
                'icon' => 'ph:user',
            ],
        ];
    }

    // ── Shared ────────────────────────────────────────────

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/exa.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.exa.ai'],
        ];
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate
     * @param  array<string, mixed>  $context  Runtime context (may contain 'account' key)
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ExaService, with optional account-specific credentials.
     *
     * When $context['account'] is set, creates a fresh service with that
     * account's credentials. Otherwise falls back to the container singleton.
     *
     * @param  array<string, mixed>  $context  Runtime context
     */
    private function resolveService(array $context = []): ExaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ExaService(
                apiKey: $creds->get('exa', 'api_key', '', $account),
                baseUrl: $creds->get('exa', 'url', 'https://api.exa.ai', $account),
            );
        }

        return app(ExaService::class);
    }
}
