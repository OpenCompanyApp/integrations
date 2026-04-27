<?php

namespace OpenCompany\Integrations\Splunk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Splunk\Tools\SplunkSearch;
use OpenCompany\Integrations\Splunk\Tools\SplunkGetSearchResults;
use OpenCompany\Integrations\Splunk\Tools\SplunkListIndexes;
use OpenCompany\Integrations\Splunk\Tools\SplunkListSavedSearches;
use OpenCompany\Integrations\Splunk\Tools\SplunkGetIndex;
use OpenCompany\Integrations\Splunk\Tools\SplunkGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SplunkToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'splunk';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'search, indexes, logs, saved searches',
            'description' => 'Log analytics and monitoring',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:splunk',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Splunk',
            'description' => 'Log analytics, search, and monitoring platform',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:splunk',
            'category' => 'monitoring',
            'badge' => 'verified',
            'docs_url' => 'https://docs.splunk.com/Documentation/Splunk/latest/RESTREF/RESTprolog',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Splunk Bearer token',
                'hint' => 'Generate a token in Splunk under Settings > Tokens, or use the REST API authentication endpoint',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Splunk Instance URL',
                'placeholder' => 'https://your-instance.splunkcloud.com:8089/services',
                'hint' => 'The base URL of your Splunk REST API. For Splunk Cloud: <code>https://your-instance.splunkcloud.com:8089/services</code>. For self-hosted: <code>https://your-server:8089/services</code>',
                'default' => 'https://localhost:8089/services',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://localhost:8089/services', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->timeout(10)->withOptions([
                'verify' => false,
            ])->get($baseUrl . '/authentication/current-context', [
                'output_mode' => 'json',
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Splunk API at {$baseUrl}. Check the URL and network access.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Splunk API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'splunk_search' => [
                'class' => SplunkSearch::class,
                'type' => 'write',
                'name' => 'Search',
                'description' => 'Run a Splunk search query (SPL). Creates a search job and returns the SID.',
                'icon' => 'ph:magnifying-glass',
            ],
            'splunk_get_search_results' => [
                'class' => SplunkGetSearchResults::class,
                'type' => 'read',
                'name' => 'Get Search Results',
                'description' => 'Retrieve results from a completed Splunk search job by SID.',
                'icon' => 'ph:table',
            ],
            'splunk_list_indexes' => [
                'class' => SplunkListIndexes::class,
                'type' => 'read',
                'name' => 'List Indexes',
                'description' => 'List all Splunk indexes available to the authenticated user.',
                'icon' => 'ph:database',
            ],
            'splunk_list_saved_searches' => [
                'class' => SplunkListSavedSearches::class,
                'type' => 'read',
                'name' => 'List Saved Searches',
                'description' => 'List all saved searches configured in Splunk.',
                'icon' => 'ph:floppy-disk',
            ],
            'splunk_get_index' => [
                'class' => SplunkGetIndex::class,
                'type' => 'read',
                'name' => 'Get Index',
                'description' => 'Get details for a specific Splunk index.',
                'icon' => 'ph:database',
            ],
            'splunk_get_current_user' => [
                'class' => SplunkGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Splunk user context.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/splunk.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Splunk URL', 'required' => false, 'default' => 'https://localhost:8089/services'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SplunkService(
                accessToken: $creds->get('splunk', 'access_token', '', $account),
                baseUrl: $creds->get('splunk', 'url', 'https://localhost:8089/services', $account),
            );

            return new $class($service);
        }

        return new $class(app(SplunkService::class));
    }
}
