<?php

namespace OpenCompany\Integrations\Baserow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Baserow\Tools\BaserowBatchCreate;
use OpenCompany\Integrations\Baserow\Tools\BaserowBatchDelete;
use OpenCompany\Integrations\Baserow\Tools\BaserowBatchUpdate;
use OpenCompany\Integrations\Baserow\Tools\BaserowCreateRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowDeleteRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowGetRow;
use OpenCompany\Integrations\Baserow\Tools\BaserowGetTable;
use OpenCompany\Integrations\Baserow\Tools\BaserowListDatabases;
use OpenCompany\Integrations\Baserow\Tools\BaserowListFields;
use OpenCompany\Integrations\Baserow\Tools\BaserowListRows;
use OpenCompany\Integrations\Baserow\Tools\BaserowListTables;
use OpenCompany\Integrations\Baserow\Tools\BaserowUpdateRow;

/**
 * Registers all Baserow tools and provides integration metadata.
 *
 * Exposes 12 tools covering rows (CRUD + batch), tables, fields,
 * and databases via the ToolProvider contract.
 */
class BaserowToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'baserow';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'databases, tables, rows, fields',
            'description' => 'Database',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:baserow',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Baserow',
            'description' => 'Databases, tables, fields, and rows',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:baserow',
            'category' => 'database',
            'badge' => 'verified',
            'docs_url' => 'https://baserow.io/docs/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'your-baserow-api-token',
                'hint' => 'A Baserow API token (JWT or permanent database token). Find it in your profile settings or generate one per database.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'Base URL',
                'placeholder' => 'https://api.baserow.io/api',
                'hint' => 'The base URL of your Baserow instance API. Change this for self-hosted instances.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the Baserow connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token' and optionally 'base_url'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl  = $config['base_url'] ?? 'https://api.baserow.io/api';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided. Generate one in your Baserow profile or database settings.'];
        }

        try {
            $url = rtrim($baseUrl, '/') . '/applications/';

            $response = Http::withHeaders([
                'Authorization' => 'Token ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($url);

            if ($response->failed()) {
                return [
                    'success' => false,
                    'error' => 'Baserow API error (' . $response->status() . '): ' . $response->body(),
                ];
            }

            $body   = $response->json() ?? [];
            $count  = is_array($body) ? count($body) : 0;

            return [
                'success' => true,
                'message' => "Connected to Baserow successfully. Found {$count} application(s).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'base_url'  => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Rows
            'baserow_list_rows' => [
                'class' => BaserowListRows::class,
                'type' => 'read',
                'name' => 'List Rows',
                'description' => 'List rows in a Baserow table with optional filtering and pagination.',
                'icon' => 'ph:list',
            ],
            'baserow_get_row' => [
                'class' => BaserowGetRow::class,
                'type' => 'read',
                'name' => 'Get Row',
                'description' => 'Get a single Baserow row by ID.',
                'icon' => 'ph:rows',
            ],
            'baserow_create_row' => [
                'class' => BaserowCreateRow::class,
                'type' => 'write',
                'name' => 'Create Row',
                'description' => 'Create a new row in a Baserow table.',
                'icon' => 'ph:plus-circle',
            ],
            'baserow_update_row' => [
                'class' => BaserowUpdateRow::class,
                'type' => 'write',
                'name' => 'Update Row',
                'description' => 'Update an existing Baserow row.',
                'icon' => 'ph:pencil-simple',
            ],
            'baserow_delete_row' => [
                'class' => BaserowDeleteRow::class,
                'type' => 'write',
                'name' => 'Delete Row',
                'description' => 'Delete a Baserow row.',
                'icon' => 'ph:trash',
            ],
            // Batch operations
            'baserow_batch_create' => [
                'class' => BaserowBatchCreate::class,
                'type' => 'write',
                'name' => 'Batch Create Rows',
                'description' => 'Create multiple rows in a Baserow table at once.',
                'icon' => 'ph:plus-circle',
            ],
            'baserow_batch_update' => [
                'class' => BaserowBatchUpdate::class,
                'type' => 'write',
                'name' => 'Batch Update Rows',
                'description' => 'Update multiple rows in a Baserow table at once.',
                'icon' => 'ph:pencil-simple',
            ],
            'baserow_batch_delete' => [
                'class' => BaserowBatchDelete::class,
                'type' => 'write',
                'name' => 'Batch Delete Rows',
                'description' => 'Delete multiple rows from a Baserow table at once.',
                'icon' => 'ph:trash',
            ],
            // Tables & Databases
            'baserow_list_tables' => [
                'class' => BaserowListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List all tables in a Baserow database.',
                'icon' => 'ph:table',
            ],
            'baserow_list_databases' => [
                'class' => BaserowListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List all Baserow databases (applications).',
                'icon' => 'ph:database',
            ],
            'baserow_get_table' => [
                'class' => BaserowGetTable::class,
                'type' => 'read',
                'name' => 'Get Table',
                'description' => 'Get details for a Baserow table.',
                'icon' => 'ph:table',
            ],
            'baserow_list_fields' => [
                'class' => BaserowListFields::class,
                'type' => 'read',
                'name' => 'List Fields',
                'description' => 'List all fields in a Baserow table.',
                'icon' => 'ph:columns',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/baserow.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Base URL', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with an injected service.
     *
     * @param  string $class  Fully-qualified tool class name
     * @param  array<string, mixed> $context Optional context (supports 'account' for multi-tenant)
     * @return Tool
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the BaserowService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): BaserowService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new BaserowService(
                apiToken: $creds->get('baserow', 'api_token', '', $account),
                baseUrl:  $creds->get('baserow', 'base_url', 'https://api.baserow.io/api', $account),
            );
        }

        return app(BaserowService::class);
    }
}
