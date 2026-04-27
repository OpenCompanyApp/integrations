<?php

namespace OpenCompany\Integrations\Devin;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Devin\Tools\DevinCreateSession;
use OpenCompany\Integrations\Devin\Tools\DevinGetSession;
use OpenCompany\Integrations\Devin\Tools\DevinListSessions;
use OpenCompany\Integrations\Devin\Tools\DevinSendMessage;
use OpenCompany\Integrations\Devin\Tools\DevinGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
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
        return 'devin';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'sessions, messages',
            'description' => 'AI software engineer',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:devin',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Devin',
            'description' => 'Autonomous AI software engineer — create sessions, send messages, and manage tasks',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:devin',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://docs.devin.ai/api-reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Devin API key',
                'hint' => 'Generate an API key in your Devin account settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.devin.ai/v1',
                'hint' => 'The Devin API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.devin.ai/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.devin.ai/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/sessions');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Devin API at {$baseUrl}. Check the URL.",
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
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'devin_create_session' => [
                'class' => DevinCreateSession::class,
                'type' => 'write',
                'name' => 'Create Session',
                'description' => 'Create a new Devin AI session with a task prompt.',
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
                'description' => 'List all Devin sessions.',
                'icon' => 'ph:list',
            ],
            'devin_send_message' => [
                'class' => DevinSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message to an existing Devin session.',
                'icon' => 'ph:chat-circle-text',
            ],
            'devin_get_current_user' => [
                'class' => DevinGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get information about the currently authenticated Devin user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/devin.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Devin API URL', 'required' => false, 'default' => 'https://api.devin.ai/v1'],
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

            $service = new DevinService(
                apiKey: $creds->get('devin', 'api_key', '', $account),
                baseUrl: $creds->get('devin', 'url', 'https://api.devin.ai/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(DevinService::class));
    }
}
