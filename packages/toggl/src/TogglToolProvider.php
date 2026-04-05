<?php

namespace OpenCompany\Integrations\Toggl;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Toggl\Tools\TogglCreateProject;
use OpenCompany\Integrations\Toggl\Tools\TogglCreateTimeEntry;
use OpenCompany\Integrations\Toggl\Tools\TogglDeleteTimeEntry;
use OpenCompany\Integrations\Toggl\Tools\TogglGetCurrentUser;
use OpenCompany\Integrations\Toggl\Tools\TogglListProjects;
use OpenCompany\Integrations\Toggl\Tools\TogglListTimeEntries;
use OpenCompany\Integrations\Toggl\Tools\TogglListWorkspaces;
use OpenCompany\Integrations\Toggl\Tools\TogglUpdateTimeEntry;

/**
 * Toggl Track tool provider — registers tools and integration metadata.
 *
 * Implements ConfigurableIntegration for multi-account support, connection
 * testing, config schema, and credential management.
 */
class TogglToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'toggl';
    }

    /**
     * Short metadata displayed in integration listings.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'workspaces, projects, time entries',
            'description' => 'Time tracking',
            'icon'        => 'ph:clock',
            'logo'        => 'simple-icons:toggl',
        ];
    }

    /**
     * Full integration metadata for marketplace / settings UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'Toggl Track',
            'description' => 'Time tracking and project management',
            'icon'        => 'ph:clock',
            'logo'        => 'simple-icons:toggl',
            'category'    => 'productivity',
            'badge'       => 'verified',
            'docs_url'    => 'https://engineering.toggl.com/docs/',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'api_token',
                'type'        => 'secret',
                'label'       => 'API Token',
                'placeholder' => 'Enter your Toggl Track API token',
                'hint'        => 'Find your API token at the bottom of your <a href="https://track.toggl.com/profile" target="_blank">Toggl Profile Settings</a> page',
                'required'    => true,
            ],
            [
                'key'         => 'url',
                'type'        => 'url',
                'label'       => 'API Base URL',
                'placeholder' => 'https://api.track.toggl.com/api/v9',
                'hint'        => 'Use the default Toggl Track API URL. Change only for custom setups.',
                'default'     => 'https://api.track.toggl.com/api/v9',
            ],
        ];
    }

    /**
     * Test the connection to the Toggl API using the provided config.
     *
     * @param array<string, mixed> $config Configuration values to test
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl  = rtrim($config['url'] ?? 'https://api.track.toggl.com/api/v9', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($apiToken, 'api_token')
              ->timeout(10)
              ->get($baseUrl . '/me');

            if (! $response->successful()) {
                return [
                    'success' => false,
                    'error'   => "Authentication failed (HTTP {$response->status()}). Check your API token.",
                ];
            }

            $user = $response->json();
            $name = trim(($user['fullname'] ?? '') . ' (' . ($user['email'] ?? '') . ')');

            return [
                'success' => true,
                'message' => "Connected to Toggl Track as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'url'       => 'nullable|url',
        ];
    }

    /**
     * Register all available Toggl Track tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'toggl_get_current_user' => [
                'class'       => TogglGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon'        => 'ph:user',
            ],
            'toggl_list_workspaces' => [
                'class'       => TogglListWorkspaces::class,
                'type'        => 'read',
                'name'        => 'List Workspaces',
                'description' => 'List all workspaces the user has access to.',
                'icon'        => 'ph:buildings',
            ],
            'toggl_list_projects' => [
                'class'       => TogglListProjects::class,
                'type'        => 'read',
                'name'        => 'List Projects',
                'description' => 'List projects in a workspace.',
                'icon'        => 'ph:folder',
            ],
            'toggl_create_project' => [
                'class'       => TogglCreateProject::class,
                'type'        => 'write',
                'name'        => 'Create Project',
                'description' => 'Create a new project in a workspace.',
                'icon'        => 'ph:folder-plus',
            ],
            'toggl_list_time_entries' => [
                'class'       => TogglListTimeEntries::class,
                'type'        => 'read',
                'name'        => 'List Time Entries',
                'description' => 'List time entries for the authenticated user.',
                'icon'        => 'ph:list-dashes',
            ],
            'toggl_create_time_entry' => [
                'class'       => TogglCreateTimeEntry::class,
                'type'        => 'write',
                'name'        => 'Create Time Entry',
                'description' => 'Start or create a new time entry.',
                'icon'        => 'ph:plus-circle',
            ],
            'toggl_update_time_entry' => [
                'class'       => TogglUpdateTimeEntry::class,
                'type'        => 'write',
                'name'        => 'Update Time Entry',
                'description' => 'Update an existing time entry.',
                'icon'        => 'ph:pencil-simple',
            ],
            'toggl_delete_time_entry' => [
                'class'       => TogglDeleteTimeEntry::class,
                'type'        => 'write',
                'name'        => 'Delete Time Entry',
                'description' => 'Delete a time entry.',
                'icon'        => 'ph:trash',
            ],
        ];
    }

    /**
     * Path to the Lua API docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/toggl.md';
    }

    /**
     * Credential fields for quick connection setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.track.toggl.com/api/v9'],
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
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param class-string<Tool> $class   The tool class to instantiate
     * @param array<string, mixed> $context Context with optional 'account' key
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TogglService(
                apiToken: $creds->get('toggl', 'api_token', '', $account),
                baseUrl: $creds->get('toggl', 'url', 'https://api.track.toggl.com/api/v9', $account),
            );

            return new $class($service);
        }

        return new $class(app(TogglService::class));
    }
}
