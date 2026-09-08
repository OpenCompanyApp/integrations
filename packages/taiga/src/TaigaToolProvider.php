<?php

namespace OpenCompany\Integrations\Taiga;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Taiga\Tools\TaigaGetCurrentUser;
use OpenCompany\Integrations\Taiga\Tools\TaigaGetProject;
use OpenCompany\Integrations\Taiga\Tools\TaigaGetUserStory;
use OpenCompany\Integrations\Taiga\Tools\TaigaCreateUserStory;
use OpenCompany\Integrations\Taiga\Tools\TaigaListIssues;
use OpenCompany\Integrations\Taiga\Tools\TaigaListProjects;
use OpenCompany\Integrations\Taiga\Tools\TaigaListUserStories;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TaigaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'taiga';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Taiga',
            'description' => 'Project management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:taiga',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Taiga',
            'description' => 'Open-source project management platform for agile teams',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:taiga',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.taiga.io/api.html',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Taiga access token',
                'hint' => 'Generate a personal access token in your Taiga account settings under "Application tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://api.taiga.io/api/v1',
                'hint' => 'Use <code>https://api.taiga.io/api/v1</code> for Taiga Cloud, or your self-hosted API URL',
                'default' => 'https://api.taiga.io/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.taiga.io/api/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->status() === 401) {
                return [
                    'success' => false,
                    'error' => 'Invalid access token. Please check your Taiga credentials.',
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Could not reach Taiga API at {$baseUrl}. Check the URL.",
                ];
            }

            $user = $response->json();
            $username = $user['full_name'] ?? $user['username'] ?? 'User';

            return [
                'success' => true,
                'message' => "Connected to Taiga as {$username}.",
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
            'taiga_list_projects' => [
                'class' => TaigaListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Taiga projects you have access to.',
                'icon' => 'ph:folder',
            ],
            'taiga_get_project' => [
                'class' => TaigaGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get detailed information about a specific Taiga project.',
                'icon' => 'ph:folder-open',
            ],
            'taiga_list_user_stories' => [
                'class' => TaigaListUserStories::class,
                'type' => 'read',
                'name' => 'List User Stories',
                'description' => 'List user stories from Taiga, optionally filtered.',
                'icon' => 'ph:list-checks',
            ],
            'taiga_get_user_story' => [
                'class' => TaigaGetUserStory::class,
                'type' => 'read',
                'name' => 'Get User Story',
                'description' => 'Get detailed information about a specific user story.',
                'icon' => 'ph:article',
            ],
            'taiga_create_user_story' => [
                'class' => TaigaCreateUserStory::class,
                'type' => 'write',
                'name' => 'Create User Story',
                'description' => 'Create a new user story in a Taiga project.',
                'icon' => 'ph:plus-circle',
            ],
            'taiga_list_issues' => [
                'class' => TaigaListIssues::class,
                'type' => 'read',
                'name' => 'List Issues',
                'description' => 'List issues from Taiga, optionally filtered.',
                'icon' => 'ph:bug',
            ],
            'taiga_get_current_user' => [
                'class' => TaigaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Taiga user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/taiga.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Taiga API URL', 'required' => false, 'default' => 'https://api.taiga.io/api/v1'],
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

            $service = new TaigaService(
                accessToken: $creds->get('taiga', 'access_token', '', $account),
                baseUrl: $creds->get('taiga', 'url', 'https://api.taiga.io/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(TaigaService::class));
    }
}
