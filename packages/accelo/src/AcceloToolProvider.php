<?php

namespace OpenCompany\Integrations\Accelo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Accelo\Tools\AcceloListTickets;
use OpenCompany\Integrations\Accelo\Tools\AcceloGetTicket;
use OpenCompany\Integrations\Accelo\Tools\AcceloCreateTicket;
use OpenCompany\Integrations\Accelo\Tools\AcceloListTasks;
use OpenCompany\Integrations\Accelo\Tools\AcceloGetTask;
use OpenCompany\Integrations\Accelo\Tools\AcceloListProjects;
use OpenCompany\Integrations\Accelo\Tools\AcceloGetCurrentUser;

/**
 * Tool provider for the Accelo integration.
 *
 * Registers 7 tools for managing Accelo tickets, tasks, projects,
 * and the current user. Implements ConfigurableIntegration for
 * multi-account support with configurable deployment and access token.
 */
class AcceloToolProvider implements ToolProvider, ConfigurableIntegration
{
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
            'label' => 'tickets, tasks, projects',
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
            'description' => 'Professional services automation — manage tickets, tasks, and projects',
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
     * - deployment: Accelo deployment name used to construct the base URL.
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
                'hint' => 'Your Accelo deployment name (used in <code>https://{deployment}.accelo.com</code>)',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Custom Base URL',
                'placeholder' => 'https://mycompany.accelo.com',
                'hint' => 'Optional. Override the base URL if your Accelo instance uses a different domain.',
                'default' => '',
            ],
        ];
    }

    /**
     * Test the connection to the Accelo API.
     *
     * Calls the /api/v0/users/me endpoint to verify credentials.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $deployment = $config['deployment'] ?? '';
        $baseUrl = rtrim($config['url'] ?? '', '/');

        if (empty($baseUrl) && !empty($deployment)) {
            $baseUrl = 'https://' . $deployment . '.accelo.com';
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
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v0/users/me');

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

            $name = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Accelo as {$name} ({$baseUrl}).",
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
                'name' => 'List Tickets',
                'description' => 'List support tickets in Accelo.',
                'icon' => 'ph:ticket',
            ],
            'accelo_get_ticket' => [
                'class' => AcceloGetTicket::class,
                'type' => 'read',
                'name' => 'Get Ticket',
                'description' => 'Get details of a specific ticket.',
                'icon' => 'ph:ticket',
            ],
            'accelo_create_ticket' => [
                'class' => AcceloCreateTicket::class,
                'type' => 'write',
                'name' => 'Create Ticket',
                'description' => 'Create a new support ticket.',
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
                'name' => 'List Projects',
                'description' => 'List projects in Accelo.',
                'icon' => 'ph:folder',
            ],
            'accelo_get_current_user' => [
                'class' => AcceloGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Accelo user profile.',
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
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

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
