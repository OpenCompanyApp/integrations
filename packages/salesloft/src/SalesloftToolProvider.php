<?php

namespace OpenCompany\Integrations\Salesloft;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftApiDelete;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftApiGet;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftApiPost;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftApiPut;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftCreateAccount;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftCreateCadenceMembership;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftCreateCall;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftCreateNote;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftCreatePerson;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftCreateSequence;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftDeleteAccount;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftDeletePerson;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetAccount;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetCadence;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetCurrentUser;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetPerson;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetRule;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetSequence;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetTask;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetUser;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListAccounts;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListCadenceMemberships;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListCadences;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListCalls;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListEmails;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListNotes;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListPeople;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListRules;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListSequences;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListTasks;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListUsers;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftUpdateAccount;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftUpdatePerson;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftUpdateTask;

/**
 * Tool catalog and setup metadata for the Salesloft integration.
 *
 * Exposes people, accounts, cadences, tasks, calls, emails, notes, users,
 * legacy sequences/rules, and generic relative API helpers.
 */
class SalesloftToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'salesloft';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Salesloft',
            'description' => 'Sales engagement platform',
            'icon' => 'ph:phone-outgoing',
            'logo' => 'simple-icons:salesloft',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Salesloft',
            'description' => 'Sales engagement platform for call sequences, automation rules, and team management',
            'icon' => 'ph:phone-outgoing',
            'logo' => 'simple-icons:salesloft',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.salesloft.com/docs/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Salesloft API access token',
                'hint' => 'Generate an API token in Salesloft under Settings > API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.salesloft.com',
                'hint' => 'Defaults to <code>https://api.salesloft.com</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.salesloft.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.salesloft.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v3/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Salesloft API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your access token.",
                ];
            }

            $userName = $json['data']['first_name'] ?? 'User';

            return [
                'success' => true,
                'message' => "Connected to Salesloft API as {$userName}.",
            ];
        } catch (\Throwable $e) {
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
            'salesloft_list_users' => [
                'class' => SalesloftListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Salesloft users.',
                'icon' => 'ph:users',
            ],
            'salesloft_get_user' => [
                'class' => SalesloftGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get one Salesloft user.',
                'icon' => 'ph:user',
            ],
            'salesloft_list_people' => [
                'class' => SalesloftListPeople::class,
                'type' => 'read',
                'name' => 'List People',
                'description' => 'List Salesloft people.',
                'icon' => 'ph:address-book',
            ],
            'salesloft_get_person' => [
                'class' => SalesloftGetPerson::class,
                'type' => 'read',
                'name' => 'Get Person',
                'description' => 'Get one Salesloft person.',
                'icon' => 'ph:user',
            ],
            'salesloft_create_person' => [
                'class' => SalesloftCreatePerson::class,
                'type' => 'write',
                'name' => 'Create Person',
                'description' => 'Create a Salesloft person.',
                'icon' => 'ph:user-plus',
            ],
            'salesloft_update_person' => [
                'class' => SalesloftUpdatePerson::class,
                'type' => 'write',
                'name' => 'Update Person',
                'description' => 'Update a Salesloft person.',
                'icon' => 'ph:pencil-simple',
            ],
            'salesloft_delete_person' => [
                'class' => SalesloftDeletePerson::class,
                'type' => 'write',
                'name' => 'Delete Person',
                'description' => 'Delete a Salesloft person.',
                'icon' => 'ph:trash',
            ],
            'salesloft_list_accounts' => [
                'class' => SalesloftListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List Salesloft accounts.',
                'icon' => 'ph:buildings',
            ],
            'salesloft_get_account' => [
                'class' => SalesloftGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get one Salesloft account.',
                'icon' => 'ph:building-office',
            ],
            'salesloft_create_account' => [
                'class' => SalesloftCreateAccount::class,
                'type' => 'write',
                'name' => 'Create Account',
                'description' => 'Create a Salesloft account.',
                'icon' => 'ph:plus',
            ],
            'salesloft_update_account' => [
                'class' => SalesloftUpdateAccount::class,
                'type' => 'write',
                'name' => 'Update Account',
                'description' => 'Update a Salesloft account.',
                'icon' => 'ph:pencil-simple',
            ],
            'salesloft_delete_account' => [
                'class' => SalesloftDeleteAccount::class,
                'type' => 'write',
                'name' => 'Delete Account',
                'description' => 'Delete a Salesloft account.',
                'icon' => 'ph:trash',
            ],
            'salesloft_list_cadences' => [
                'class' => SalesloftListCadences::class,
                'type' => 'read',
                'name' => 'List Cadences',
                'description' => 'List Salesloft cadences.',
                'icon' => 'ph:list',
            ],
            'salesloft_get_cadence' => [
                'class' => SalesloftGetCadence::class,
                'type' => 'read',
                'name' => 'Get Cadence',
                'description' => 'Get one Salesloft cadence.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'salesloft_list_cadence_memberships' => [
                'class' => SalesloftListCadenceMemberships::class,
                'type' => 'read',
                'name' => 'List Cadence Memberships',
                'description' => 'List Salesloft cadence memberships.',
                'icon' => 'ph:users-three',
            ],
            'salesloft_create_cadence_membership' => [
                'class' => SalesloftCreateCadenceMembership::class,
                'type' => 'write',
                'name' => 'Create Cadence Membership',
                'description' => 'Add a person to a Salesloft cadence.',
                'icon' => 'ph:user-plus',
            ],
            'salesloft_list_tasks' => [
                'class' => SalesloftListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List Salesloft tasks.',
                'icon' => 'ph:check-square',
            ],
            'salesloft_get_task' => [
                'class' => SalesloftGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get one Salesloft task.',
                'icon' => 'ph:check-square',
            ],
            'salesloft_update_task' => [
                'class' => SalesloftUpdateTask::class,
                'type' => 'write',
                'name' => 'Update Task',
                'description' => 'Update a Salesloft task.',
                'icon' => 'ph:pencil-simple',
            ],
            'salesloft_list_calls' => [
                'class' => SalesloftListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List Salesloft call activities.',
                'icon' => 'ph:phone',
            ],
            'salesloft_create_call' => [
                'class' => SalesloftCreateCall::class,
                'type' => 'write',
                'name' => 'Create Call',
                'description' => 'Create a Salesloft call activity.',
                'icon' => 'ph:phone-call',
            ],
            'salesloft_list_emails' => [
                'class' => SalesloftListEmails::class,
                'type' => 'read',
                'name' => 'List Emails',
                'description' => 'List Salesloft email activities.',
                'icon' => 'ph:envelope',
            ],
            'salesloft_list_notes' => [
                'class' => SalesloftListNotes::class,
                'type' => 'read',
                'name' => 'List Notes',
                'description' => 'List Salesloft notes.',
                'icon' => 'ph:note',
            ],
            'salesloft_create_note' => [
                'class' => SalesloftCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Create a Salesloft note.',
                'icon' => 'ph:note-pencil',
            ],
            'salesloft_list_sequences' => [
                'class' => SalesloftListSequences::class,
                'type' => 'read',
                'name' => 'List Sequences',
                'description' => 'List call sequences with optional status filtering.',
                'icon' => 'ph:list',
            ],
            'salesloft_get_sequence' => [
                'class' => SalesloftGetSequence::class,
                'type' => 'read',
                'name' => 'Get Sequence',
                'description' => 'Get details of a specific call sequence.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'salesloft_create_sequence' => [
                'class' => SalesloftCreateSequence::class,
                'type' => 'write',
                'name' => 'Create Sequence',
                'description' => 'Create a new call sequence with steps and targets.',
                'icon' => 'ph:plus',
            ],
            'salesloft_list_rules' => [
                'class' => SalesloftListRules::class,
                'type' => 'read',
                'name' => 'List Rules',
                'description' => 'List automation rules.',
                'icon' => 'ph:funnel',
            ],
            'salesloft_get_rule' => [
                'class' => SalesloftGetRule::class,
                'type' => 'read',
                'name' => 'Get Rule',
                'description' => 'Get details of a specific automation rule.',
                'icon' => 'ph:funnel',
            ],
            'salesloft_get_current_user' => [
                'class' => SalesloftGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
            'salesloft_api_get' => [
                'class' => SalesloftApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call a relative Salesloft API GET endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'salesloft_api_post' => [
                'class' => SalesloftApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call a relative Salesloft API POST endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'salesloft_api_put' => [
                'class' => SalesloftApiPut::class,
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call a relative Salesloft API PUT endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'salesloft_api_delete' => [
                'class' => SalesloftApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call a relative Salesloft API DELETE endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/salesloft.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.salesloft.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new SalesloftService(
                accessToken: $creds->get('salesloft', 'access_token', '', $account),
                baseUrl: $creds->get('salesloft', 'url', 'https://api.salesloft.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(SalesloftService::class));
    }
}
