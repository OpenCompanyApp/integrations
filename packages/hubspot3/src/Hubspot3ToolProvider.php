<?php

namespace OpenCompany\Integrations\Hubspot3;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Hubspot3\Tools\Hubspot3ListContacts;
use OpenCompany\Integrations\Hubspot3\Tools\Hubspot3GetContact;
use OpenCompany\Integrations\Hubspot3\Tools\Hubspot3CreateContact;
use OpenCompany\Integrations\Hubspot3\Tools\Hubspot3ListCompanies;
use OpenCompany\Integrations\Hubspot3\Tools\Hubspot3GetCompany;
use OpenCompany\Integrations\Hubspot3\Tools\Hubspot3ListDeals;
use OpenCompany\Integrations\Hubspot3\Tools\Hubspot3GetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all HubSpot tools and provides integration metadata, configuration schema, and connection testing.
 */
class Hubspot3ToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'hubspot3';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'HubSpot',
            'description' => 'Marketing and CRM platform',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:hubspot',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'HubSpot',
            'description' => 'Marketing and CRM platform – contacts, companies, and deals',
            'icon' => 'ph:chart-line-up',
            'logo' => 'simple-icons:hubspot',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.hubspot.com/docs/api/overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'pat-...',
                'hint' => 'HubSpot Private App access token or OAuth 2.0 token. Generate via HubSpot Settings → Integrations → Private Apps.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.hubapi.com/v1',
                'hint' => 'Override only if using a custom HubSpot API endpoint. Defaults to <code>https://api.hubapi.com/v1</code>.',
                'default' => 'https://api.hubapi.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.hubapi.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate one via HubSpot Private Apps or OAuth.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/integrations/v1/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $email = $data['user'] ?? $data['email'] ?? '';
                $name = $name = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to HubSpot as {$name} ({$email}).",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $body['error'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'HubSpot API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Contacts
            'hubspot3_list_contacts' => [
                'class' => Hubspot3ListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List HubSpot contacts.',
                'icon' => 'ph:users',
            ],
            'hubspot3_get_contact' => [
                'class' => Hubspot3GetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve a HubSpot contact by ID.',
                'icon' => 'ph:user',
            ],
            'hubspot3_create_contact' => [
                'class' => Hubspot3CreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new HubSpot contact.',
                'icon' => 'ph:user-plus',
            ],
            // Companies
            'hubspot3_list_companies' => [
                'class' => Hubspot3ListCompanies::class,
                'type' => 'read',
                'name' => 'List Companies',
                'description' => 'List HubSpot companies.',
                'icon' => 'ph:buildings',
            ],
            'hubspot3_get_company' => [
                'class' => Hubspot3GetCompany::class,
                'type' => 'read',
                'name' => 'Get Company',
                'description' => 'Retrieve a HubSpot company by ID.',
                'icon' => 'ph:building-office',
            ],
            // Deals
            'hubspot3_list_deals' => [
                'class' => Hubspot3ListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List HubSpot deals.',
                'icon' => 'ph:handshake',
            ],
            'hubspot3_get_current_user' => [
                'class' => Hubspot3GetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated HubSpot user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/hubspot3.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.hubapi.com/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Hubspot3Service, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): Hubspot3Service
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new Hubspot3Service(
                accessToken: $creds->get('hubspot3', 'access_token', '', $account),
                baseUrl: $creds->get('hubspot3', 'base_url', 'https://api.hubapi.com/v1', $account),
            );
        }

        return app(Hubspot3Service::class);
    }
}
