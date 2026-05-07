<?php

namespace OpenCompany\Integrations\Devin;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Devin\Tools\DevinAppendSessionTags;
use OpenCompany\Integrations\Devin\Tools\DevinCreateSecret;
use OpenCompany\Integrations\Devin\Tools\DevinCreateSession;
use OpenCompany\Integrations\Devin\Tools\DevinDeleteSecret;
use OpenCompany\Integrations\Devin\Tools\DevinGenerateSessionInsights;
use OpenCompany\Integrations\Devin\Tools\DevinGetCurrentUser;
use OpenCompany\Integrations\Devin\Tools\DevinGetSession;
use OpenCompany\Integrations\Devin\Tools\DevinGetSessionInsights;
use OpenCompany\Integrations\Devin\Tools\DevinGetSessionTags;
use OpenCompany\Integrations\Devin\Tools\DevinListSecrets;
use OpenCompany\Integrations\Devin\Tools\DevinListSessionAttachments;
use OpenCompany\Integrations\Devin\Tools\DevinListSessionMessages;
use OpenCompany\Integrations\Devin\Tools\DevinListSessions;
use OpenCompany\Integrations\Devin\Tools\DevinSendMessage;
use OpenCompany\Integrations\Devin\Tools\DevinTerminateSession;

/**
 * Catalog provider for the Devin integration.
 *
 * Exposes current v3 organization tools, legacy-compatible session tools, and
 * setup metadata for host integration catalogs.
 */
class DevinToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['v3 organization endpoints require org_id.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
        return 'devin';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Devin',
            'description' => 'Autonomous software engineering agent',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:devin',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Devin',
            'description' => 'Create Devin sessions, send messages, inspect artifacts, manage tags, generate insights, and manage organization secrets.',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:devin',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.devin.ai/api-reference/overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Devin API key',
                'hint' => 'Generate a Devin API key in Devin settings.',
                'required' => true,
            ],
            [
                'key' => 'org_id',
                'type' => 'text',
                'label' => 'Organization ID',
                'placeholder' => 'org_...',
                'hint' => 'Required for current v3 organization endpoints.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.devin.ai',
                'hint' => 'Use https://api.devin.ai for v3. Existing /v1 URLs keep legacy session behavior.',
                'default' => 'https://api.devin.ai',
            ],
            [
                'key' => 'api_version',
                'type' => 'select',
                'label' => 'API Version',
                'options' => [
                    ['value' => 'v3', 'label' => 'v3'],
                    ['value' => 'v1', 'label' => 'v1 legacy sessions'],
                ],
                'default' => 'v3',
            ],
        ];
    }

    /**
     * Validate credentials with a lightweight Devin API request.
     *
     * @param  array<string, mixed>  $config  Setup form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.devin.ai', '/');
        $orgId = trim((string) ($config['org_id'] ?? ''));

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (str_ends_with($baseUrl, '/v1')) {
            $baseUrl = substr($baseUrl, 0, -3);
            $path = '/v1/sessions';
        } elseif ($orgId !== '') {
            $baseUrl = str_ends_with($baseUrl, '/v3') ? substr($baseUrl, 0, -3) : $baseUrl;
            $path = '/v3/organizations/'.rawurlencode($orgId).'/sessions';
        } else {
            $baseUrl = str_ends_with($baseUrl, '/v3') ? substr($baseUrl, 0, -3) : $baseUrl;
            $path = '/v3/self';
        }

        try {
            $query = $path === '/v1/sessions'
                ? ['limit' => 1]
                : ($path === '/v3/self' ? [] : ['first' => 1]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl.$path, $query);

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Devin API returned HTTP {$response->status()}. Check the key, URL, and organization ID.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Devin API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'org_id' => 'nullable|string',
            'url' => 'nullable|url',
            'api_version' => 'nullable|in:v1,v3',
        ];
    }

    public function tools(): array
    {
        return [
            'devin_create_session' => [
                'class' => DevinCreateSession::class,
                'type' => 'write',
                'name' => 'Create Session',
                'description' => 'Create a new Devin session with a task prompt and optional context.',
                'icon' => 'ph:plus-circle',
            ],
            'devin_get_session' => [
                'class' => DevinGetSession::class,
                'type' => 'read',
                'name' => 'Get Session',
                'description' => 'Get details and status of a Devin session.',
                'icon' => 'ph:eye',
            ],
            'devin_list_sessions' => [
                'class' => DevinListSessions::class,
                'type' => 'read',
                'name' => 'List Sessions',
                'description' => 'List Devin sessions with filtering and pagination.',
                'icon' => 'ph:list',
            ],
            'devin_send_message' => [
                'class' => DevinSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message to an existing Devin session.',
                'icon' => 'ph:chat-circle-text',
            ],
            'devin_terminate_session' => [
                'class' => DevinTerminateSession::class,
                'type' => 'write',
                'name' => 'Terminate Session',
                'description' => 'Terminate an active Devin session.',
                'icon' => 'ph:x-circle',
            ],
            'devin_list_session_messages' => [
                'class' => DevinListSessionMessages::class,
                'type' => 'read',
                'name' => 'List Session Messages',
                'description' => 'List messages exchanged in a Devin v3 session.',
                'icon' => 'ph:chat-circle',
            ],
            'devin_list_session_attachments' => [
                'class' => DevinListSessionAttachments::class,
                'type' => 'read',
                'name' => 'List Session Attachments',
                'description' => 'List attachments for a Devin v3 session.',
                'icon' => 'ph:paperclip',
            ],
            'devin_get_session_tags' => [
                'class' => DevinGetSessionTags::class,
                'type' => 'read',
                'name' => 'Get Session Tags',
                'description' => 'Read tags attached to a Devin v3 session.',
                'icon' => 'ph:tag',
            ],
            'devin_append_session_tags' => [
                'class' => DevinAppendSessionTags::class,
                'type' => 'write',
                'name' => 'Append Session Tags',
                'description' => 'Append tags to a Devin session.',
                'icon' => 'ph:tags',
            ],
            'devin_get_session_insights' => [
                'class' => DevinGetSessionInsights::class,
                'type' => 'read',
                'name' => 'Get Session Insights',
                'description' => 'Get generated insights for a Devin v3 session.',
                'icon' => 'ph:lightbulb',
            ],
            'devin_generate_session_insights' => [
                'class' => DevinGenerateSessionInsights::class,
                'type' => 'write',
                'name' => 'Generate Session Insights',
                'description' => 'Request insight generation for a Devin v3 session.',
                'icon' => 'ph:sparkle',
            ],
            'devin_get_current_user' => [
                'class' => DevinGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get information about the authenticated Devin principal.',
                'icon' => 'ph:user',
            ],
            'devin_list_secrets' => [
                'class' => DevinListSecrets::class,
                'type' => 'read',
                'name' => 'List Secrets',
                'description' => 'List Devin v3 organization secrets.',
                'icon' => 'ph:key',
            ],
            'devin_create_secret' => [
                'class' => DevinCreateSecret::class,
                'type' => 'write',
                'name' => 'Create Secret',
                'description' => 'Create a Devin v3 organization secret.',
                'icon' => 'ph:keyhole',
            ],
            'devin_delete_secret' => [
                'class' => DevinDeleteSecret::class,
                'type' => 'write',
                'name' => 'Delete Secret',
                'description' => 'Delete a Devin v3 organization secret.',
                'icon' => 'ph:trash',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/devin.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'org_id', 'type' => 'text', 'label' => 'Organization ID', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'Devin API URL', 'required' => false, 'default' => 'https://api.devin.ai'],
            ['key' => 'api_version', 'type' => 'select', 'label' => 'API Version', 'required' => false, 'default' => 'v3'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Devin service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): DevinService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DevinService(
                apiKey: $creds->get('devin', 'api_key', '', $account),
                baseUrl: $creds->get('devin', 'url', 'https://api.devin.ai', $account),
                orgId: $creds->get('devin', 'org_id', '', $account),
                apiVersion: $creds->get('devin', 'api_version', 'v3', $account),
            );
        }

        return app(DevinService::class);
    }
}
