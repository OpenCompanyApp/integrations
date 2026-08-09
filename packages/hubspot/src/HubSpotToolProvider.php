<?php

namespace OpenCompany\Integrations\HubSpot;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotAddContactToList;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotCreateAssociation;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotCreateCompany;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotCreateContact;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotCreateDeal;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotCreateEngagement;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotCreateOrUpdateContact;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotCreateTicket;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotDeleteContact;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotGetCompany;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotGetContact;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotGetCurrentUser;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotGetDeal;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotGetTicket;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotListAssociations;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotListCompanies;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotListContacts;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotListDeals;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotListForms;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotListOwners;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotListPipelines;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotListProperties;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotSearchCompanies;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotSearchContacts;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotUpdateCompany;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotUpdateContact;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotUpdateDeal;
use OpenCompany\Integrations\HubSpot\Tools\HubSpotUpdateTicket;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all HubSpot tools and provides integration metadata, configuration schema, and connection testing.
 */
class HubSpotToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'hubspot';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'HubSpot',
            'description' => 'CRM platform',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:hubspot',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'HubSpot',
            'description' => 'CRM contacts, companies, deals, tickets, associations, engagements, and marketing forms',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:hubspot',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.hubspot.com/docs/api/overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Private App Access Token',
                'placeholder' => 'pat-...',
                'hint' => 'Create a private app in HubSpot Settings → Integrations → Private Apps with the required scopes.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.hubapi.com',
                'hint' => 'Use the default HubSpot API URL unless you have a compatible gateway.',
                'default' => 'https://api.hubapi.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://api.hubapi.com'), '/');

        if (str_ends_with($baseUrl, '/v1')) {
            $baseUrl = substr($baseUrl, 0, -3);
        }

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Create one at HubSpot Settings → Integrations → Private Apps.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/crm/v3/owners', ['limit' => 1]);

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $total = $data['total'] ?? count($data['results'] ?? []);

                return [
                    'success' => true,
                    'message' => "Connected to HubSpot. Found {$total} owner(s).",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'HubSpot API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Contacts
            'hubspot_create_contact' => [
                'class' => HubSpotCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in HubSpot.',
                'icon' => 'ph:user-plus',
            ],
            'hubspot_get_contact' => [
                'class' => HubSpotGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve a HubSpot contact by ID.',
                'icon' => 'ph:user',
            ],
            'hubspot_update_contact' => [
                'class' => HubSpotUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing HubSpot contact.',
                'icon' => 'ph:pencil-simple',
            ],
            'hubspot_search_contacts' => [
                'class' => HubSpotSearchContacts::class,
                'type' => 'read',
                'name' => 'Search Contacts',
                'description' => 'Search HubSpot contacts with filters.',
                'icon' => 'ph:magnifying-glass',
            ],
            'hubspot_delete_contact' => [
                'class' => HubSpotDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a HubSpot contact.',
                'icon' => 'ph:trash',
            ],
            'hubspot_create_or_update_contact' => [
                'class' => HubSpotCreateOrUpdateContact::class,
                'type' => 'write',
                'name' => 'Create or Update Contact',
                'description' => 'Create or update a HubSpot contact by email.',
                'icon' => 'ph:user-check',
            ],
            'hubspot_list_contacts' => [
                'class' => HubSpotListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List HubSpot contacts with pagination.',
                'icon' => 'ph:users',
            ],
            // Companies
            'hubspot_create_company' => [
                'class' => HubSpotCreateCompany::class,
                'type' => 'write',
                'name' => 'Create Company',
                'description' => 'Create a new company in HubSpot.',
                'icon' => 'ph:buildings',
            ],
            'hubspot_get_company' => [
                'class' => HubSpotGetCompany::class,
                'type' => 'read',
                'name' => 'Get Company',
                'description' => 'Retrieve a HubSpot company by ID.',
                'icon' => 'ph:building',
            ],
            'hubspot_update_company' => [
                'class' => HubSpotUpdateCompany::class,
                'type' => 'write',
                'name' => 'Update Company',
                'description' => 'Update an existing HubSpot company.',
                'icon' => 'ph:pencil-simple',
            ],
            'hubspot_search_companies' => [
                'class' => HubSpotSearchCompanies::class,
                'type' => 'read',
                'name' => 'Search Companies',
                'description' => 'Search HubSpot companies with filters.',
                'icon' => 'ph:magnifying-glass',
            ],
            'hubspot_list_companies' => [
                'class' => HubSpotListCompanies::class,
                'type' => 'read',
                'name' => 'List Companies',
                'description' => 'List HubSpot companies with pagination.',
                'icon' => 'ph:buildings',
            ],
            // Deals
            'hubspot_create_deal' => [
                'class' => HubSpotCreateDeal::class,
                'type' => 'write',
                'name' => 'Create Deal',
                'description' => 'Create a new deal in HubSpot.',
                'icon' => 'ph:currency-dollar',
            ],
            'hubspot_get_deal' => [
                'class' => HubSpotGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Retrieve a HubSpot deal by ID.',
                'icon' => 'ph:handshake',
            ],
            'hubspot_update_deal' => [
                'class' => HubSpotUpdateDeal::class,
                'type' => 'write',
                'name' => 'Update Deal',
                'description' => 'Update an existing HubSpot deal.',
                'icon' => 'ph:pencil-simple',
            ],
            'hubspot_list_deals' => [
                'class' => HubSpotListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List HubSpot deals with pagination.',
                'icon' => 'ph:list',
            ],
            // Tickets
            'hubspot_create_ticket' => [
                'class' => HubSpotCreateTicket::class,
                'type' => 'write',
                'name' => 'Create Ticket',
                'description' => 'Create a new ticket in HubSpot.',
                'icon' => 'ph:ticket',
            ],
            'hubspot_get_ticket' => [
                'class' => HubSpotGetTicket::class,
                'type' => 'read',
                'name' => 'Get Ticket',
                'description' => 'Retrieve a HubSpot ticket by ID.',
                'icon' => 'ph:ticket',
            ],
            'hubspot_update_ticket' => [
                'class' => HubSpotUpdateTicket::class,
                'type' => 'write',
                'name' => 'Update Ticket',
                'description' => 'Update an existing HubSpot ticket.',
                'icon' => 'ph:pencil-simple',
            ],
            // Associations & Metadata
            'hubspot_create_association' => [
                'class' => HubSpotCreateAssociation::class,
                'type' => 'write',
                'name' => 'Create Association',
                'description' => 'Associate two HubSpot CRM objects.',
                'icon' => 'ph:link',
            ],
            'hubspot_list_associations' => [
                'class' => HubSpotListAssociations::class,
                'type' => 'read',
                'name' => 'List Associations',
                'description' => 'List associations for a HubSpot object.',
                'icon' => 'ph:link',
            ],
            'hubspot_list_owners' => [
                'class' => HubSpotListOwners::class,
                'type' => 'read',
                'name' => 'List Owners',
                'description' => 'List HubSpot CRM owners.',
                'icon' => 'ph:users',
            ],
            'hubspot_create_engagement' => [
                'class' => HubSpotCreateEngagement::class,
                'type' => 'write',
                'name' => 'Create Engagement',
                'description' => 'Create a note, task, or meeting in HubSpot.',
                'icon' => 'ph:chat-circle-text',
            ],
            'hubspot_list_pipelines' => [
                'class' => HubSpotListPipelines::class,
                'type' => 'read',
                'name' => 'List Pipelines',
                'description' => 'List HubSpot CRM pipelines.',
                'icon' => 'ph:funnel',
            ],
            'hubspot_list_properties' => [
                'class' => HubSpotListProperties::class,
                'type' => 'read',
                'name' => 'List Properties',
                'description' => 'List HubSpot CRM property definitions.',
                'icon' => 'ph:sliders',
            ],
            'hubspot_add_contact_to_list' => [
                'class' => HubSpotAddContactToList::class,
                'type' => 'write',
                'name' => 'Add Contact to List',
                'description' => 'Add contacts to a HubSpot marketing list.',
                'icon' => 'ph:list-plus',
            ],
            'hubspot_list_forms' => [
                'class' => HubSpotListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List HubSpot marketing forms.',
                'icon' => 'ph:notebook',
            ],
            'hubspot_get_current_user' => [
                'class' => HubSpotGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated HubSpot user and portal.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/hubspot.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Private App Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.hubapi.com'],
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
     * Resolve the HubSpotService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): HubSpotService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);
            $accessToken = (string) $creds->get('hubspot', 'access_token', '', $account);
            $baseUrl = (string) $creds->get('hubspot', 'base_url', '', $account);

            if ($accessToken === '') {
                $accessToken = (string) $creds->get('hubspot3', 'access_token', '', $account);
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('hubspot3', 'base_url', 'https://api.hubapi.com', $account);
            }

            return new HubSpotService(
                accessToken: $accessToken,
                baseUrl: $baseUrl,
            );
        }

        return app(HubSpotService::class);
    }
}
