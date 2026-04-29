<?php

namespace OpenCompany\Integrations\Supabase;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetCurrentUser;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetProject;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetRow;
use OpenCompany\Integrations\Supabase\Tools\SupabaseGetTable;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListProjects;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListRows;
use OpenCompany\Integrations\Supabase\Tools\SupabaseListTables;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SupabaseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the integration app name identifier.
     *
     * @return string
     */
    public function appName(): string
    {
        return 'supabase';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Supabase',
            'description' => 'Supabase integration for Laravel — manage projects, tables, and rows.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Supabase',
            'description' => 'Supabase integration for Laravel — manage projects, tables, and rows.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for this integration.
     *
     * @return array
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Supabase access token',
                'hint' => 'Generate an access token in your Supabase dashboard under "Access Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API URL',
                'placeholder' => 'https://api.supabase.com/v1',
                'hint' => 'Use <code>https://api.supabase.com/v1</code> for the default Supabase Management API',
                'default' => 'https://api.supabase.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to Supabase using the provided configuration.
     *
     * @param  array $config The configuration values to test.
     * @return array Result array with 'success' bool and 'message' or 'error' string.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.supabase.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withToken($accessToken)
                ->timeout(10)
                ->get($baseUrl . '/profile');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Supabase at {$baseUrl}.",
                ];
            }

            $json = $response->json();
            $error = $json['message'] ?? $json['msg'] ?? "HTTP {$response->status()}";

            return [
                'success' => false,
                'error' => "Supabase returned an error: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     *
     * @return array
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array
     */
    public function tools(): array
    {
        return [
            'supabase_list_projects' => [
                'class' => SupabaseListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Supabase projects in the organization.',
                'icon' => 'ph:folders',
            ],
            'supabase_get_project' => [
                'class' => SupabaseGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific Supabase project.',
                'icon' => 'ph:folder-open',
            ],
            'supabase_list_tables' => [
                'class' => SupabaseListTables::class,
                'type' => 'read',
                'name' => 'List Tables',
                'description' => 'List all tables in a Supabase project.',
                'icon' => 'ph:table',
            ],
            'supabase_get_table' => [
                'class' => SupabaseGetTable::class,
                'type' => 'read',
                'name' => 'Get Table',
                'description' => 'Get details of a specific table in a project.',
                'icon' => 'ph:table',
            ],
            'supabase_list_rows' => [
                'class' => SupabaseListRows::class,
                'type' => 'read',
                'name' => 'List Rows',
                'description' => 'List rows in a Supabase table.',
                'icon' => 'ph:list-dashes',
            ],
            'supabase_get_row' => [
                'class' => SupabaseGetRow::class,
                'type' => 'read',
                'name' => 'Get Row',
                'description' => 'Get a single row by ID.',
                'icon' => 'ph:file-text',
            ],
            'supabase_get_current_user' => [
                'class' => SupabaseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Supabase user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     *
     * @return string|null
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/supabase.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api.supabase.com/v1'],
        ];
    }

    /**
     * Whether this class represents an integration.
     *
     * @return bool
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the appropriate service injected.
     *
     * @param  string $class   The tool class name.
     * @param  array  $context Optional context including the account.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SupabaseService(
                accessToken: $creds->get('supabase', 'access_token', '', $account),
                baseUrl: $creds->get('supabase', 'url', 'https://api.supabase.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(SupabaseService::class));
    }
}
