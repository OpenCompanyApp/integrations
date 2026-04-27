<?php

namespace OpenCompany\Integrations\ZendeskSell;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListContacts;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetContact;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellCreateContact;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListDeals;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetDeal;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellListLeads;
use OpenCompany\Integrations\ZendeskSell\Tools\ZendeskSellGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ZendeskSellToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'zendesk-sell';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'contacts, deals, leads',
            'description' => 'Sales CRM',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:zendesk',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zendesk Sell',
            'description' => 'Sales CRM for managing contacts, deals, and leads',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:zendesk',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developers.getbase.com/docs/rest',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zendesk Sell access token',
                'hint' => 'Generate a personal access token in Zendesk Sell under Settings &gt; Integrations &gt; API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getbase.com',
                'hint' => 'Use <code>https://api.getbase.com</code> for the standard Zendesk Sell API',
                'default' => 'https://api.getbase.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.getbase.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Zendesk Sell API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your access token.",
                ];
            }

            $userName = $json['data']['first_name'] . ' ' . $json['data']['last_name'];

            return [
                'success' => true,
                'message' => "Connected to Zendesk Sell as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'zendesk_sell_list_contacts' => [
                'class' => ZendeskSellListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in Zendesk Sell.',
                'icon' => 'ph:users',
            ],
            'zendesk_sell_get_contact' => [
                'class' => ZendeskSellGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:user',
            ],
            'zendesk_sell_create_contact' => [
                'class' => ZendeskSellCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Zendesk Sell.',
                'icon' => 'ph:user-plus',
            ],
            'zendesk_sell_list_deals' => [
                'class' => ZendeskSellListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List deals in Zendesk Sell.',
                'icon' => 'ph:currency-dollar',
            ],
            'zendesk_sell_get_deal' => [
                'class' => ZendeskSellGetDeal::class,
                'type' => 'read',
                'name' => 'Get Deal',
                'description' => 'Get details of a specific deal.',
                'icon' => 'ph:currency-dollar',
            ],
            'zendesk_sell_list_leads' => [
                'class' => ZendeskSellListLeads::class,
                'type' => 'read',
                'name' => 'List Leads',
                'description' => 'List leads in Zendesk Sell.',
                'icon' => 'ph:magnifying-glass',
            ],
            'zendesk_sell_get_current_user' => [
                'class' => ZendeskSellGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Zendesk Sell user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zendesk-sell.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.getbase.com'],
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

            $service = new ZendeskSellService(
                accessToken: $creds->get('zendesk-sell', 'access_token', '', $account),
                baseUrl: $creds->get('zendesk-sell', 'url', 'https://api.getbase.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(ZendeskSellService::class));
    }
}
