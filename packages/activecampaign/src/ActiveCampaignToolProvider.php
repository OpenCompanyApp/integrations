<?php

namespace OpenCompany\Integrations\ActiveCampaign;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListContacts;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignGetContact;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignCreateContact;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignUpdateContact;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignDeleteContact;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListLists;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignGetList;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignAddContactToList;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignAddContactTag;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignApiDelete;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignApiGet;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignApiPost;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignApiPut;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignRemoveContactFromList;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignCreateAccount;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListDeals;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignGetDeal;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignCreateDeal;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignCreateField;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignCreateFieldValue;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignUpdateDeal;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListAutomations;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignCreateTag;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignCreateNote;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignDeleteDeal;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignGetAccount;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignGetCampaign;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignGetCurrentUser;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListAccounts;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListCampaigns;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListContactTags;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListDealGroups;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListDealStages;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListFields;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListMessages;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListTags;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListUsers;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignRemoveContactTag;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignSyncContact;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignUpdateAccount;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignUpdateFieldValue;

/**
 * Registers the integration provider and exposes its tools.
 */
class ActiveCampaignToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => [
                    'manual_secret',
                ],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [
                    'api_key',
                ],
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

    /**
     * Get the internal app name identifier.
     *
     * @return string The app name slug.
     */
    public function appName(): string
    {
        return 'activecampaign';
    }

    /**
     * Get metadata for the app display.
     *
     * @return array{label: string, description: string, icon: string, logo: string} App metadata.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'ActiveCampaign',
            'description' => 'Email marketing & CRM',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:activecampaign',
        ];
    }

    /**
     * Get integration metadata for the marketplace display.
     *
     * @return array{name: string, description: string, icon: string, logo: string, category: string, badge: string, docs_url: string} Integration metadata.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'ActiveCampaign',
            'description' => 'Email marketing, marketing automation, and CRM platform',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:activecampaign',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.activecampaign.com/reference',
        ];
    }

    /**
     * Define the configuration schema for the ActiveCampaign integration.
     *
     * @return array<int, array{key: string, type: string, label: string, placeholder?: string, hint?: string, required?: bool}> The config field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your ActiveCampaign API key',
                'hint' => 'Find your API key in Settings → Developer under "API Access"',
                'required' => true,
            ],
            [
                'key' => 'account_name',
                'type' => 'string',
                'label' => 'Account Name',
                'placeholder' => 'e.g., mycompany',
                'hint' => 'The subdomain from your ActiveCampaign URL (e.g., <code>mycompany</code> from <code>mycompany.activehosted.com</code>)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the ActiveCampaign API connection using the provided configuration.
     *
     * @param  array $config The configuration array containing 'api_key' and 'account_name'.
     * @return array{success: bool, message?: string, error?: string} The connection test result.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $accountName = $config['account_name'] ?? '';

        if (empty($apiKey) || empty($accountName)) {
            return ['success' => false, 'error' => 'API key and account name are required.'];
        }

        try {
            $baseUrl = "https://{$accountName}.api-us1.com/api/3";

            $response = Http::withHeaders([
                'Api-Token' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get("{$baseUrl}/users/me");

            if (!$response->successful()) {
                $error = $response->json('message') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Connection failed: {$error}",
                ];
            }

            $userData = $response->json();
            $username = $userData['user']['username'] ?? $userData['user']['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to ActiveCampaign as {$username}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, string> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'account_name' => 'required|string',
        ];
    }

    /**
     * Get all available ActiveCampaign tools.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}> The tool definitions.
     */
    public function tools(): array
    {
        return [
            'activecampaign_list_contacts' => [
                'class' => ActiveCampaignListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts with pagination, search, and filters.',
                'icon' => 'ph:users',
            ],
            'activecampaign_get_contact' => [
                'class' => ActiveCampaignGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:user',
            ],
            'activecampaign_create_contact' => [
                'class' => ActiveCampaignCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact.',
                'icon' => 'ph:user-plus',
            ],
            'activecampaign_update_contact' => [
                'class' => ActiveCampaignUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing contact.',
                'icon' => 'ph:pencil-simple',
            ],
            'activecampaign_delete_contact' => [
                'class' => ActiveCampaignDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a contact.',
                'icon' => 'ph:trash',
            ],
            'activecampaign_list_lists' => [
                'class' => ActiveCampaignListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all contact lists.',
                'icon' => 'ph:list-bullets',
            ],
            'activecampaign_get_list' => [
                'class' => ActiveCampaignGetList::class,
                'type' => 'read',
                'name' => 'Get List',
                'description' => 'Get details of a specific list.',
                'icon' => 'ph:list-bullets',
            ],
            'activecampaign_add_contact_to_list' => [
                'class' => ActiveCampaignAddContactToList::class,
                'type' => 'write',
                'name' => 'Add Contact to List',
                'description' => 'Subscribe a contact to a list.',
                'icon' => 'ph:user-plus',
            ],
            'activecampaign_remove_contact_from_list' => [
                'class' => ActiveCampaignRemoveContactFromList::class,
                'type' => 'write',
                'name' => 'Remove Contact from List',
                'description' => 'Unsubscribe a contact from a list.',
                'icon' => 'ph:user-minus',
            ],
            'activecampaign_list_deals' => [
                'class' => ActiveCampaignListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List deals with filters.',
                'icon' => 'ph:handshake',
            ],
            'activecampaign_get_deal' => [
                'class' => ActiveCampaignGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Get details of a specific deal.',
                'icon' => 'ph:handshake',
            ],
            'activecampaign_create_deal' => [
                'class' => ActiveCampaignCreateDeal::class,
                'type' => 'write',
                'name' => 'Create Deal',
                'description' => 'Create a new deal.',
                'icon' => 'ph:plus',
            ],
            'activecampaign_update_deal' => [
                'class' => ActiveCampaignUpdateDeal::class,
                'type' => 'write',
                'name' => 'Update Deal',
                'description' => 'Update an existing deal.',
                'icon' => 'ph:pencil-simple',
            ],
            'activecampaign_list_automations' => [
                'class' => ActiveCampaignListAutomations::class,
                'type' => 'read',
                'name' => 'List Automations',
                'description' => 'List all automations.',
                'icon' => 'ph:lightning',
            ],
            'activecampaign_create_note' => [
                'class' => ActiveCampaignCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Add a note to a contact.',
                'icon' => 'ph:note',
            ],
            'activecampaign_get_current_user' => [
                'class' => ActiveCampaignGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user.',
                'icon' => 'ph:user-circle',
            ],
            'activecampaign_list_users' => [
                'class' => ActiveCampaignListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List account users.',
                'icon' => 'ph:users-three',
            ],
            'activecampaign_sync_contact' => [
                'class' => ActiveCampaignSyncContact::class,
                'type' => 'write',
                'name' => 'Sync Contact',
                'description' => 'Create or update a contact by email.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'activecampaign_list_tags' => [
                'class' => ActiveCampaignListTags::class,
                'type' => 'read',
                'name' => 'List Tags',
                'description' => 'List contact tags.',
                'icon' => 'ph:tag',
            ],
            'activecampaign_create_tag' => [
                'class' => ActiveCampaignCreateTag::class,
                'type' => 'write',
                'name' => 'Create Tag',
                'description' => 'Create a contact tag.',
                'icon' => 'ph:tag-chevron',
            ],
            'activecampaign_add_contact_tag' => [
                'class' => ActiveCampaignAddContactTag::class,
                'type' => 'write',
                'name' => 'Add Contact Tag',
                'description' => 'Add an existing tag to a contact.',
                'icon' => 'ph:tag',
            ],
            'activecampaign_remove_contact_tag' => [
                'class' => ActiveCampaignRemoveContactTag::class,
                'type' => 'write',
                'name' => 'Remove Contact Tag',
                'description' => 'Remove a contact-tag relationship.',
                'icon' => 'ph:tag',
            ],
            'activecampaign_list_contact_tags' => [
                'class' => ActiveCampaignListContactTags::class,
                'type' => 'read',
                'name' => 'List Contact Tags',
                'description' => 'List tags applied to a contact.',
                'icon' => 'ph:tags',
            ],
            'activecampaign_list_fields' => [
                'class' => ActiveCampaignListFields::class,
                'type' => 'read',
                'name' => 'List Fields',
                'description' => 'List custom contact fields.',
                'icon' => 'ph:textbox',
            ],
            'activecampaign_create_field' => [
                'class' => ActiveCampaignCreateField::class,
                'type' => 'write',
                'name' => 'Create Field',
                'description' => 'Create a custom contact field.',
                'icon' => 'ph:textbox',
            ],
            'activecampaign_create_field_value' => [
                'class' => ActiveCampaignCreateFieldValue::class,
                'type' => 'write',
                'name' => 'Create Field Value',
                'description' => 'Create a contact custom field value.',
                'icon' => 'ph:input',
            ],
            'activecampaign_update_field_value' => [
                'class' => ActiveCampaignUpdateFieldValue::class,
                'type' => 'write',
                'name' => 'Update Field Value',
                'description' => 'Update a contact custom field value.',
                'icon' => 'ph:pencil-simple',
            ],
            'activecampaign_list_campaigns' => [
                'class' => ActiveCampaignListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List campaigns.',
                'icon' => 'ph:megaphone',
            ],
            'activecampaign_get_campaign' => [
                'class' => ActiveCampaignGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get a campaign by ID.',
                'icon' => 'ph:megaphone',
            ],
            'activecampaign_list_messages' => [
                'class' => ActiveCampaignListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List campaign messages.',
                'icon' => 'ph:envelope',
            ],
            'activecampaign_list_accounts' => [
                'class' => ActiveCampaignListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List CRM accounts.',
                'icon' => 'ph:buildings',
            ],
            'activecampaign_get_account' => [
                'class' => ActiveCampaignGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get a CRM account by ID.',
                'icon' => 'ph:building-office',
            ],
            'activecampaign_create_account' => [
                'class' => ActiveCampaignCreateAccount::class,
                'type' => 'write',
                'name' => 'Create Account',
                'description' => 'Create a CRM account.',
                'icon' => 'ph:building-office',
            ],
            'activecampaign_update_account' => [
                'class' => ActiveCampaignUpdateAccount::class,
                'type' => 'write',
                'name' => 'Update Account',
                'description' => 'Update a CRM account.',
                'icon' => 'ph:pencil-simple',
            ],
            'activecampaign_list_deal_groups' => [
                'class' => ActiveCampaignListDealGroups::class,
                'type' => 'read',
                'name' => 'List Deal Groups',
                'description' => 'List deal pipelines.',
                'icon' => 'ph:kanban',
            ],
            'activecampaign_list_deal_stages' => [
                'class' => ActiveCampaignListDealStages::class,
                'type' => 'read',
                'name' => 'List Deal Stages',
                'description' => 'List deal stages.',
                'icon' => 'ph:columns',
            ],
            'activecampaign_delete_deal' => [
                'class' => ActiveCampaignDeleteDeal::class,
                'type' => 'write',
                'name' => 'Delete Deal',
                'description' => 'Delete a deal.',
                'icon' => 'ph:trash',
            ],
            'activecampaign_api_get' => [
                'class' => ActiveCampaignApiGet::class,
                'type' => 'read',
                'name' => 'ActiveCampaign API GET',
                'description' => 'Call a documented GET endpoint under /api/3.',
                'icon' => 'ph:terminal-window',
            ],
            'activecampaign_api_post' => [
                'class' => ActiveCampaignApiPost::class,
                'type' => 'write',
                'name' => 'ActiveCampaign API POST',
                'description' => 'Call a documented POST endpoint under /api/3.',
                'icon' => 'ph:terminal-window',
            ],
            'activecampaign_api_put' => [
                'class' => ActiveCampaignApiPut::class,
                'type' => 'write',
                'name' => 'ActiveCampaign API PUT',
                'description' => 'Call a documented PUT endpoint under /api/3.',
                'icon' => 'ph:terminal-window',
            ],
            'activecampaign_api_delete' => [
                'class' => ActiveCampaignApiDelete::class,
                'type' => 'write',
                'name' => 'ActiveCampaign API DELETE',
                'description' => 'Call a documented DELETE endpoint under /api/3.',
                'icon' => 'ph:terminal-window',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     *
     * @return string|null The absolute path to the Lua docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/activecampaign.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}> The credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'account_name', 'type' => 'string', 'label' => 'Account Name', 'required' => true],
        ];
    }

    /**
     * Indicate that this is an integration provider.
     *
     * @return bool Always true.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolving credentials for a specific account.
     *
     * @param  string $class   The tool class FQCN.
     * @param  array  $context The context array, may contain an 'account' key for multi-account support.
     * @return Tool   The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new ActiveCampaignService(
                apiKey: $creds->get('activecampaign', 'api_key', '', $account),
                accountName: $creds->get('activecampaign', 'account_name', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ActiveCampaignService::class));
    }

}
