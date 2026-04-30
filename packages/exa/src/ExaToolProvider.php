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

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
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
            'description' => 'AI-powered web search',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:exa',
        ];
    }

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
        return $this->credentialFields();
    }

    /**
     * Validate that required credentials were supplied for this integration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        foreach ($this->credentialFields() as $field) {
            if (($field['required'] ?? true) && empty($config[$field['key']])) {
                return [
                    'success' => false,
                    'error' => ($field['label'] ?? $field['key']) . ' is required.',
                ];
            }
        }

        return [
            'success' => true,
            'message' => 'Required credentials are configured. API access will be verified when tools run.',
        ];
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
                'name' => 'Exa Search',
                'description' => 'Perform a neural search query across the web using Exa AI. Returns a list of relevant pages with titles, URLs, and scores. Supports filtering by category, date range, and autoprompt mode.',
                'icon' => 'ph:wrench',
            ],
            'exa_find_similar' => [
                'class' => ExaFindSimilar::class,
                'type' => 'read',
                'name' => 'Exa Find Similar',
                'description' => 'Find web pages similar to a given URL. Useful for discovering related content, competitors, or alternative resources. Returns a list of similar pages with titles, URLs, and scores.',
                'icon' => 'ph:wrench',
            ],
            'exa_get_contents' => [
                'class' => ExaGetContents::class,
                'type' => 'read',
                'name' => 'Exa Get Contents',
                'description' => 'Retrieve the full text contents and optional highlights for a list of Exa document IDs. Use this after a search or findSimilar call to get the actual page content.',
                'icon' => 'ph:wrench',
            ],
            'exa_search_and_contents' => [
                'class' => ExaSearchAndContents::class,
                'type' => 'read',
                'name' => 'Exa Search And Contents',
                'description' => 'Search the web and retrieve full page contents in one call. Combines search and content retrieval into a single request for efficiency. Returns results with both metadata and full text content.',
                'icon' => 'ph:wrench',
            ],
            'exa_get_current_user' => [
                'class' => ExaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Exa Get Current User',
                'description' => 'Get the currently authenticated Exa user\'s profile information, including email and API usage details. Useful for verifying credentials.',
                'icon' => 'ph:wrench',
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
    {        return new $class($this->resolveService($context));
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
