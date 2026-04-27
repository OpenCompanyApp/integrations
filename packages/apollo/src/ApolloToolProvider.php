<?php

namespace OpenCompany\Integrations\Apollo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Apollo\Tools\ApolloSearchContacts;
use OpenCompany\Integrations\Apollo\Tools\ApolloGetContact;
use OpenCompany\Integrations\Apollo\Tools\ApolloEnrich;
use OpenCompany\Integrations\Apollo\Tools\ApolloListOrganizations;
use OpenCompany\Integrations\Apollo\Tools\ApolloGetOrganization;
use OpenCompany\Integrations\Apollo\Tools\ApolloGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class ApolloToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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




/**
     * The machine name of this integration.
     */
    public function appName(): string
    {
        return 'apollo';
    }

/**
     * Short metadata for tooling UI display.
     *
     * @return array<string, string> Label, description, icon, and logo.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'contacts, organizations, enrich',
            'description' => 'Sales intelligence',
            'icon' => 'ph:rocket-launch',
            'logo' => 'simple-icons:apollo',
        ];
    }

/**
     * Integration metadata for the marketplace / settings UI.
     *
     * @return array<string, string> Name, description, icons, category, badge, and docs URL.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Apollo.io',
            'description' => 'Sales intelligence — search contacts, enrich data, manage organizations',
            'icon' => 'ph:rocket-launch',
            'logo' => 'simple-icons:apollo',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developer.apollo.io',
        ];
    }/**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>> Field definitions for api_key and url.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Apollo API key',
                'hint' => 'Generate an API key in your Apollo account settings under "Integrations → API"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.apollo.io',
                'hint' => 'Use <code>https://api.apollo.io</code> (default) or a custom endpoint',
                'default' => 'https://api.apollo.io',
            ],
        ];
    }

    /**
     * Test the connection to the Apollo API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_key and optional url.
     * @return array{success: bool, message?: string, error?: string} Test result.
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.apollo.io', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache',
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Apollo API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Apollo API returned an error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $userName = $json['user']['name'] ?? 'Unknown user';

            return [
                'success' => true,
                'message' => "Connected to Apollo API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the integration configuration.
     *
     * @return array<string, string> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'apollo_search_contacts' => [
                'class' => ApolloSearchContacts::class,
                'type' => 'read',
                'name' => 'Search Contacts',
                'description' => 'Search for people in Apollo by name, email, or keyword.',
                'icon' => 'ph:magnifying-glass',
            ],
            'apollo_get_contact' => [
                'class' => ApolloGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve full details for a specific contact by ID.',
                'icon' => 'ph:user',
            ],
            'apollo_enrich' => [
                'class' => ApolloEnrich::class,
                'type' => 'read',
                'name' => 'Enrich Contact',
                'description' => 'Enrich a contact by matching on email or name.',
                'icon' => 'ph:user-circle-gear',
            ],
            'apollo_list_organizations' => [
                'class' => ApolloListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List organizations from your Apollo account.',
                'icon' => 'ph:buildings',
            ],
            'apollo_get_organization' => [
                'class' => ApolloGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => 'Retrieve full details for a specific organization by ID.',
                'icon' => 'ph:building-office',
            ],
            'apollo_get_current_user' => [
                'class' => ApolloGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Retrieve the authenticated user\'s profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/apollo.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array<string, mixed>> Field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.apollo.io'],
        ];
    }

    /**
     * Confirm this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ApolloService(
                apiKey: $creds->get('apollo', 'api_key', '', $account),
                baseUrl: $creds->get('apollo', 'url', 'https://api.apollo.io', $account),
            );

            return new $class($service);
        }

        return new $class(app(ApolloService::class));
    }
}
