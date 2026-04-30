<?php

namespace OpenCompany\Integrations\Freshsales;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesListContacts;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesGetContact;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesCreateContact;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesListDeals;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesGetDeal;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesListAccounts;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesCreateDeal;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesDeleteContact;
use OpenCompany\Integrations\Freshsales\Tools\FreshsalesUpdateContact;
class FreshsalesToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'freshsales';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Freshsales',
            'description' => 'CRM & sales management',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:freshworks',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Freshsales',
            'description' => 'CRM platform for managing contacts, deals, and sales accounts',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:freshworks',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developers.freshworks.com/crm/api/',
        ];
    }    public function configSchema(): array
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
                'hint' => 'Your Freshsales subdomain (the part before <code>.myfreshworks.com</code>). For example, if your URL is <code>https://mycompany.myfreshworks.com/crm/sales</code>, enter <code>mycompany</code>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $domain = $config['domain'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($domain)) {
            return ['success' => false, 'error' => 'No domain provided'];
        }

        $baseUrl = 'https://' . $domain . '.myfreshworks.com/crm/sales';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token token=' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/users/me');

            if ($response->successful()) {
                $user = $response->json();

                return [
                    'success' => true,
                    'message' => 'Connected to Freshsales as ' . ($user['user']['display_name'] ?? $user['user']['email'] ?? 'unknown user') . '.',
                ];
            }

            return [
                'success' => false,
                'error' => "Connection failed (HTTP {$response->status()}): " . ($response->json('error') ?? $response->body()),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'domain' => 'nullable|string',
        ];
    }

        public function tools(): array
    {
        return [
            'freshsales_create_contact' => [
                'class' => FreshsalesCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Freshsales CRM with name, email, and phone details.',
                'icon' => 'ph:wrench',
            ],
            'freshsales_get_contact' => [
                'class' => FreshsalesGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get full details for a specific Freshsales contact by ID.',
                'icon' => 'ph:wrench',
            ],
            'freshsales_get_current_user' => [
                'class' => FreshsalesGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Freshsales user. Useful for verifying the API connection.',
                'icon' => 'ph:wrench',
            ],
            'freshsales_get_deal' => [
                'class' => FreshsalesGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Get full details for a specific Freshsales deal by ID.',
                'icon' => 'ph:wrench',
            ],
            'freshsales_list_accounts' => [
                'class' => FreshsalesListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List sales accounts (companies) from Freshsales CRM. Returns paginated results.',
                'icon' => 'ph:wrench',
            ],
            'freshsales_list_contacts' => [
                'class' => FreshsalesListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from Freshsales CRM. Returns paginated results with optional sorting by field and direction.',
                'icon' => 'ph:wrench',
            ],
            'freshsales_list_deals' => [
                'class' => FreshsalesListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List deals from Freshsales CRM. Returns paginated results showing deal pipeline information.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/freshsales.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'domain', 'type' => 'string', 'label' => 'Domain', 'required' => true],
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
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $domain = $creds->get('freshsales', 'domain', '', $account);
            $baseUrl = $domain
                ? 'https://' . $domain . '.myfreshworks.com/crm/sales'
                : '';

            $service = new FreshsalesService(
                apiKey: $creds->get('freshsales', 'api_key', '', $account),
                baseUrl: $baseUrl,
            );

            return new $class($service);
        }

        return new $class(app(FreshsalesService::class));
    }
}
