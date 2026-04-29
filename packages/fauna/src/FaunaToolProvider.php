<?php

namespace OpenCompany\Integrations\Fauna;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Fauna\Tools\FaunaCreateDatabase;
use OpenCompany\Integrations\Fauna\Tools\FaunaGetCollection;
use OpenCompany\Integrations\Fauna\Tools\FaunaGetCurrentUser;
use OpenCompany\Integrations\Fauna\Tools\FaunaGetDatabase;
use OpenCompany\Integrations\Fauna\Tools\FaunaListCollections;
use OpenCompany\Integrations\Fauna\Tools\FaunaListDatabases;
use OpenCompany\Integrations\Fauna\Tools\FaunaQueryFql;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Fauna tools and provides integration metadata, configuration schema, and connection testing.
 */
class FaunaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'fauna';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Fauna',
            'description' => 'Serverless NoSQL Database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:fauna',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Fauna',
            'description' => 'Databases, collections, FQL queries, and auth',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:fauna',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.fauna.com/fauna/current/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'bearer_token',
                'type' => 'secret',
                'label' => 'Bearer Token (Fauna Secret)',
                'placeholder' => 'fnA...',
                'hint' => 'Fauna secret key from <a href="https://dashboard.fauna.com/" target="_blank">Dashboard → Security</a>. Can be a server, admin, or database key.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'string',
                'label' => 'Base URL',
                'placeholder' => 'https://db.fauna.com',
                'hint' => 'Fauna API endpoint. Defaults to https://db.fauna.com. Use https://db.us.fauna.com for US region.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the Fauna connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'bearer_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $bearerToken = $config['bearer_token'] ?? '';
        $baseUrl = $config['base_url'] ?? 'https://db.fauna.com';

        if (empty($bearerToken)) {
            return ['success' => false, 'error' => 'No bearer token provided. Find it in Fauna Dashboard → Security.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $bearerToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get(rtrim($baseUrl, '/') . '/databases');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Fauna successfully.',
                ];
            }

            $error = $response->body();

            return [
                'success' => false,
                'error' => 'Fauna API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'bearer_token' => 'required|string',
            'base_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            'fauna_list_databases' => [
                'class' => FaunaListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all databases in the current Fauna context.',
                'icon' => 'ph:list',
            ],
            'fauna_get_database' => [
                'class' => FaunaGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get details of a specific Fauna database by name.',
                'icon' => 'ph:database',
            ],
            'fauna_create_database' => [
                'class' => FaunaCreateDatabase::class,
                'type' => 'write',
                'name' => 'Create Database',
                'description' => 'Create a new Fauna database.',
                'icon' => 'ph:plus-circle',
            ],
            'fauna_query_fql' => [
                'class' => FaunaQueryFql::class,
                'type' => 'action',
                'name' => 'Query FQL',
                'description' => 'Execute a Fauna Query Language (FQL) expression.',
                'icon' => 'ph:code',
            ],
            'fauna_list_collections' => [
                'class' => FaunaListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all collections in the current Fauna database.',
                'icon' => 'ph:folders',
            ],
            'fauna_get_collection' => [
                'class' => FaunaGetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get details of a specific Fauna collection by name.',
                'icon' => 'ph:folder-open',
            ],
            'fauna_get_current_user' => [
                'class' => FaunaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Fauna key identity.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/fauna.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'bearer_token', 'type' => 'secret', 'label' => 'Bearer Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'string', 'label' => 'Base URL', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the FaunaService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): FaunaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new FaunaService(
                bearerToken: $creds->get('fauna', 'bearer_token', '', $account),
                baseUrl: $creds->get('fauna', 'base_url', 'https://db.fauna.com', $account),
            );
        }

        return app(FaunaService::class);
    }
}
