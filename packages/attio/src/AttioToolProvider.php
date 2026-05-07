<?php

namespace OpenCompany\Integrations\Attio;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Attio\Tools\AttioApiDelete;
use OpenCompany\Integrations\Attio\Tools\AttioApiGet;
use OpenCompany\Integrations\Attio\Tools\AttioApiPatch;
use OpenCompany\Integrations\Attio\Tools\AttioApiPost;
use OpenCompany\Integrations\Attio\Tools\AttioApiPut;
use OpenCompany\Integrations\Attio\Tools\AttioCreateAttribute;
use OpenCompany\Integrations\Attio\Tools\AttioCreateEntry;
use OpenCompany\Integrations\Attio\Tools\AttioCreateList;
use OpenCompany\Integrations\Attio\Tools\AttioCreateNote;
use OpenCompany\Integrations\Attio\Tools\AttioCreateRecord;
use OpenCompany\Integrations\Attio\Tools\AttioCreateTask;
use OpenCompany\Integrations\Attio\Tools\AttioDeleteEntry;
use OpenCompany\Integrations\Attio\Tools\AttioDeleteRecord;
use OpenCompany\Integrations\Attio\Tools\AttioDeleteTask;
use OpenCompany\Integrations\Attio\Tools\AttioGetAttribute;
use OpenCompany\Integrations\Attio\Tools\AttioGetCurrentUser;
use OpenCompany\Integrations\Attio\Tools\AttioGetEntry;
use OpenCompany\Integrations\Attio\Tools\AttioGetList;
use OpenCompany\Integrations\Attio\Tools\AttioGetObject;
use OpenCompany\Integrations\Attio\Tools\AttioGetRecord;
use OpenCompany\Integrations\Attio\Tools\AttioListAttributes;
use OpenCompany\Integrations\Attio\Tools\AttioListEntries;
use OpenCompany\Integrations\Attio\Tools\AttioListLists;
use OpenCompany\Integrations\Attio\Tools\AttioListNotes;
use OpenCompany\Integrations\Attio\Tools\AttioListObjects;
use OpenCompany\Integrations\Attio\Tools\AttioListRecordEntries;
use OpenCompany\Integrations\Attio\Tools\AttioListRecords;
use OpenCompany\Integrations\Attio\Tools\AttioListTasks;
use OpenCompany\Integrations\Attio\Tools\AttioListWebhooks;
use OpenCompany\Integrations\Attio\Tools\AttioListWorkspaces;
use OpenCompany\Integrations\Attio\Tools\AttioUpdateEntry;
use OpenCompany\Integrations\Attio\Tools\AttioUpdateList;
use OpenCompany\Integrations\Attio\Tools\AttioUpdateRecord;
use OpenCompany\Integrations\Attio\Tools\AttioUpdateTask;

/**
 * Tool provider for Attio CRM APIs.
 *
 * Exposes typed tools for records, objects, attributes, lists, entries, notes,
 * tasks, and webhooks plus raw API helpers for newer Attio endpoints.
 */
class AttioToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => [],
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
        return 'attio';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Attio',
            'description' => 'CRM records, lists, notes, and tasks',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:attio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Attio',
            'description' => 'CRM records, objects, lists, entries, attributes, notes, tasks, and webhooks',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:attio',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.attio.com/rest-api/endpoint-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Attio API access token',
                'hint' => 'Generate an access token in your Attio workspace settings under API Keys',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.attio.com',
                'hint' => 'Use the default Attio API URL, or a custom endpoint if applicable',
                'default' => 'https://api.attio.com',
            ],
        ];
    }

    /**
     * Test the connection to the Attio API using the provided config.
     *
     * @param  array<string, mixed>  $config  The configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.attio.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/self');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Attio API error (' . $response->status() . '): ' . $response->body()];
            }

            $json = $response->json();

            if (!is_array($json)) {
                return ['success' => false, 'error' => "Could not reach Attio API at {$baseUrl}. Check the URL."];
            }

            $userName = $json['data']['first_name'] ?? $json['data']['email_address'] ?? 'authenticated user';

            return ['success' => true, 'message' => "Connected to Attio API as {$userName}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'attio_api_get' => ['class' => AttioApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call any Attio GET endpoint.', 'icon' => 'ph:plug'],
            'attio_api_post' => ['class' => AttioApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call any Attio POST endpoint.', 'icon' => 'ph:plug'],
            'attio_api_patch' => ['class' => AttioApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call any Attio PATCH endpoint.', 'icon' => 'ph:plug'],
            'attio_api_put' => ['class' => AttioApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call any Attio PUT endpoint.', 'icon' => 'ph:plug'],
            'attio_api_delete' => ['class' => AttioApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call any Attio DELETE endpoint.', 'icon' => 'ph:plug'],

            'attio_list_workspaces' => ['class' => AttioListWorkspaces::class, 'type' => 'read', 'name' => 'List Workspaces', 'description' => 'List all workspaces accessible to the authenticated user.', 'icon' => 'ph:buildings'],
            'attio_get_current_user' => ['class' => AttioGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the currently authenticated user profile.', 'icon' => 'ph:user'],
            'attio_list_objects' => ['class' => AttioListObjects::class, 'type' => 'read', 'name' => 'List Objects', 'description' => 'List all object types in the workspace.', 'icon' => 'ph:squares-four'],
            'attio_get_object' => ['class' => AttioGetObject::class, 'type' => 'read', 'name' => 'Get Object', 'description' => 'Get details for a specific object type.', 'icon' => 'ph:square'],
            'attio_list_attributes' => ['class' => AttioListAttributes::class, 'type' => 'read', 'name' => 'List Attributes', 'description' => 'List object or list attributes.', 'icon' => 'ph:list-bullets'],
            'attio_get_attribute' => ['class' => AttioGetAttribute::class, 'type' => 'read', 'name' => 'Get Attribute', 'description' => 'Get an object or list attribute.', 'icon' => 'ph:tag'],
            'attio_create_attribute' => ['class' => AttioCreateAttribute::class, 'type' => 'write', 'name' => 'Create Attribute', 'description' => 'Create an object or list attribute.', 'icon' => 'ph:plus'],

            'attio_list_records' => ['class' => AttioListRecords::class, 'type' => 'read', 'name' => 'List Records', 'description' => 'List records for an object type with filtering, sorting, and pagination.', 'icon' => 'ph:list'],
            'attio_get_record' => ['class' => AttioGetRecord::class, 'type' => 'read', 'name' => 'Get Record', 'description' => 'Get a single record by ID.', 'icon' => 'ph:eye'],
            'attio_create_record' => ['class' => AttioCreateRecord::class, 'type' => 'write', 'name' => 'Create Record', 'description' => 'Create a new record for an object type.', 'icon' => 'ph:plus'],
            'attio_update_record' => ['class' => AttioUpdateRecord::class, 'type' => 'write', 'name' => 'Update Record', 'description' => 'Update a record for an object type.', 'icon' => 'ph:pencil-simple'],
            'attio_delete_record' => ['class' => AttioDeleteRecord::class, 'type' => 'write', 'name' => 'Delete Record', 'description' => 'Delete a record for an object type.', 'icon' => 'ph:trash'],
            'attio_list_record_entries' => ['class' => AttioListRecordEntries::class, 'type' => 'read', 'name' => 'List Record Entries', 'description' => 'List list entries for a record.', 'icon' => 'ph:list-checks'],

            'attio_list_lists' => ['class' => AttioListLists::class, 'type' => 'read', 'name' => 'List Lists', 'description' => 'List Attio lists.', 'icon' => 'ph:list'],
            'attio_get_list' => ['class' => AttioGetList::class, 'type' => 'read', 'name' => 'Get List', 'description' => 'Get an Attio list.', 'icon' => 'ph:list-dashes'],
            'attio_create_list' => ['class' => AttioCreateList::class, 'type' => 'write', 'name' => 'Create List', 'description' => 'Create an Attio list.', 'icon' => 'ph:plus'],
            'attio_update_list' => ['class' => AttioUpdateList::class, 'type' => 'write', 'name' => 'Update List', 'description' => 'Update an Attio list.', 'icon' => 'ph:pencil-simple'],
            'attio_list_entries' => ['class' => AttioListEntries::class, 'type' => 'read', 'name' => 'List Entries', 'description' => 'Query entries in an Attio list.', 'icon' => 'ph:list-checks'],
            'attio_create_entry' => ['class' => AttioCreateEntry::class, 'type' => 'write', 'name' => 'Create Entry', 'description' => 'Add a record to an Attio list.', 'icon' => 'ph:plus'],
            'attio_get_entry' => ['class' => AttioGetEntry::class, 'type' => 'read', 'name' => 'Get Entry', 'description' => 'Get an Attio list entry.', 'icon' => 'ph:eye'],
            'attio_update_entry' => ['class' => AttioUpdateEntry::class, 'type' => 'write', 'name' => 'Update Entry', 'description' => 'Update an Attio list entry.', 'icon' => 'ph:pencil-simple'],
            'attio_delete_entry' => ['class' => AttioDeleteEntry::class, 'type' => 'write', 'name' => 'Delete Entry', 'description' => 'Delete an Attio list entry.', 'icon' => 'ph:trash'],

            'attio_list_notes' => ['class' => AttioListNotes::class, 'type' => 'read', 'name' => 'List Notes', 'description' => 'List Attio notes.', 'icon' => 'ph:note'],
            'attio_create_note' => ['class' => AttioCreateNote::class, 'type' => 'write', 'name' => 'Create Note', 'description' => 'Create an Attio note.', 'icon' => 'ph:note-pencil'],
            'attio_list_tasks' => ['class' => AttioListTasks::class, 'type' => 'read', 'name' => 'List Tasks', 'description' => 'List Attio tasks.', 'icon' => 'ph:check-square'],
            'attio_create_task' => ['class' => AttioCreateTask::class, 'type' => 'write', 'name' => 'Create Task', 'description' => 'Create an Attio task.', 'icon' => 'ph:plus'],
            'attio_update_task' => ['class' => AttioUpdateTask::class, 'type' => 'write', 'name' => 'Update Task', 'description' => 'Update an Attio task.', 'icon' => 'ph:pencil-simple'],
            'attio_delete_task' => ['class' => AttioDeleteTask::class, 'type' => 'write', 'name' => 'Delete Task', 'description' => 'Delete an Attio task.', 'icon' => 'ph:trash'],
            'attio_list_webhooks' => ['class' => AttioListWebhooks::class, 'type' => 'read', 'name' => 'List Webhooks', 'description' => 'List Attio webhooks.', 'icon' => 'ph:webhooks-logo'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/attio.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.attio.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Optional context containing an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve default or account-specific Attio credentials.
     *
     * @param  array<string, mixed>  $context  Optional context containing an account key.
     */
    private function resolveService(array $context = []): AttioService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AttioService(
                accessToken: $creds->get('attio', 'access_token', '', $account),
                baseUrl: $creds->get('attio', 'base_url', 'https://api.attio.com', $account),
            );
        }

        return app(AttioService::class);
    }
}
