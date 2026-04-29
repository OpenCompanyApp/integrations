<?php

namespace OpenCompany\Integrations\Apify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Apify\Tools\ApifyRunActor;
use OpenCompany\Integrations\Apify\Tools\ApifyGetRun;
use OpenCompany\Integrations\Apify\Tools\ApifyListActors;
use OpenCompany\Integrations\Apify\Tools\ApifyGetActor;
use OpenCompany\Integrations\Apify\Tools\ApifyListDatasets;
use OpenCompany\Integrations\Apify\Tools\ApifyGetDataset;
use OpenCompany\Integrations\Apify\Tools\ApifyGetDatasetItems;
use OpenCompany\Integrations\Apify\Tools\ApifyListKeyValueStores;
use OpenCompany\Integrations\Apify\Tools\ApifyGetRecord;
use OpenCompany\Integrations\Apify\Tools\ApifyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ApifyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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
        return 'apify';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Apify',
            'description' => 'Web scraping & automation',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:apify',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Apify',
            'description' => 'Web scraping and automation platform — run actors, manage datasets and key-value stores.',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:apify',
            'category' => 'automation',
            'badge' => 'verified',
            'docs_url' => 'https://docs.apify.com/api/v2',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Apify API token',
                'hint' => 'Find your API token in Apify at <strong>Settings → Integrations → API token</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.apify.com/v2',
                'hint' => 'Use the default Apify Cloud URL, or your self-hosted Apify API URL',
                'default' => 'https://api.apify.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.apify.com/v2', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Apify API at {$baseUrl}. Check the URL.",
                ];
            }

            $username = $json['data']['username'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Apify as {$username}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'apify_run_actor' => [
                'class' => ApifyRunActor::class,
                'type' => 'write',
                'name' => 'Run Actor',
                'description' => 'Run an Apify actor with input configuration.',
                'icon' => 'ph:play',
            ],
            'apify_get_run' => [
                'class' => ApifyGetRun::class,
                'type' => 'read',
                'name' => 'Get Run',
                'description' => 'Get details and status of an actor run.',
                'icon' => 'ph:info',
            ],
            'apify_list_actors' => [
                'class' => ApifyListActors::class,
                'type' => 'read',
                'name' => 'List Actors',
                'description' => 'List available Apify actors.',
                'icon' => 'ph:list',
            ],
            'apify_get_actor' => [
                'class' => ApifyGetActor::class,
                'type' => 'read',
                'name' => 'Get Actor',
                'description' => 'Get details of a specific Apify actor.',
                'icon' => 'ph:info',
            ],
            'apify_list_datasets' => [
                'class' => ApifyListDatasets::class,
                'type' => 'read',
                'name' => 'List Datasets',
                'description' => 'List accessible Apify datasets.',
                'icon' => 'ph:database',
            ],
            'apify_get_dataset' => [
                'class' => ApifyGetDataset::class,
                'type' => 'read',
                'name' => 'Get Dataset',
                'description' => 'Get details of a specific dataset.',
                'icon' => 'ph:database',
            ],
            'apify_get_dataset_items' => [
                'class' => ApifyGetDatasetItems::class,
                'type' => 'read',
                'name' => 'Get Dataset Items',
                'description' => 'Retrieve items from a dataset.',
                'icon' => 'ph:table',
            ],
            'apify_list_key_value_stores' => [
                'class' => ApifyListKeyValueStores::class,
                'type' => 'read',
                'name' => 'List Key-Value Stores',
                'description' => 'List accessible key-value stores.',
                'icon' => 'ph:key',
            ],
            'apify_get_record' => [
                'class' => ApifyGetRecord::class,
                'type' => 'read',
                'name' => 'Get Record',
                'description' => 'Get a record from a key-value store.',
                'icon' => 'ph:file-text',
            ],
            'apify_get_current_user' => [
                'class' => ApifyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/apify.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Apify API URL', 'required' => false, 'default' => 'https://api.apify.com/v2'],
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

            $service = new ApifyService(
                apiToken: $creds->get('apify', 'api_token', '', $account),
                baseUrl: $creds->get('apify', 'url', 'https://api.apify.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(ApifyService::class));
    }
}
