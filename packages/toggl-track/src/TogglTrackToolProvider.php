<?php

namespace OpenCompany\Integrations\TogglTrack;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\TogglTrack\Tools\TogglListTimeEntries;
use OpenCompany\Integrations\TogglTrack\Tools\TogglGetTimeEntry;
use OpenCompany\Integrations\TogglTrack\Tools\TogglCreateTimeEntry;
use OpenCompany\Integrations\TogglTrack\Tools\TogglListProjects;
use OpenCompany\Integrations\TogglTrack\Tools\TogglGetProject;
use OpenCompany\Integrations\TogglTrack\Tools\TogglListWorkspaces;
use OpenCompany\Integrations\TogglTrack\Tools\TogglGetCurrentUser;

/**
 * TogglTrackToolProvider — registers Toggl Track tools with the integration framework.
 *
 * Implements ConfigurableIntegration for multi-account support, configuration schema,
 * connection testing, and credential field definitions.
 *
 * @see https://developers.track.toggl.com/docs/
 */
class TogglTrackToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'toggl-track';
    }

    /**
     * Get short metadata for the application.
     *
     * @return array<string, string> App metadata (label, description, icon, logo).
     */
    public function appMeta(): array
    {
        return [
            'label' => 'time entries, projects, workspaces',
            'description' => 'Time tracking & productivity',
            'icon' => 'ph:timer',
            'logo' => 'simple-icons:toggltrack',
        ];
    }

    /**
     * Get integration metadata for display in the UI.
     *
     * @return array<string, string> Integration metadata (name, description, icon, logo, category, badge, docs_url).
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Toggl Track',
            'description' => 'Time tracking and productivity management',
            'icon' => 'ph:timer',
            'logo' => 'simple-icons:toggltrack',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.track.toggl.com/docs/',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>> List of configuration field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Toggl Track API token',
                'hint' => 'Find your API token at the bottom of your <a href="https://track.toggl.com/profile" target="_blank">Toggl Track profile page</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.track.toggl.com',
                'hint' => 'Use the default URL for Toggl Track cloud. Only change if using a custom endpoint.',
                'default' => 'https://api.track.toggl.com',
            ],
        ];
    }

    /**
     * Test the connection to Toggl Track using the provided configuration.
     *
     * @param  array<string, mixed>  $config  The configuration to test.
     * @return array{success: bool, message?: string, error?: string} The test result.
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.track.toggl.com', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($apiToken . ':api_token'),
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v9/me');

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            $data = $response->json();
            $email = $data['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Toggl Track as {$email}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string> Validation rules keyed by field name.
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'toggl_list_time_entries' => [
                'class' => TogglListTimeEntries::class,
                'type' => 'read',
                'name' => 'List Time Entries',
                'description' => 'List time entries for the authenticated user.',
                'icon' => 'ph:list-bullets',
            ],
            'toggl_get_time_entry' => [
                'class' => TogglGetTimeEntry::class,
                'type' => 'read',
                'name' => 'Get Time Entry',
                'description' => 'Get details of a specific time entry.',
                'icon' => 'ph:clock',
            ],
            'toggl_create_time_entry' => [
                'class' => TogglCreateTimeEntry::class,
                'type' => 'write',
                'name' => 'Create Time Entry',
                'description' => 'Create a new time entry.',
                'icon' => 'ph:plus-circle',
            ],
            'toggl_list_projects' => [
                'class' => TogglListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects accessible to the user.',
                'icon' => 'ph:folder',
            ],
            'toggl_get_project' => [
                'class' => TogglGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific project.',
                'icon' => 'ph:folder-open',
            ],
            'toggl_list_workspaces' => [
                'class' => TogglListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all workspaces accessible to the user.',
                'icon' => 'ph:buildings',
            ],
            'toggl_get_current_user' => [
                'class' => TogglGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/toggl-track.md';
    }

    /**
     * Get the credential fields for the integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.track.toggl.com'],
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
     * @param  string  $class    The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TogglTrackService(
                apiToken: $creds->get('toggl-track', 'api_token', '', $account),
                baseUrl: $creds->get('toggl-track', 'url', 'https://api.track.toggl.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(TogglTrackService::class));
    }
}
