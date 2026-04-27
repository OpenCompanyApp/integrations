<?php

namespace OpenCompany\Integrations\Basecamp;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Basecamp\Tools\BasecampListProjects;
use OpenCompany\Integrations\Basecamp\Tools\BasecampGetProject;
use OpenCompany\Integrations\Basecamp\Tools\BasecampListTodos;
use OpenCompany\Integrations\Basecamp\Tools\BasecampCreateTodo;
use OpenCompany\Integrations\Basecamp\Tools\BasecampListMessages;
use OpenCompany\Integrations\Basecamp\Tools\BasecampGetMessage;
use OpenCompany\Integrations\Basecamp\Tools\BasecampGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class BasecampToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
     * Machine name of the integration.
     */
    public function appName(): string
    {
        return 'basecamp';
    }

    /**
     * Short metadata for tool-chip display.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'projects, todos, messages',
            'description' => 'Project management',
            'icon' => 'ph:mountains',
            'logo' => 'simple-icons:basecamp',
        ];
    }

    /**
     * Full integration metadata for the Integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Basecamp 3',
            'description' => 'Project management and team collaboration',
            'icon' => 'ph:mountains',
            'logo' => 'simple-icons:basecamp',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://github.com/basecamp/api/blob/master/README.md',
        ];
    }

    /**
     * Configuration schema for the Integrations UI.
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
                'placeholder' => 'Enter your Basecamp OAuth access token',
                'hint' => 'Generate an OAuth token in your Basecamp account. See the <a href="https://github.com/basecamp/api/blob/master/sections/authentication.md" target="_blank">Basecamp API authentication guide</a>.',
                'required' => true,
            ],
            [
                'key' => 'account_id',
                'type' => 'string',
                'label' => 'Account ID',
                'placeholder' => 'Enter your Basecamp account ID',
                'hint' => 'Your numeric Basecamp account ID, used in the API base URL. Find it in your Basecamp URL, e.g. <code>3.basecampapi.com/1234567</code>.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://3.basecampapi.com',
                'hint' => 'Use <code>https://3.basecampapi.com</code> for Basecamp 3. Change only if using a custom endpoint.',
                'default' => 'https://3.basecampapi.com',
            ],
        ];
    }

    /**
     * Test the connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $accountId = $config['account_id'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://3.basecampapi.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($accountId)) {
            return ['success' => false, 'error' => 'No account ID provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get("{$baseUrl}/{$accountId}/users/me");

            if ($response->successful()) {
                $user = $response->json();
                $name = trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to Basecamp as {$name}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Basecamp API returned HTTP {$response->status()}. Check your access token and account ID.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'account_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'basecamp_list_projects' => [
                'class' => BasecampListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Basecamp projects.',
                'icon' => 'ph:folder',
            ],
            'basecamp_get_project' => [
                'class' => BasecampGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a single Basecamp project.',
                'icon' => 'ph:folder-open',
            ],
            'basecamp_list_todos' => [
                'class' => BasecampListTodos::class,
                'type' => 'read',
                'name' => 'List To-Dos',
                'description' => 'List to-dos in a Basecamp to-do list.',
                'icon' => 'ph:check-square',
            ],
            'basecamp_create_todo' => [
                'class' => BasecampCreateTodo::class,
                'type' => 'write',
                'name' => 'Create To-Do',
                'description' => 'Create a new to-do in a Basecamp to-do list.',
                'icon' => 'ph:plus-square',
            ],
            'basecamp_list_messages' => [
                'class' => BasecampListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages for a Basecamp project.',
                'icon' => 'ph:chat-text',
            ],
            'basecamp_get_message' => [
                'class' => BasecampGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get a single message from a Basecamp project.',
                'icon' => 'ph:chat-centered-text',
            ],
            'basecamp_get_current_user' => [
                'class' => BasecampGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Basecamp user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API docs for agent consumption.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/basecamp.md';
    }

    /**
     * Credential fields for quick-reference display.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'account_id', 'type' => 'string', 'label' => 'Account ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://3.basecampapi.com'],
        ];
    }

    /**
     * Confirm this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool class, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BasecampService(
                accessToken: $creds->get('basecamp', 'access_token', '', $account),
                accountId: $creds->get('basecamp', 'account_id', '', $account),
                baseUrl: $creds->get('basecamp', 'url', 'https://3.basecampapi.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(BasecampService::class));
    }
}
