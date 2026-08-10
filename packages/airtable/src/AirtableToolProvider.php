<?php

namespace OpenCompany\Integrations\Airtable;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Airtable\Tools\AirtableApiDelete;
use OpenCompany\Integrations\Airtable\Tools\AirtableApiGet;
use OpenCompany\Integrations\Airtable\Tools\AirtableApiPatch;
use OpenCompany\Integrations\Airtable\Tools\AirtableApiPost;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateComment;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateField;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateRecords;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateTable;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateWebhook;
use OpenCompany\Integrations\Airtable\Tools\AirtableDeleteComment;
use OpenCompany\Integrations\Airtable\Tools\AirtableDeleteRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableDeleteRecords;
use OpenCompany\Integrations\Airtable\Tools\AirtableDeleteWebhook;
use OpenCompany\Integrations\Airtable\Tools\AirtableGetBaseSchema;
use OpenCompany\Integrations\Airtable\Tools\AirtableGetCurrentUser;
use OpenCompany\Integrations\Airtable\Tools\AirtableGetRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableListBases;
use OpenCompany\Integrations\Airtable\Tools\AirtableListComments;
use OpenCompany\Integrations\Airtable\Tools\AirtableListRecords;
use OpenCompany\Integrations\Airtable\Tools\AirtableListViews;
use OpenCompany\Integrations\Airtable\Tools\AirtableListWebhookPayloads;
use OpenCompany\Integrations\Airtable\Tools\AirtableListWebhooks;
use OpenCompany\Integrations\Airtable\Tools\AirtableUpdateComment;
use OpenCompany\Integrations\Airtable\Tools\AirtableUpdateField;
use OpenCompany\Integrations\Airtable\Tools\AirtableUpdateRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableUpdateRecords;
use OpenCompany\Integrations\Airtable\Tools\AirtableUpdateTable;
use OpenCompany\Integrations\Airtable\Tools\AirtableUpsertRecords;

/**
 * Tool provider for the Airtable Web API.
 *
 * Registers focused tools for records, base metadata, schema changes,
 * comments, webhooks, and raw API access.
 */
class AirtableToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'oauth2_manual_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Token acquisition may happen outside this package, but the host only needs to store the resulting token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'airtable';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Airtable',
            'description' => 'Spreadsheet database and workflow data',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:airtable',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Airtable',
            'description' => 'Bases, tables, records, comments, schema metadata, and webhooks for Airtable.',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:airtable',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://airtable.com/developers/web/api/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [[
            'key' => 'access_token',
            'type' => 'secret',
            'label' => 'Access Token',
            'placeholder' => 'pat...',
            'hint' => 'Airtable Personal Access Token or OAuth access token.',
            'required' => true,
        ]];
    }

    /**
     * Test the Airtable connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken])
                ->acceptJson()
                ->asJson()
                ->timeout(10)
                ->get('https://api.airtable.com/v0/whoami');

            if ($response->failed()) {
                $body = $response->json() ?? [];
                $error = $body['error']['message'] ?? $body['error']['type'] ?? $response->body();

                return ['success' => false, 'error' => is_string($error) ? $error : json_encode($error)];
            }

            $body = $response->json() ?? [];
            $name = trim((string) ($body['name'] ?? $body['email'] ?? $body['id'] ?? 'Airtable'));

            return ['success' => true, 'message' => "Connected to Airtable as {$name}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return ['access_token' => 'nullable|string'];
    }

    public function tools(): array
    {
        return [
            'airtable_api_get' => [
                'class' => AirtableApiGet::class,
                'type' => 'read',
                'name' => 'Api Get',
                'description' => 'Call any Airtable Web API GET endpoint with query parameters.',
                'icon' => 'ph:table',
            ],
            'airtable_api_post' => [
                'class' => AirtableApiPost::class,
                'type' => 'write',
                'name' => 'Api Post',
                'description' => 'Call any Airtable Web API POST endpoint with a JSON payload.',
                'icon' => 'ph:table',
            ],
            'airtable_api_patch' => [
                'class' => AirtableApiPatch::class,
                'type' => 'write',
                'name' => 'Api Patch',
                'description' => 'Call any Airtable Web API PATCH endpoint with a JSON payload.',
                'icon' => 'ph:table',
            ],
            'airtable_api_delete' => [
                'class' => AirtableApiDelete::class,
                'type' => 'write',
                'name' => 'Api Delete',
                'description' => 'Call any Airtable Web API DELETE endpoint with query parameters.',
                'icon' => 'ph:table',
            ],
            'airtable_get_current_user' => [
                'class' => AirtableGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Airtable user.',
                'icon' => 'ph:table',
            ],
            'airtable_list_bases' => [
                'class' => AirtableListBases::class,
                'type' => 'read',
                'name' => 'List Bases',
                'description' => 'List Airtable bases accessible to the token.',
                'icon' => 'ph:table',
            ],
            'airtable_get_base_schema' => [
                'class' => AirtableGetBaseSchema::class,
                'type' => 'read',
                'name' => 'Get Base Schema',
                'description' => 'Get table, field, and view schema metadata for a base.',
                'icon' => 'ph:table',
            ],
            'airtable_create_table' => [
                'class' => AirtableCreateTable::class,
                'type' => 'write',
                'name' => 'Create Table',
                'description' => 'Create a table in an Airtable base.',
                'icon' => 'ph:table',
            ],
            'airtable_update_table' => [
                'class' => AirtableUpdateTable::class,
                'type' => 'write',
                'name' => 'Update Table',
                'description' => 'Update table metadata in an Airtable base.',
                'icon' => 'ph:table',
            ],
            'airtable_create_field' => [
                'class' => AirtableCreateField::class,
                'type' => 'write',
                'name' => 'Create Field',
                'description' => 'Create a field in an Airtable table.',
                'icon' => 'ph:table',
            ],
            'airtable_update_field' => [
                'class' => AirtableUpdateField::class,
                'type' => 'write',
                'name' => 'Update Field',
                'description' => 'Update field metadata in an Airtable table.',
                'icon' => 'ph:table',
            ],
            'airtable_list_views' => [
                'class' => AirtableListViews::class,
                'type' => 'read',
                'name' => 'List Views',
                'description' => 'List views by reading Airtable base schema metadata.',
                'icon' => 'ph:table',
            ],
            'airtable_list_records' => [
                'class' => AirtableListRecords::class,
                'type' => 'read',
                'name' => 'List Records',
                'description' => 'List records from an Airtable table.',
                'icon' => 'ph:table',
            ],
            'airtable_get_record' => [
                'class' => AirtableGetRecord::class,
                'type' => 'read',
                'name' => 'Get Record',
                'description' => 'Get a single Airtable record.',
                'icon' => 'ph:table',
            ],
            'airtable_create_record' => [
                'class' => AirtableCreateRecord::class,
                'type' => 'write',
                'name' => 'Create Record',
                'description' => 'Create one Airtable record.',
                'icon' => 'ph:table',
            ],
            'airtable_create_records' => [
                'class' => AirtableCreateRecords::class,
                'type' => 'write',
                'name' => 'Create Records',
                'description' => 'Create multiple Airtable records in one request.',
                'icon' => 'ph:table',
            ],
            'airtable_update_record' => [
                'class' => AirtableUpdateRecord::class,
                'type' => 'write',
                'name' => 'Update Record',
                'description' => 'Update one Airtable record.',
                'icon' => 'ph:table',
            ],
            'airtable_update_records' => [
                'class' => AirtableUpdateRecords::class,
                'type' => 'write',
                'name' => 'Update Records',
                'description' => 'Update multiple Airtable records in one request.',
                'icon' => 'ph:table',
            ],
            'airtable_upsert_records' => [
                'class' => AirtableUpsertRecords::class,
                'type' => 'write',
                'name' => 'Upsert Records',
                'description' => 'Create or update records using Airtable performUpsert.',
                'icon' => 'ph:table',
            ],
            'airtable_delete_record' => [
                'class' => AirtableDeleteRecord::class,
                'type' => 'write',
                'name' => 'Delete Record',
                'description' => 'Delete one Airtable record.',
                'icon' => 'ph:table',
            ],
            'airtable_delete_records' => [
                'class' => AirtableDeleteRecords::class,
                'type' => 'write',
                'name' => 'Delete Records',
                'description' => 'Delete multiple Airtable records using records[] query parameters.',
                'icon' => 'ph:table',
            ],
            'airtable_list_comments' => [
                'class' => AirtableListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments for an Airtable record.',
                'icon' => 'ph:table',
            ],
            'airtable_create_comment' => [
                'class' => AirtableCreateComment::class,
                'type' => 'write',
                'name' => 'Create Comment',
                'description' => 'Create a comment on an Airtable record.',
                'icon' => 'ph:table',
            ],
            'airtable_update_comment' => [
                'class' => AirtableUpdateComment::class,
                'type' => 'write',
                'name' => 'Update Comment',
                'description' => 'Update a comment on an Airtable record.',
                'icon' => 'ph:table',
            ],
            'airtable_delete_comment' => [
                'class' => AirtableDeleteComment::class,
                'type' => 'write',
                'name' => 'Delete Comment',
                'description' => 'Delete a comment from an Airtable record.',
                'icon' => 'ph:table',
            ],
            'airtable_list_webhooks' => [
                'class' => AirtableListWebhooks::class,
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List Airtable webhooks for a base.',
                'icon' => 'ph:table',
            ],
            'airtable_create_webhook' => [
                'class' => AirtableCreateWebhook::class,
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create an Airtable webhook for a base.',
                'icon' => 'ph:table',
            ],
            'airtable_delete_webhook' => [
                'class' => AirtableDeleteWebhook::class,
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete an Airtable webhook.',
                'icon' => 'ph:table',
            ],
            'airtable_list_webhook_payloads' => [
                'class' => AirtableListWebhookPayloads::class,
                'type' => 'read',
                'name' => 'List Webhook Payloads',
                'description' => 'List webhook payloads for an Airtable webhook.',
                'icon' => 'ph:table',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/airtable.md';
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
     * Resolve the Airtable service for default or account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): AirtableService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AirtableService(
                accessToken: $creds->get('airtable', 'access_token', '', $account),
            );
        }

        return app(AirtableService::class);
    }
}
