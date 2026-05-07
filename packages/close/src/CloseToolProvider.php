<?php

namespace OpenCompany\Integrations\Close;

use Exception;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Registers the Close integration provider and exposes its CRM tools.
 *
 * Supports API-key configuration, multi-account service resolution, catalog
 * metadata, Lua documentation lookup, and one tool per Close API operation.
 */
class CloseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
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
        return 'close';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Close CRM',
            'description' => 'Sales CRM and engagement platform',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:close',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Close CRM',
            'description' => 'Sales CRM for leads, contacts, opportunities, tasks, notes, users, statuses, and pipelines.',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:close',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.close.com/api/overview',
        ];
    }

    /**
     * Get the configuration schema for the Close integration settings UI.
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
                'placeholder' => 'Enter your Close API key',
                'hint' => 'Generate an API key in Close under Settings > API Keys.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.close.com/api/v1',
                'hint' => 'Change only if using a custom Close-compatible API endpoint.',
                'default' => 'https://api.close.com/api/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Close API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key and optionally url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.close.com/api/v1'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, '')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/me/');

            $json = $response->json();

            if (! $response->successful()) {
                return [
                    'success' => false,
                    'error' => 'Close API returned HTTP ' . $response->status(),
                ];
            }

            if (! is_array($json)) {
                return [
                    'success' => false,
                    'error' => "Could not reach Close API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = trim(((string) ($json['first_name'] ?? '')) . ' ' . ((string) ($json['last_name'] ?? '')));
            $identity = $name !== '' ? $name : (string) ($json['email'] ?? 'authenticated user');

            return [
                'success' => true,
                'message' => "Connected to Close API as {$identity}.",
            ];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'close_list_leads' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListLeads', 'type' => 'read', 'name' => 'List Leads', 'description' => 'Search and list leads in Close.', 'icon' => 'ph:magnifying-glass'],
            'close_get_lead' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseGetLead', 'type' => 'read', 'name' => 'Get Lead', 'description' => 'Get details for a single lead.', 'icon' => 'ph:buildings'],
            'close_create_lead' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseCreateLead', 'type' => 'write', 'name' => 'Create Lead', 'description' => 'Create a new lead with contacts.', 'icon' => 'ph:plus-circle'],
            'close_update_lead' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseUpdateLead', 'type' => 'write', 'name' => 'Update Lead', 'description' => 'Update an existing lead.', 'icon' => 'ph:pencil-simple'],
            'close_delete_lead' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseDeleteLead', 'type' => 'write', 'name' => 'Delete Lead', 'description' => 'Delete a lead.', 'icon' => 'ph:trash'],
            'close_list_contacts' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListContacts', 'type' => 'read', 'name' => 'List Contacts', 'description' => 'List contacts in Close.', 'icon' => 'ph:users'],
            'close_get_contact' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseGetContact', 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Get a single contact.', 'icon' => 'ph:user'],
            'close_create_contact' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseCreateContact', 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create a contact on a lead.', 'icon' => 'ph:user-plus'],
            'close_update_contact' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseUpdateContact', 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update a contact.', 'icon' => 'ph:pencil-simple'],
            'close_delete_contact' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseDeleteContact', 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete a contact.', 'icon' => 'ph:user-minus'],
            'close_list_opportunities' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListOpportunities', 'type' => 'read', 'name' => 'List Opportunities', 'description' => 'List or filter opportunities.', 'icon' => 'ph:chart-line-up'],
            'close_get_opportunity' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseGetOpportunity', 'type' => 'read', 'name' => 'Get Opportunity', 'description' => 'Get a single opportunity.', 'icon' => 'ph:target'],
            'close_create_opportunity' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseCreateOpportunity', 'type' => 'write', 'name' => 'Create Opportunity', 'description' => 'Create an opportunity.', 'icon' => 'ph:plus-circle'],
            'close_update_opportunity' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseUpdateOpportunity', 'type' => 'write', 'name' => 'Update Opportunity', 'description' => 'Update an opportunity.', 'icon' => 'ph:pencil-simple'],
            'close_delete_opportunity' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseDeleteOpportunity', 'type' => 'write', 'name' => 'Delete Opportunity', 'description' => 'Delete an opportunity.', 'icon' => 'ph:trash'],
            'close_list_tasks' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListTasks', 'type' => 'read', 'name' => 'List Tasks', 'description' => 'List or filter tasks.', 'icon' => 'ph:check-square'],
            'close_create_task' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseCreateTask', 'type' => 'write', 'name' => 'Create Task', 'description' => 'Create a new task.', 'icon' => 'ph:check-square-offset'],
            'close_get_task' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseGetTask', 'type' => 'read', 'name' => 'Get Task', 'description' => 'Get a single task.', 'icon' => 'ph:list-checks'],
            'close_update_task' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseUpdateTask', 'type' => 'write', 'name' => 'Update Task', 'description' => 'Update a task.', 'icon' => 'ph:pencil-simple'],
            'close_delete_task' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseDeleteTask', 'type' => 'write', 'name' => 'Delete Task', 'description' => 'Delete a task.', 'icon' => 'ph:trash'],
            'close_list_activities' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListActivities', 'type' => 'read', 'name' => 'List Activities', 'description' => 'List activities across types.', 'icon' => 'ph:list-bullets'],
            'close_list_notes' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListNotes', 'type' => 'read', 'name' => 'List Notes', 'description' => 'List note activities.', 'icon' => 'ph:note'],
            'close_get_note' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseGetNote', 'type' => 'read', 'name' => 'Get Note', 'description' => 'Get a note activity.', 'icon' => 'ph:note-pencil'],
            'close_create_note' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseCreateNote', 'type' => 'write', 'name' => 'Create Note', 'description' => 'Create a note activity.', 'icon' => 'ph:note-pencil'],
            'close_update_note' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseUpdateNote', 'type' => 'write', 'name' => 'Update Note', 'description' => 'Update a note activity.', 'icon' => 'ph:pencil-simple'],
            'close_delete_note' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseDeleteNote', 'type' => 'write', 'name' => 'Delete Note', 'description' => 'Delete a note activity.', 'icon' => 'ph:trash'],
            'close_get_current_user' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get authenticated user profile.', 'icon' => 'ph:user-circle'],
            'close_list_users' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListUsers', 'type' => 'read', 'name' => 'List Users', 'description' => 'List users in the organization.', 'icon' => 'ph:users-three'],
            'close_get_user' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseGetUser', 'type' => 'read', 'name' => 'Get User', 'description' => 'Get a single user.', 'icon' => 'ph:user'],
            'close_list_user_availability' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListUserAvailability', 'type' => 'read', 'name' => 'List User Availability', 'description' => 'List user availability statuses.', 'icon' => 'ph:user-sound'],
            'close_list_lead_statuses' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListLeadStatuses', 'type' => 'read', 'name' => 'List Lead Statuses', 'description' => 'List configured lead statuses.', 'icon' => 'ph:list-dashes'],
            'close_create_lead_status' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseCreateLeadStatus', 'type' => 'write', 'name' => 'Create Lead Status', 'description' => 'Create a lead status.', 'icon' => 'ph:plus-circle'],
            'close_update_lead_status' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseUpdateLeadStatus', 'type' => 'write', 'name' => 'Update Lead Status', 'description' => 'Rename a lead status.', 'icon' => 'ph:pencil-simple'],
            'close_delete_lead_status' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseDeleteLeadStatus', 'type' => 'write', 'name' => 'Delete Lead Status', 'description' => 'Delete a lead status.', 'icon' => 'ph:trash'],
            'close_list_opportunity_statuses' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListOpportunityStatuses', 'type' => 'read', 'name' => 'List Opportunity Statuses', 'description' => 'List configured opportunity statuses.', 'icon' => 'ph:list-dashes'],
            'close_create_opportunity_status' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseCreateOpportunityStatus', 'type' => 'write', 'name' => 'Create Opportunity Status', 'description' => 'Create an opportunity status.', 'icon' => 'ph:plus-circle'],
            'close_update_opportunity_status' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseUpdateOpportunityStatus', 'type' => 'write', 'name' => 'Update Opportunity Status', 'description' => 'Update an opportunity status.', 'icon' => 'ph:pencil-simple'],
            'close_delete_opportunity_status' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseDeleteOpportunityStatus', 'type' => 'write', 'name' => 'Delete Opportunity Status', 'description' => 'Delete an opportunity status.', 'icon' => 'ph:trash'],
            'close_list_pipelines' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseListPipelines', 'type' => 'read', 'name' => 'List Pipelines', 'description' => 'List configured pipelines.', 'icon' => 'ph:git-branch'],
            'close_create_pipeline' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseCreatePipeline', 'type' => 'write', 'name' => 'Create Pipeline', 'description' => 'Create a pipeline.', 'icon' => 'ph:plus-circle'],
            'close_update_pipeline' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseUpdatePipeline', 'type' => 'write', 'name' => 'Update Pipeline', 'description' => 'Update a pipeline.', 'icon' => 'ph:pencil-simple'],
            'close_delete_pipeline' => ['class' => 'OpenCompany\\Integrations\\Close\\Tools\\CloseDeletePipeline', 'type' => 'write', 'name' => 'Delete Pipeline', 'description' => 'Delete a pipeline.', 'icon' => 'ph:trash'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/close.md';
    }

    /**
     * Get credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.close.com/api/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Close API service, including account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): CloseService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CloseService(
                apiKey: $creds->get('close', 'api_key', '', $account),
                baseUrl: $creds->get('close', 'url', 'https://api.close.com/api/v1', $account),
            );
        }

        return app(CloseService::class);
    }

}
