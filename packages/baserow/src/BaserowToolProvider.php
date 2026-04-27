<?php

namespace OpenCompany\Integrations\Baserow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Baserow\Tools\BaserowListTables;
use OpenCompany\Integrations\Baserow\Tools\BaserowGetRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowCreateRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowUpdateRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowDeleteRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowListDatabases;
use OpenCompany\Integrations\Baserow\Tools\BaserowGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class BaserowToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'baserow';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'databases, tables, rows',
            'description' => 'Database management',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:baserow',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Baserow',
            'description' => 'No-code database and Airtable alternative',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:baserow',
            'category' => 'database',
            'badge' => 'verified',
            'docs_url' => 'https://baserow.io/docs/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Baserow access token',
                'hint' => 'Generate a personal access token in your Baserow account settings under "Personal access tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://api.baserow.io',
                'hint' => 'Use <code>https://api.baserow.io</code> for cloud, or your self-hosted API URL',
                'default' => 'https://api.baserow.io',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.baserow.io', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/user/');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Baserow API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['detail'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Baserow API error: {$error}",
                ];
            }

            $userName = $json['first_name'] ?? $json['username'] ?? $json['email'] ?? 'User';

            return [
                'success' => true,
                'message' => "Connected to Baserow API as {$userName}.",
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
            'baserow_list_tables' => [
                'class' => BaserowListTables::class,
                'type' => 'read',
                'name' => 'List Table Rows',
                'description' => 'List rows in a Baserow database table with pagination and filtering.',
                'icon' => 'ph:table',
            ],
            'baserow_get_row' => [
                'class' => BaserowGetRow::class,
                'type' => 'read',
                'name' => 'Get Row',
                'description' => 'Get a single row from a Baserow database table.',
                'icon' => 'ph:rows',
            ],
            'baserow_create_row' => [
                'class' => BaserowCreateRow::class,
                'type' => 'write',
                'name' => 'Create Row',
                'description' => 'Create a new row in a Baserow database table.',
                'icon' => 'ph:plus',
            ],
            'baserow_update_row' => [
                'class' => BaserowUpdateRow::class,
                'type' => 'write',
                'name' => 'Update Row',
                'description' => 'Update an existing row in a Baserow database table.',
                'icon' => 'ph:pencil',
            ],
            'baserow_delete_row' => [
                'class' => BaserowDeleteRow::class,
                'type' => 'write',
                'name' => 'Delete Row',
                'description' => 'Delete a row from a Baserow database table.',
                'icon' => 'ph:trash',
            ],
            'baserow_list_databases' => [
                'class' => BaserowListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all databases (applications) in the Baserow workspace.',
                'icon' => 'ph:database',
            ],
            'baserow_get_current_user' => [
                'class' => BaserowGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Baserow user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/baserow.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Baserow API URL', 'required' => false, 'default' => 'https://api.baserow.io'],
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

            $service = new BaserowService(
                accessToken: $creds->get('baserow', 'access_token', '', $account),
                baseUrl: $creds->get('baserow', 'url', 'https://api.baserow.io', $account),
            );

            return new $class($service);
        }

        return new $class(app(BaserowService::class));
    }
}
