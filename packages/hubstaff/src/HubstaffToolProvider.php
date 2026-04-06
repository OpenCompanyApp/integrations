<?php

namespace OpenCompany\Integrations\Hubstaff;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Hubstaff\Tools\HubstaffListTimeEntries;
use OpenCompany\Integrations\Hubstaff\Tools\HubstaffGetTimeEntry;
use OpenCompany\Integrations\Hubstaff\Tools\HubstaffCreateTimeEntry;
use OpenCompany\Integrations\Hubstaff\Tools\HubstaffListProjects;
use OpenCompany\Integrations\Hubstaff\Tools\HubstaffGetProject;
use OpenCompany\Integrations\Hubstaff\Tools\HubstaffListOrganizations;
use OpenCompany\Integrations\Hubstaff\Tools\HubstaffGetCurrentUser;

class HubstaffToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'hubstaff';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'time entries, projects, organizations',
            'description' => 'Time tracking & productivity',
            'icon' => 'ph:clock-countdown',
            'logo' => 'simple-icons:hubstaff',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Hubstaff',
            'description' => 'Time tracking, productivity monitoring, and workforce management',
            'icon' => 'ph:clock-countdown',
            'logo' => 'simple-icons:hubstaff',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.hubstaff.com/docs/hubstaff_v2',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Hubstaff personal access token',
                'hint' => 'Generate a personal access token in your Hubstaff account under "API Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.hubstaff.com',
                'hint' => 'Use <code>https://api.hubstaff.com</code> for the default API, or a custom URL if applicable',
                'default' => 'https://api.hubstaff.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.hubstaff.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Hubstaff API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your access token.",
                ];
            }

            $userName = $json['user']['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Hubstaff API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'hubstaff_list_time_entries' => [
                'class' => HubstaffListTimeEntries::class,
                'type' => 'read',
                'name' => 'List Time Entries',
                'description' => 'List time entries with optional filters for date range, user, and project.',
                'icon' => 'ph:clock',
            ],
            'hubstaff_get_time_entry' => [
                'class' => HubstaffGetTimeEntry::class,
                'type' => 'read',
                'name' => 'Get Time Entry',
                'description' => 'Get details for a specific time entry.',
                'icon' => 'ph:clock',
            ],
            'hubstaff_create_time_entry' => [
                'class' => HubstaffCreateTimeEntry::class,
                'type' => 'write',
                'name' => 'Create Time Entry',
                'description' => 'Create a new manual time entry for a project.',
                'icon' => 'ph:plus-circle',
            ],
            'hubstaff_list_projects' => [
                'class' => HubstaffListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects in the organization.',
                'icon' => 'ph:folder',
            ],
            'hubstaff_get_project' => [
                'class' => HubstaffGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a specific project.',
                'icon' => 'ph:folder',
            ],
            'hubstaff_list_organizations' => [
                'class' => HubstaffListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List organizations the authenticated user belongs to.',
                'icon' => 'ph:buildings',
            ],
            'hubstaff_get_current_user' => [
                'class' => HubstaffGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/hubstaff.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.hubstaff.com'],
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

            $service = new HubstaffService(
                accessToken: $creds->get('hubstaff', 'access_token', '', $account),
                baseUrl: $creds->get('hubstaff', 'url', 'https://api.hubstaff.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(HubstaffService::class));
    }
}
