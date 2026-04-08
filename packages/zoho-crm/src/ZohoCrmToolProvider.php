<?php

namespace OpenCompany\Integrations\ZohoCrm;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmCreateLead;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmGetLead;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmUpdateLead;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmSearchLeads;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmCreateContact;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmGetContact;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmUpdateContact;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmSearchContacts;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmCreateAccount;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmGetAccount;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmCreateDeal;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmGetDeal;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmListDeals;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmListUsers;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmGetCurrentUser;

/**
 * Registers all Zoho CRM tools and provides integration metadata, configuration schema, and connection testing.
 */
class ZohoCrmToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'zoho_crm';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'crm, leads, contacts, deals',
            'description' => 'CRM platform',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:zoho',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho CRM',
            'description' => 'CRM leads, contacts, accounts, deals, and users',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:zoho',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.zoho.com/crm/developer/docs/api/v7/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'OAuth2 Access Token',
                'placeholder' => '1000.xxxxxx.xxxxxx',
                'hint' => 'Generate an OAuth2 access token from the Zoho API Console with the required CRM scopes.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate one from the Zoho API Console.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://www.zohoapis.com/crm/v7/users/me');

            if ($response->successful()) {
                $body = $response->json() ?? [];
                $users = $body['users'] ?? [];
                $userName = $users[0]['full_name'] ?? ($users[0]['First_Name'] . ' ' . $users[0]['Last_Name'] ?? 'Unknown');

                return [
                    'success' => true,
                    'message' => "Connected to Zoho CRM as {$userName}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Zoho CRM API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
        ];
    }

    public function tools(): array
    {
        return [
            // Leads
            'zoho_crm_create_lead' => [
                'class' => ZohoCrmCreateLead::class,
                'type' => 'write',
                'name' => 'Create Lead',
                'description' => 'Create a new lead in Zoho CRM.',
                'icon' => 'ph:user-plus',
            ],
            'zoho_crm_get_lead' => [
                'class' => ZohoCrmGetLead::class,
                'type' => 'read',
                'name' => 'Get Lead',
                'description' => 'Retrieve a Zoho CRM lead by ID.',
                'icon' => 'ph:user',
            ],
            'zoho_crm_update_lead' => [
                'class' => ZohoCrmUpdateLead::class,
                'type' => 'write',
                'name' => 'Update Lead',
                'description' => 'Update an existing Zoho CRM lead.',
                'icon' => 'ph:pencil-simple',
            ],
            'zoho_crm_search_leads' => [
                'class' => ZohoCrmSearchLeads::class,
                'type' => 'read',
                'name' => 'Search Leads',
                'description' => 'Search Zoho CRM leads by criteria or email.',
                'icon' => 'ph:magnifying-glass',
            ],
            // Contacts
            'zoho_crm_create_contact' => [
                'class' => ZohoCrmCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Zoho CRM.',
                'icon' => 'ph:user-plus',
            ],
            'zoho_crm_get_contact' => [
                'class' => ZohoCrmGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve a Zoho CRM contact by ID.',
                'icon' => 'ph:user',
            ],
            'zoho_crm_update_contact' => [
                'class' => ZohoCrmUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing Zoho CRM contact.',
                'icon' => 'ph:pencil-simple',
            ],
            'zoho_crm_search_contacts' => [
                'class' => ZohoCrmSearchContacts::class,
                'type' => 'read',
                'name' => 'Search Contacts',
                'description' => 'Search Zoho CRM contacts by criteria or email.',
                'icon' => 'ph:magnifying-glass',
            ],
            // Accounts
            'zoho_crm_create_account' => [
                'class' => ZohoCrmCreateAccount::class,
                'type' => 'write',
                'name' => 'Create Account',
                'description' => 'Create a new account in Zoho CRM.',
                'icon' => 'ph:buildings',
            ],
            'zoho_crm_get_account' => [
                'class' => ZohoCrmGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Retrieve a Zoho CRM account by ID.',
                'icon' => 'ph:building',
            ],
            // Deals
            'zoho_crm_create_deal' => [
                'class' => ZohoCrmCreateDeal::class,
                'type' => 'write',
                'name' => 'Create Deal',
                'description' => 'Create a new deal in Zoho CRM.',
                'icon' => 'ph:currency-dollar',
            ],
            'zoho_crm_get_deal' => [
                'class' => ZohoCrmGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Retrieve a Zoho CRM deal by ID.',
                'icon' => 'ph:handshake',
            ],
            'zoho_crm_list_deals' => [
                'class' => ZohoCrmListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List Zoho CRM deals with pagination.',
                'icon' => 'ph:list',
            ],
            // Users
            'zoho_crm_list_users' => [
                'class' => ZohoCrmListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Zoho CRM users.',
                'icon' => 'ph:users',
            ],
            'zoho_crm_get_current_user' => [
                'class' => ZohoCrmGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Zoho CRM user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-crm.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth2 Access Token', 'required' => true],
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
     * Resolve the ZohoCrmService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ZohoCrmService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ZohoCrmService(
                accessToken: $creds->get('zoho_crm', 'access_token', '', $account),
            );
        }

        return app(ZohoCrmService::class);
    }
}
