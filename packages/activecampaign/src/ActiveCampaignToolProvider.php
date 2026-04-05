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
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignRemoveContactFromList;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListDeals;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignGetDeal;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignCreateDeal;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignUpdateDeal;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignListAutomations;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignCreateNote;

/**
 * Tool provider for the ActiveCampaign integration.
 *
 * Registers all ActiveCampaign tools and provides integration configuration
 * including API key and account name fields, connection testing, and
 * multi-account support via credential resolution.
 */
class ActiveCampaignToolProvider implements ToolProvider, ConfigurableIntegration
{
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
            'label' => 'contacts, lists, deals, automations, notes',
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
            'category' => 'crm',
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
            'api_key' => 'nullable|string',
            'account_name' => 'nullable|string',
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
    {
        $account = $context['account'] ?? null;

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
