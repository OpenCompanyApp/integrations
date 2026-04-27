<?php

namespace OpenCompany\Integrations\Vbout;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vbout\Tools\VboutListContacts;
use OpenCompany\Integrations\Vbout\Tools\VboutGetContact;
use OpenCompany\Integrations\Vbout\Tools\VboutCreateContact;
use OpenCompany\Integrations\Vbout\Tools\VboutListCampaigns;
use OpenCompany\Integrations\Vbout\Tools\VboutGetCampaign;
use OpenCompany\Integrations\Vbout\Tools\VboutGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class VboutToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'vbout';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'contacts, campaigns, users',
            'description' => 'Email marketing & CRM',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vbout',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'VBout',
            'description' => 'All-in-one email marketing, CRM, and marketing automation platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vbout',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://vbout.com/developers/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your VBout API key',
                'hint' => 'Find your API key in VBout under Settings → API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.vbout.com/1',
                'hint' => 'Defaults to <code>https://api.vbout.com/1</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.vbout.com/1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.vbout.com/1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach VBout API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your API key.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to VBout API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'vbout_list_contacts' => [
                'class' => VboutListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from VBout.',
                'icon' => 'ph:users',
            ],
            'vbout_get_contact' => [
                'class' => VboutGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details for a specific VBout contact.',
                'icon' => 'ph:user',
            ],
            'vbout_create_contact' => [
                'class' => VboutCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Add a new contact to a VBout list.',
                'icon' => 'ph:user-plus',
            ],
            'vbout_list_campaigns' => [
                'class' => VboutListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List email campaigns from VBout.',
                'icon' => 'ph:envelope',
            ],
            'vbout_get_campaign' => [
                'class' => VboutGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details for a specific VBout campaign.',
                'icon' => 'ph:envelope-open',
            ],
            'vbout_get_current_user' => [
                'class' => VboutGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated VBout user profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/vbout.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.vbout.com/1'],
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

            $service = new VboutService(
                apiKey: $creds->get('vbout', 'api_key', '', $account),
                baseUrl: $creds->get('vbout', 'url', 'https://api.vbout.com/1', $account),
            );

            return new $class($service);
        }

        return new $class(app(VboutService::class));
    }
}
