<?php

namespace OpenCompany\Integrations\Accelo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Accelo\Tools\AcceloListTickets;
use OpenCompany\Integrations\Accelo\Tools\AcceloGetTicket;
use OpenCompany\Integrations\Accelo\Tools\AcceloCreateTicket;
use OpenCompany\Integrations\Accelo\Tools\AcceloListTasks;
use OpenCompany\Integrations\Accelo\Tools\AcceloGetTask;
use OpenCompany\Integrations\Accelo\Tools\AcceloListProjects;
use OpenCompany\Integrations\Accelo\Tools\AcceloGetCurrentUser;

/**
 * Tool catalog and configuration metadata for Accelo.
 *
 * Exposes core issue, task, job, and token information endpoints from the
 * Accelo public REST API.
 */
class AcceloToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

/**
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'accelo';
    }

    /**
     * Short metadata displayed in tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Accelo',
            'description' => 'Professional services automation',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:accelo',
        ];
    }

    /**
     * Integration metadata for the UI configuration screen.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Accelo',
            'description' => 'Professional services automation - manage issues, tasks, and jobs',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:accelo',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.accelo.com/docs/',
        ];
    }

    /**
     * Configuration schema for the Accelo integration.
     *
     * Defines the fields shown in the integration settings UI:
     * - access_token: Bearer token for API authentication.
     * - deployment: Accelo deployment name used to construct the API base URL.
     * - url: Optional override for the full base URL.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Accelo access token',
                'hint' => 'Generate an access token in your Accelo deployment under "API Credentials"',
                'required' => true,
            ],
            [
                'key' => 'deployment',
                'type' => 'string',
                'label' => 'Deployment Name',
                'placeholder' => 'e.g. mycompany',
                'hint' => 'Your Accelo deployment name (used in https://{deployment}.api.accelo.com)',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Custom Base URL',
                'placeholder' => 'https://mycompany.api.accelo.com',
                'hint' => 'Optional. Override the base URL if your Accelo instance uses a different domain.',
                'default' => '',
            ],
        ];
    }

    /**
     * Test the connection to the Accelo API.
     *
     * @param  array<string, mixed>  $config  Configuration containing access_token and deployment or url.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $deployment = $config['deployment'] ?? '';
        $baseUrl = rtrim($config['url'] ?? '', '/');

        if (empty($baseUrl) && !empty($deployment)) {
            $baseUrl = 'https://' . $deployment . '.api.accelo.com';
        }

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No deployment name or base URL provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v0/tokeninfo');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Accelo API at {$baseUrl}. Check your deployment name.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            $name = trim(($json['firstname'] ?? '') . ' ' . ($json['surname'] ?? ''));
            $email = $json['email'] ?? '';

            return [
                'success' => true,
                'message' => 'Connected to Accelo' . ($name !== '' ? " as {$name}" : '') . ($email !== '' ? " <{$email}>" : '') . " ({$baseUrl}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the integration configuration.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'deployment' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available Accelo tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'accelo_list_tickets' => [
                'class' => AcceloListTickets::class,
                'type' => 'read',
                'name' => 'List Issues',
                'description' => 'List support issues, also known as tickets, in Accelo.',
                'icon' => 'ph:ticket',
            ],
            'accelo_get_ticket' => [
                'class' => AcceloGetTicket::class,
                'type' => 'read',
                'name' => 'Get Issue',
                'description' => 'Get details of a specific issue, also known as a ticket.',
                'icon' => 'ph:ticket',
            ],
            'accelo_create_ticket' => [
                'class' => AcceloCreateTicket::class,
                'type' => 'write',
                'name' => 'Create Issue',
                'description' => 'Create a new support issue, also known as a ticket.',
                'icon' => 'ph:plus-circle',
            ],
            'accelo_list_tasks' => [
                'class' => AcceloListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks in Accelo.',
                'icon' => 'ph:check-square',
            ],
            'accelo_get_task' => [
                'class' => AcceloGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get details of a specific task.',
                'icon' => 'ph:check-square',
            ],
            'accelo_list_projects' => [
                'class' => AcceloListProjects::class,
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List projects, represented as jobs in the Accelo API.',
                'icon' => 'ph:folder',
            ],
            'accelo_get_current_user' => [
                'class' => AcceloGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Token Info',
                'description' => 'Get token information for the current Accelo access token.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/accelo.md';
    }

    /**
     * Credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'deployment', 'type' => 'string', 'label' => 'Deployment Name', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Custom Base URL', 'required' => false, 'default' => ''],
        ];
    }

    /**
     * Confirm this is an integration (not just a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * When an account context is provided, creates a new AcceloService with
     * that account's credentials. Otherwise, uses the app-container service.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new AcceloService(
                accessToken: $creds->get('accelo', 'access_token', '', $account),
                deployment: $creds->get('accelo', 'deployment', '', $account),
                baseUrl: $creds->get('accelo', 'url', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(AcceloService::class));
    }
}
