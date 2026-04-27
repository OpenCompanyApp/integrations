<?php

namespace OpenCompany\Integrations\Sentry;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Sentry\Tools\SentryCreateIssue;
use OpenCompany\Integrations\Sentry\Tools\SentryGetCurrentUser;
use OpenCompany\Integrations\Sentry\Tools\SentryGetIssue;
use OpenCompany\Integrations\Sentry\Tools\SentryGetProject;
use OpenCompany\Integrations\Sentry\Tools\SentryListIssues;
use OpenCompany\Integrations\Sentry\Tools\SentryListProjects;
use OpenCompany\Integrations\Sentry\Tools\SentryListReleases;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SentryToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'sentry';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'projects, issues, releases',
            'description' => 'Error monitoring',
            'icon' => 'ph:bug',
            'logo' => 'simple-icons:sentry',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Sentry',
            'description' => 'Application error monitoring and performance tracking',
            'icon' => 'ph:bug',
            'logo' => 'simple-icons:sentry',
            'category' => 'monitoring',
            'badge' => 'verified',
            'docs_url' => 'https://docs.sentry.io/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'auth_token',
                'type' => 'secret',
                'label' => 'Auth Token',
                'placeholder' => 'Enter your Sentry auth token',
                'hint' => 'Generate an auth token in Sentry under Settings → Auth Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Sentry API URL',
                'placeholder' => 'https://sentry.io/api/0',
                'hint' => 'Use <code>https://sentry.io/api/0</code> for Sentry SaaS, or your self-hosted Sentry URL with <code>/api/0</code>',
                'default' => 'https://sentry.io/api/0',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $authToken = $config['auth_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://sentry.io/api/0', '/');

        if (empty($authToken)) {
            return ['success' => false, 'error' => 'No auth token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $authToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Sentry API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your auth token.",
                ];
            }

            $name = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Sentry as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'auth_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'sentry_list_projects' => [
                'class' => SentryListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Sentry projects accessible to the authenticated user.',
                'icon' => 'ph:folder',
            ],
            'sentry_get_project' => [
                'class' => SentryGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a specific Sentry project.',
                'icon' => 'ph:folder-open',
            ],
            'sentry_list_issues' => [
                'class' => SentryListIssues::class,
                'type' => 'read',
                'name' => 'List Issues',
                'description' => 'List issues (errors) for a Sentry project.',
                'icon' => 'ph:warning',
            ],
            'sentry_get_issue' => [
                'class' => SentryGetIssue::class,
                'type' => 'read',
                'name' => 'Get Issue',
                'description' => 'Get details for a specific Sentry issue.',
                'icon' => 'ph:warning-circle',
            ],
            'sentry_list_releases' => [
                'class' => SentryListReleases::class,
                'type' => 'read',
                'name' => 'List Releases',
                'description' => 'List releases for a Sentry project.',
                'icon' => 'ph:rocket',
            ],
            'sentry_create_issue' => [
                'class' => SentryCreateIssue::class,
                'type' => 'write',
                'name' => 'Create Issue',
                'description' => 'Create a new issue (user report) in a Sentry project.',
                'icon' => 'ph:plus-circle',
            ],
            'sentry_get_current_user' => [
                'class' => SentryGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Sentry user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/sentry.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'auth_token', 'type' => 'secret', 'label' => 'Auth Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Sentry API URL', 'required' => false, 'default' => 'https://sentry.io/api/0'],
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

            $service = new SentryService(
                authToken: $creds->get('sentry', 'auth_token', '', $account),
                baseUrl: $creds->get('sentry', 'url', 'https://sentry.io/api/0', $account),
            );

            return new $class($service);
        }

        return new $class(app(SentryService::class));
    }
}
