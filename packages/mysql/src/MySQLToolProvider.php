<?php

namespace OpenCompany\Integrations\MySQL;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MySQL\Tools\MySQLQuery;
use OpenCompany\Integrations\MySQL\Tools\MySQLListDatabases;
use OpenCompany\Integrations\MySQL\Tools\MySQLListTables;
use OpenCompany\Integrations\MySQL\Tools\MySQLDescribeTable;
use OpenCompany\Integrations\MySQL\Tools\MySQLInsert;
use OpenCompany\Integrations\MySQL\Tools\MySQLUpdate;
use OpenCompany\Integrations\MySQL\Tools\MySQLDelete;
use OpenCompany\Integrations\MySQL\Tools\MySQLGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MySQLToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'mysql';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Mysql',
            'description' => 'MySQL integration for Laravel — query databases, manage tables, and perform CRUD…',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Mysql',
            'description' => 'MySQL integration for Laravel — query databases, manage tables, and perform CRUD operations via HTTP REST bridge.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'data',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your MySQL REST bridge API key',
                'hint' => 'The API key for authenticating with the MySQL HTTP REST bridge',
                'required' => true,
            ],
            [
                'key' => 'host',
                'type' => 'url',
                'label' => 'Host URL',
                'placeholder' => 'https://mysql-api.example.com',
                'hint' => 'The base URL of your MySQL HTTP REST bridge (e.g., <code>https://mysql-api.example.com</code>)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the MySQL REST bridge.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['host'] ?? '', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No host URL provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/ping');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach MySQL API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to MySQL API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'host' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'mysql_query' => [
                'class' => MySQLQuery::class,
                'type' => 'read',
                'name' => 'Query',
                'description' => 'Execute a raw SQL query on the MySQL database.',
                'icon' => 'ph:code',
            ],
            'mysql_list_databases' => [
                'class' => MySQLListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all accessible databases.',
                'icon' => 'ph:database',
            ],
            'mysql_list_tables' => [
                'class' => MySQLListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List all tables in a database.',
                'icon' => 'ph:table',
            ],
            'mysql_describe_table' => [
                'class' => MySQLDescribeTable::class,
                'type' => 'read',
                'name' => 'Describe Table',
                'description' => 'Get the column structure of a table.',
                'icon' => 'ph:info',
            ],
            'mysql_insert' => [
                'class' => MySQLInsert::class,
                'type' => 'write',
                'name' => 'Insert Row',
                'description' => 'Insert a row into a table.',
                'icon' => 'ph:plus',
            ],
            'mysql_update' => [
                'class' => MySQLUpdate::class,
                'type' => 'write',
                'name' => 'Update Rows',
                'description' => 'Update rows matching a filter.',
                'icon' => 'ph:pencil',
            ],
            'mysql_delete' => [
                'class' => MySQLDelete::class,
                'type' => 'write',
                'name' => 'Delete Rows',
                'description' => 'Delete rows matching a filter.',
                'icon' => 'ph:trash',
            ],
            'mysql_get_current_user' => [
                'class' => MySQLGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Current User',
                'description' => 'Get the currently authenticated database user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mysql.md';
    }

    /**
     * Get the credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'host', 'type' => 'url', 'label' => 'Host URL', 'required' => true],
        ];
    }

    /**
     * Indicate this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account info.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MySQLService(
                apiKey: $creds->get('mysql', 'api_key', '', $account),
                baseUrl: $creds->get('mysql', 'host', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(MySQLService::class));
    }
}
