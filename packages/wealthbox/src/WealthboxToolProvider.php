<?php

namespace OpenCompany\Integrations\Wealthbox;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxListContacts;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxGetContact;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxCreateContact;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxListTasks;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxCreateTask;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxListOpportunities;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxListWorkflows;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxListEvents;
use OpenCompany\Integrations\Wealthbox\Tools\WealthboxGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class WealthboxToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'wealthbox';
    }    /**
     * Get the configuration schema for the Wealthbox integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Wealthbox access token',
                'hint' => 'Generate an access token in Wealthbox under Settings > Integrations > API',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Wealthbox API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.crmworkspace.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Wealthbox API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            $userName = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Wealthbox API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for the configuration values.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
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
            'wealthbox_list_contacts' => [
                'class' => WealthboxListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from Wealthbox CRM.',
                'icon' => 'ph:users',
            ],
            'wealthbox_get_contact' => [
                'class' => WealthboxGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a specific contact by ID.',
                'icon' => 'ph:user',
            ],
            'wealthbox_create_contact' => [
                'class' => WealthboxCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Wealthbox CRM.',
                'icon' => 'ph:user-plus',
            ],
            'wealthbox_list_tasks' => [
                'class' => WealthboxListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks from Wealthbox CRM.',
                'icon' => 'ph:check-square',
            ],
            'wealthbox_create_task' => [
                'class' => WealthboxCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in Wealthbox CRM.',
                'icon' => 'ph:plus-square',
            ],
            'wealthbox_list_opportunities' => [
                'class' => WealthboxListOpportunities::class,
                'type' => 'read',
                'name' => 'List Opportunities',
                'description' => 'List opportunities from the sales pipeline.',
                'icon' => 'ph:currency-dollar',
            ],
            'wealthbox_list_workflows' => [
                'class' => WealthboxListWorkflows::class,
                'type' => 'read',
                'name' => 'List Workflows',
                'description' => 'List workflows from Wealthbox CRM.',
                'icon' => 'ph:flow-arrow',
            ],
            'wealthbox_list_events' => [
                'class' => WealthboxListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List calendar events from Wealthbox CRM.',
                'icon' => 'ph:calendar',
            ],
            'wealthbox_get_current_user' => [
                'class' => WealthboxGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Wealthbox user.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/wealthbox.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
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
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  string  $class  The fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Context containing optional 'account' for multi-account support.
     * @return Tool
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new WealthboxService(
                accessToken: $creds->get('wealthbox', 'access_token', '', $account),
                baseUrl: $creds->get('wealthbox', 'url', 'https://api.crmworkspace.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(WealthboxService::class));
    }
}
