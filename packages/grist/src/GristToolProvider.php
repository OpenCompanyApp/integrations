<?php

namespace OpenCompany\Integrations\Grist;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Grist\Tools\GristListWorkspaces;
use OpenCompany\Integrations\Grist\Tools\GristGetWorkspace;
use OpenCompany\Integrations\Grist\Tools\GristListTables;
use OpenCompany\Integrations\Grist\Tools\GristGetTable;
use OpenCompany\Integrations\Grist\Tools\GristListRecords;
use OpenCompany\Integrations\Grist\Tools\GristGetRecord;
use OpenCompany\Integrations\Grist\Tools\GristCreateRecords;
use OpenCompany\Integrations\Grist\Tools\GristUpdateRecords;
use OpenCompany\Integrations\Grist\Tools\GristDeleteRecords;
use OpenCompany\Integrations\Grist\Tools\GristCreateColumn;
use OpenCompany\Integrations\Grist\Tools\GristListColumns;
use OpenCompany\Integrations\Grist\Tools\GristListDocs;
use OpenCompany\Integrations\Grist\Tools\GristGetDoc;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Grist tools and provides integration metadata.
 *
 * Exposes 12 tools covering workspaces, documents, tables, columns,
 * and records via the ToolProvider contract.
 */
class GristToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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

    public function appName(): string
    {
        return 'grist';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Grist',
            'description' => 'Spreadsheets & Database',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:grist',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Grist',
            'description' => 'Workspaces, documents, tables, columns, and records',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:grist',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://support.getgrist.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'your-grist-api-key',
                'hint' => 'Grist API key. Find it in your Grist profile settings under API Keys.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'string',
                'label' => 'Base URL',
                'placeholder' => 'https://docs.getgrist.com/api',
                'hint' => 'Grist API base URL. Use the default for hosted Grist, or your self-hosted URL followed by <code>/api</code>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Grist connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_key' and optionally 'base_url'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = $config['base_url'] ?? 'https://docs.getgrist.com/api';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided. Generate one in your Grist profile settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get(rtrim($baseUrl, '/') . '/orgs');

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['error'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Grist API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $orgCount = count($body);

            return [
                'success' => true,
                'message' => "Connected to Grist. Found {$orgCount} accessible organization(s).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'base_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Workspaces
            'grist_list_workspaces' => [
                'class' => GristListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all workspaces in a Grist organization.',
                'icon' => 'ph:folders',
            ],
            'grist_get_workspace' => [
                'class' => GristGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get details for a single Grist workspace.',
                'icon' => 'ph:folder-open',
            ],
            // Documents
            'grist_list_docs' => [
                'class' => GristListDocs::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List all documents in a Grist organization.',
                'icon' => 'ph:files',
            ],
            'grist_get_doc' => [
                'class' => GristGetDoc::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Get details for a single Grist document.',
                'icon' => 'ph:file',
            ],
            // Tables
            'grist_list_tables' => [
                'class' => GristListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List all tables in a Grist document.',
                'icon' => 'ph:table',
            ],
            'grist_get_table' => [
                'class' => GristGetTable::class,
                'type' => 'read',
                'name' => 'Get Table',
                'description' => 'Get a single table from a Grist document.',
                'icon' => 'ph:table',
            ],
            // Records
            'grist_list_records' => [
                'class' => GristListRecords::class,
                'type' => 'read',
                'name' => 'List Records',
                'description' => 'List records from a Grist table with optional filtering and sorting.',
                'icon' => 'ph:list',
            ],
            'grist_get_record' => [
                'class' => GristGetRecord::class,
                'type' => 'read',
                'name' => 'Get Table Data',
                'description' => 'Get full column data for a Grist table (raw cell values per column).',
                'icon' => 'ph:database',
            ],
            'grist_create_records' => [
                'class' => GristCreateRecords::class,
                'type' => 'write',
                'name' => 'Create Records',
                'description' => 'Create one or more records in a Grist table.',
                'icon' => 'ph:plus-circle',
            ],
            'grist_update_records' => [
                'class' => GristUpdateRecords::class,
                'type' => 'write',
                'name' => 'Update Records',
                'description' => 'Update one or more existing records in a Grist table.',
                'icon' => 'ph:pencil-simple',
            ],
            'grist_delete_records' => [
                'class' => GristDeleteRecords::class,
                'type' => 'write',
                'name' => 'Delete Records',
                'description' => 'Delete records from a Grist table by row IDs.',
                'icon' => 'ph:trash',
            ],
            // Columns
            'grist_create_column' => [
                'class' => GristCreateColumn::class,
                'type' => 'write',
                'name' => 'Create Column',
                'description' => 'Create a new column in a Grist table.',
                'icon' => 'ph:columns',
            ],
            'grist_list_columns' => [
                'class' => GristListColumns::class,
                'type' => 'read',
                'name' => 'List Columns',
                'description' => 'List all columns in a Grist table.',
                'icon' => 'ph:columns',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/grist.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'base_url', 'type' => 'string', 'label' => 'Base URL', 'required' => true],
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
     * Resolve the GristService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): GristService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new GristService(
                apiKey: $creds->get('grist', 'api_key', '', $account),
                baseUrl: $creds->get('grist', 'base_url', 'https://docs.getgrist.com/api', $account),
            );
        }

        return app(GristService::class);
    }
}
