<?php

namespace OpenCompany\Integrations\GetResponse;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseListContacts;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseGetContact;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseCreateContact;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseUpdateContact;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseDeleteContact;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseListCampaigns;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseGetCampaign;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseCreateCampaign;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseListNewsletters;
use OpenCompany\Integrations\GetResponse\Tools\GetResponseGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GetResponseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'getresponse';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'GetResponse',
            'description' => 'Email marketing platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:getresponse',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'GetResponse',
            'description' => 'Email marketing and automation platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:getresponse',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://apidoc.getresponse.com/v3',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your GetResponse API key',
                'hint' => 'Find your API key in GetResponse under Account > API & OAuth > Generate new API key',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getresponse.com/v3',
                'hint' => 'Use the default URL for GetResponse, or a custom endpoint if applicable',
                'default' => 'https://api.getresponse.com/v3',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.getresponse.com/v3', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Auth-Token' => 'api-key ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/accounts');

            if ($response->successful()) {
                $data = $response->json();
                $email = $data['email'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to GetResponse as {$email}.",
                ];
            }

            return [
                'success' => false,
                'error' => "GetResponse API returned HTTP {$response->status()}.",
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
            'getresponse_list_contacts' => [
                'class' => GetResponseListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in your GetResponse account with pagination.',
                'icon' => 'ph:users',
            ],
            'getresponse_get_contact' => [
                'class' => GetResponseGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact by ID.',
                'icon' => 'ph:user',
            ],
            'getresponse_create_contact' => [
                'class' => GetResponseCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in GetResponse.',
                'icon' => 'ph:user-plus',
            ],
            'getresponse_update_contact' => [
                'class' => GetResponseUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing contact\'s details.',
                'icon' => 'ph:pencil',
            ],
            'getresponse_delete_contact' => [
                'class' => GetResponseDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a contact from GetResponse.',
                'icon' => 'ph:trash',
            ],
            'getresponse_list_campaigns' => [
                'class' => GetResponseListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List all email campaigns in your GetResponse account.',
                'icon' => 'ph:envelope',
            ],
            'getresponse_get_campaign' => [
                'class' => GetResponseGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details of a specific campaign by ID.',
                'icon' => 'ph:envelope',
            ],
            'getresponse_create_campaign' => [
                'class' => GetResponseCreateCampaign::class,
                'type' => 'write',
                'name' => 'Create Campaign',
                'description' => 'Create a new email campaign.',
                'icon' => 'ph:plus',
            ],
            'getresponse_list_newsletters' => [
                'class' => GetResponseListNewsletters::class,
                'type' => 'read',
                'name' => 'List Newsletters',
                'description' => 'List newsletters in your GetResponse account.',
                'icon' => 'ph:envelope',
            ],
            'getresponse_get_current_user' => [
                'class' => GetResponseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/getresponse.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.getresponse.com/v3'],
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

            $service = new GetResponseService(
                apiKey: $creds->get('getresponse', 'api_key', '', $account),
                baseUrl: $creds->get('getresponse', 'url', 'https://api.getresponse.com/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(GetResponseService::class));
    }
}
