<?php

namespace OpenCompany\Integrations\Bugsnag;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListProjects;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetProject;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListErrors;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetError;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListEvents;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListCollaborators;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetCurrentUser;

class BugsnagToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'bugsnag';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'projects, errors, events',
            'description' => 'Error monitoring',
            'icon' => 'ph:bug',
            'logo' => 'simple-icons:bugsnag',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Bugsnag',
            'description' => 'Error monitoring and crash reporting platform',
            'icon' => 'ph:bug',
            'logo' => 'simple-icons:bugsnag',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.bugsnag.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Bugsnag API token',
                'hint' => 'Generate a personal API token in your Bugsnag account settings under "My Account > API Tokens"',
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
            $response = Http::withHeaders([
                'Authorization' => 'token ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.bugsnag.com/user');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Bugsnag API successfully.',
                ];
            }

            return [
                'success' => false,
                'error' => "Bugsnag API returned HTTP {$response->status()}.",
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
            'bugsnag_list_projects' => [
                'class' => BugsnagListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List Bugsnag projects.',
                'icon' => 'ph:folder',
            ],
            'bugsnag_get_project' => [
                'class' => BugsnagGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a Bugsnag project.',
                'icon' => 'ph:folder-open',
            ],
            'bugsnag_list_errors' => [
                'class' => BugsnagListErrors::class,
                'type' => 'read',
                'name' => 'List Errors',
                'description' => 'List errors for a Bugsnag project.',
                'icon' => 'ph:warning',
            ],
            'bugsnag_get_error' => [
                'class' => BugsnagGetError::class,
                'type' => 'read',
                'name' => 'Get Error',
                'description' => 'Get details of a specific error.',
                'icon' => 'ph:warning-circle',
            ],
            'bugsnag_list_events' => [
                'class' => BugsnagListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List events for a Bugsnag project.',
                'icon' => 'ph:list-bullets',
            ],
            'bugsnag_list_collaborators' => [
                'class' => BugsnagListCollaborators::class,
                'type' => 'read',
                'name' => 'List Collaborators',
                'description' => 'List collaborators for an organization.',
                'icon' => 'ph:users',
            ],
            'bugsnag_get_current_user' => [
                'class' => BugsnagGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/bugsnag.md';
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

            $service = new BugsnagService(
                apiToken: $creds->get('bugsnag', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(BugsnagService::class));
    }
}
