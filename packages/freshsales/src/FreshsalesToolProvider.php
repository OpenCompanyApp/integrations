<?php

namespace OpenCompany\Integrations\Freshsales;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesListContacts;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesGetContact;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesCreateContact;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesUpdateContact;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesDeleteContact;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesListDeals;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesGetDeal;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesCreateDeal;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesListAccounts;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesGetCurrentUser;

class FreshsalesToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'freshsales';
    }

    /**
     * Get metadata for the application display.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'contacts, deals, accounts',
            'description' => 'CRM',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:freshworks',
        ];
    }

    /**
     * Get integration metadata for display and categorization.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Freshsales',
            'description' => 'CRM for high-velocity sales teams',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:freshworks',
            'category' => 'crm',
            'badge' => 'verified',
            'docs_url' => 'https://developers.freshworks.com/crm/api/',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your Freshsales API key',
                'hint' => 'Find your API key in Freshsales under Profile Settings → API Settings',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'string',
                'label' => 'Domain',
                'placeholder' => 'mycompany',
                'hint' => 'Your Freshsales subdomain (the part before <code>.myfreshworks.com</code>)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Freshsales API using the given configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array<string, mixed>
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $domain = $config['domain'] ?? '';

        if (empty($apiKey) || empty($domain)) {
            return ['success' => false, 'error' => 'API key and domain are required.'];
        }

        try {
            $baseUrl = "https://{$domain}.myfreshworks.com/crm/sales/api";

            $response = Http::withHeaders([
                'Authorization' => 'Token token=' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $user = $response->json();

                return [
                    'success' => true,
                    'message' => "Connected to Freshsales as " . ($user['user']['display_name'] ?? $user['user']['email'] ?? 'unknown user') . ".",
                ];
            }

            return [
                'success' => false,
                'error' => "Authentication failed (HTTP {$response->status()}). Check your API key and domain.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the integration configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'domain' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'freshsales_list_contacts' => [
                'class' => FreshsalesListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from Freshsales CRM.',
                'icon' => 'ph:users',
            ],
            'freshsales_get_contact' => [
                'class' => FreshsalesGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:user',
            ],
            'freshsales_create_contact' => [
                'class' => FreshsalesCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Freshsales.',
                'icon' => 'ph:user-plus',
            ],
            'freshsales_update_contact' => [
                'class' => FreshsalesUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing contact in Freshsales.',
                'icon' => 'ph:pencil-simple',
            ],
            'freshsales_delete_contact' => [
                'class' => FreshsalesDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a contact from Freshsales.',
                'icon' => 'ph:trash',
            ],
            'freshsales_list_deals' => [
                'class' => FreshsalesListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List deals from Freshsales CRM.',
                'icon' => 'ph:currency-dollar',
            ],
            'freshsales_get_deal' => [
                'class' => FreshsalesGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Get details of a specific deal.',
                'icon' => 'ph:currency-dollar',
            ],
            'freshsales_create_deal' => [
                'class' => FreshsalesCreateDeal::class,
                'type' => 'write',
                'name' => 'Create Deal',
                'description' => 'Create a new deal in Freshsales.',
                'icon' => 'ph:plus',
            ],
            'freshsales_list_accounts' => [
                'class' => FreshsalesListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List sales accounts from Freshsales.',
                'icon' => 'ph:buildings',
            ],
            'freshsales_get_current_user' => [
                'class' => FreshsalesGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Freshsales user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/freshsales.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'domain', 'type' => 'string', 'label' => 'Domain', 'required' => true],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context with optional 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FreshsalesService(
                apiKey: $creds->get('freshsales', 'api_key', '', $account),
                domain: $creds->get('freshsales', 'domain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(FreshsalesService::class));
    }
}
