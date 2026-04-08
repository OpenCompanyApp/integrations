<?php

namespace OpenCompany\Integrations\LaunchDarkly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetCurrentUser;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetFlag;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyGetProject;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListEnvironments;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListFlags;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyListProjects;
use OpenCompany\Integrations\LaunchDarkly\Tools\LaunchDarklyToggleFlag;

class LaunchDarklyToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'launchdarkly';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'flags, projects, environments',
            'description' => 'Feature flags',
            'icon' => 'ph:flag',
            'logo' => 'simple-icons:launchdarkly',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'LaunchDarkly',
            'description' => 'Feature flags and project management',
            'icon' => 'ph:flag',
            'logo' => 'simple-icons:launchdarkly',
            'category' => 'devtools',
            'badge' => 'verified',
            'docs_url' => 'https://apidocs.launchdarkly.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your LaunchDarkly access token',
                'hint' => 'Generate an API access token in LaunchDarkly under Account Settings > Authorization',
                'required' => true,
            ],
            [
                'key' => 'project_key',
                'type' => 'text',
                'label' => 'Default Project Key',
                'placeholder' => 'default',
                'hint' => 'The LaunchDarkly project key to use by default. Find it in your LaunchDarkly project settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://app.launchdarkly.com/api/v2',
                'hint' => 'Use <code>https://app.launchdarkly.com/api/v2</code> for the standard LaunchDarkly API, or your custom relay proxy URL',
                'default' => 'https://app.launchdarkly.com/api/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://app.launchdarkly.com/api/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/members/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach LaunchDarkly API at {$baseUrl}. Check the URL.",
                ];
            }

            $member = $json['member'] ?? $json;
            $name = $member['firstName'] . ' ' . $member['lastName'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to LaunchDarkly as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'project_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'launchdarkly_list_flags' => [
                'class' => LaunchDarklyListFlags::class,
                'type' => 'read',
                'name' => 'List Flags',
                'description' => 'List feature flags in a LaunchDarkly project.',
                'icon' => 'ph:flag',
            ],
            'launchdarkly_get_flag' => [
                'class' => LaunchDarklyGetFlag::class,
                'type' => 'read',
                'name' => 'Get Flag',
                'description' => 'Get details of a specific feature flag.',
                'icon' => 'ph:flag',
            ],
            'launchdarkly_toggle_flag' => [
                'class' => LaunchDarklyToggleFlag::class,
                'type' => 'write',
                'name' => 'Toggle Flag',
                'description' => 'Turn a feature flag on or off in a specific environment.',
                'icon' => 'ph:toggle-left',
            ],
            'launchdarkly_list_environments' => [
                'class' => LaunchDarklyListEnvironments::class,
                'type' => 'read',
                'name' => 'List Environments',
                'description' => 'List environments for a LaunchDarkly project.',
                'icon' => 'ph:tree-structure',
            ],
            'launchdarkly_list_projects' => [
                'class' => LaunchDarklyListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all LaunchDarkly projects.',
                'icon' => 'ph:folder',
            ],
            'launchdarkly_get_project' => [
                'class' => LaunchDarklyGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific LaunchDarkly project.',
                'icon' => 'ph:folder-open',
            ],
            'launchdarkly_get_current_user' => [
                'class' => LaunchDarklyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated LaunchDarkly user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/launchdarkly.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'project_key', 'type' => 'text', 'label' => 'Project Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://app.launchdarkly.com/api/v2'],
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

            $service = new LaunchDarklyService(
                accessToken: $creds->get('launchdarkly', 'access_token', '', $account),
                projectKey: $creds->get('launchdarkly', 'project_key', '', $account),
                baseUrl: $creds->get('launchdarkly', 'url', 'https://app.launchdarkly.com/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(LaunchDarklyService::class));
    }
}
