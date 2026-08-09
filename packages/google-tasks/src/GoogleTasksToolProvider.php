<?php

namespace OpenCompany\Integrations\GoogleTasks;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Tasks.
 *
 * Exposes generated coverage for the official Google Tasks API v1 Discovery
 * document, including task lists and tasks.
 */
class GoogleTasksToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Tasks API scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-tasks'; }
    public function appMeta(): array { return ['label' => 'Google Tasks', 'description' => 'Task lists and tasks', 'icon' => 'ph:list-checks', 'logo' => 'logos:google-icon']; }
    public function integrationMeta(): array { return ['name' => 'Google Tasks', 'description' => 'Generated coverage for the Google Tasks API v1: task lists and tasks.', 'icon' => 'ph:list-checks', 'logo' => 'logos:google-icon', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/workspace/tasks/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Tasks API scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://tasks.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://tasks.googleapis.com']]; }

    /**
     * Verify Google Tasks credentials with a lightweight tasklists endpoint call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://tasks.googleapis.com'), '/');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        try {
            $response = Http::withToken($accessToken)->acceptJson()->timeout(20)->get($baseUrl.'/tasks/v1/users/@me/lists', ['maxResults' => 1]);
            return $response->successful() ? ['success' => true, 'message' => 'Google Tasks credentials verified.'] : ['success' => false, 'error' => 'Google Tasks API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_tasks_tasks_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasksUpdate',
  'type' => 'write',
  'name' => 'Tasks Update',
  'description' => 'Tasks Update (PUT /tasks/v1/lists/{tasklist}/tasks/{task}).',
  'icon' => 'ph:list-checks',
),
            'google_tasks_tasks_move' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasksMove',
  'type' => 'write',
  'name' => 'Tasks Move',
  'description' => 'Tasks Move (POST /tasks/v1/lists/{tasklist}/tasks/{task}/move).',
  'icon' => 'ph:list-checks',
),
            'google_tasks_tasks_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasksDelete',
  'type' => 'write',
  'name' => 'Tasks Delete',
  'description' => 'Tasks Delete (DELETE /tasks/v1/lists/{tasklist}/tasks/{task}).',
  'icon' => 'ph:list-checks',
),
            'google_tasks_tasks_clear' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasksClear',
  'type' => 'write',
  'name' => 'Tasks Clear',
  'description' => 'Tasks Clear (POST /tasks/v1/lists/{tasklist}/clear).',
  'icon' => 'ph:list-checks',
),
            'google_tasks_tasks_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasksGet',
  'type' => 'read',
  'name' => 'Tasks Get',
  'description' => 'Tasks Get (GET /tasks/v1/lists/{tasklist}/tasks/{task}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_tasks_tasks_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasksInsert',
  'type' => 'write',
  'name' => 'Tasks Insert',
  'description' => 'Tasks Insert (POST /tasks/v1/lists/{tasklist}/tasks).',
  'icon' => 'ph:list-checks',
),
            'google_tasks_tasks_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasksList',
  'type' => 'read',
  'name' => 'Tasks List',
  'description' => 'Tasks List (GET /tasks/v1/lists/{tasklist}/tasks).',
  'icon' => 'ph:magnifying-glass',
),
            'google_tasks_tasks_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasksPatch',
  'type' => 'write',
  'name' => 'Tasks Patch',
  'description' => 'Tasks Patch (PATCH /tasks/v1/lists/{tasklist}/tasks/{task}).',
  'icon' => 'ph:list-checks',
),
            'google_tasks_tasklists_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasklistsDelete',
  'type' => 'write',
  'name' => 'Tasklists Delete',
  'description' => 'Tasklists Delete (DELETE /tasks/v1/users/@me/lists/{tasklist}).',
  'icon' => 'ph:list-checks',
),
            'google_tasks_tasklists_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasklistsGet',
  'type' => 'read',
  'name' => 'Tasklists Get',
  'description' => 'Tasklists Get (GET /tasks/v1/users/@me/lists/{tasklist}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_tasks_tasklists_insert' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasklistsInsert',
  'type' => 'write',
  'name' => 'Tasklists Insert',
  'description' => 'Tasklists Insert (POST /tasks/v1/users/@me/lists).',
  'icon' => 'ph:list-checks',
),
            'google_tasks_tasklists_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasklistsList',
  'type' => 'read',
  'name' => 'Tasklists List',
  'description' => 'Tasklists List (GET /tasks/v1/users/@me/lists).',
  'icon' => 'ph:magnifying-glass',
),
            'google_tasks_tasklists_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasklistsPatch',
  'type' => 'write',
  'name' => 'Tasklists Patch',
  'description' => 'Tasklists Patch (PATCH /tasks/v1/users/@me/lists/{tasklist}).',
  'icon' => 'ph:list-checks',
),
            'google_tasks_tasklists_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleTasks\\Tools\\GoogleTasksTasklistsUpdate',
  'type' => 'write',
  'name' => 'Tasklists Update',
  'description' => 'Tasklists Update (PUT /tasks/v1/users/@me/lists/{tasklist}).',
  'icon' => 'ph:list-checks',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Tasks tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleTasksService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleTasksService(accessToken: $creds->get('google-tasks', 'access_token', '', $account), baseUrl: $creds->get('google-tasks', 'url', 'https://tasks.googleapis.com', $account));
        }
        return app(GoogleTasksService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-tasks.md'; }
}
