<?php

namespace OpenCompany\Integrations\Baserow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Baserow\Tools\BaserowApiDelete;
use OpenCompany\Integrations\Baserow\Tools\BaserowApiGet;
use OpenCompany\Integrations\Baserow\Tools\BaserowApiPatch;
use OpenCompany\Integrations\Baserow\Tools\BaserowApiPost;
use OpenCompany\Integrations\Baserow\Tools\BaserowBatchCreate;
use OpenCompany\Integrations\Baserow\Tools\BaserowBatchDelete;
use OpenCompany\Integrations\Baserow\Tools\BaserowBatchUpdate;
use OpenCompany\Integrations\Baserow\Tools\BaserowCreateField;
use OpenCompany\Integrations\Baserow\Tools\BaserowCreateRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowDeleteField;
use OpenCompany\Integrations\Baserow\Tools\BaserowDeleteRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowGetCurrentUser;
use OpenCompany\Integrations\Baserow\Tools\BaserowGetField;
use OpenCompany\Integrations\Baserow\Tools\BaserowGetRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowGetTable;
use OpenCompany\Integrations\Baserow\Tools\BaserowListAllTables;
use OpenCompany\Integrations\Baserow\Tools\BaserowListDatabaseTables;
use OpenCompany\Integrations\Baserow\Tools\BaserowListDatabases;
use OpenCompany\Integrations\Baserow\Tools\BaserowListFields;
use OpenCompany\Integrations\Baserow\Tools\BaserowListRows;
use OpenCompany\Integrations\Baserow\Tools\BaserowListTables;
use OpenCompany\Integrations\Baserow\Tools\BaserowMoveRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowUpdateField;
use OpenCompany\Integrations\Baserow\Tools\BaserowUpdateRow;

/**
 * Exposes the Baserow tool catalog and credential configuration.
 *
 * Supports multi-account credentials and registers row, table, field, batch,
 * user, and raw API helpers for host discovery.
 */
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [
                    'Baserow database API endpoints normally use the Token auth scheme. JWT or Bearer can be configured for host-specific account tokens.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
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
        return 'baserow';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Baserow',
            'description' => 'No-code database automation',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:baserow',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Baserow',
            'description' => 'No-code database tables, fields, rows, and batch operations.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:baserow',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://baserow.io/api-docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Baserow token',
                'hint' => 'Use a database token for table, field, and row operations. Use JWT or Bearer only when your host provides account-level tokens.',
                'required' => true,
            ],
            [
                'key' => 'auth_scheme',
                'type' => 'select',
                'label' => 'Auth Scheme',
                'default' => 'Token',
                'options' => [
                    ['label' => 'Token', 'value' => 'Token'],
                    ['label' => 'JWT', 'value' => 'JWT'],
                    ['label' => 'Bearer', 'value' => 'Bearer'],
                ],
                'hint' => 'Baserow database tokens use Token. Some account endpoints require JWT or Bearer depending on how credentials are provisioned.',
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://api.baserow.io',
                'hint' => 'Use https://api.baserow.io for cloud, or your self-hosted API URL.',
                'default' => 'https://api.baserow.io',
            ],
        ];
    }

    /**
     * Test Baserow credentials against a lightweight database-token endpoint.
     *
     * @param  array<string, mixed>  $config  Credential configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.baserow.io'), '/');
        $authScheme = trim((string) ($config['auth_scheme'] ?? 'Token')) ?: 'Token';

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $authScheme . ' ' . $accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/database/tables/all-tables/');

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

            return [
                'success' => true,
                'message' => 'Connected to Baserow API.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'auth_scheme' => 'nullable|string|in:Token,JWT,Bearer',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'baserow_list_databases' => $this->tool(BaserowListDatabases::class, 'read', 'List Databases', 'List databases available to the authenticated Baserow account.'),
            'baserow_list_all_tables' => $this->tool(BaserowListAllTables::class, 'read', 'List All Tables', 'List all tables visible to the configured database token.'),
            'baserow_list_database_tables' => $this->tool(BaserowListDatabaseTables::class, 'read', 'List Database Tables', 'List tables in a specific Baserow database.'),
            'baserow_get_table' => $this->tool(BaserowGetTable::class, 'read', 'Get Table', 'Get Baserow table metadata.'),
            'baserow_list_fields' => $this->tool(BaserowListFields::class, 'read', 'List Fields', 'List fields in a Baserow table.'),
            'baserow_get_field' => $this->tool(BaserowGetField::class, 'read', 'Get Field', 'Get metadata for a Baserow field.'),
            'baserow_create_field' => $this->tool(BaserowCreateField::class, 'write', 'Create Field', 'Create a field in a Baserow table.'),
            'baserow_update_field' => $this->tool(BaserowUpdateField::class, 'write', 'Update Field', 'Update a Baserow field definition.'),
            'baserow_delete_field' => $this->tool(BaserowDeleteField::class, 'write', 'Delete Field', 'Delete a Baserow field.'),
            'baserow_list_rows' => $this->tool(BaserowListRows::class, 'read', 'List Rows', 'List rows in a table with search, sorting, filtering, and pagination.'),
            'baserow_list_tables' => $this->tool(BaserowListTables::class, 'read', 'List Rows (Legacy)', 'Legacy slug that lists rows in a Baserow table. Use baserow_list_rows for new agents.'),
            'baserow_get_row' => $this->tool(BaserowGetRow::class, 'read', 'Get Row', 'Get a single row from a Baserow table.'),
            'baserow_create_row' => $this->tool(BaserowCreateRow::class, 'write', 'Create Row', 'Create a row in a Baserow table.'),
            'baserow_update_row' => $this->tool(BaserowUpdateRow::class, 'write', 'Update Row', 'Update a row in a Baserow table.'),
            'baserow_move_row' => $this->tool(BaserowMoveRow::class, 'write', 'Move Row', 'Move a Baserow row before another row or to the end of a table.'),
            'baserow_delete_row' => $this->tool(BaserowDeleteRow::class, 'write', 'Delete Row', 'Delete a row from a Baserow table.'),
            'baserow_batch_create' => $this->tool(BaserowBatchCreate::class, 'write', 'Batch Create Rows', 'Create multiple rows in one Baserow request.'),
            'baserow_batch_update' => $this->tool(BaserowBatchUpdate::class, 'write', 'Batch Update Rows', 'Update multiple rows in one Baserow request.'),
            'baserow_batch_delete' => $this->tool(BaserowBatchDelete::class, 'write', 'Batch Delete Rows', 'Delete multiple rows in one Baserow request.'),
            'baserow_get_current_user' => $this->tool(BaserowGetCurrentUser::class, 'read', 'Get Current User', 'Get the authenticated Baserow user profile.'),
            'baserow_api_get' => $this->tool(BaserowApiGet::class, 'read', 'API GET', 'Call a relative Baserow API path with GET.'),
            'baserow_api_post' => $this->tool(BaserowApiPost::class, 'write', 'API POST', 'Call a relative Baserow API path with POST.'),
            'baserow_api_patch' => $this->tool(BaserowApiPatch::class, 'write', 'API PATCH', 'Call a relative Baserow API path with PATCH.'),
            'baserow_api_delete' => $this->tool(BaserowApiDelete::class, 'write', 'API DELETE', 'Call a relative Baserow API path with DELETE.'),
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/baserow.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'auth_scheme', 'type' => 'select', 'label' => 'Auth Scheme', 'required' => false, 'default' => 'Token'],
            ['key' => 'url', 'type' => 'url', 'label' => 'Baserow API URL', 'required' => false, 'default' => 'https://api.baserow.io'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool with account-scoped credentials when provided.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Baserow service for default or named account credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): BaserowService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BaserowService(
                accessToken: $creds->get('baserow', 'access_token', '', $account),
                baseUrl: $creds->get('baserow', 'url', 'https://api.baserow.io', $account),
                authScheme: $creds->get('baserow', 'auth_scheme', 'Token', $account),
            );
        }

        return app(BaserowService::class);
    }

    /**
     * Build a catalog entry for a Baserow tool.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @return array<string, mixed>
     */
    private function tool(string $class, string $type, string $name, string $description): array
    {
        return [
            'class' => $class,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'icon' => $type === 'read' ? 'ph:database' : 'ph:pencil-simple',
        ];
    }
}
