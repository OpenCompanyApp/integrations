<?php

namespace OpenCompany\Integrations\Copper;

use Exception;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Registers the Copper integration provider and exposes its CRM tools.
 *
 * Supports API-key plus user-email authentication, multi-account service
 * resolution, catalog metadata, and one tool per Copper API operation.
 */
class CopperToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Requires the Copper account email in X-PW-UserEmail.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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
        return 'copper';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Copper CRM',
            'description' => 'Google Workspace CRM',
            'icon' => 'ph:users',
            'logo' => 'simple-icons:copper',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Copper CRM',
            'description' => 'CRM for people, companies, opportunities, projects, tasks, activities, pipelines, tags, custom fields, users, and webhooks.',
            'icon' => 'ph:users',
            'logo' => 'simple-icons:copper',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.copper.com/introduction/requests.html',
        ];
    }

    /**
     * Get the configuration schema for the Copper settings UI.
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
                'placeholder' => 'Enter your Copper API key',
                'hint' => 'Generate an API key in Copper Settings > Integrations > API Keys.',
                'required' => true,
            ],
            [
                'key' => 'email',
                'type' => 'email',
                'label' => 'Account Email',
                'placeholder' => 'you@example.test',
                'hint' => 'The email address associated with the Copper API key.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.copper.com/developer_api/v1',
                'default' => 'https://api.copper.com/developer_api/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Copper API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key, email, and optional url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $email = (string) ($config['email'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.copper.com/developer_api/v1'), '/');

        if ($apiKey === '' || $email === '') {
            return ['success' => false, 'error' => 'API key and email are required'];
        }

        try {
            $response = Http::withHeaders([
                'X-PW-AccessToken' => $apiKey,
                'X-PW-Application' => 'developer_api',
                'X-PW-UserEmail' => $email,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Copper API returned HTTP {$response->status()}. Check your credentials.",
                ];
            }

            $user = $response->json() ?? [];
            $name = trim(((string) ($user['first_name'] ?? '')) . ' ' . ((string) ($user['last_name'] ?? '')));
            $identity = $name !== '' ? $name : $email;

            return [
                'success' => true,
                'message' => "Connected to Copper as {$identity}.",
            ];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'email' => 'nullable|email',
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
            'copper_list_contacts' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListContacts', 'type' => 'read', 'name' => 'List Contacts', 'description' => 'Search and list people in Copper.', 'icon' => 'ph:address-book'],
            'copper_get_contact' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetContact', 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Get a Copper person by ID.', 'icon' => 'ph:address-book'],
            'copper_get_contact_by_email' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetContactByEmail', 'type' => 'read', 'name' => 'Get Contact By Email', 'description' => 'Get a Copper person by email.', 'icon' => 'ph:envelope'],
            'copper_create_contact' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperCreateContact', 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create a Copper person.', 'icon' => 'ph:user-plus'],
            'copper_update_contact' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperUpdateContact', 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update a Copper person.', 'icon' => 'ph:pencil-simple'],
            'copper_delete_contact' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperDeleteContact', 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete a Copper person.', 'icon' => 'ph:trash'],
            'copper_list_companies' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListCompanies', 'type' => 'read', 'name' => 'List Companies', 'description' => 'Search and list companies.', 'icon' => 'ph:buildings'],
            'copper_get_company' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetCompany', 'type' => 'read', 'name' => 'Get Company', 'description' => 'Get a company by ID.', 'icon' => 'ph:buildings'],
            'copper_create_company' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperCreateCompany', 'type' => 'write', 'name' => 'Create Company', 'description' => 'Create a company.', 'icon' => 'ph:building-office'],
            'copper_update_company' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperUpdateCompany', 'type' => 'write', 'name' => 'Update Company', 'description' => 'Update a company.', 'icon' => 'ph:pencil-simple'],
            'copper_delete_company' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperDeleteCompany', 'type' => 'write', 'name' => 'Delete Company', 'description' => 'Delete a company.', 'icon' => 'ph:trash'],
            'copper_list_opportunities' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListOpportunities', 'type' => 'read', 'name' => 'List Opportunities', 'description' => 'Search and list opportunities.', 'icon' => 'ph:currency-dollar'],
            'copper_get_opportunity' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetOpportunity', 'type' => 'read', 'name' => 'Get Opportunity', 'description' => 'Get an opportunity by ID.', 'icon' => 'ph:currency-dollar'],
            'copper_create_opportunity' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperCreateOpportunity', 'type' => 'write', 'name' => 'Create Opportunity', 'description' => 'Create an opportunity.', 'icon' => 'ph:plus-circle'],
            'copper_update_opportunity' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperUpdateOpportunity', 'type' => 'write', 'name' => 'Update Opportunity', 'description' => 'Update an opportunity.', 'icon' => 'ph:pencil-simple'],
            'copper_delete_opportunity' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperDeleteOpportunity', 'type' => 'write', 'name' => 'Delete Opportunity', 'description' => 'Delete an opportunity.', 'icon' => 'ph:trash'],
            'copper_list_leads' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListLeads', 'type' => 'read', 'name' => 'List Leads', 'description' => 'Search and list leads.', 'icon' => 'ph:funnel'],
            'copper_get_lead' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetLead', 'type' => 'read', 'name' => 'Get Lead', 'description' => 'Get a lead by ID.', 'icon' => 'ph:user-focus'],
            'copper_create_lead' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperCreateLead', 'type' => 'write', 'name' => 'Create Lead', 'description' => 'Create a lead.', 'icon' => 'ph:plus-circle'],
            'copper_update_lead' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperUpdateLead', 'type' => 'write', 'name' => 'Update Lead', 'description' => 'Update a lead.', 'icon' => 'ph:pencil-simple'],
            'copper_delete_lead' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperDeleteLead', 'type' => 'write', 'name' => 'Delete Lead', 'description' => 'Delete a lead.', 'icon' => 'ph:trash'],
            'copper_list_projects' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListProjects', 'type' => 'read', 'name' => 'List Projects', 'description' => 'Search and list projects.', 'icon' => 'ph:briefcase'],
            'copper_get_project' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetProject', 'type' => 'read', 'name' => 'Get Project', 'description' => 'Get a project by ID.', 'icon' => 'ph:briefcase'],
            'copper_create_project' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperCreateProject', 'type' => 'write', 'name' => 'Create Project', 'description' => 'Create a project.', 'icon' => 'ph:plus-circle'],
            'copper_update_project' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperUpdateProject', 'type' => 'write', 'name' => 'Update Project', 'description' => 'Update a project.', 'icon' => 'ph:pencil-simple'],
            'copper_delete_project' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperDeleteProject', 'type' => 'write', 'name' => 'Delete Project', 'description' => 'Delete a project.', 'icon' => 'ph:trash'],
            'copper_list_tasks' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListTasks', 'type' => 'read', 'name' => 'List Tasks', 'description' => 'Search and list tasks.', 'icon' => 'ph:check-square'],
            'copper_get_task' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetTask', 'type' => 'read', 'name' => 'Get Task', 'description' => 'Get a task by ID.', 'icon' => 'ph:list-checks'],
            'copper_create_task' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperCreateTask', 'type' => 'write', 'name' => 'Create Task', 'description' => 'Create a task.', 'icon' => 'ph:check-square-offset'],
            'copper_update_task' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperUpdateTask', 'type' => 'write', 'name' => 'Update Task', 'description' => 'Update a task.', 'icon' => 'ph:pencil-simple'],
            'copper_delete_task' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperDeleteTask', 'type' => 'write', 'name' => 'Delete Task', 'description' => 'Delete a task.', 'icon' => 'ph:trash'],
            'copper_list_activities' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListActivities', 'type' => 'read', 'name' => 'List Activities', 'description' => 'Search and list activities.', 'icon' => 'ph:list-bullets'],
            'copper_get_activity' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetActivity', 'type' => 'read', 'name' => 'Get Activity', 'description' => 'Get an activity by ID.', 'icon' => 'ph:clock-counter-clockwise'],
            'copper_create_activity' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperCreateActivity', 'type' => 'write', 'name' => 'Create Activity', 'description' => 'Create an activity.', 'icon' => 'ph:plus-circle'],
            'copper_update_activity' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperUpdateActivity', 'type' => 'write', 'name' => 'Update Activity', 'description' => 'Update an activity.', 'icon' => 'ph:pencil-simple'],
            'copper_delete_activity' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperDeleteActivity', 'type' => 'write', 'name' => 'Delete Activity', 'description' => 'Delete an activity.', 'icon' => 'ph:trash'],
            'copper_list_activity_types' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListActivityTypes', 'type' => 'read', 'name' => 'List Activity Types', 'description' => 'List activity types.', 'icon' => 'ph:list-dashes'],
            'copper_get_current_user' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the current API user.', 'icon' => 'ph:identification-badge'],
            'copper_list_users' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListUsers', 'type' => 'read', 'name' => 'List Users', 'description' => 'Search and list users.', 'icon' => 'ph:users-three'],
            'copper_get_user' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetUser', 'type' => 'read', 'name' => 'Get User', 'description' => 'Get a user by ID.', 'icon' => 'ph:user'],
            'copper_get_account_details' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetAccountDetails', 'type' => 'read', 'name' => 'Get Account Details', 'description' => 'Get account details.', 'icon' => 'ph:gear'],
            'copper_list_pipelines' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListPipelines', 'type' => 'read', 'name' => 'List Pipelines', 'description' => 'List sales pipelines.', 'icon' => 'ph:pipeline'],
            'copper_list_pipeline_stages' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListPipelineStages', 'type' => 'read', 'name' => 'List Pipeline Stages', 'description' => 'List pipeline stages.', 'icon' => 'ph:list-dashes'],
            'copper_list_pipeline_stages_in_pipeline' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListPipelineStagesInPipeline', 'type' => 'read', 'name' => 'List Stages In Pipeline', 'description' => 'List stages in one pipeline.', 'icon' => 'ph:list-dashes'],
            'copper_list_lead_statuses' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListLeadStatuses', 'type' => 'read', 'name' => 'List Lead Statuses', 'description' => 'List lead statuses.', 'icon' => 'ph:list-dashes'],
            'copper_list_customer_sources' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListCustomerSources', 'type' => 'read', 'name' => 'List Customer Sources', 'description' => 'List customer sources.', 'icon' => 'ph:tree-structure'],
            'copper_list_loss_reasons' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListLossReasons', 'type' => 'read', 'name' => 'List Loss Reasons', 'description' => 'List opportunity loss reasons.', 'icon' => 'ph:x-circle'],
            'copper_list_contact_types' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListContactTypes', 'type' => 'read', 'name' => 'List Contact Types', 'description' => 'List contact types.', 'icon' => 'ph:address-book-tabs'],
            'copper_list_tags' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListTags', 'type' => 'read', 'name' => 'List Tags', 'description' => 'List tags.', 'icon' => 'ph:tag'],
            'copper_list_custom_field_definitions' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListCustomFieldDefinitions', 'type' => 'read', 'name' => 'List Custom Field Definitions', 'description' => 'List custom field definitions.', 'icon' => 'ph:textbox'],
            'copper_list_webhooks' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperListWebhooks', 'type' => 'read', 'name' => 'List Webhooks', 'description' => 'List webhook subscriptions.', 'icon' => 'ph:webhooks-logo'],
            'copper_get_webhook' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperGetWebhook', 'type' => 'read', 'name' => 'Get Webhook', 'description' => 'Get a webhook subscription.', 'icon' => 'ph:webhooks-logo'],
            'copper_create_webhook' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperCreateWebhook', 'type' => 'write', 'name' => 'Create Webhook', 'description' => 'Create a webhook subscription.', 'icon' => 'ph:plus-circle'],
            'copper_update_webhook' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperUpdateWebhook', 'type' => 'write', 'name' => 'Update Webhook', 'description' => 'Update a webhook subscription.', 'icon' => 'ph:pencil-simple'],
            'copper_delete_webhook' => ['class' => 'OpenCompany\\Integrations\\Copper\\Tools\\CopperDeleteWebhook', 'type' => 'write', 'name' => 'Delete Webhook', 'description' => 'Delete a webhook subscription.', 'icon' => 'ph:trash'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/copper.md';
    }

    /**
     * Get credential field definitions.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'email', 'type' => 'email', 'label' => 'Account Email', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.copper.com/developer_api/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class  Tool class.
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Copper API service, including account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): CopperService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CopperService(
                apiKey: $creds->get('copper', 'api_key', '', $account),
                email: $creds->get('copper', 'email', '', $account),
                baseUrl: $creds->get('copper', 'url', 'https://api.copper.com/developer_api/v1', $account),
            );
        }

        return app(CopperService::class);
    }
}
