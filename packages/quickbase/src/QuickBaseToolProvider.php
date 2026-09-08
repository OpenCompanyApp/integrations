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

/**
 * Registers the QuickBase integration provider and exposes REST API tools.
 */
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
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.quickbase.com/operation',
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
            'access_token' => 'required|string',
            'realm_hostname' => 'required|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'quickbase_list_apps' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseListApps',
                'type' => 'read',
                'name' => 'List Apps',
                'description' => 'List Quickbase apps available to the authenticated user.',
                'icon' => 'ph:app-window',
                'parameters' => [
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as name, limit, and offset.'],
                ],
            ],
            'quickbase_get_app' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseGetApp',
                'type' => 'read',
                'name' => 'Get App',
                'description' => 'Get metadata for a Quickbase app.',
                'icon' => 'ph:app-window',
                'parameters' => [
                    'appId' => ['type' => 'string', 'required' => true, 'description' => 'The application ID.'],
                ],
            ],
            'quickbase_create_app' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseCreateApp',
                'type' => 'write',
                'name' => 'Create App',
                'description' => 'Create a Quickbase app.',
                'icon' => 'ph:plus-circle',
                'parameters' => [
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'App creation payload.'],
                ],
            ],
            'quickbase_copy_app' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseCopyApp',
                'type' => 'write',
                'name' => 'Copy App',
                'description' => 'Copy an existing Quickbase app.',
                'icon' => 'ph:copy',
                'parameters' => [
                    'appId' => ['type' => 'string', 'required' => true, 'description' => 'The source application ID.'],
                    'body' => ['type' => 'object', 'description' => 'Optional copy settings.'],
                ],
            ],
            'quickbase_delete_app' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseDeleteApp',
                'type' => 'write',
                'name' => 'Delete App',
                'description' => 'Delete a Quickbase app by ID.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'appId' => ['type' => 'string', 'required' => true, 'description' => 'The application ID.'],
                    'name' => ['type' => 'string', 'description' => 'Optional app name confirmation.'],
                ],
            ],
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
            'quickbase_create_table' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseCreateTable',
                'type' => 'write',
                'name' => 'Create Table',
                'description' => 'Create a table in a Quickbase app.',
                'icon' => 'ph:table',
                'parameters' => [
                    'appId' => ['type' => 'string', 'required' => true, 'description' => 'The application ID.'],
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Table creation payload.'],
                ],
            ],
            'quickbase_update_table' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseUpdateTable',
                'type' => 'write',
                'name' => 'Update Table',
                'description' => 'Update Quickbase table metadata.',
                'icon' => 'ph:pencil-simple',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Table attributes to update.'],
                ],
            ],
            'quickbase_delete_table' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseDeleteTable',
                'type' => 'write',
                'name' => 'Delete Table',
                'description' => 'Delete a Quickbase table.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                ],
            ],
            'quickbase_list_fields' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseListFields',
                'type' => 'read',
                'name' => 'List Fields',
                'description' => 'List field definitions in a Quickbase table.',
                'icon' => 'ph:list-checks',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters such as includeFieldPerms.'],
                ],
            ],
            'quickbase_get_field' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseGetField',
                'type' => 'read',
                'name' => 'Get Field',
                'description' => 'Get a Quickbase field definition by field ID.',
                'icon' => 'ph:textbox',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'fieldId' => ['type' => 'integer', 'required' => true, 'description' => 'The field ID.'],
                ],
            ],
            'quickbase_create_field' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseCreateField',
                'type' => 'write',
                'name' => 'Create Field',
                'description' => 'Create a field in a Quickbase table.',
                'icon' => 'ph:textbox',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Field creation payload.'],
                ],
            ],
            'quickbase_update_field' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseUpdateField',
                'type' => 'write',
                'name' => 'Update Field',
                'description' => 'Update field properties in a Quickbase table.',
                'icon' => 'ph:pencil-simple',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'fieldId' => ['type' => 'integer', 'required' => true, 'description' => 'The field ID.'],
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Field attributes to update.'],
                ],
            ],
            'quickbase_delete_field' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseDeleteField',
                'type' => 'write',
                'name' => 'Delete Field',
                'description' => 'Delete a field from a Quickbase table.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'fieldId' => ['type' => 'integer', 'required' => true, 'description' => 'The field ID.'],
                ],
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
            'quickbase_upsert_records' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseUpsertRecords',
                'type' => 'write',
                'name' => 'Upsert Records',
                'description' => 'Upsert one or more Quickbase records, optionally using a merge field.',
                'icon' => 'ph:arrows-clockwise',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'data' => ['type' => 'array', 'required' => true, 'description' => 'Record data array using Quickbase field ID objects.'],
                    'mergeFieldId' => ['type' => 'integer', 'description' => 'Optional merge field ID.'],
                    'fieldsToReturn' => ['type' => 'array', 'description' => 'Optional field IDs to return.'],
                ],
            ],
            'quickbase_delete_records' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseDeleteRecords',
                'type' => 'write',
                'name' => 'Delete Records',
                'description' => 'Delete Quickbase records matching a where clause.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'where' => ['type' => 'string', 'required' => true, 'description' => 'Quickbase query expression selecting records to delete.'],
                ],
            ],
            'quickbase_list_reports' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseListReports',
                'type' => 'read',
                'name' => 'List Reports',
                'description' => 'List reports for a Quickbase table.',
                'icon' => 'ph:chart-bar',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                ],
            ],
            'quickbase_get_report' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseGetReport',
                'type' => 'read',
                'name' => 'Get Report',
                'description' => 'Get metadata for a Quickbase report.',
                'icon' => 'ph:chart-bar',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'reportId' => ['type' => 'string', 'required' => true, 'description' => 'The report ID.'],
                ],
            ],
            'quickbase_run_report' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseRunReport',
                'type' => 'read',
                'name' => 'Run Report',
                'description' => 'Run a Quickbase report and return its data.',
                'icon' => 'ph:play-circle',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'reportId' => ['type' => 'string', 'required' => true, 'description' => 'The report ID.'],
                    'body' => ['type' => 'object', 'description' => 'Optional report run options.'],
                ],
            ],
            'quickbase_list_relationships' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseListRelationships',
                'type' => 'read',
                'name' => 'List Relationships',
                'description' => 'List relationships for a Quickbase table.',
                'icon' => 'ph:tree-structure',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                ],
            ],
            'quickbase_create_relationship' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseCreateRelationship',
                'type' => 'write',
                'name' => 'Create Relationship',
                'description' => 'Create a relationship for a Quickbase table.',
                'icon' => 'ph:tree-structure',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The parent table ID.'],
                    'body' => ['type' => 'object', 'required' => true, 'description' => 'Relationship creation payload.'],
                ],
            ],
            'quickbase_delete_relationship' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseDeleteRelationship',
                'type' => 'write',
                'name' => 'Delete Relationship',
                'description' => 'Delete a Quickbase table relationship.',
                'icon' => 'ph:trash',
                'parameters' => [
                    'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
                    'relationshipId' => ['type' => 'integer', 'required' => true, 'description' => 'The relationship ID.'],
                ],
            ],
            'quickbase_get_current_user' => [
                'class' => QuickBaseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated QuickBase user.',
                'icon' => 'ph:user',
            ],
            'quickbase_api_get' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseApiGet',
                'type' => 'read',
                'name' => 'QuickBase API GET',
                'description' => 'Call a documented Quickbase REST API GET endpoint.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /apps or /fields.'],
                    'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
                ],
            ],
            'quickbase_api_post' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseApiPost',
                'type' => 'write',
                'name' => 'QuickBase API POST',
                'description' => 'Call a documented Quickbase REST API POST endpoint.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /records.'],
                    'body' => ['type' => 'object', 'description' => 'JSON request body.'],
                    'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
                ],
            ],
            'quickbase_api_delete' => [
                'class' => 'OpenCompany\\Integrations\\QuickBase\\Tools\\QuickBaseApiDelete',
                'type' => 'write',
                'name' => 'QuickBase API DELETE',
                'description' => 'Call a documented Quickbase REST API DELETE endpoint.',
                'icon' => 'ph:terminal-window',
                'parameters' => [
                    'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /records.'],
                    'body' => ['type' => 'object', 'description' => 'JSON request body.'],
                    'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
                ],
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/quickbase.md';
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
