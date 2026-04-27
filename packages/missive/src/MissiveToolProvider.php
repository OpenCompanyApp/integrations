<?php

namespace OpenCompany\Integrations\Missive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Missive\Tools\MissiveListConversations;
use OpenCompany\Integrations\Missive\Tools\MissiveGetConversation;
use OpenCompany\Integrations\Missive\Tools\MissiveCreateComment;
use OpenCompany\Integrations\Missive\Tools\MissiveListTasks;
use OpenCompany\Integrations\Missive\Tools\MissiveCreateTask;
use OpenCompany\Integrations\Missive\Tools\MissiveGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class MissiveToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'missive';
    }

/**
     * Short metadata for the app selector UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'conversations, comments, tasks',
            'description' => 'Email & team chat',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:missive',
        ];
    }

/**
     * Full integration metadata for the Integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Missive',
            'description' => 'Email and team chat platform — manage conversations, comments, and tasks',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:missive',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://missiveapp.com/help/api/rest',
        ];
    }/**
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
                'placeholder' => 'Enter your Missive API access token',
                'hint' => 'Generate a token in Missive at <strong>Settings → API → Personal access tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://public.missiveapp.com/v1',
                'hint' => 'Use the default Missive Public API URL, or override for testing',
                'default' => 'https://public.missiveapp.com/v1',
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
        $baseUrl = rtrim($config['url'] ?? 'https://public.missiveapp.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($response->successful() && $json !== null) {
                $name = $json['user']['name'] ?? $json['user']['email'] ?? 'Unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Missive as {$name}.",
                ];
            }

            $error = $json['error'] ?? $json['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Missive API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
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
     * Register all Missive tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'missive_list_conversations' => [
                'class' => MissiveListConversations::class,
                'type' => 'read',
                'name' => 'List Conversations',
                'description' => 'List conversations with filters and pagination.',
                'icon' => 'ph:envelopes',
            ],
            'missive_get_conversation' => [
                'class' => MissiveGetConversation::class,
                'type' => 'read',
                'name' => 'Get Conversation',
                'description' => 'Get a single conversation by ID.',
                'icon' => 'ph:envelope',
            ],
            'missive_create_comment' => [
                'class' => MissiveCreateComment::class,
                'type' => 'write',
                'name' => 'Create Comment',
                'description' => 'Add a comment to a conversation.',
                'icon' => 'ph:chat-circle-text',
            ],
            'missive_list_tasks' => [
                'class' => MissiveListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks with filters and pagination.',
                'icon' => 'ph:list-checks',
            ],
            'missive_create_task' => [
                'class' => MissiveCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task.',
                'icon' => 'ph:plus-circle',
            ],
            'missive_get_current_user' => [
                'class' => MissiveGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/missive.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://public.missiveapp.com/v1'],
        ];
    }

    /**
     * Whether this class represents an integration (always true).
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class   The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with 'account' for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the MissiveService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context  May contain 'account' key for multi-account resolution.
     */
    private function resolveService(array $context = []): MissiveService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new MissiveService(
                accessToken: $creds->get('missive', 'access_token', '', $account),
                baseUrl: $creds->get('missive', 'url', 'https://public.missiveapp.com/v1', $account),
            );
        }

        return app(MissiveService::class);
    }
}
