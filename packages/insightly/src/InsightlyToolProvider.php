<?php

namespace OpenCompany\Integrations\Insightly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Registers Insightly CRM tools and setup metadata.
 *
 * Exposes CRM records, search, activity, user/team, and reference-data
 * operations from the Insightly v3.1 REST API.
 */
class InsightlyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'basic_api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Insightly expects Authorization: Basic base64(api_key).'],
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
        return 'insightly';
    }

    /**
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Insightly CRM',
            'description' => 'CRM, project, task, event, team, and pipeline operations',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:insightly',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Insightly CRM',
            'description' => 'CRM platform for contacts, organizations, leads, opportunities, projects, activities, and reference data.',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:insightly',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.na1.insightly.com/v3.1/Help',
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Insightly API key',
                'hint' => 'Find the API key and API URL under Insightly User Settings.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.na1.insightly.com',
                'hint' => 'Use the API URL shown in Insightly User Settings. Defaults to the North America pod.',
                'default' => 'https://api.na1.insightly.com',
            ],
        ];
    }

    /**
     * Test the connection to the Insightly API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key and base_url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.na1.insightly.com', '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No Insightly API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode((string) $apiKey),
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v3.1/Users/Me');

            if ($response->successful()) {
                $user = $response->json();
                $name = trim(($user['FIRST_NAME'] ?? '') . ' ' . ($user['LAST_NAME'] ?? ''));

                return [
                    'success' => true,
                    'message' => $name !== '' ? "Connected to Insightly API as {$name}." : 'Connected to Insightly API.',
                ];
            }

            return [
                'success' => false,
                'error' => "API returned HTTP {$response->status()}. Check your API key and base URL.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'insightly_create_contact' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateContact', 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create Contact via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_event' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateEvent', 'type' => 'write', 'name' => 'Create Event', 'description' => 'Create Event via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_lead' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateLead', 'type' => 'write', 'name' => 'Create Lead', 'description' => 'Create Lead via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_note_comment' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateNoteComment', 'type' => 'write', 'name' => 'Create Note Comment', 'description' => 'Create Note Comment via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_opportunity' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateOpportunity', 'type' => 'write', 'name' => 'Create Opportunity', 'description' => 'Create Opportunity via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_organization' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateOrganization', 'type' => 'write', 'name' => 'Create Organization', 'description' => 'Create Organization via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_project' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateProject', 'type' => 'write', 'name' => 'Create Project', 'description' => 'Create Project via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_task' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateTask', 'type' => 'write', 'name' => 'Create Task', 'description' => 'Create Task via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_task_category' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateTaskCategory', 'type' => 'write', 'name' => 'Create Task Category', 'description' => 'Create Task Category via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_team' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateTeam', 'type' => 'write', 'name' => 'Create Team', 'description' => 'Create Team via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_create_team_member' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyCreateTeamMember', 'type' => 'write', 'name' => 'Create Team Member', 'description' => 'Create Team Member via Insightly.', 'icon' => 'ph:plus-circle'],
            'insightly_delete_contact' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteContact', 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete Contact via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_event' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteEvent', 'type' => 'write', 'name' => 'Delete Event', 'description' => 'Delete Event via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_lead' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteLead', 'type' => 'write', 'name' => 'Delete Lead', 'description' => 'Delete Lead via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_note' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteNote', 'type' => 'write', 'name' => 'Delete Note', 'description' => 'Delete Note via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_note_comment' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteNoteComment', 'type' => 'write', 'name' => 'Delete Note Comment', 'description' => 'Delete Note Comment via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_opportunity' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteOpportunity', 'type' => 'write', 'name' => 'Delete Opportunity', 'description' => 'Delete Opportunity via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_organization' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteOrganization', 'type' => 'write', 'name' => 'Delete Organization', 'description' => 'Delete Organization via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_project' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteProject', 'type' => 'write', 'name' => 'Delete Project', 'description' => 'Delete Project via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_task' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteTask', 'type' => 'write', 'name' => 'Delete Task', 'description' => 'Delete Task via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_task_category' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteTaskCategory', 'type' => 'write', 'name' => 'Delete Task Category', 'description' => 'Delete Task Category via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_team' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteTeam', 'type' => 'write', 'name' => 'Delete Team', 'description' => 'Delete Team via Insightly.', 'icon' => 'ph:trash'],
            'insightly_delete_team_member' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyDeleteTeamMember', 'type' => 'write', 'name' => 'Delete Team Member', 'description' => 'Delete Team Member via Insightly.', 'icon' => 'ph:trash'],
            'insightly_get_activity_set' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetActivitySet', 'type' => 'read', 'name' => 'Get Activity Set', 'description' => 'Get Activity Set via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_contact' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetContact', 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Get Contact via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_current_user' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get Current User via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_event' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetEvent', 'type' => 'read', 'name' => 'Get Event', 'description' => 'Get Event via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_instance' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetInstance', 'type' => 'read', 'name' => 'Get Instance', 'description' => 'Get Instance via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_lead' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetLead', 'type' => 'read', 'name' => 'Get Lead', 'description' => 'Get Lead via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_note' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetNote', 'type' => 'read', 'name' => 'Get Note', 'description' => 'Get Note via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_opportunity' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetOpportunity', 'type' => 'read', 'name' => 'Get Opportunity', 'description' => 'Get Opportunity via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_organization' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetOrganization', 'type' => 'read', 'name' => 'Get Organization', 'description' => 'Get Organization via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_pipeline' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetPipeline', 'type' => 'read', 'name' => 'Get Pipeline', 'description' => 'Get Pipeline via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_pipeline_stage' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetPipelineStage', 'type' => 'read', 'name' => 'Get Pipeline Stage', 'description' => 'Get Pipeline Stage via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_project' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetProject', 'type' => 'read', 'name' => 'Get Project', 'description' => 'Get Project via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_task' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetTask', 'type' => 'read', 'name' => 'Get Task', 'description' => 'Get Task via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_task_category' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetTaskCategory', 'type' => 'read', 'name' => 'Get Task Category', 'description' => 'Get Task Category via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_team' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetTeam', 'type' => 'read', 'name' => 'Get Team', 'description' => 'Get Team via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_team_member' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetTeamMember', 'type' => 'read', 'name' => 'Get Team Member', 'description' => 'Get Team Member via Insightly.', 'icon' => 'ph:info'],
            'insightly_get_user' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyGetUser', 'type' => 'read', 'name' => 'Get User', 'description' => 'Get User via Insightly.', 'icon' => 'ph:info'],
            'insightly_list_activity_sets' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListActivitySets', 'type' => 'read', 'name' => 'List Activity Sets', 'description' => 'List Activity Sets via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_contacts' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListContacts', 'type' => 'read', 'name' => 'List Contacts', 'description' => 'List Contacts via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_countries' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListCountries', 'type' => 'read', 'name' => 'List Countries', 'description' => 'List Countries via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_currencies' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListCurrencies', 'type' => 'read', 'name' => 'List Currencies', 'description' => 'List Currencies via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_custom_fields' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListCustomFields', 'type' => 'read', 'name' => 'List Custom Fields', 'description' => 'List Custom Fields via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_events' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListEvents', 'type' => 'read', 'name' => 'List Events', 'description' => 'List Events via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_lead_sources' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListLeadSources', 'type' => 'read', 'name' => 'List Lead Sources', 'description' => 'List Lead Sources via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_lead_statuses' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListLeadStatuses', 'type' => 'read', 'name' => 'List Lead Statuses', 'description' => 'List Lead Statuses via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_leads' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListLeads', 'type' => 'read', 'name' => 'List Leads', 'description' => 'List Leads via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_note_comments' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListNoteComments', 'type' => 'read', 'name' => 'List Note Comments', 'description' => 'List Note Comments via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_notes' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListNotes', 'type' => 'read', 'name' => 'List Notes', 'description' => 'List Notes via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_opportunities' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListOpportunities', 'type' => 'read', 'name' => 'List Opportunities', 'description' => 'List Opportunities via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_opportunity_categories' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListOpportunityCategories', 'type' => 'read', 'name' => 'List Opportunity Categories', 'description' => 'List Opportunity Categories via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_organizations' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListOrganizations', 'type' => 'read', 'name' => 'List Organizations', 'description' => 'List Organizations via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_permissions' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListPermissions', 'type' => 'read', 'name' => 'List Permissions', 'description' => 'List Permissions via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_pipeline_stages' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListPipelineStages', 'type' => 'read', 'name' => 'List Pipeline Stages', 'description' => 'List Pipeline Stages via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_pipelines' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListPipelines', 'type' => 'read', 'name' => 'List Pipelines', 'description' => 'List Pipelines via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_project_categories' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListProjectCategories', 'type' => 'read', 'name' => 'List Project Categories', 'description' => 'List Project Categories via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_projects' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListProjects', 'type' => 'read', 'name' => 'List Projects', 'description' => 'List Projects via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_tags' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListTags', 'type' => 'read', 'name' => 'List Tags', 'description' => 'List Tags via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_task_categories' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListTaskCategories', 'type' => 'read', 'name' => 'List Task Categories', 'description' => 'List Task Categories via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_tasks' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListTasks', 'type' => 'read', 'name' => 'List Tasks', 'description' => 'List Tasks via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_team_members' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListTeamMembers', 'type' => 'read', 'name' => 'List Team Members', 'description' => 'List Team Members via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_teams' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListTeams', 'type' => 'read', 'name' => 'List Teams', 'description' => 'List Teams via Insightly.', 'icon' => 'ph:list'],
            'insightly_list_users' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyListUsers', 'type' => 'read', 'name' => 'List Users', 'description' => 'List Users via Insightly.', 'icon' => 'ph:list'],
            'insightly_search_contacts' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchContacts', 'type' => 'read', 'name' => 'Search Contacts', 'description' => 'Search Contacts via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_contacts_by_tag' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchContactsByTag', 'type' => 'read', 'name' => 'Search Contacts By Tag', 'description' => 'Search Contacts By Tag via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_custom_fields' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchCustomFields', 'type' => 'read', 'name' => 'Search Custom Fields', 'description' => 'Search Custom Fields via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_events' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchEvents', 'type' => 'read', 'name' => 'Search Events', 'description' => 'Search Events via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_leads' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchLeads', 'type' => 'read', 'name' => 'Search Leads', 'description' => 'Search Leads via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_leads_by_tag' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchLeadsByTag', 'type' => 'read', 'name' => 'Search Leads By Tag', 'description' => 'Search Leads By Tag via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_notes' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchNotes', 'type' => 'read', 'name' => 'Search Notes', 'description' => 'Search Notes via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_opportunities' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchOpportunities', 'type' => 'read', 'name' => 'Search Opportunities', 'description' => 'Search Opportunities via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_opportunities_by_tag' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchOpportunitiesByTag', 'type' => 'read', 'name' => 'Search Opportunities By Tag', 'description' => 'Search Opportunities By Tag via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_organizations' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchOrganizations', 'type' => 'read', 'name' => 'Search Organizations', 'description' => 'Search Organizations via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_organizations_by_tag' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchOrganizationsByTag', 'type' => 'read', 'name' => 'Search Organizations By Tag', 'description' => 'Search Organizations By Tag via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_projects' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchProjects', 'type' => 'read', 'name' => 'Search Projects', 'description' => 'Search Projects via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_projects_by_tag' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchProjectsByTag', 'type' => 'read', 'name' => 'Search Projects By Tag', 'description' => 'Search Projects By Tag via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_search_users' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlySearchUsers', 'type' => 'read', 'name' => 'Search Users', 'description' => 'Search Users via Insightly.', 'icon' => 'ph:magnifying-glass'],
            'insightly_update_contact' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateContact', 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update Contact via Insightly.', 'icon' => 'ph:pencil-simple'],
            'insightly_update_event' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateEvent', 'type' => 'write', 'name' => 'Update Event', 'description' => 'Update Event via Insightly.', 'icon' => 'ph:pencil-simple'],
            'insightly_update_lead' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateLead', 'type' => 'write', 'name' => 'Update Lead', 'description' => 'Update Lead via Insightly.', 'icon' => 'ph:pencil-simple'],
            'insightly_update_note' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateNote', 'type' => 'write', 'name' => 'Update Note', 'description' => 'Update Note via Insightly.', 'icon' => 'ph:pencil-simple'],
            'insightly_update_opportunity' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateOpportunity', 'type' => 'write', 'name' => 'Update Opportunity', 'description' => 'Update Opportunity via Insightly.', 'icon' => 'ph:pencil-simple'],
            'insightly_update_organization' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateOrganization', 'type' => 'write', 'name' => 'Update Organization', 'description' => 'Update Organization via Insightly.', 'icon' => 'ph:pencil-simple'],
            'insightly_update_project' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateProject', 'type' => 'write', 'name' => 'Update Project', 'description' => 'Update Project via Insightly.', 'icon' => 'ph:pencil-simple'],
            'insightly_update_task' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateTask', 'type' => 'write', 'name' => 'Update Task', 'description' => 'Update Task via Insightly.', 'icon' => 'ph:pencil-simple'],
            'insightly_update_task_category' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateTaskCategory', 'type' => 'write', 'name' => 'Update Task Category', 'description' => 'Update Task Category via Insightly.', 'icon' => 'ph:pencil-simple'],
            'insightly_update_team' => ['class' => 'OpenCompany\Integrations\Insightly\Tools\InsightlyUpdateTeam', 'type' => 'write', 'name' => 'Update Team', 'description' => 'Update Team via Insightly.', 'icon' => 'ph:pencil-simple'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/insightly.md';
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.na1.insightly.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Insightly service for the default account or a named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): InsightlyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $apiKey = $creds->get('insightly', 'api_key', '', $account)
                ?: $creds->get('insightly', 'access_token', '', $account);

            return new InsightlyService(
                apiKey: $apiKey,
                baseUrl: $creds->get('insightly', 'base_url', 'https://api.na1.insightly.com', $account),
            );
        }

        return app(InsightlyService::class);
    }
}
