<?php

namespace OpenCompany\Integrations\Lasso;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Lasso\Tools\LassoListContacts;
use OpenCompany\Integrations\Lasso\Tools\LassoGetContact;
use OpenCompany\Integrations\Lasso\Tools\LassoCreateContact;
use OpenCompany\Integrations\Lasso\Tools\LassoListDeals;
use OpenCompany\Integrations\Lasso\Tools\LassoGetDeal;
use OpenCompany\Integrations\Lasso\Tools\LassoListInventory;
use OpenCompany\Integrations\Lasso\Tools\LassoGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class LassoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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
     * Get the application identifier for this integration.
     */
    public function appName(): string
    {
        return 'lasso';
    }

/**
     * Get short metadata describing the integration's capabilities.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'Lasso CRM',
            'description' => 'Real estate CRM',
            'icon'        => 'ph:buildings',
            'logo'        => 'simple-icons:lasso',
        ];
    }

/**
     * Get full integration metadata for display and categorization.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'Lasso CRM',
            'description' => 'CRM for real estate developers and homebuilders',
            'icon'        => 'ph:buildings',
            'logo'        => 'simple-icons:lasso',
            'category'    => 'productivity',
            'badge'       => 'verified',
            'docs_url'    => 'https://api.lassocrm.com/v1',
        ];
    }/**
     * Get the configuration schema for the Lasso integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'token',
                'type'        => 'secret',
                'label'       => 'API Token',
                'placeholder' => 'Enter your Lasso CRM API token',
                'hint'        => 'Generate an API token in Lasso CRM under Settings → API',
                'required'    => true,
            ],
            [
                'key'         => 'url',
                'type'        => 'url',
                'label'       => 'API Base URL',
                'placeholder' => 'https://api.lassocrm.com/v1',
                'hint'        => 'Change only if using a custom Lasso API endpoint',
                'default'     => 'https://api.lassocrm.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Lasso API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration containing token and optionally url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $token   = $config['token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.lassocrm.com/v1', '/');

        if (empty($token)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withToken($token)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error'   => "Could not reach Lasso API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));
            $org  = $json['organization']['name'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to Lasso API as {$name}" . ($org ? " ({$org})" : '') . '.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'token' => 'nullable|string',
            'url'   => 'nullable|url',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'lasso_list_contacts' => [
                'class'       => LassoListContacts::class,
                'type'        => 'read',
                'name'        => 'List Contacts',
                'description' => 'List contacts (registrants) in Lasso CRM.',
                'icon'        => 'ph:users',
            ],
            'lasso_get_contact' => [
                'class'       => LassoGetContact::class,
                'type'        => 'read',
                'name'        => 'Get Contact',
                'description' => 'Get details for a single contact.',
                'icon'        => 'ph:user',
            ],
            'lasso_create_contact' => [
                'class'       => LassoCreateContact::class,
                'type'        => 'write',
                'name'        => 'Create Contact',
                'description' => 'Create a new contact (registrant) in Lasso CRM.',
                'icon'        => 'ph:plus-circle',
            ],
            'lasso_list_deals' => [
                'class'       => LassoListDeals::class,
                'type'        => 'read',
                'name'        => 'List Deals',
                'description' => 'List deals (sales) in Lasso CRM.',
                'icon'        => 'ph:handshake',
            ],
            'lasso_get_deal' => [
                'class'       => LassoGetDeal::class,
                'type'        => 'read',
                'name'        => 'Get Deal',
                'description' => 'Get details for a single deal.',
                'icon'        => 'ph:handshake',
            ],
            'lasso_list_inventory' => [
                'class'       => LassoListInventory::class,
                'type'        => 'read',
                'name'        => 'List Inventory',
                'description' => 'List available inventory (units/lots) in Lasso CRM.',
                'icon'        => 'ph:buildings',
            ],
            'lasso_get_current_user' => [
                'class'       => LassoGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon'        => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/lasso.md';
    }

    /**
     * Get credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.lassocrm.com/v1'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * When an account context is provided, credentials are resolved for that
     * specific account. Otherwise the default app-bound service is used.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new LassoService(
                token: $creds->get('lasso', 'token', '', $account),
                baseUrl: $creds->get('lasso', 'url', 'https://api.lassocrm.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(LassoService::class));
    }
}
