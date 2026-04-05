<?php

namespace OpenCompany\Integrations\Airtable;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Airtable\Tools\AirtableBatchCreate;
use OpenCompany\Integrations\Airtable\Tools\AirtableBatchDelete;
use OpenCompany\Integrations\Airtable\Tools\AirtableBatchUpdate;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateField;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableDeleteRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableGetBaseSchema;
use OpenCompany\Integrations\Airtable\Tools\AirtableGetRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableGetRecordAttachments;
use OpenCompany\Integrations\Airtable\Tools\AirtableListBases;
use OpenCompany\Integrations\Airtable\Tools\AirtableListRecords;
use OpenCompany\Integrations\Airtable\Tools\AirtableListViews;
use OpenCompany\Integrations\Airtable\Tools\AirtableSearchRecords;
use OpenCompany\Integrations\Airtable\Tools\AirtableUpdateRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableUpsertRecord;

/**
 * Registers all Airtable tools and provides integration metadata.
 *
 * Exposes 15 tools covering records, batches, bases, schemas,
 * fields, views, attachments, search, and upserts via the ToolProvider contract.
 */
class AirtableToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'airtable';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'bases, tables, records, views',
            'description' => 'Spreadsheets & Database',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:airtable',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Airtable',
            'description' => 'Bases, tables, records, fields, views, and attachments',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:airtable',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://airtable.com/developers/web/api/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'pat...',
                'hint' => 'Airtable Personal Access Token or OAuth access token. Starts with <code>pat</code>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Airtable connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate a Personal Access Token in your Airtable account settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.airtable.com/v0/meta/bases');

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['error']['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Airtable API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $baseCount = count($body['bases'] ?? []);

            return [
                'success' => true,
                'message' => "Connected to Airtable. Found {$baseCount} accessible base(s).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Records
            'airtable_list_records' => [
                'class' => AirtableListRecords::class,
                'type' => 'read',
                'name' => 'List Records',
                'description' => 'List records from an Airtable table with filtering, sorting, and pagination.',
                'icon' => 'ph:list',
            ],
            'airtable_get_record' => [
                'class' => AirtableGetRecord::class,
                'type' => 'read',
                'name' => 'Get Record',
                'description' => 'Get a single Airtable record by ID.',
                'icon' => 'ph:record',
            ],
            'airtable_create_record' => [
                'class' => AirtableCreateRecord::class,
                'type' => 'write',
                'name' => 'Create Record',
                'description' => 'Create a new record in an Airtable table.',
                'icon' => 'ph:plus-circle',
            ],
            'airtable_update_record' => [
                'class' => AirtableUpdateRecord::class,
                'type' => 'write',
                'name' => 'Update Record',
                'description' => 'Update an existing Airtable record.',
                'icon' => 'ph:pencil-simple',
            ],
            'airtable_delete_record' => [
                'class' => AirtableDeleteRecord::class,
                'type' => 'write',
                'name' => 'Delete Record',
                'description' => 'Delete a record from an Airtable table.',
                'icon' => 'ph:trash',
            ],
            // Batch
            'airtable_batch_create' => [
                'class' => AirtableBatchCreate::class,
                'type' => 'write',
                'name' => 'Batch Create Records',
                'description' => 'Create up to 10 records in a single request.',
                'icon' => 'ph:stack-plus',
            ],
            'airtable_batch_update' => [
                'class' => AirtableBatchUpdate::class,
                'type' => 'write',
                'name' => 'Batch Update Records',
                'description' => 'Update up to 10 records in a single request.',
                'icon' => 'ph:stack',
            ],
            'airtable_batch_delete' => [
                'class' => AirtableBatchDelete::class,
                'type' => 'write',
                'name' => 'Batch Delete Records',
                'description' => 'Delete up to 10 records in a single request.',
                'icon' => 'ph:stack-minus',
            ],
            // Meta
            'airtable_list_bases' => [
                'class' => AirtableListBases::class,
                'type' => 'read',
                'name' => 'List Bases',
                'description' => 'List all Airtable bases the token has access to.',
                'icon' => 'ph:database',
            ],
            'airtable_get_base_schema' => [
                'class' => AirtableGetBaseSchema::class,
                'type' => 'read',
                'name' => 'Get Base Schema',
                'description' => 'Get the tables and fields schema for an Airtable base.',
                'icon' => 'ph:tree-structure',
            ],
            'airtable_create_field' => [
                'class' => AirtableCreateField::class,
                'type' => 'write',
                'name' => 'Create Field',
                'description' => 'Create a new field in an Airtable table.',
                'icon' => 'ph:columns',
            ],
            'airtable_list_views' => [
                'class' => AirtableListViews::class,
                'type' => 'read',
                'name' => 'List Views',
                'description' => 'List views for an Airtable base.',
                'icon' => 'ph:eye',
            ],
            // Attachments & Search
            'airtable_get_record_attachments' => [
                'class' => AirtableGetRecordAttachments::class,
                'type' => 'read',
                'name' => 'Get Record Attachments',
                'description' => 'Get attachment URLs from a specific field on a record.',
                'icon' => 'ph:paperclip',
            ],
            'airtable_upsert_record' => [
                'class' => AirtableUpsertRecord::class,
                'type' => 'write',
                'name' => 'Upsert Record',
                'description' => 'Create or update a record based on field matching.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'airtable_search_records' => [
                'class' => AirtableSearchRecords::class,
                'type' => 'read',
                'name' => 'Search Records',
                'description' => 'Search records using an Airtable formula expression.',
                'icon' => 'ph:magnifying-glass',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/airtable.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
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
     * Resolve the AirtableService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): AirtableService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new AirtableService(
                accessToken: $creds->get('airtable', 'access_token', '', $account),
            );
        }

        return app(AirtableService::class);
    }
}
