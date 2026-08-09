<?php

namespace OpenCompany\Integrations\Unbounce;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Unbounce.
 *
 * Exposes accounts, sub-accounts, pages, domains, page groups, form fields,
 * leads, lead deletion requests, users, and safe raw relative API calls.
 */
class UnbounceToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Unbounce OAuth access tokens are short-lived; hosts should provide token refresh outside this package when needed.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'unbounce';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Unbounce',
            'description' => 'Landing pages, accounts, domains, page groups, leads, and form fields',
            'icon' => 'ph:browser',
            'logo' => 'simple-icons:unbounce',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Unbounce',
            'description' => 'Unbounce REST API coverage for accounts, sub-accounts, pages, domains, page groups, form fields, leads, lead deletion requests, users, and raw relative calls.',
            'icon' => 'ph:browser',
            'logo' => 'simple-icons:unbounce',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.unbounce.com/api_reference/',
        ];
    }

    /**
     * Get the configuration schema for the settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Enter your Unbounce bearer token', 'hint' => 'Generate or refresh an OAuth token for the Unbounce API.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.unbounce.com', 'hint' => 'Use https://api.unbounce.com for the standard API.', 'default' => 'https://api.unbounce.com'],
        ];
    }

    /**
     * Test the connection to Unbounce using /users/me.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.unbounce.com'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $data = $response->json() ?: [];
                $name = trim((string) (($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')));

                return ['success' => true, 'message' => 'Connected to Unbounce' . ($name === '' ? '.' : " as {$name}.")];
            }

            return ['success' => false, 'error' => "Unbounce API returned HTTP {$response->status()}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the tool definitions for this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'unbounce_get_api_metadata' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceGetApiMetadata', 'type' => 'read', 'name' => 'Get API Metadata', 'description' => 'Retrieve API root metadata.', 'icon' => 'ph:info'],
            'unbounce_list_accounts' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListAccounts', 'type' => 'read', 'name' => 'List Accounts', 'description' => 'List accounts available to the token.', 'icon' => 'ph:buildings'],
            'unbounce_get_account' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceGetAccount', 'type' => 'read', 'name' => 'Get Account', 'description' => 'Get one account.', 'icon' => 'ph:buildings'],
            'unbounce_list_sub_accounts' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListSubAccounts', 'type' => 'read', 'name' => 'List Sub Accounts', 'description' => 'List sub-accounts in Unbounce.', 'icon' => 'ph:folders'],
            'unbounce_get_sub_account' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceGetSubAccount', 'type' => 'read', 'name' => 'Get Sub Account', 'description' => 'Get one sub-account.', 'icon' => 'ph:folder'],
            'unbounce_list_pages' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListPages', 'type' => 'read', 'name' => 'List Pages', 'description' => 'List landing pages globally.', 'icon' => 'ph:browser'],
            'unbounce_list_account_pages' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListAccountPages', 'type' => 'read', 'name' => 'List Account Pages', 'description' => 'List pages for an account.', 'icon' => 'ph:browser'],
            'unbounce_list_sub_account_pages' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListSubAccountPages', 'type' => 'read', 'name' => 'List Sub Account Pages', 'description' => 'List pages for a sub-account.', 'icon' => 'ph:browser'],
            'unbounce_get_page' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceGetPage', 'type' => 'read', 'name' => 'Get Page', 'description' => 'Get details of a landing page.', 'icon' => 'ph:browser'],
            'unbounce_list_page_form_fields' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListPageFormFields', 'type' => 'read', 'name' => 'List Page Form Fields', 'description' => 'List form fields for a page.', 'icon' => 'ph:list-bullets'],
            'unbounce_list_leads' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListLeads', 'type' => 'read', 'name' => 'List Leads', 'description' => 'List leads for a page.', 'icon' => 'ph:users'],
            'unbounce_get_lead' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceGetLead', 'type' => 'read', 'name' => 'Get Lead', 'description' => 'Get a lead by ID.', 'icon' => 'ph:user'],
            'unbounce_create_lead' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceCreateLead', 'type' => 'write', 'name' => 'Create Lead', 'description' => 'Create a lead for a page.', 'icon' => 'ph:user-plus'],
            'unbounce_create_lead_deletion_request' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceCreateLeadDeletionRequest', 'type' => 'write', 'name' => 'Create Lead Deletion Request', 'description' => 'Create a lead deletion request.', 'icon' => 'ph:trash'],
            'unbounce_get_lead_deletion_request' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceGetLeadDeletionRequest', 'type' => 'read', 'name' => 'Get Lead Deletion Request', 'description' => 'Get a lead deletion request.', 'icon' => 'ph:trash'],
            'unbounce_list_domains' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListDomains', 'type' => 'read', 'name' => 'List Domains', 'description' => 'List domains for a sub-account.', 'icon' => 'ph:globe'],
            'unbounce_get_domain' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceGetDomain', 'type' => 'read', 'name' => 'Get Domain', 'description' => 'Get a domain.', 'icon' => 'ph:globe'],
            'unbounce_list_domain_pages' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListDomainPages', 'type' => 'read', 'name' => 'List Domain Pages', 'description' => 'List pages for a domain.', 'icon' => 'ph:browser'],
            'unbounce_list_page_groups' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListPageGroups', 'type' => 'read', 'name' => 'List Page Groups', 'description' => 'List page groups for a sub-account.', 'icon' => 'ph:folder-open'],
            'unbounce_get_page_group' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceGetPageGroup', 'type' => 'read', 'name' => 'Get Page Group', 'description' => 'Get a page group.', 'icon' => 'ph:folder-open'],
            'unbounce_list_page_group_pages' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceListPageGroupPages', 'type' => 'read', 'name' => 'List Page Group Pages', 'description' => 'List pages in a page group.', 'icon' => 'ph:browser'],
            'unbounce_get_current_user' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Unbounce user.', 'icon' => 'ph:user-circle'],
            'unbounce_api_get' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceApiGet', 'type' => 'read', 'name' => 'Api Get', 'description' => 'Call a safe relative API path with GET.', 'icon' => 'ph:magnifying-glass'],
            'unbounce_api_post' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceApiPost', 'type' => 'write', 'name' => 'Api Post', 'description' => 'Call a safe relative API path with POST.', 'icon' => 'ph:pencil-simple'],
            'unbounce_api_delete' => ['class' => 'OpenCompany\\Integrations\\Unbounce\\Tools\\UnbounceApiDelete', 'type' => 'write', 'name' => 'Api Delete', 'description' => 'Call a safe relative API path with DELETE.', 'icon' => 'ph:trash'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/unbounce.md';
    }

    /**
     * Get credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.unbounce.com'],
        ];
    }

    /**
     * Confirm this provider is an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool with optional account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Fully-qualified tool class name.
     * @param  array{account?: mixed}  $context  Optional multi-account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the service for the default account or a named account.
     *
     * @param  array{account?: mixed}  $context  Optional multi-account context.
     */
    private function resolveService(array $context = []): UnbounceService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new UnbounceService(
                accessToken: $creds->get('unbounce', 'access_token', '', $account),
                baseUrl: $creds->get('unbounce', 'url', 'https://api.unbounce.com', $account),
            );
        }

        return app(UnbounceService::class);
    }
}
