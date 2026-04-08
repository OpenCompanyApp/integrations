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

/**
 * Tool provider for the Toggl integration.
 *
 * Registers 7 tools covering workspaces, projects, time entries, and user info.
 * Implements ConfigurableIntegration for settings UI and credential management.
 */
class TogglToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'toggl';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'workspaces, projects, time entries',
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
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withBasicAuth($apiToken, 'api_token')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get('https://api.track.toggl.com/api/v9/me');

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
        ];
    }

    public function tools(): array
    {
        return [
            'toggl_list_workspaces' => [
                'class' => TogglListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all Toggl workspaces the authenticated user belongs to.',
                'icon' => 'ph:buildings',
            ],
            'toggl_list_projects' => [
                'class' => TogglListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects in a Toggl workspace.',
                'icon' => 'ph:folder',
            ],
            'toggl_get_project' => [
                'class' => TogglGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a single Toggl project.',
                'icon' => 'ph:folder',
            ],
            'toggl_list_time_entries' => [
                'class' => TogglListTimeEntries::class,
                'type' => 'read',
                'name' => 'List Time Entries',
                'description' => 'List recent Toggl time entries, optionally filtered by date range.',
                'icon' => 'ph:timer',
            ],
            'toggl_get_time_entry' => [
                'class' => TogglGetTimeEntry::class,
                'type' => 'read',
                'name' => 'Get Time Entry',
                'description' => 'Get details for a single Toggl time entry.',
                'icon' => 'ph:timer',
            ],
            'toggl_create_time_entry' => [
                'class' => TogglCreateTimeEntry::class,
                'type' => 'write',
                'name' => 'Create Time Entry',
                'description' => 'Create a new time entry in a Toggl workspace.',
                'icon' => 'ph:timer',
            ],
            'toggl_get_current_user' => [
                'class' => TogglGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Toggl user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/toggl.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
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

            $service = new TogglService(
                apiToken: $creds->get('toggl', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(TogglService::class));
    }
}
