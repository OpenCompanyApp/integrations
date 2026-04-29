<?php

namespace OpenCompany\Integrations\QuickBase;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseListTables;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseGetTable;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseListRecords;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseGetRecord;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseCreateRecord;
use OpenCompany\Integrations\QuickBase\Tools\QuickBaseGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class QuickBaseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'quickbase';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'QuickBase',
            'description' => 'Low-code database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:quickbase',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'QuickBase',
            'description' => 'Low-code database platform for building business applications',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:quickbase',
            'category' => 'database',
            'badge' => 'verified',
            'docs_url' => 'https://developer.quickbase.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your QuickBase user token',
                'hint' => 'Generate a user token in QuickBase at My Preferences → User Properties → Manage My User Tokens',
                'required' => true,
            ],
            [
                'key' => 'realm_hostname',
                'type' => 'text',
                'label' => 'Realm Hostname',
                'placeholder' => 'mycompany.quickbase.com',
                'hint' => 'Your QuickBase realm hostname, e.g. <code>mycompany.quickbase.com</code>',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.quickbase.com/v1',
                'hint' => 'The QuickBase API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.quickbase.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $realmHostname = $config['realm_hostname'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.quickbase.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        if (empty($realmHostname)) {
            return ['success' => false, 'error' => 'No realm hostname provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'QB-Realm-Hostname' => $realmHostname,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            if ($response->successful()) {
                $user = $response->json();
                $name = trim(($user['firstName'] ?? '') . ' ' . ($user['lastName'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to QuickBase as {$name} (realm: {$realmHostname}).",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'QuickBase API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'realm_hostname' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'quickbase_list_tables' => [
                'class' => QuickBaseListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List all tables in a QuickBase application.',
                'icon' => 'ph:table',
            ],
            'quickbase_get_table' => [
                'class' => QuickBaseGetTable::class,
                'type' => 'read',
                'name' => 'Get Table',
                'description' => 'Get details for a specific table.',
                'icon' => 'ph:table',
            ],
            'quickbase_list_records' => [
                'class' => QuickBaseListRecords::class,
                'type' => 'read',
                'name' => 'List Records',
                'description' => 'Query records from a table with filters and pagination.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'quickbase_get_record' => [
                'class' => QuickBaseGetRecord::class,
                'type' => 'read',
                'name' => 'Get Record',
                'description' => 'Get a single record by ID.',
                'icon' => 'ph:clipboard-text',
            ],
            'quickbase_create_record' => [
                'class' => QuickBaseCreateRecord::class,
                'type' => 'write',
                'name' => 'Create Record',
                'description' => 'Create a new record in a table.',
                'icon' => 'ph:plus-circle',
            ],
            'quickbase_get_current_user' => [
                'class' => QuickBaseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated QuickBase user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/quickbase.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'realm_hostname', 'type' => 'text', 'label' => 'Realm Hostname', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.quickbase.com/v1'],
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
     * Resolve the QuickBaseService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): QuickBaseService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new QuickBaseService(
                accessToken: $creds->get('quickbase', 'access_token', '', $account),
                realmHostname: $creds->get('quickbase', 'realm_hostname', '', $account),
                baseUrl: $creds->get('quickbase', 'base_url', 'https://api.quickbase.com/v1', $account),
            );
        }

        return app(QuickBaseService::class);
    }
}
