<?php

namespace OpenCompany\Integrations\Salesforce;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceCreateAccount;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceCreateCase;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceCreateContact;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceCreateLead;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceCreateOpportunity;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceCreateTask;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceDescribeObject;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceGetAccount;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceGetContact;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceGetLead;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceGetOpportunity;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceGetUser;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceListObjects;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceListRecent;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceQuery;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceSearch;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceUpdateAccount;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceUpdateLead;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Salesforce tools and provides integration metadata, configuration schema, and connection testing.
 */
class SalesforceToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'salesforce';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'crm, sales, leads, contacts, accounts, opportunities',
            'description' => 'CRM platform',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:salesforce',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Salesforce',
            'description' => 'CRM leads, contacts, accounts, opportunities, tasks, cases, SOQL queries, and SOSL searches',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:salesforce',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.salesforce.com/docs/apis',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'OAuth2 Access Token',
                'placeholder' => '00D...',
                'hint' => 'Obtain via OAuth2 flow from Salesforce. Go to Setup → Apps → Connected Apps.',
                'required' => true,
            ],
            [
                'key' => 'instance_url',
                'type' => 'string',
                'label' => 'Instance URL',
                'placeholder' => 'https://na1.salesforce.com',
                'hint' => 'The Salesforce instance URL returned by the OAuth2 flow.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $instanceUrl = $config['instance_url'] ?? '';

        if (empty($accessToken) || empty($instanceUrl)) {
            return ['success' => false, 'error' => 'Access token and instance URL are required. Obtain them via the Salesforce OAuth2 flow.'];
        }

        try {
            $baseUrl = rtrim($instanceUrl, '/') . '/services/data/v60.0';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Salesforce successfully.',
                ];
            }

            $body = $response->json() ?? [];
            $error = $body[0]['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Salesforce API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'instance_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Leads
            'salesforce_create_lead' => [
                'class' => SalesforceCreateLead::class,
                'type' => 'write',
                'name' => 'Create Lead',
                'description' => 'Create a new lead in Salesforce.',
                'icon' => 'ph:user-plus',
            ],
            'salesforce_get_lead' => [
                'class' => SalesforceGetLead::class,
                'type' => 'read',
                'name' => 'Get Lead',
                'description' => 'Retrieve a Salesforce lead by ID.',
                'icon' => 'ph:user',
            ],
            'salesforce_update_lead' => [
                'class' => SalesforceUpdateLead::class,
                'type' => 'write',
                'name' => 'Update Lead',
                'description' => 'Update an existing Salesforce lead.',
                'icon' => 'ph:pencil-simple',
            ],
            // Contacts
            'salesforce_create_contact' => [
                'class' => SalesforceCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Salesforce.',
                'icon' => 'ph:address-book',
            ],
            'salesforce_get_contact' => [
                'class' => SalesforceGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve a Salesforce contact by ID.',
                'icon' => 'ph:address-book',
            ],
            // Accounts
            'salesforce_create_account' => [
                'class' => SalesforceCreateAccount::class,
                'type' => 'write',
                'name' => 'Create Account',
                'description' => 'Create a new account in Salesforce.',
                'icon' => 'ph:buildings',
            ],
            'salesforce_get_account' => [
                'class' => SalesforceGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Retrieve a Salesforce account by ID.',
                'icon' => 'ph:building',
            ],
            'salesforce_update_account' => [
                'class' => SalesforceUpdateAccount::class,
                'type' => 'write',
                'name' => 'Update Account',
                'description' => 'Update an existing Salesforce account.',
                'icon' => 'ph:pencil-simple',
            ],
            // Opportunities
            'salesforce_create_opportunity' => [
                'class' => SalesforceCreateOpportunity::class,
                'type' => 'write',
                'name' => 'Create Opportunity',
                'description' => 'Create a new opportunity in Salesforce.',
                'icon' => 'ph:currency-dollar',
            ],
            'salesforce_get_opportunity' => [
                'class' => SalesforceGetOpportunity::class,
                'type' => 'read',
                'name' => 'Get Opportunity',
                'description' => 'Retrieve a Salesforce opportunity by ID.',
                'icon' => 'ph:handshake',
            ],
            // Query & Search
            'salesforce_query' => [
                'class' => SalesforceQuery::class,
                'type' => 'read',
                'name' => 'SOQL Query',
                'description' => 'Execute a SOQL query against Salesforce.',
                'icon' => 'ph:magnifying-glass',
            ],
            'salesforce_search' => [
                'class' => SalesforceSearch::class,
                'type' => 'read',
                'name' => 'SOSL Search',
                'description' => 'Execute a SOSL search across Salesforce.',
                'icon' => 'ph:magnifying-glass',
            ],
            'salesforce_describe_object' => [
                'class' => SalesforceDescribeObject::class,
                'type' => 'read',
                'name' => 'Describe Object',
                'description' => 'Get metadata for a Salesforce object type.',
                'icon' => 'ph:info',
            ],
            'salesforce_list_objects' => [
                'class' => SalesforceListObjects::class,
                'type' => 'read',
                'name' => 'List Objects',
                'description' => 'List all available Salesforce objects.',
                'icon' => 'ph:list',
            ],
            // Tasks & Cases
            'salesforce_create_task' => [
                'class' => SalesforceCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in Salesforce.',
                'icon' => 'ph:check-square',
            ],
            'salesforce_create_case' => [
                'class' => SalesforceCreateCase::class,
                'type' => 'write',
                'name' => 'Create Case',
                'description' => 'Create a new case in Salesforce.',
                'icon' => 'ph:ticket',
            ],
            'salesforce_list_recent' => [
                'class' => SalesforceListRecent::class,
                'type' => 'read',
                'name' => 'List Recent',
                'description' => 'List recently accessed Salesforce items.',
                'icon' => 'ph:clock',
            ],
            'salesforce_get_user' => [
                'class' => SalesforceGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Retrieve a Salesforce user by ID.',
                'icon' => 'ph:users',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/salesforce.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth2 Access Token', 'required' => true],
            ['key' => 'instance_url', 'type' => 'string', 'label' => 'Instance URL', 'required' => true],
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
     * Resolve the SalesforceService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): SalesforceService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new SalesforceService(
                accessToken: $creds->get('salesforce', 'access_token', '', $account),
                instanceUrl: $creds->get('salesforce', 'instance_url', '', $account),
            );
        }

        return app(SalesforceService::class);
    }
}
