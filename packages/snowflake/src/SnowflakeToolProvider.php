<?php

namespace OpenCompany\Integrations\Snowflake;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeExecuteQuery;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeListDatabases;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeGetDatabase;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeListSchemas;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeListTables;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeDescribeTable;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeListWarehouses;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeGetWarehouse;
use OpenCompany\Integrations\Snowflake\Tools\SnowflakeGetCurrentUser;

class SnowflakeToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'snowflake';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'query, databases, schemas, tables, warehouses',
            'description' => 'Cloud data warehouse',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:snowflake',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Snowflake',
            'description' => 'Cloud-based data warehouse for SQL analytics',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:snowflake',
            'category' => 'database',
            'badge' => 'verified',
            'docs_url' => 'https://docs.snowflake.com/en/developer-guide/sql-api/index',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Snowflake access token',
                'hint' => 'Generate an access token via OAuth or key-pair authentication in your Snowflake account',
                'required' => true,
            ],
            [
                'key' => 'account',
                'type' => 'string',
                'label' => 'Account Identifier',
                'placeholder' => 'e.g. orgname-accountname',
                'hint' => 'Your Snowflake account identifier (e.g., <code>orgname-accountname</code> or <code>account.region.cloud</code>)',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $account = $config['account'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($account)) {
            return ['success' => false, 'error' => 'No account identifier provided'];
        }

        try {
            $baseUrl = 'https://' . $account . '.snowflakecomputing.com/api/v2';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(15)->get($baseUrl . '/session');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Snowflake API at {$baseUrl}. Check the account identifier.",
                ];
            }

            $userName = $json['userName'] ?? $json['user'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Snowflake as {$userName} (account: {$account}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'account' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'snowflake_execute_query' => [
                'class' => SnowflakeExecuteQuery::class,
                'type' => 'write',
                'name' => 'Execute Query',
                'description' => 'Execute a SQL statement on Snowflake.',
                'icon' => 'ph:play',
            ],
            'snowflake_list_databases' => [
                'class' => SnowflakeListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all databases in the Snowflake account.',
                'icon' => 'ph:database',
            ],
            'snowflake_get_database' => [
                'class' => SnowflakeGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get details for a specific database.',
                'icon' => 'ph:database',
            ],
            'snowflake_list_schemas' => [
                'class' => SnowflakeListSchemas::class,
                'type' => 'read',
                'name' => 'List Schemas',
                'description' => 'List schemas in a database.',
                'icon' => 'ph:folders',
            ],
            'snowflake_list_tables' => [
                'class' => SnowflakeListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List tables in a schema.',
                'icon' => 'ph:table',
            ],
            'snowflake_describe_table' => [
                'class' => SnowflakeDescribeTable::class,
                'type' => 'read',
                'name' => 'Describe Table',
                'description' => 'Get column definitions and metadata for a table.',
                'icon' => 'ph:info',
            ],
            'snowflake_list_warehouses' => [
                'class' => SnowflakeListWarehouses::class,
                'type' => 'read',
                'name' => 'List Warehouses',
                'description' => 'List all warehouses in the Snowflake account.',
                'icon' => 'ph:warehouse',
            ],
            'snowflake_get_warehouse' => [
                'class' => SnowflakeGetWarehouse::class,
                'type' => 'read',
                'name' => 'Get Warehouse',
                'description' => 'Get details for a specific warehouse.',
                'icon' => 'ph:warehouse',
            ],
            'snowflake_get_current_user' => [
                'class' => SnowflakeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Snowflake user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/snowflake.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'account', 'type' => 'string', 'label' => 'Account Identifier', 'required' => true],
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

            $service = new SnowflakeService(
                accessToken: $creds->get('snowflake', 'access_token', '', $account),
                account: $creds->get('snowflake', 'account', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(SnowflakeService::class));
    }
}
