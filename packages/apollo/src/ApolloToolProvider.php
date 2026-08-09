<?php

namespace OpenCompany\Integrations\Apollo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Apollo\Tools\ApolloBulkCreateAccounts;
use OpenCompany\Integrations\Apollo\Tools\ApolloBulkCreateContacts;
use OpenCompany\Integrations\Apollo\Tools\ApolloBulkEnrichOrganizations;
use OpenCompany\Integrations\Apollo\Tools\ApolloBulkEnrichPeople;
use OpenCompany\Integrations\Apollo\Tools\ApolloCreateAccount;
use OpenCompany\Integrations\Apollo\Tools\ApolloCreateContact;
use OpenCompany\Integrations\Apollo\Tools\ApolloEnrich;
use OpenCompany\Integrations\Apollo\Tools\ApolloEnrichOrganization;
use OpenCompany\Integrations\Apollo\Tools\ApolloGetApiUsageStats;
use OpenCompany\Integrations\Apollo\Tools\ApolloGetContact;
use OpenCompany\Integrations\Apollo\Tools\ApolloGetCurrentUser;
use OpenCompany\Integrations\Apollo\Tools\ApolloGetOrganization;
use OpenCompany\Integrations\Apollo\Tools\ApolloListAccountStages;
use OpenCompany\Integrations\Apollo\Tools\ApolloListContactStages;
use OpenCompany\Integrations\Apollo\Tools\ApolloListEmailAccounts;
use OpenCompany\Integrations\Apollo\Tools\ApolloListOrganizationJobPostings;
use OpenCompany\Integrations\Apollo\Tools\ApolloListOrganizations;
use OpenCompany\Integrations\Apollo\Tools\ApolloListUsers;
use OpenCompany\Integrations\Apollo\Tools\ApolloSearchAccounts;
use OpenCompany\Integrations\Apollo\Tools\ApolloSearchContacts;
use OpenCompany\Integrations\Apollo\Tools\ApolloSearchPeople;
use OpenCompany\Integrations\Apollo\Tools\ApolloUpdateAccount;
use OpenCompany\Integrations\Apollo\Tools\ApolloUpdateContact;

/**
 * Tool catalog and configuration metadata for Apollo.
 *
 * Exposes the documented Apollo REST API surfaces for enrichment, search,
 * contacts, accounts, team metadata, and usage statistics.
 */
class ApolloToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => ['api_key'],
                'notes' => ['Apollo authenticates requests with the X-Api-Key header. Some endpoints require a master API key and plan-specific access.'],
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
        return 'apollo';
    }

    /**
     * Short metadata for tooling UI display.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Apollo.io',
            'description' => 'B2B data, contacts, and accounts',
            'icon' => 'ph:rocket-launch',
            'logo' => 'simple-icons:apollo',
        ];
    }

    /**
     * Integration metadata for catalogs and settings.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Apollo.io',
            'description' => 'B2B people, organization, contact, account, and usage API tools',
            'icon' => 'ph:rocket-launch',
            'logo' => 'simple-icons:apollo',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.apollo.io/',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your Apollo API key',
                'hint' => 'Use an Apollo API key. Master API keys are required for several account/contact endpoints.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.apollo.io',
                'hint' => 'Override only for a proxy or compatible endpoint.',
                'default' => 'https://api.apollo.io',
            ],
        ];
    }

    /**
     * Test the connection to Apollo with the documented API key health check.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key and optional url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.apollo.io'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'X-Api-Key' => $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache',
            ])->timeout(10)->get($baseUrl.'/v1/auth/health');

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Connected to Apollo API.'];
            }

            $error = $response->json('error') ?? $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Apollo API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the integration configuration.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'apollo_search_people' => [
                'class' => ApolloSearchPeople::class,
                'type' => 'read',
                'name' => 'Search People',
                'description' => 'Search net-new people in Apollo data.',
                'icon' => 'ph:user-list',
            ],
            'apollo_enrich' => [
                'class' => ApolloEnrich::class,
                'type' => 'read',
                'name' => 'Enrich Person',
                'description' => 'Enrich one person by email, name, ID, LinkedIn URL, or company attributes.',
                'icon' => 'ph:user-circle-gear',
            ],
            'apollo_bulk_enrich_people' => [
                'class' => ApolloBulkEnrichPeople::class,
                'type' => 'read',
                'name' => 'Bulk Enrich People',
                'description' => 'Enrich up to 10 people in a single Apollo request.',
                'icon' => 'ph:users-three',
            ],
            'apollo_list_organizations' => [
                'class' => ApolloListOrganizations::class,
                'type' => 'read',
                'name' => 'Search Organizations',
                'description' => 'Search companies in Apollo data.',
                'icon' => 'ph:buildings',
            ],
            'apollo_enrich_organization' => [
                'class' => ApolloEnrichOrganization::class,
                'type' => 'read',
                'name' => 'Enrich Organization',
                'description' => 'Enrich one company by domain.',
                'icon' => 'ph:building-office',
            ],
            'apollo_bulk_enrich_organizations' => [
                'class' => ApolloBulkEnrichOrganizations::class,
                'type' => 'read',
                'name' => 'Bulk Enrich Organizations',
                'description' => 'Enrich up to 10 companies by domain.',
                'icon' => 'ph:buildings',
            ],
            'apollo_list_organization_job_postings' => [
                'class' => ApolloListOrganizationJobPostings::class,
                'type' => 'read',
                'name' => 'List Organization Job Postings',
                'description' => 'List current job postings for an Apollo organization.',
                'icon' => 'ph:briefcase',
            ],
            'apollo_search_contacts' => [
                'class' => ApolloSearchContacts::class,
                'type' => 'read',
                'name' => 'Search Contacts',
                'description' => 'Search saved contacts in your Apollo team account.',
                'icon' => 'ph:magnifying-glass',
            ],
            'apollo_get_contact' => [
                'class' => ApolloGetContact::class,
                'type' => 'read',
                'name' => 'View Contact',
                'description' => 'View a saved Apollo contact by contact ID.',
                'icon' => 'ph:user',
            ],
            'apollo_create_contact' => [
                'class' => ApolloCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a saved Apollo contact.',
                'icon' => 'ph:user-plus',
            ],
            'apollo_update_contact' => [
                'class' => ApolloUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update a saved Apollo contact.',
                'icon' => 'ph:user-gear',
            ],
            'apollo_bulk_create_contacts' => [
                'class' => ApolloBulkCreateContacts::class,
                'type' => 'write',
                'name' => 'Bulk Create Contacts',
                'description' => 'Create up to 100 Apollo contacts in one request.',
                'icon' => 'ph:users-three',
            ],
            'apollo_list_contact_stages' => [
                'class' => ApolloListContactStages::class,
                'type' => 'read',
                'name' => 'List Contact Stages',
                'description' => 'List Apollo contact stage IDs.',
                'icon' => 'ph:flag',
            ],
            'apollo_search_accounts' => [
                'class' => ApolloSearchAccounts::class,
                'type' => 'read',
                'name' => 'Search Accounts',
                'description' => 'Search saved accounts in your Apollo team account.',
                'icon' => 'ph:buildings',
            ],
            'apollo_get_organization' => [
                'class' => ApolloGetOrganization::class,
                'type' => 'read',
                'name' => 'View Account',
                'description' => 'View a saved Apollo account by ID.',
                'icon' => 'ph:building-office',
            ],
            'apollo_create_account' => [
                'class' => ApolloCreateAccount::class,
                'type' => 'write',
                'name' => 'Create Account',
                'description' => 'Create a saved Apollo account.',
                'icon' => 'ph:building-office',
            ],
            'apollo_update_account' => [
                'class' => ApolloUpdateAccount::class,
                'type' => 'write',
                'name' => 'Update Account',
                'description' => 'Update a saved Apollo account.',
                'icon' => 'ph:building-office',
            ],
            'apollo_bulk_create_accounts' => [
                'class' => ApolloBulkCreateAccounts::class,
                'type' => 'write',
                'name' => 'Bulk Create Accounts',
                'description' => 'Create up to 100 Apollo accounts in one request.',
                'icon' => 'ph:buildings',
            ],
            'apollo_list_account_stages' => [
                'class' => ApolloListAccountStages::class,
                'type' => 'read',
                'name' => 'List Account Stages',
                'description' => 'List Apollo account stage IDs.',
                'icon' => 'ph:flag',
            ],
            'apollo_get_current_user' => [
                'class' => ApolloGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Apollo user profile when available.',
                'icon' => 'ph:identification-card',
            ],
            'apollo_list_users' => [
                'class' => ApolloListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Apollo team users.',
                'icon' => 'ph:users',
            ],
            'apollo_list_email_accounts' => [
                'class' => ApolloListEmailAccounts::class,
                'type' => 'read',
                'name' => 'List Email Accounts',
                'description' => 'List Apollo email accounts.',
                'icon' => 'ph:envelope',
            ],
            'apollo_get_api_usage_stats' => [
                'class' => ApolloGetApiUsageStats::class,
                'type' => 'read',
                'name' => 'Get API Usage Stats',
                'description' => 'View Apollo API usage and rate-limit statistics.',
                'icon' => 'ph:gauge',
            ],
        ];
    }

    /**
     * Path to the JavaScript API reference documentation.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/apollo.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Apollo API key',
                'hint' => 'Use an Apollo API key. Master API keys are required for several account/contact endpoints.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.apollo.io',
                'hint' => 'Override only for a proxy or compatible endpoint.',
                'default' => 'https://api.apollo.io',
            ],
        ];
    }

    /**
     * Confirm this is an integration package.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Apollo service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Optional context with an account key.
     */
    private function resolveService(array $context = []): ApolloService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ApolloService(
                apiKey: $creds->get('apollo', 'api_key', '', $account),
                baseUrl: $creds->get('apollo', 'url', 'https://api.apollo.io', $account),
            );
        }

        return app(ApolloService::class);
    }
}
