<?php

namespace OpenCompany\Integrations\Splitwise;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Splitwise\Tools\SplitwiseCreateExpense;
use OpenCompany\Integrations\Splitwise\Tools\SplitwiseGetCurrentUser;
use OpenCompany\Integrations\Splitwise\Tools\SplitwiseGetExpense;
use OpenCompany\Integrations\Splitwise\Tools\SplitwiseGetGroup;
use OpenCompany\Integrations\Splitwise\Tools\SplitwiseListExpenses;
use OpenCompany\Integrations\Splitwise\Tools\SplitwiseListFriends;
use OpenCompany\Integrations\Splitwise\Tools\SplitwiseListGroups;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class SplitwiseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the integration identifier.
     *
     * @return string The integration name used for namespacing.
     */
    public function appName(): string
    {
        return 'splitwise';
    }

/**
     * Get short metadata for the integration listing.
     *
     * @return array<string, mixed> App metadata (label, description, icons).
     */
    public function appMeta(): array
    {
        return [
            'label' => 'expenses, groups, friends',
            'description' => 'Shared expense tracking',
            'icon' => 'ph:split',
            'logo' => 'simple-icons:splitwise',
        ];
    }

/**
     * Get full integration metadata for the settings UI.
     *
     * @return array<string, mixed> Integration metadata (name, description, category, docs URL, etc.).
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Splitwise',
            'description' => 'Track and manage shared expenses with friends and groups',
            'icon' => 'ph:split',
            'logo' => 'simple-icons:splitwise',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://dev.splitwise.com/',
        ];
    }/**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>> Array of config field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Splitwise OAuth access token',
                'hint' => 'Generate an access token in your Splitwise developer settings at <code>https://secure.splitwise.com/apps</code>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://secure.splitwise.com/api/v3.0',
                'hint' => 'The Splitwise API base URL. Use the default unless connecting to a custom instance.',
                'default' => 'https://secure.splitwise.com/api/v3.0',
            ],
        ];
    }

    /**
     * Test the connection to the Splitwise API using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration array containing access_token and optionally url.
     * @return array{success: bool, message?: string, error?: string} Connection test result.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://secure.splitwise.com/api/v3.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/get_current_user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Splitwise API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = $json['user']['first_name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Splitwise API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>> Validation rules keyed by field name.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all available tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}> Tool definitions keyed by tool name.
     */
    public function tools(): array
    {
        return [
            'splitwise_list_expenses' => [
                'class' => SplitwiseListExpenses::class,
                'type' => 'read',
                'name' => 'List Expenses',
                'description' => 'List shared expenses with optional filters.',
                'icon' => 'ph:receipt',
            ],
            'splitwise_get_expense' => [
                'class' => SplitwiseGetExpense::class,
                'type' => 'read',
                'name' => 'Get Expense',
                'description' => 'Get details of a specific expense.',
                'icon' => 'ph:receipt',
            ],
            'splitwise_create_expense' => [
                'class' => SplitwiseCreateExpense::class,
                'type' => 'write',
                'name' => 'Create Expense',
                'description' => 'Create a new shared expense.',
                'icon' => 'ph:plus-circle',
            ],
            'splitwise_list_groups' => [
                'class' => SplitwiseListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List all groups the user belongs to.',
                'icon' => 'ph:users-three',
            ],
            'splitwise_get_group' => [
                'class' => SplitwiseGetGroup::class,
                'type' => 'read',
                'name' => 'Get Group',
                'description' => 'Get details of a specific group.',
                'icon' => 'ph:users-three',
            ],
            'splitwise_list_friends' => [
                'class' => SplitwiseListFriends::class,
                'type' => 'read',
                'name' => 'List Friends',
                'description' => 'List all friends with balances.',
                'icon' => 'ph:users',
            ],
            'splitwise_get_current_user' => [
                'class' => SplitwiseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     *
     * @return string|null Absolute path to the Lua docs markdown file, or null.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/splitwise.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}> Credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://secure.splitwise.com/api/v3.0'],
        ];
    }

    /**
     * Whether this class represents an integration (always true for tool providers).
     *
     * @return bool
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with 'account' for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SplitwiseService(
                accessToken: $creds->get('splitwise', 'access_token', '', $account),
                baseUrl: $creds->get('splitwise', 'url', 'https://secure.splitwise.com/api/v3.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(SplitwiseService::class));
    }
}
