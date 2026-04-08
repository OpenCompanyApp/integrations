<?php

namespace OpenCompany\Integrations\Cursor;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cursor\Tools\CursorListWorkspaces;
use OpenCompany\Integrations\Cursor\Tools\CursorGetWorkspace;
use OpenCompany\Integrations\Cursor\Tools\CursorListTeamMembers;
use OpenCompany\Integrations\Cursor\Tools\CursorListExtensions;

class CursorToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the internal application name for this integration.
     */
    public function appName(): string
    {
        return 'cursor';
    }

    /**
     * Get short metadata used for display in tool lists.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'workspaces, members, extensions',
            'description' => 'AI-powered code editor',
            'icon' => 'ph:code',
            'logo' => 'simple-icons:cursor',
        ];
    }

    /**
     * Get detailed metadata for the integration configuration UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Cursor',
            'description' => 'AI-powered code editor — manage workspaces, team members, and extensions',
            'icon' => 'ph:code',
            'logo' => 'simple-icons:cursor',
            'category' => 'development',
            'badge' => 'verified',
            'docs_url' => 'https://docs.cursor.com',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Cursor API key',
                'hint' => 'Generate an API key in your Cursor account settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api2.cursor.sh',
                'hint' => 'Use <code>https://api2.cursor.sh</code> for the default Cursor API',
                'default' => 'https://api2.cursor.sh',
            ],
        ];
    }

    /**
     * Test the connection to the Cursor API using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api2.cursor.sh', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/workspaces');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Cursor API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Cursor API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
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
            'cursor_list_workspaces' => [
                'class' => CursorListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all Cursor workspaces.',
                'icon' => 'ph:folders',
            ],
            'cursor_get_workspace' => [
                'class' => CursorGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get details for a specific workspace.',
                'icon' => 'ph:folder-open',
            ],
            'cursor_list_team_members' => [
                'class' => CursorListTeamMembers::class,
                'type' => 'read',
                'name' => 'List Team Members',
                'description' => 'List all members in a workspace.',
                'icon' => 'ph:users',
            ],
            'cursor_list_extensions' => [
                'class' => CursorListExtensions::class,
                'type' => 'read',
                'name' => 'List Extensions',
                'description' => 'List all extensions in a workspace.',
                'icon' => 'ph:puzzle-piece',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/cursor.md';
    }

    /**
     * Get the credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api2.cursor.sh'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new CursorService(
                apiKey: $creds->get('cursor', 'api_key', '', $account),
                baseUrl: $creds->get('cursor', 'url', 'https://api2.cursor.sh', $account),
            );

            return new $class($service);
        }

        return new $class(app(CursorService::class));
    }
}
