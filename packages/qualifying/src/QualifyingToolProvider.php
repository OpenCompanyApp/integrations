<?php

namespace OpenCompany\Integrations\Qualifying;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Qualifying\Tools\QualifyingListAccounts;
use OpenCompany\Integrations\Qualifying\Tools\QualifyingGetAccount;
use OpenCompany\Integrations\Qualifying\Tools\QualifyingListContacts;
use OpenCompany\Integrations\Qualifying\Tools\QualifyingGetContact;
use OpenCompany\Integrations\Qualifying\Tools\QualifyingListDeals;
use OpenCompany\Integrations\Qualifying\Tools\QualifyingGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class QualifyingToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'qualifying';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Qualifying',
            'description' => 'Sales CRM',
            'icon' => 'ph:handshake',
            'logo' => 'ph:handshake',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Qualifying',
            'description' => 'AI-powered sales CRM — manage accounts, contacts, and deals',
            'icon' => 'ph:handshake',
            'logo' => 'ph:handshake',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://docs.qualifying.ai',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Qualifying access token',
                'hint' => 'Generate an access token in your Qualifying account settings under "API Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.qualifying.ai',
                'hint' => 'Use <code>https://api.qualifying.ai</code> for cloud, or your self-hosted URL',
                'default' => 'https://api.qualifying.ai',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.qualifying.ai', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Qualifying API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your access token.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Qualifying API at {$baseUrl}.",
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
            'qualifying_list_accounts' => [
                'class' => QualifyingListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List sales accounts with pagination.',
                'icon' => 'ph:buildings',
            ],
            'qualifying_get_account' => [
                'class' => QualifyingGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get details for a specific account.',
                'icon' => 'ph:buildings',
            ],
            'qualifying_list_contacts' => [
                'class' => QualifyingListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts with optional account filter.',
                'icon' => 'ph:users',
            ],
            'qualifying_get_contact' => [
                'class' => QualifyingGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details for a specific contact.',
                'icon' => 'ph:user',
            ],
            'qualifying_list_deals' => [
                'class' => QualifyingListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List deals with optional stage filter.',
                'icon' => 'ph:currency-dollar',
            ],
            'qualifying_get_current_user' => [
                'class' => QualifyingGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/qualifying.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api.qualifying.ai'],
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

            $service = new QualifyingService(
                accessToken: $creds->get('qualifying', 'access_token', '', $account),
                baseUrl: $creds->get('qualifying', 'url', 'https://api.qualifying.ai', $account),
            );

            return new $class($service);
        }

        return new $class(app(QualifyingService::class));
    }
}
