<?php

namespace OpenCompany\Integrations\MicrosoftTodo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoCreateList;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoCreateTask;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoGetCurrentUser;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoGetList;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoGetTask;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoListLists;
use OpenCompany\Integrations\MicrosoftTodo\Tools\TodoListTasks;

/**
 * Tool provider for Microsoft To Do through Microsoft Graph.
 *
 * Exposes task-list, task, and current-user tools with manual-token credential
 * metadata for default and named account resolution.
 */
class MicrosoftTodoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * The machine name used to identify this integration.
     */
    public function appName(): string
    {
        return 'microsoft-todo';
    }

    /**
     * Short metadata for UI display — label, description, icons.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Microsoft To Do',
            'description' => 'Task lists and tasks through Microsoft Graph.',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:microsofttodo',
        ];
    }

    /**
     * Full integration metadata for the integrations catalog.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Microsoft To Do',
            'description' => 'Manage task lists and tasks via the Microsoft Graph API',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:microsofttodo',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://learn.microsoft.com/en-us/graph/api/resources/todo-overview',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your Microsoft Graph OAuth2 access token',
                'hint' => 'Provide a valid OAuth2 access token with <code>Tasks.ReadWrite</code> and <code>User.Read</code> scopes',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Microsoft Graph URL',
                'placeholder' => 'https://graph.microsoft.com/v1.0',
                'hint' => 'Use the default Microsoft Graph v1.0 URL, or override for testing',
                'default' => 'https://graph.microsoft.com/v1.0',
            ],
        ];
    }

    /**
     * Test the connection to the Microsoft Graph API using the provided config.
     *
     * @param  array<string, mixed>  $config  The configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://graph.microsoft.com/v1.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Microsoft Graph API at {$baseUrl}. Check the URL and token.",
                ];
            }

            if (!$response->successful()) {
                $errorMsg = $json['error']['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Microsoft Graph API error: {$errorMsg}",
                ];
            }

            $displayName = $json['displayName'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Microsoft Graph API as {$displayName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration values.
     *
     * @return array<string, string|string[]>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * The tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'todo_list_lists' => [
                'class' => TodoListLists::class,
                'type' => 'read',
                'name' => 'List Todo Lists',
                'description' => 'List all Microsoft To Do task lists.',
                'icon' => 'ph:list-bullets',
            ],
            'todo_get_list' => [
                'class' => TodoGetList::class,
                'type' => 'read',
                'name' => 'Get Todo List',
                'description' => 'Get a specific Microsoft To Do task list by ID.',
                'icon' => 'ph:list',
            ],
            'todo_create_list' => [
                'class' => TodoCreateList::class,
                'type' => 'write',
                'name' => 'Create Todo List',
                'description' => 'Create a new Microsoft To Do task list.',
                'icon' => 'ph:plus-circle',
            ],
            'todo_list_tasks' => [
                'class' => TodoListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List all tasks in a Microsoft To Do task list.',
                'icon' => 'ph:checks',
            ],
            'todo_get_task' => [
                'class' => TodoGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get a specific task from a Microsoft To Do task list.',
                'icon' => 'ph:check-square',
            ],
            'todo_create_task' => [
                'class' => TodoCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in a Microsoft To Do task list.',
                'icon' => 'ph:plus',
            ],
            'todo_get_current_user' => [
                'class' => TodoGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Microsoft user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the JavaScript API documentation file for this integration.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/microsoft-todo.md';
    }

    /**
     * Credential fields for multi-account support.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Microsoft Graph URL', 'required' => false, 'default' => 'https://graph.microsoft.com/v1.0'],
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
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds, $account): mixed {
                $value = $creds->get('microsoft-todo', $key, null, $account);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('microsoft_todo', $key, $default, $account);
            };

            $service = new MicrosoftTodoService(
                accessToken: $get('access_token'),
                baseUrl: $get('url', 'https://graph.microsoft.com/v1.0'),
            );

            return new $class($service);
        }

        return new $class(app(MicrosoftTodoService::class));
    }
}
