<?php

namespace OpenCompany\Integrations\Capsule;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Capsule\Tools\CapsuleApiDelete;
use OpenCompany\Integrations\Capsule\Tools\CapsuleApiGet;
use OpenCompany\Integrations\Capsule\Tools\CapsuleApiPost;
use OpenCompany\Integrations\Capsule\Tools\CapsuleApiPut;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateCase;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateContact;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateCustomField;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateOpportunity;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateTag;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateTask;
use OpenCompany\Integrations\Capsule\Tools\CapsuleDeleteCase;
use OpenCompany\Integrations\Capsule\Tools\CapsuleDeleteContact;
use OpenCompany\Integrations\Capsule\Tools\CapsuleDeleteCustomField;
use OpenCompany\Integrations\Capsule\Tools\CapsuleDeleteOpportunity;
use OpenCompany\Integrations\Capsule\Tools\CapsuleDeleteTag;
use OpenCompany\Integrations\Capsule\Tools\CapsuleDeleteTask;
use OpenCompany\Integrations\Capsule\Tools\CapsuleGetCase;
use OpenCompany\Integrations\Capsule\Tools\CapsuleGetContact;
use OpenCompany\Integrations\Capsule\Tools\CapsuleGetCurrentUser;
use OpenCompany\Integrations\Capsule\Tools\CapsuleGetOpportunity;
use OpenCompany\Integrations\Capsule\Tools\CapsuleGetTask;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListCases;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListContacts;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListCustomFields;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListOpportunities;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListPartyCases;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListPartyOpportunities;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListTags;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListTasks;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListTracks;
use OpenCompany\Integrations\Capsule\Tools\CapsuleUpdateCase;
use OpenCompany\Integrations\Capsule\Tools\CapsuleUpdateContact;
use OpenCompany\Integrations\Capsule\Tools\CapsuleUpdateCustomField;
use OpenCompany\Integrations\Capsule\Tools\CapsuleUpdateOpportunity;
use OpenCompany\Integrations\Capsule\Tools\CapsuleUpdateTag;
use OpenCompany\Integrations\Capsule\Tools\CapsuleUpdateTask;

/**
 * Registers Capsule CRM tools, metadata, credentials, and multi-account service resolution.
 */
class CapsuleToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'capsule';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Capsule CRM',
            'description' => 'CRM records and sales operations',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:capsulecrm',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Capsule CRM',
            'description' => 'CRM contacts, opportunities, cases, tasks, tracks, tags, and custom fields.',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:capsulecrm',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.capsulecrm.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Capsule CRM access token',
                'hint' => 'Generate a personal access token in Capsule under My Preferences > API Authentication Tokens.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.capsulecrm.com/api/v2',
                'hint' => 'Use the default Capsule CRM API URL unless you proxy Capsule API traffic.',
                'default' => 'https://api.capsulecrm.com/api/v2',
            ],
        ];
    }

    /**
     * Test Capsule CRM credentials with the current user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.capsulecrm.com/api/v2'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/users/me');

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Capsule CRM API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)),
                ];
            }

            $json = $response->json() ?? [];
            $userName = trim(($json['user']['firstName'] ?? '').' '.($json['user']['lastName'] ?? '')) ?: 'Unknown user';

            return [
                'success' => true,
                'message' => "Connected to Capsule CRM as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'capsule_list_contacts' => $this->tool(CapsuleListContacts::class, 'read', 'List Contacts', 'List people and organisations.'),
            'capsule_get_contact' => $this->tool(CapsuleGetContact::class, 'read', 'Get Contact', 'Get one party by ID.'),
            'capsule_create_contact' => $this->tool(CapsuleCreateContact::class, 'write', 'Create Contact', 'Create a person or organisation.'),
            'capsule_update_contact' => $this->tool(CapsuleUpdateContact::class, 'write', 'Update Contact', 'Update a person or organisation.'),
            'capsule_delete_contact' => $this->tool(CapsuleDeleteContact::class, 'write', 'Delete Contact', 'Delete a person or organisation.'),
            'capsule_list_opportunities' => $this->tool(CapsuleListOpportunities::class, 'read', 'List Opportunities', 'List sales opportunities.'),
            'capsule_list_party_opportunities' => $this->tool(CapsuleListPartyOpportunities::class, 'read', 'List Party Opportunities', 'List opportunities for a party.'),
            'capsule_get_opportunity' => $this->tool(CapsuleGetOpportunity::class, 'read', 'Get Opportunity', 'Get one opportunity.'),
            'capsule_create_opportunity' => $this->tool(CapsuleCreateOpportunity::class, 'write', 'Create Opportunity', 'Create an opportunity.'),
            'capsule_update_opportunity' => $this->tool(CapsuleUpdateOpportunity::class, 'write', 'Update Opportunity', 'Update an opportunity.'),
            'capsule_delete_opportunity' => $this->tool(CapsuleDeleteOpportunity::class, 'write', 'Delete Opportunity', 'Delete an opportunity.'),
            'capsule_list_cases' => $this->tool(CapsuleListCases::class, 'read', 'List Cases', 'List projects/cases.'),
            'capsule_list_party_cases' => $this->tool(CapsuleListPartyCases::class, 'read', 'List Party Cases', 'List cases for a party.'),
            'capsule_get_case' => $this->tool(CapsuleGetCase::class, 'read', 'Get Case', 'Get one project/case.'),
            'capsule_create_case' => $this->tool(CapsuleCreateCase::class, 'write', 'Create Case', 'Create a project/case.'),
            'capsule_update_case' => $this->tool(CapsuleUpdateCase::class, 'write', 'Update Case', 'Update a project/case.'),
            'capsule_delete_case' => $this->tool(CapsuleDeleteCase::class, 'write', 'Delete Case', 'Delete a project/case.'),
            'capsule_list_tasks' => $this->tool(CapsuleListTasks::class, 'read', 'List Tasks', 'List tasks.'),
            'capsule_get_task' => $this->tool(CapsuleGetTask::class, 'read', 'Get Task', 'Get one task.'),
            'capsule_create_task' => $this->tool(CapsuleCreateTask::class, 'write', 'Create Task', 'Create a task.'),
            'capsule_update_task' => $this->tool(CapsuleUpdateTask::class, 'write', 'Update Task', 'Update a task.'),
            'capsule_delete_task' => $this->tool(CapsuleDeleteTask::class, 'write', 'Delete Task', 'Delete a task.'),
            'capsule_list_tracks' => $this->tool(CapsuleListTracks::class, 'read', 'List Tracks', 'List track definitions.'),
            'capsule_list_tags' => $this->tool(CapsuleListTags::class, 'read', 'List Tags', 'List tag definitions.'),
            'capsule_create_tag' => $this->tool(CapsuleCreateTag::class, 'write', 'Create Tag', 'Create a tag definition.'),
            'capsule_update_tag' => $this->tool(CapsuleUpdateTag::class, 'write', 'Update Tag', 'Update a tag definition.'),
            'capsule_delete_tag' => $this->tool(CapsuleDeleteTag::class, 'write', 'Delete Tag', 'Delete a tag definition.'),
            'capsule_list_custom_fields' => $this->tool(CapsuleListCustomFields::class, 'read', 'List Custom Fields', 'List custom field definitions.'),
            'capsule_create_custom_field' => $this->tool(CapsuleCreateCustomField::class, 'write', 'Create Custom Field', 'Create a custom field definition.'),
            'capsule_update_custom_field' => $this->tool(CapsuleUpdateCustomField::class, 'write', 'Update Custom Field', 'Update a custom field definition.'),
            'capsule_delete_custom_field' => $this->tool(CapsuleDeleteCustomField::class, 'write', 'Delete Custom Field', 'Delete a custom field definition.'),
            'capsule_get_current_user' => $this->tool(CapsuleGetCurrentUser::class, 'read', 'Get Current User', 'Get the authenticated Capsule user.'),
            'capsule_api_get' => $this->tool(CapsuleApiGet::class, 'read', 'API GET', 'Call a relative Capsule API path with GET.'),
            'capsule_api_post' => $this->tool(CapsuleApiPost::class, 'write', 'API POST', 'Call a relative Capsule API path with POST.'),
            'capsule_api_put' => $this->tool(CapsuleApiPut::class, 'write', 'API PUT', 'Call a relative Capsule API path with PUT.'),
            'capsule_api_delete' => $this->tool(CapsuleApiDelete::class, 'write', 'API DELETE', 'Call a relative Capsule API path with DELETE.'),
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/capsule.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.capsulecrm.com/api/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool with default or account-scoped credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve Capsule service credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): CapsuleService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CapsuleService(
                accessToken: $creds->get('capsule', 'access_token', '', $account),
                baseUrl: $creds->get('capsule', 'url', 'https://api.capsulecrm.com/api/v2', $account),
            );
        }

        return app(CapsuleService::class);
    }

    /**
     * Build one catalog entry.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @return array<string, mixed>
     */
    private function tool(string $class, string $type, string $name, string $description): array
    {
        return [
            'class' => $class,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'icon' => $type === 'read' ? 'ph:address-book' : 'ph:pencil-simple',
        ];
    }
}
