<?php

namespace OpenCompany\Integrations\Rollbar;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Rollbar\Tools\RollbarGetCurrentUser;
use OpenCompany\Integrations\Rollbar\Tools\RollbarGetItem;
use OpenCompany\Integrations\Rollbar\Tools\RollbarGetProject;
use OpenCompany\Integrations\Rollbar\Tools\RollbarListDeploys;
use OpenCompany\Integrations\Rollbar\Tools\RollbarListItems;
use OpenCompany\Integrations\Rollbar\Tools\RollbarListProjects;
use OpenCompany\Integrations\Rollbar\Tools\RollbarListTeams;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class RollbarToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'rollbar';
    }

/**
     * Get metadata for the app listing.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Rollbar',
            'description' => 'Error monitoring',
            'icon' => 'ph:bug',
            'logo' => 'simple-icons:rollbar',
        ];
    }

/**
     * Get metadata for the integration card.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Rollbar',
            'description' => 'Error monitoring and crash reporting platform',
            'icon' => 'ph:bug',
            'logo' => 'simple-icons:rollbar',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.rollbar.com/docs/api',
        ];
    }/**
     * Get the configuration schema for the Rollbar integration.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Rollbar access token',
                'hint' => 'Generate an account-level access token in your Rollbar account settings under "Access Tokens"',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Rollbar API.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.rollbar.com/api/1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Rollbar API. Check your access token.',
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Rollbar API successfully.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     */
    public function tools(): array
    {
        return [
            'rollbar_list_projects' => [
                'class' => RollbarListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all projects in your Rollbar account.',
                'icon' => 'ph:folder',
            ],
            'rollbar_get_project' => [
                'class' => RollbarGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a specific Rollbar project.',
                'icon' => 'ph:folder-open',
            ],
            'rollbar_list_items' => [
                'class' => RollbarListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List error items (occurrences) with optional filters.',
                'icon' => 'ph:list-bullets',
            ],
            'rollbar_get_item' => [
                'class' => RollbarGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Get details for a specific error item.',
                'icon' => 'ph:bug',
            ],
            'rollbar_list_deploys' => [
                'class' => RollbarListDeploys::class,
                'type' => 'read',
                'name' => 'List Deploys',
                'description' => 'List recent deploys across your Rollbar account.',
                'icon' => 'ph:rocket',
            ],
            'rollbar_list_teams' => [
                'class' => RollbarListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all teams in your Rollbar account.',
                'icon' => 'ph:users',
            ],
            'rollbar_get_current_user' => [
                'class' => RollbarGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get details about the currently authenticated Rollbar user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/rollbar.md';
    }

    /**
     * Get the credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance with the appropriate service.
     *
     * @param  string  $class    The tool class to instantiate
     * @param  array   $context  Context containing optional account information
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new RollbarService(
                accessToken: $creds->get('rollbar', 'access_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(RollbarService::class));
    }
}
