<?php

namespace OpenCompany\Integrations\Insightly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Insightly\Tools\InsightlyListContacts;
use OpenCompany\Integrations\Insightly\Tools\InsightlyGetContact;
use OpenCompany\Integrations\Insightly\Tools\InsightlyCreateContact;
use OpenCompany\Integrations\Insightly\Tools\InsightlyListOpportunities;
use OpenCompany\Integrations\Insightly\Tools\InsightlyGetOpportunity;
use OpenCompany\Integrations\Insightly\Tools\InsightlyListProjects;
use OpenCompany\Integrations\Insightly\Tools\InsightlyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class InsightlyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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




/**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'insightly';
    }

/**
     * Get metadata for the application display.
     *
     * @return array<string, mixed> Application metadata with label, description, icons.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'contacts, opportunities, projects',
            'description' => 'CRM & project management',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:insightly',
        ];
    }

/**
     * Get integration metadata for the OpenCompany integrations UI.
     *
     * @return array<string, mixed> Integration metadata with name, description, category, etc.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Insightly CRM',
            'description' => 'CRM platform for managing contacts, opportunities, and projects',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:insightly',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://api.na1.insightly.com/v3.1/Help',
        ];
    }/**
     * Get the configuration schema for the Insightly integration.
     *
     * Defines the access_token and base_url fields required to connect to the Insightly API.
     *
     * @return array<int, array<string, mixed>> Configuration field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Insightly API access token',
                'hint' => 'Find your API key in Insightly under <strong>User Settings &gt; API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.na1.insightly.com',
                'hint' => 'The base URL for your Insightly API. Defaults to <code>https://api.na1.insightly.com</code>. Change if using a different region.',
                'default' => 'https://api.na1.insightly.com',
            ],
        ];
    }

    /**
     * Test the connection to the Insightly API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token' and 'base_url'.
     * @return array{success: bool, message?: string, error?: string} Connection test result.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.na1.insightly.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v3.1/Users/me');

            if ($response->successful()) {
                $user = $response->json();
                $name = trim(($user['FIRST_NAME'] ?? '') . ' ' . ($user['LAST_NAME'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to Insightly API as {$name}.",
                ];
            }

            return [
                'success' => false,
                'error' => "API returned HTTP {$response->status()}. Check your access token and base URL.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Insightly configuration.
     *
     * @return array<string, string|array<int, string>> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'insightly_list_contacts' => [
                'class' => InsightlyListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from Insightly CRM.',
                'icon' => 'ph:users',
            ],
            'insightly_get_contact' => [
                'class' => InsightlyGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a single contact by ID.',
                'icon' => 'ph:user',
            ],
            'insightly_create_contact' => [
                'class' => InsightlyCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Insightly.',
                'icon' => 'ph:user-plus',
            ],
            'insightly_list_opportunities' => [
                'class' => InsightlyListOpportunities::class,
                'type' => 'read',
                'name' => 'List Opportunities',
                'description' => 'List opportunities from Insightly.',
                'icon' => 'ph:handshake',
            ],
            'insightly_get_opportunity' => [
                'class' => InsightlyGetOpportunity::class,
                'type' => 'read',
                'name' => 'Get Opportunity',
                'description' => 'Get a single opportunity by ID.',
                'icon' => 'ph:handshake',
            ],
            'insightly_list_projects' => [
                'class' => InsightlyListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects from Insightly.',
                'icon' => 'ph:folder',
            ],
            'insightly_get_current_user' => [
                'class' => InsightlyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/insightly.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>> Credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.na1.insightly.com'],
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
     * @param  array<string, mixed>  $context  Context containing optional 'account' for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new InsightlyService(
                accessToken: $creds->get('insightly', 'access_token', '', $account),
                baseUrl: $creds->get('insightly', 'base_url', 'https://api.na1.insightly.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(InsightlyService::class));
    }
}
