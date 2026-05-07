<?php

namespace OpenCompany\Integrations\Toggl;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Toggl\Tools\TogglCreateTimeEntry;
use OpenCompany\Integrations\Toggl\Tools\TogglGetCurrentUser;
use OpenCompany\Integrations\Toggl\Tools\TogglGetProject;
use OpenCompany\Integrations\Toggl\Tools\TogglGetTimeEntry;
use OpenCompany\Integrations\Toggl\Tools\TogglListProjects;
use OpenCompany\Integrations\Toggl\Tools\TogglListTimeEntries;
use OpenCompany\Integrations\Toggl\Tools\TogglListWorkspaces;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Toggl\Tools\TogglCreateProject;
use OpenCompany\Integrations\Toggl\Tools\TogglDeleteTimeEntry;
use OpenCompany\Integrations\Toggl\Tools\TogglUpdateTimeEntry;
/**
 * Tool provider for the Toggl integration.
 *
 * Registers 7 tools covering workspaces, projects, time entries, and user info.
 * Implements ConfigurableIntegration for settings UI and credential management.
 */
class TogglToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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

    public function appName(): string
    {
        return 'toggl';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Toggl',
            'description' => 'Time tracking and project management',
            'icon' => 'ph:timer',
            'logo' => 'simple-icons:toggl',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Toggl',
            'description' => 'Simple and powerful time tracking',
            'icon' => 'ph:timer',
            'logo' => 'simple-icons:toggl',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.track.toggl.com/docs/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Toggl API token',
                'hint' => 'Find your API token at the bottom of your Toggl Track profile settings page.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.track.toggl.com',
                'hint' => 'Use the default Toggl Track API URL unless you have a compatible gateway.',
                'default' => 'https://api.track.toggl.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.track.toggl.com'), '/');

        if (! str_ends_with($baseUrl, '/api/v9')) {
            $baseUrl .= '/api/v9';
        }

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withBasicAuth($apiToken, 'api_token')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/me');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your API token.",
                ];
            }

            $user = $response->json();
            $name = trim(($user['fullname'] ?? '') . ' <' . ($user['email'] ?? '') . '>');

            return [
                'success' => true,
                'message' => "Connected to Toggl as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

        public function tools(): array
    {
        return [
            'toggl_create_time_entry' => [
                'class' => TogglCreateTimeEntry::class,
                'type' => 'write',
                'name' => 'Create Time Entry',
                'description' => 'Create a new time entry in a Toggl workspace. Provide a description, start time, and optionally a project and stop time.',
                'icon' => 'ph:wrench',
            ],
            'toggl_get_current_user' => [
                'class' => TogglGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Toggl user profile. Use this to verify your API token is working.',
                'icon' => 'ph:wrench',
            ],
            'toggl_get_project' => [
                'class' => TogglGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a single Toggl project by ID.',
                'icon' => 'ph:wrench',
            ],
            'toggl_get_time_entry' => [
                'class' => TogglGetTimeEntry::class,
                'type' => 'read',
                'name' => 'Get Time Entry',
                'description' => 'Get details for a single Toggl time entry by ID.',
                'icon' => 'ph:wrench',
            ],
            'toggl_list_projects' => [
                'class' => TogglListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects in a Toggl workspace. Optionally filter for active projects only.',
                'icon' => 'ph:wrench',
            ],
            'toggl_list_time_entries' => [
                'class' => TogglListTimeEntries::class,
                'type' => 'read',
                'name' => 'List Time Entries',
                'description' => 'List recent Toggl time entries. Optionally filter by date range.',
                'icon' => 'ph:wrench',
            ],
            'toggl_list_workspaces' => [
                'class' => TogglListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all Toggl workspaces the authenticated user belongs to. Returns workspace IDs and names needed for other Toggl tools.',
                'icon' => 'ph:wrench',
            ],
            'toggl_create_project' => [
                'class' => TogglCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a project in a Toggl workspace.',
                'icon' => 'ph:folder-plus',
            ],
            'toggl_update_time_entry' => [
                'class' => TogglUpdateTimeEntry::class,
                'type' => 'write',
                'name' => 'Update Time Entry',
                'description' => 'Update an existing Toggl time entry.',
                'icon' => 'ph:pencil-simple',
            ],
            'toggl_delete_time_entry' => [
                'class' => TogglDeleteTimeEntry::class,
                'type' => 'write',
                'name' => 'Delete Time Entry',
                'description' => 'Delete a Toggl time entry from a workspace.',
                'icon' => 'ph:trash',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/toggl.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.track.toggl.com'],
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
            $apiToken = (string) $creds->get('toggl', 'api_token', '', $account);
            $baseUrl = (string) $creds->get('toggl', 'url', '', $account);

            if ($apiToken === '') {
                $apiToken = (string) $creds->get('toggl-track', 'api_token', '', $account);
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('toggl-track', 'url', 'https://api.track.toggl.com', $account);
            }

            $service = new TogglService(
                apiToken: $apiToken,
                baseUrl: $baseUrl,
            );

            return new $class($service);
        }

        return new $class(app(TogglService::class));
    }
}
