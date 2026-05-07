<?php

namespace OpenCompany\Integrations\Keap;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Keap\Tools\KeapListContacts;
use OpenCompany\Integrations\Keap\Tools\KeapGetContact;
use OpenCompany\Integrations\Keap\Tools\KeapCreateContact;
use OpenCompany\Integrations\Keap\Tools\KeapListOpportunities;
use OpenCompany\Integrations\Keap\Tools\KeapGetOpportunity;
use OpenCompany\Integrations\Keap\Tools\KeapListTags;
use OpenCompany\Integrations\Keap\Tools\KeapGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class KeapToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'keap';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Keap',
            'description' => 'CRM & sales automation',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:keap',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Keap',
            'description' => 'CRM and sales automation platform for small businesses',
            'icon' => 'ph:handshake',
            'logo' => 'simple-icons:keap',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.keap.com/docs/rest/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Keap access token',
                'hint' => 'Generate an access token in your Keap developer account at <code>https://developer.keap.com</code>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.keap.com',
                'hint' => 'Use <code>https://api.keap.com</code> for the standard Keap API',
                'default' => 'https://api.keap.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.keap.com', '/');

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
                    'error' => "Could not reach Keap API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = ($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? '');
            $name = trim($name) ?: 'Unknown user';

            return [
                'success' => true,
                'message' => "Connected to Keap API as {$name}.",
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
            'keap_list_contacts' => [
                'class' => KeapListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from Keap CRM with pagination.',
                'icon' => 'ph:users',
            ],
            'keap_get_contact' => [
                'class' => KeapGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve a single contact by ID.',
                'icon' => 'ph:user',
            ],
            'keap_create_contact' => [
                'class' => KeapCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Keap CRM.',
                'icon' => 'ph:user-plus',
            ],
            'keap_list_opportunities' => [
                'class' => KeapListOpportunities::class,
                'type' => 'read',
                'name' => 'List Opportunities',
                'description' => 'List sales opportunities with optional stage filter.',
                'icon' => 'ph:currency-dollar',
            ],
            'keap_get_opportunity' => [
                'class' => KeapGetOpportunity::class,
                'type' => 'read',
                'name' => 'Get Opportunity',
                'description' => 'Retrieve a single opportunity by ID.',
                'icon' => 'ph:currency-dollar',
            ],
            'keap_list_tags' => [
                'class' => KeapListTags::class,
                'type' => 'read',
                'name' => 'List Tags',
                'description' => 'List all tags in Keap.',
                'icon' => 'ph:tag',
            ],
            'keap_get_current_user' => [
                'class' => KeapGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Keap user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/keap.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.keap.com'],
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

            $service = new KeapService(
                accessToken: $creds->get('keap', 'access_token', '', $account),
                baseUrl: $creds->get('keap', 'url', 'https://api.keap.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(KeapService::class));
    }
}
