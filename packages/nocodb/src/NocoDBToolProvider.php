<?php

namespace OpenCompany\Integrations\NocoDB;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBBatchCreate;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBBatchDelete;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBBatchUpdate;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBCountRecords;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBCreateRecord;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBCreateTable;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBDeleteRecord;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBGetBase;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBGetRecord;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBGetTable;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBListBases;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBListRecords;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBListTables;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBListViews;
use OpenCompany\Integrations\NocoDB\Tools\NocoDBUpdateRecord;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all NocoDB tools and provides integration metadata.
 *
 * Exposes 15 tools covering records, batches, bases, tables,
 * views, and record counts via the ToolProvider contract.
 */
class NocoDBToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'nocodb';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'NocoDB',
            'description' => 'Spreadsheets & Database',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:nocodb',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'NocoDB',
            'description' => 'Bases, tables, records, views, and bulk operations',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:nocodb',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.nocodb.com/developer-resources/rest-APIs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'xc-token...',
                'hint' => 'NocoDB API token. Found in Project Settings → Access Tokens.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'Base URL',
                'placeholder' => 'https://my-nocodb.example.com',
                'hint' => 'The base URL of your self-hosted NocoDB instance (no trailing slash).',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the NocoDB connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token' and 'base_url'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = $config['base_url'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided. Generate a token in your NocoDB project settings.'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No base URL provided. Enter the URL of your NocoDB instance.'];
        }

        try {
            $url = rtrim($baseUrl, '/') . '/api/v2/meta/bases';

            $response = Http::withHeaders([
                'xc-token' => $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($url);

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['msg'] ?? $body['error'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'NocoDB API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $baseCount = count($body['list'] ?? $body['bases'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to NocoDB. Found {$baseCount} accessible base(s).",
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
            'base_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Records
            'nocodb_list_records' => [
                'class' => NocoDBListRecords::class,
                'type' => 'read',
                'name' => 'List Records',
                'description' => 'List records from a NocoDB table with optional filtering, sorting, and pagination.',
                'icon' => 'ph:list',
            ],
            'nocodb_get_record' => [
                'class' => NocoDBGetRecord::class,
                'type' => 'read',
                'name' => 'Get Record',
                'description' => 'Get a single NocoDB record by ID.',
                'icon' => 'ph:record',
            ],
            'nocodb_create_record' => [
                'class' => NocoDBCreateRecord::class,
                'type' => 'write',
                'name' => 'Create Record',
                'description' => 'Create a new record in a NocoDB table.',
                'icon' => 'ph:plus-circle',
            ],
            'nocodb_update_record' => [
                'class' => NocoDBUpdateRecord::class,
                'type' => 'write',
                'name' => 'Update Record',
                'description' => 'Update an existing NocoDB record.',
                'icon' => 'ph:pencil-simple',
            ],
            'nocodb_delete_record' => [
                'class' => NocoDBDeleteRecord::class,
                'type' => 'write',
                'name' => 'Delete Record',
                'description' => 'Delete a record from a NocoDB table.',
                'icon' => 'ph:trash',
            ],
            // Batch
            'nocodb_batch_create' => [
                'class' => NocoDBBatchCreate::class,
                'type' => 'write',
                'name' => 'Batch Create Records',
                'description' => 'Create multiple records in a single NocoDB API request.',
                'icon' => 'ph:stack-plus',
            ],
            'nocodb_batch_update' => [
                'class' => NocoDBBatchUpdate::class,
                'type' => 'write',
                'name' => 'Batch Update Records',
                'description' => 'Update multiple records in a single NocoDB API request.',
                'icon' => 'ph:stack',
            ],
            'nocodb_batch_delete' => [
                'class' => NocoDBBatchDelete::class,
                'type' => 'write',
                'name' => 'Batch Delete Records',
                'description' => 'Delete multiple records in a single NocoDB API request.',
                'icon' => 'ph:stack-minus',
            ],
            // Meta: Bases
            'nocodb_list_bases' => [
                'class' => NocoDBListBases::class,
                'type' => 'read',
                'name' => 'List Bases',
                'description' => 'List all NocoDB bases the token has access to.',
                'icon' => 'ph:database',
            ],
            'nocodb_get_base' => [
                'class' => NocoDBGetBase::class,
                'type' => 'read',
                'name' => 'Get Base',
                'description' => 'Get details of a single NocoDB base.',
                'icon' => 'ph:database',
            ],
            // Meta: Tables
            'nocodb_list_tables' => [
                'class' => NocoDBListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List all tables in a NocoDB base.',
                'icon' => 'ph:tree-structure',
            ],
            'nocodb_get_table' => [
                'class' => NocoDBGetTable::class,
                'type' => 'read',
                'name' => 'Get Table',
                'description' => 'Get details of a single NocoDB table.',
                'icon' => 'ph:tree-structure',
            ],
            'nocodb_create_table' => [
                'class' => NocoDBCreateTable::class,
                'type' => 'write',
                'name' => 'Create Table',
                'description' => 'Create a new table in a NocoDB base.',
                'icon' => 'ph:table',
            ],
            // Views
            'nocodb_list_views' => [
                'class' => NocoDBListViews::class,
                'type' => 'read',
                'name' => 'List Views',
                'description' => 'List views for a NocoDB table.',
                'icon' => 'ph:eye',
            ],
            // Count
            'nocodb_count_records' => [
                'class' => NocoDBCountRecords::class,
                'type' => 'read',
                'name' => 'Count Records',
                'description' => 'Count records in a NocoDB table with optional filtering.',
                'icon' => 'ph:hash',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/nocodb.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Base URL', 'required' => true],
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
     * Resolve the NocoDBService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): NocoDBService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new NocoDBService(
                apiToken: $creds->get('nocodb', 'api_token', '', $account),
                baseUrl: $creds->get('nocodb', 'base_url', '', $account),
            );
        }

        return app(NocoDBService::class);
    }
}
