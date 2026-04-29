<?php

namespace OpenCompany\Integrations\FreshworksCrm;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmListContacts;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmGetContact;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmCreateContact;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmListDeals;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmGetDeal;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmListAccounts;
use OpenCompany\Integrations\FreshworksCrm\Tools\FreshworksCrmGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FreshworksCrmToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'freshworks_crm';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Freshworks CRM',
            'description' => 'CRM & Sales',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:freshworks',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Freshworks CRM',
            'description' => 'Sales CRM by Freshworks — manage contacts, deals, and accounts',
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
                'placeholder' => 'Enter your Freshworks CRM API key',
                'hint' => 'Find your API key in Freshworks CRM under Profile Settings → API Settings',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'string',
                'label' => 'Domain',
                'placeholder' => 'mycompany',
                'hint' => 'Your Freshworks subdomain (the part before <code>.myfreshworks.com</code>). E.g., enter <code>mycompany</code> for <code>mycompany.myfreshworks.com</code>',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Custom Base URL',
                'placeholder' => '',
                'hint' => 'Override the auto-generated URL. Leave empty to use <code>https://{domain}.myfreshworks.com/crm/sales</code>',
                'required' => false,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $domain = $config['domain'] ?? '';
        $baseUrl = $config['base_url'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($domain) && empty($baseUrl)) {
            return ['success' => false, 'error' => 'No domain or base URL provided'];
        }

        $url = !empty($baseUrl)
            ? rtrim($baseUrl, '/')
            : "https://{$domain}.myfreshworks.com/crm/sales";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token token=' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($url . '/api/users/me');

            $json = $response->json();

            if ($response->successful() && $json !== null) {
                $userName = $json['user']['first_name'] ?? 'User';

                return [
                    'success' => true,
                    'message' => "Connected to Freshworks CRM as {$userName}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Could not connect to Freshworks CRM (HTTP {$response->status()}). Check your domain and API key.",
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
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'freshworks_crm_list_contacts' => [
                'class' => FreshworksCrmListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in Freshworks CRM with pagination.',
                'icon' => 'ph:users',
            ],
            'freshworks_crm_get_contact' => [
                'class' => FreshworksCrmGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a single contact by ID.',
                'icon' => 'ph:user',
            ],
            'freshworks_crm_create_contact' => [
                'class' => FreshworksCrmCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Freshworks CRM.',
                'icon' => 'ph:user-plus',
            ],
            'freshworks_crm_list_deals' => [
                'class' => FreshworksCrmListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List deals in Freshworks CRM with pagination and optional stage filter.',
                'icon' => 'ph:currency-dollar',
            ],
            'freshworks_crm_get_deal' => [
                'class' => FreshworksCrmGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Get a single deal by ID.',
                'icon' => 'ph:currency-dollar',
            ],
            'freshworks_crm_list_accounts' => [
                'class' => FreshworksCrmListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List sales accounts in Freshworks CRM with pagination.',
                'icon' => 'ph:buildings',
            ],
            'freshworks_crm_get_current_user' => [
                'class' => FreshworksCrmGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Freshworks CRM user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/freshworks-crm.md';
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

            $domain = $creds->get('freshworks_crm', 'domain', '', $account);
            $baseUrl = $domain
                ? "https://{$domain}.myfreshworks.com/crm/sales"
                : $creds->get('freshworks_crm', 'base_url', '', $account);

            $service = new FreshworksCrmService(
                apiKey: $creds->get('freshworks_crm', 'api_key', '', $account),
                baseUrl: $baseUrl,
            );

            return new $class($service);
        }

        return new $class(app(FreshworksCrmService::class));
    }
}
